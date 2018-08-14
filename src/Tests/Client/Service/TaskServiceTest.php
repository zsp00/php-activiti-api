<?php

namespace Activiti\Tests\Client\Service;

use Activiti\Client\Exception\ActivitiException;
use Activiti\Client\ModelFactoryInterface;
use Activiti\Client\ObjectSerializerInterface;
use Activiti\Client\Model\Task\TaskQuery;
use Activiti\Client\Model\Task\TaskUpdate;
use Activiti\Client\Model\VariableCreate;
use Activiti\Client\Service\TaskService;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Psr7\Response;

class TaskServiceTest extends AbstractServiceTest
{
    public function testGetTask()
    {
        $taskId = $this->getExampleTaskId();
        $expected = $this->getExampleTask();

        $client = $this->createClient($this->createJsonResponse($expected, 200));
        $actual = $this
            ->createTaskService($client)
            ->getTask($taskId);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId);
    }

    public function testQueryTask()
    {
        $expected = $this->getExampleTask();
        $client = $this->createClient($this->createJsonResponse($expected, 200));
        $actual = $this
            ->createTaskService($client)
            ->queryTasks(new TaskQuery(['name' => '123']));

        $this->assertRequestMethod('POST');
        $this->assertRequestUri('query/tasks');
    }

    public function testGetTaskOnNonExistingTaskId()
    {
        $this->expectException(ActivitiException::class);

        $taskId = $this->getExampleTaskId();

        $client = $this->createClient($this->createActivitiErrorResponse(
            404, "Could not find a task with id '$taskId'."
        ));

        $this
            ->createTaskService($client)
            ->getTask($taskId);
    }

    public function testGetTaskList()
    {
        $expected = [
            'data' => [
                $this->getExampleTask(),
            ],
            'total' => 1,
            'start' => 0,
            'sort' => 'name',
            'order' => 'asc',
            'size' => 1,
        ];

        $client = $this->createClient($this->createJsonResponse($expected, 200));
        $actual = $this
            ->createTaskService($client)
            ->getTaskList(new TaskQuery([]));

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks');
    }

    public function testUpdateTask()
    {
        $taskId = $this->getExampleTaskId();

        $payload = [
            'assignee' => 'assignee',
            'delegationState' => 'resolved',
            'description' => 'New task description',
            'dueDate' => '2013-04-17T13:06:02.438+02:00',
            'name' => 'New task name',
            'owner' => 'owner',
            'parentTaskId' => '3',
            'priority' => 20,
        ];

        $expected = $this->getExampleTask();

        $client = $this->createClient($this->createJsonResponse($expected, 200));

        $data = new TaskUpdate();
        $data->setAssignee('assignee');
        $data->setDelegationState('resolved');
        $data->setDescription('New task description');
        $data->setDueDate('2013-04-17T13:06:02.438+02:00');
        $data->setName('New task name');
        $data->setOwner('owner');
        $data->setParentTaskId(3);
        $data->setPriority(20);

        $actual = $this
            ->createTaskService($client, $this->createObjectSerializerMock($data, $payload))
            ->updateTask($taskId, $data);

        $this->assertRequestMethod('PUT');
        $this->assertRequestUri('runtime/tasks/' . $taskId);
        $this->assertRequestJsonPayload($payload);
    }

    /**
     * @dataProvider getUpdateFailureResponses
     */
    public function testUpdateFailure($response)
    {
        $this->expectException(ActivitiException::class);

        $this
            ->createTaskService($this->createClient($response))
            ->getTask($this->getExampleTaskId());
    }

    public function testDeleteTask()
    {
        $taskId = $this->getExampleTaskId();

        $client = $this->createClient(new Response(204));
        $actual = $this
            ->createTaskService($client)
            ->deleteTask($taskId);

        $this->assertRequestMethod('DELETE');
        $this->assertRequestUri('runtime/tasks/' . $taskId);
        $this->assertNull($actual);
    }

    public function testDeleteTaskWithNonExistingTaskId()
    {
        $this->expectException(ActivitiException::class);

        $taskId = $this->getExampleTaskId();
        $client = $this->createClient($this->createActivitiErrorResponse(
            404, "Could not find a task with id '$taskId'."
        ));

        $this
            ->createTaskService($client)
            ->deleteTask($taskId);
    }

    public function testComplete()
    {
        $expectedPayload = [
            'action' => 'complete',
            'variables' => [],
        ];

        $extraArgs = [];

        $this->doTestTaskActionSuccess('complete', $extraArgs, $expectedPayload);
    }

    /**
     * @dataProvider getActionFailureResponses
     */
    public function testCompleteFailure(Response $response)
    {
        $this->expectException(ActivitiException::class);

        $this
            ->createTaskService($this->createClient($response))
            ->getTask($this->getExampleTaskId());
    }

    public function testClaim()
    {
        $expectedPayload = [
            'action' => 'claim',
            'assignee' => 'kermit',
        ];

        $this->doTestTaskActionSuccess('claim', ['kermit'], $expectedPayload);
    }

    /**
     * @dataProvider getUpdateFailureResponses
     */
    public function testClaimFailure(Response $response)
    {
        $this->expectException(ActivitiException::class);

        $this
            ->createTaskService($this->createClient($response))
            ->getTask($this->getExampleTaskId());
    }

    public function testDelegate()
    {
        $expectedPayload = [
            'action' => 'delegate',
            'assignee' => 'kermit',
        ];

        $this->doTestTaskActionSuccess('delegate', ['kermit'], $expectedPayload);
    }

    /**
     * @dataProvider getUpdateFailureResponses
     */
    public function testDelegateFailure(Response $response)
    {
        $this->doTestTaskActionFailure('delegate', $response, [$this->getExampleTaskId(), 'kermit']);
    }

    public function testResolve()
    {
        $action = 'resolve';
        $payload = [
            'action' => $action,
        ];

        $this->doTestTaskActionSuccess($action, [], $payload);
    }

    /**
     * @dataProvider getUpdateFailureResponses
     */
    public function testResolveFailure(Response $response)
    {
        $this->doTestTaskActionFailure('resolve', $response, [$this->getExampleTaskId()]);
    }

    public function testGetVariables()
    {
        $taskId = $this->getExampleTaskId();
        $scope = null;

        $expected = [
            [
                'name' => 'intProcVar',
                'type' => 'integer',
                'value' => 123,
                'scope' => 'local',
            ],
            [
                'name' => 'hello',
                'type' => 'string',
                'value' => 'Hello World!',
                'scope' => 'global',
            ],
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getVariables($taskId, $scope);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/variables');
    }

    public function testGetVariable()
    {
        $taskId = $this->getExampleTaskId();
        $variableName = 'foo';
        $scope = null;

        $expected = [
            'name' => 'hello',
            'type' => 'string',
            'value' => 'Hello World!',
            'scope' => 'global',
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getVariable($taskId, $variableName, $scope);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/variables/' . $variableName);
    }

    public function testGetBinaryVariable()
    {
        $taskId = $this->getExampleTaskId();
        $variableName = 'foo';
        $scope = null;

        $expected = '(some binary data)';

        $client = $this->createClient(new Response(200, [], $expected));
        $actual = $this
            ->createTaskService($client)
            ->getBinaryVariable($taskId, $variableName, $scope);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/variables/' . $variableName . '/data');
        $this->assertEquals($expected, $actual);
    }

    public function testCreateVariables()
    {
        $taskId = $this->getExampleTaskId();

        $expected = [
            [
                'name' => 'intProcVar',
                'type' => 'integer',
                'value' => 123,
                'scope' => 'local',
            ],
        ];

        $payload = [
            [
                'name' => 'intProcVar',
                'type' => 'integer',
                'value' => 123,
            ],
        ];

        $variable = new VariableCreate();
        $variable->setName('intProcVar');
        $variable->setType('integer');
        $variable->setValue(123);

        $client = $this->createClient($this->createJsonResponse($expected, 201));
        $actual = $this
            ->createTaskService($client, $this->createObjectSerializerMock([$variable], $payload))
            ->createVariables($taskId, [$variable]);

        $this->assertRequestMethod('POST');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/variables');
        $this->assertRequestJsonPayload($payload);
    }

    public function testDeleteVariable()
    {
        $taskId = $this->getExampleTaskId();
        $variableName = 'foo';
        $scope = null;

        $client = $this->createClient(new Response(204));
        $actual = $this
            ->createTaskService($client)
            ->deleteVariable($taskId, $variableName, $scope);

        $this->assertRequestMethod('DELETE');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/variables/' . $variableName);
        $this->assertnull($actual);
    }

    public function testDeleteLocalVariables()
    {
        $taskId = $this->getExampleTaskId();

        $client = $this->createClient(new Response(204));
        $actual = $this
            ->createTaskService($client)
            ->deleteLocalVariables($taskId);

        $this->assertRequestMethod('DELETE');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/variables');
        $this->assertnull($actual);
    }

    public function testGetIdentityLinks()
    {
        $taskId = $this->getExampleTaskId();

        $expected = [
            [
                'user' => 'kermit',
                'group' => null,
                'type' => 'candidate',
                'url' => 'http://localhost:8081/activiti-rest/service/runtime/tasks/' . $taskId . '/identitylinks/users/kermit/candidate',
            ],
            [
                'user' => null,
                'group' => 'sales',
                'type' => 'candidate',
                'url' => 'http://localhost:8081/activiti-rest/service/runtime/tasks/' . $taskId . '/identitylinks/groups/sales/candidate',
            ],
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getIdentityLinks($taskId);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/identitylinks');
    }

    public function testGetUsersIdentityLinks()
    {
        $taskId = $this->getExampleTaskId();

        $expected = [
            [
                'user' => 'kermit',
                'group' => null,
                'type' => 'candidate',
                'url' => 'http://localhost:8081/activiti-rest/service/runtime/tasks/' . $taskId . '/identitylinks/users/kermit/candidate',
            ],
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getUsersIdentityLinks($taskId);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/identitylinks/users');
    }

    public function testGetGroupsIdentityLinks()
    {
        $taskId = $this->getExampleTaskId();

        $expected = [
            [
                'user' => null,
                'group' => 'sales',
                'type' => 'candidate',
                'url' => 'http://localhost:8081/activiti-rest/service/runtime/tasks/' . $taskId . '/identitylinks/groups/sales/candidate',
            ],
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getGroupsIdentityLinks($taskId);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/identitylinks/groups');
    }

    public function testGetIdentityLink()
    {
        $taskId = $this->getExampleTaskId();
        $family = 'groups';
        $identityId = 'sales';
        $type = 'candidate';

        $expected = [
            'user' => null,
            'group' => 'sales',
            'type' => 'candidate',
            'url' => 'http://localhost:8081/activiti-rest/service/runtime/tasks/' . $taskId . '/identitylinks/groups/sales/candidate',
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getIdentityLink($taskId, $family, $identityId, $type);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/identitylinks/' . $family . '/' . $identityId . '/' . $type);
    }

    public function testCreateIdentityLink()
    {
        $taskId = $this->getExampleTaskId();
        $family = 'groups';
        $identityId = 'sales';
        $type = 'candidate';

        $expected = [
            'url' => 'http://localhost:8081/activiti-rest/service/runtime/tasks/' . $taskId . '/identitylinks/' . $family . '/' . $identityId . '/' . $type,
            'user' => null,
            'group' => $identityId,
            'type' => $type,
        ];

        $payload = [
            'groupId' => $identityId,
            'type' => $type,
        ];

        $client = $this->createClient($this->createJsonResponse($expected, 201));
        $actual = $this
            ->createTaskService($client)
            ->createIdentityLink($taskId, $family, $identityId, $type);

        $this->assertRequestMethod('POST');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/identitylinks');
        $this->assertRequestJsonPayload($payload);
    }

    public function testDeleteIdentityLink()
    {
        $taskId = $this->getExampleTaskId();
        $family = 'groups';
        $identityId = 'sales';
        $type = 'candidate';

        $client = $this->createClient(new Response(204));
        $actual = $this
            ->createTaskService($client)
            ->deleteIdentityLink($taskId, $family, $identityId, $type);

        $this->assertRequestMethod('DELETE');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/identitylinks/' . $family . '/' . $identityId . '/' . $type);
        $this->assertNull($actual);
    }

    public function testCreateComment()
    {
        $taskId = $this->getExampleTaskId();
        $message = 'This is a comment on the task.';
        $saveProcessInstanceId = false;

        $expected = [
            'id' => 3,
            'taskUrl' => 'http://localhost:8081/activiti-rest/service/runtime/tasks/' . $taskId . '/comments/3',
            'processInstanceUrl' => 'http://localhost:8081/activiti-rest/service/history/historic-process-instances/' . $taskId . '/comments/3',
            'message' => $message,
            'author' => 'kermit',
            'time' => '2014-07-13T13:13:52.232+08:00',
            'taskId' => $taskId,
            'processInstanceId' => '100',
        ];

        $payload = [
            'message' => $message,
            'saveProcessInstanceId' => $saveProcessInstanceId,
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->createComment($taskId, $message, $saveProcessInstanceId);

        $this->assertRequestMethod('POST');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/comments');
        $this->assertRequestJsonPayload($payload);
    }

    public function testGetComments()
    {
        $taskId = $this->getExampleTaskId();

        $expected = [
            [
                'id' => '123',
                'taskUrl' => 'http://localhost:8081/activiti-rest/service/runtime/tasks/' . $taskId . '/comments/123',
                'processInstanceUrl' => 'http://localhost:8081/activiti-rest/service/history/historic-process-instances/' . $taskId . '/comments/123',
                'message' => 'This is a comment on the task.',
                'author' => 'kermit',
                'time' => '2014-07-13T13:13:52.232+08:00',
                'taskId' => '101',
                'processInstanceId' => '100',
            ],
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getComments($taskId);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/comments');
    }

    public function testGetComment()
    {
        $taskId = $this->getExampleTaskId();
        $commentId = 123;

        $expected = [
            'id' => $commentId,
            'taskUrl' => 'http://localhost:8081/activiti-rest/service/runtime/tasks/' . $taskId . '/comments/' . $commentId,
            'processInstanceUrl' => 'http://localhost:8081/activiti-rest/service/history/historic-process-instances/' . $taskId . '/comments/' . $commentId,
            'message' => 'This is a comment on the task.',
            'author' => 'kermit',
            'time' => '2014-07-13T13:13:52.232+08:00',
            'taskId' => $taskId,
            'processInstanceId' => '100',
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getComment($taskId, $commentId);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/comments/' . $commentId);
    }

    public function testDeleteComment()
    {
        $taskId = $this->getExampleTaskId();
        $commentId = 123456;

        $client = $this->createClient(new Response(204));
        $actual = $this
            ->createTaskService($client)
            ->deleteComment($taskId, $commentId);

        $this->assertRequestMethod('DELETE');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/comments/' . $commentId);
        $this->assertnull($actual);
    }

    public function testGetEvents()
    {
        $taskId = $this->getExampleTaskId();

        $expected = [
            [
                'action' => 'AddUserLink',
                'id' => '4',
                'message' => [
                    'gonzo',
                    'contributor',
                ],
                'taskUrl' => 'http://localhost:8182/runtime/tasks/' . $taskId,
                'time' => '2013-05-17T11:50:50.000+0000',
                'url' => 'http://localhost:8182/runtime/tasks/' . $taskId . '/events/4',
                'userId' => null,
            ],
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getEvents($taskId);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/events');
    }

    public function testGetEvent()
    {
        $taskId = $this->getExampleTaskId();
        $eventId = 4;

        $expected = [
            'action' => 'AddUserLink',
            'id' => $eventId,
            'message' => [
                'gonzo',
                'contributor',
            ],
            'taskUrl' => 'http://localhost:8182/runtime/tasks/' . $taskId,
            'time' => '2013-05-17T11:50:50.000+0000',
            'url' => 'http://localhost:8182/runtime/tasks/' . $taskId . '/events/' . $eventId,
            'userId' => null,
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getEvent($taskId, $eventId);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/events/' . $eventId);
    }

    public function testCreateAttachment()
    {
        $taskId = $this->getExampleTaskId();
        $name = 'Simple attachment';
        $description = 'Simple attachment description';
        $type = 'simpleType';
        $data = 'http://google.com';

        $expected = [
            'id' => 3,
            'url' => 'http://localhost:8182/runtime/tasks/' . $taskId . '/attachments',
            'name' => 'Simple attachment',
            'description' => 'Simple attachment description',
            'type' => 'simpleType',
            'taskUrl' => 'http://localhost:8182/runtime/tasks/' . $taskId,
            'processInstanceUrl' => null,
            'externalUrl' => 'http://activiti.org',
            'contentUrl' => null,
        ];

        $payload = [
            'name' => $name,
            'description' => $description,
            'type' => $type,
        ];

        $client = $this->createClient($this->createJsonResponse($expected, 201));
        $actual = $this
            ->createTaskService($client)
            ->createAttachment($taskId, $name, $data, $description, $type);

        $this->assertRequestMethod('POST');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/attachments');
        $this->assertRequestContentType('multipart/form-data');
        // TODO: Assert payload
    }

    public function testGetAttachments()
    {
        $taskId = $this->getExampleTaskId();

        $expected = [
            [
                'id' => '3',
                'url' => 'http://localhost:8182/runtime/tasks/' . $taskId . '/attachments/3',
                'name' => 'Simple attachment',
                'description' => 'Simple attachment description',
                'type' => 'simpleType',
                'taskUrl' => 'http://localhost:8182/runtime/tasks/' . $taskId,
                'processInstanceUrl' => null,
                'externalUrl' => 'http://activiti.org',
                'contentUrl' => null,
            ],
            [
                'id' => '5',
                'url' => 'http://localhost:8182/runtime/tasks/' . $taskId . '/attachments/5',
                'name' => 'Binary attachment',
                'description' => 'Binary attachment description',
                'type' => 'binaryType',
                'taskUrl' => 'http://localhost:8182/runtime/tasks/' . $taskId,
                'processInstanceUrl' => null,
                'externalUrl' => null,
                'contentUrl' => 'http://localhost:8182/runtime/tasks/' . $taskId . '/attachments/5/content',
            ],
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getAttachments($taskId);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/attachments');
    }

    public function testGetAttachment()
    {
        $taskId = $this->getExampleTaskId();
        $attachmentId = 3;

        $expected = [
            'id' => $attachmentId,
            'url' => 'http://localhost:8182/runtime/tasks/' . $taskId . '/attachments/' . $attachmentId,
            'name' => 'Simple attachment',
            'description' => 'Simple attachment description',
            'type' => 'simpleType',
            'taskUrl' => 'http://localhost:8182/runtime/tasks/' . $taskId,
            'processInstanceUrl' => null,
            'externalUrl' => 'http://activiti.org',
            'contentUrl' => null,
        ];

        $client = $this->createClient($this->createJsonResponse($expected));
        $actual = $this
            ->createTaskService($client)
            ->getAttachment($taskId, $attachmentId);

        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/attachments/' . $attachmentId);
    }

    public function testDeleteAttachment()
    {
        $taskId = $this->getExampleTaskId();
        $attachmentId = 123456;

        $client = $this->createClient(new Response(204));
        $actual = $this
            ->createTaskService($client)
            ->deleteAttachment($taskId, $attachmentId);

        $this->assertRequestMethod('DELETE');
        $this->assertRequestUri('runtime/tasks/' . $taskId . '/attachments/' . $attachmentId);
        $this->assertNull($actual);
    }

    public function getUpdateFailureResponses()
    {
        return [
            [
                'response' => $this->createActivitiErrorResponse(404),
            ],
            [
                'response' => $this->createActivitiErrorResponse(409),
            ],
        ];
    }

    public function getActionFailureResponses()
    {
        return [
            [
                'response' => $this->createActivitiErrorResponse(400),
            ],
            [
                'response' => $this->createActivitiErrorResponse(404),
            ],
            [
                'response' => $this->createActivitiErrorResponse(409),
            ],
        ];
    }

    private function createTaskService(ClientInterface $client, ObjectSerializerInterface $objectSerializer = null)
    {
        $modelFactory = $this->createMock(ModelFactoryInterface::class);
        if ($objectSerializer === null) {
            $objectSerializer = $this->createMock(ObjectSerializerInterface::class);
        }

        return new TaskService($client, $modelFactory, $objectSerializer);
    }

    private function doTestTaskActionSuccess($action, array $args = [], array $payload = [])
    {
        $taskId = $this->getExampleTaskId();
        $expected = $this->getExampleTask();

        $client = $this->createClient($this->createJsonResponse($expected, 200));
        $service = $this->createTaskService($client);

        // Call task action
        $actual = call_user_func_array([$service, $action], array_merge([$taskId], $args));

        $this->assertRequestMethod('POST');
        $this->assertRequestUri('runtime/tasks/' . urlencode($taskId));
        $this->assertRequestJsonPayload($payload);
    }

    private function doTestTaskActionFailure($action, Response $response, array $args)
    {
        $this->expectException(ActivitiException::class);

        $service = $this->createTaskService($this->createClient($response));
        $service->{$action}(...$args);
    }

    private function getExampleTaskId()
    {
        return 7513;
    }

    private function getExampleTask()
    {
        return [
            'id' => '7513',
            'url' => 'http://localhost:8080/activiti-rest/service/runtime/tasks/7513',
            'owner' => null,
            'assignee' => null,
            'delegationState' => null,
            'name' => 'Handle escalated issue',
            'description' => 'Escalation: issue was not fixed in time by first level support',
            'createTime' => '2017-06-18T13:29:44.019+02:00',
            'dueDate' => null,
            'priority' => 50,
            'suspended' => false,
            'taskDefinitionKey' => 'handleEscalation',
            'tenantId' => '',
            'category' => null,
            'formKey' => null,
            'parentTaskId' => null,
            'parentTaskUrl' => null,
            'executionId' => '7508',
            'executionUrl' => 'http://localhost:8080/activiti-rest/service/runtime/executions/7508',
            'processInstanceId' => '7501',
            'processInstanceUrl' => 'http://localhost:8080/activiti-rest/service/runtime/process-instances/7501',
            'processDefinitionId' => 'escalationExample:6:5006',
            'processDefinitionUrl' => 'http://localhost:8080/activiti-rest/service/repository/process-definitions/escalationExample:6:5006',
            'variables' => [],
        ];
    }
}
