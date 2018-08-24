<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\IdentityLink;
use Activiti\Client\Model\IdentityLinkList;
use Activiti\Client\Model\Task\Attachment;
use Activiti\Client\Model\Task\AttachmentList;
use Activiti\Client\Model\Task\Comment;
use Activiti\Client\Model\Task\CommentList;
use Activiti\Client\Model\Task\Event;
use Activiti\Client\Model\Task\EventList;
use Activiti\Client\Model\Task\Task;
use Activiti\Client\Model\Task\TaskList;
use Activiti\Client\Model\Task\TaskQuery;
use Activiti\Client\Model\Task\TaskUpdate;
use Activiti\Client\Model\Variable;
use Activiti\Client\Model\VariableList;
use GuzzleHttp\ClientInterface;
use function GuzzleHttp\uri_template;

class TaskService extends AbstractService implements TaskServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function queryTasks(TaskQuery $query = null)
    {
        return $this->call(function (ClientInterface $client) use ($query) {
            $json = $this->serializer->serialize($query);
            if ($json != null) {
                $json = array_filter($json);
            }
            return $client->request('POST', 'query/tasks', [
                'json' => $json,
            ]);
        }, TaskList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getTask($taskId)
    {
        return $this->call(function (ClientInterface $client) use ($taskId) {
            return $client->request('GET', uri_template('runtime/tasks/{taskId}', [
                'taskId' => $taskId,
            ]));
        }, Task::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getTaskList(TaskQuery $query = null)
    {
        return $this->call(function (ClientInterface $client) use ($query) {
            return $client->request('GET', 'runtime/tasks', [
                'query' => $this->serializer->serialize($query),
            ]);
        }, TaskList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function updateTask($taskId, TaskUpdate $data)
    {
        return $this->call(function (ClientInterface $client) use ($taskId, $data) {
            $uri = uri_template('runtime/tasks/{taskId}', ['taskId' => $taskId]);

            return $client->request('PUT', $uri, [
                'json' => $this->serializer->serialize($data),
            ]);
        }, Task::class);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteTask($taskId, $cascadeHistory = null, $deleteReason = null)
    {
        $this->call(function (ClientInterface $client) use ($taskId, $cascadeHistory, $deleteReason) {
            $uri = uri_template('runtime/tasks/{taskId}', [
                'taskId' => $taskId,
            ]);

            return $client->request('DELETE', $uri, [
                'query' => [
                    'cascadeHistory' => $cascadeHistory,
                    'deleteReason' => $deleteReason,
                ],
            ]);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function complete($taskId, array $variables = [])
    {
        return $this->callTaskAction($taskId, 'complete', [
            'variables' => $variables,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function claim($taskId, $assignee)
    {
        return $this->callTaskAction($taskId, 'claim', [
            'assignee' => $assignee,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function delegate($taskId, $assignee)
    {
        return $this->callTaskAction($taskId, 'delegate', [
            'assignee' => $assignee,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function resolve($taskId)
    {
        return $this->callTaskAction($taskId, 'resolve');
    }

    /**
     * {@inheritdoc}
     */
    public function getVariables($taskId, $scope = null)
    {
        return $this->call(function (ClientInterface $client) use ($taskId, $scope) {
            $uri = uri_template('runtime/tasks/{taskId}/variables', [
                'taskId' => $taskId,
            ]);

            return $client->request('GET', $uri, [
                'query' => [
                    'scope' => $scope,
                ],
            ]);
        }, VariableList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getVariable($taskId, $variableName, $scope = null)
    {
        return $this->call(function (ClientInterface $client) use ($taskId, $variableName, $scope) {
            $uri = uri_template('runtime/tasks/{taskId}/variables/{variableName}', [
                'taskId' => $taskId,
                'variableName' => $variableName,
            ]);

            return $client->request('GET', $uri, [
                'query' => [
                    'scope' => $scope,
                ],
            ]);
        }, Variable::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getBinaryVariable($taskId, $variableName, $scope = null)
    {
        return $this->call(function (ClientInterface $client) use ($taskId, $variableName, $scope) {
            $uri = uri_template('runtime/tasks/{taskId}/variables/{variableName}/data', [
                'taskId' => $taskId,
                'variableName' => $variableName,
            ]);

            return $client->request('GET', $uri, [
                'query' => [
                    'scope' => $scope,
                ],
            ]);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function createVariables($taskId, array $variables)
    {
        return $this->call(function (ClientInterface $client) use ($taskId, $variables) {
            $uri = uri_template('runtime/tasks/{taskId}/variables', [
                'taskId' => $taskId,
            ]);

            return $client->request('POST', $uri, [
                'json' => $this->serializer->serialize($variables),
            ]);
        }, VariableList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteVariable($taskId, $variableName, $scope = null)
    {
        $this->call(function (ClientInterface $client) use ($taskId, $variableName, $scope) {
            $uri = uri_template('runtime/tasks/{taskId}/variables/{variableName}', [
                'taskId' => $taskId,
                'variableName' => $variableName,
            ]);

            return $client->request('DELETE', $uri, [
                'query' => [
                    'scope' => $scope,
                ],
            ]);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function deleteLocalVariables($taskId)
    {
        $this->call(function (ClientInterface $client) use ($taskId) {
            $uri = uri_template('runtime/tasks/{taskId}/variables', [
                'taskId' => $taskId,
            ]);

            return $client->request('DELETE', $uri);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentityLinks($taskId)
    {
        return $this->call(function (ClientInterface $client) use ($taskId) {
            $uri = uri_template('runtime/tasks/{taskId}/identitylinks', [
                'taskId' => $taskId,
            ]);

            return $client->request('GET', $uri);
        }, IdentityLinkList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getUsersIdentityLinks($taskId)
    {
        return $this->call(function (ClientInterface $client) use ($taskId) {
            $uri = uri_template('runtime/tasks/{taskId}/identitylinks/users', [
                'taskId' => $taskId,
            ]);

            return $client->request('GET', $uri);
        }, IdentityLinkList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getGroupsIdentityLinks($taskId)
    {
        return $this->call(function (ClientInterface $client) use ($taskId) {
            $uri = uri_template('runtime/tasks/{taskId}/identitylinks/groups', [
                'taskId' => $taskId,
            ]);

            return $client->request('GET', $uri);
        }, IdentityLinkList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentityLink($taskId, $family, $identityId, $type)
    {
        return $this->call(function (ClientInterface $client) use ($taskId, $family, $identityId, $type) {
            $uri = uri_template('runtime/tasks/{taskId}/identitylinks/{family}/{identityId}/{type}', [
                'taskId' => $taskId,
                'family' => $family,
                'identityId' => $identityId,
                'type' => $type,
            ]);

            return $client->request('GET', $uri);
        }, IdentityLink::class);
    }

    /**
     * {@inheritdoc}
     */
    public function createIdentityLink($taskId, $family, $identityId, $type)
    {
        return $this->call(function (ClientInterface $client) use ($taskId, $family, $identityId, $type) {
            $uri = uri_template('runtime/tasks/{taskId}/identitylinks', [
                'taskId' => $taskId,
            ]);

            $payload = [
                'type' => $type,
            ];

            switch ($family) {
                case 'groups':
                    $payload['group'] = $identityId;
                    break;
                case 'users':
                    $payload['user'] = $identityId;
                    break;
                default:
                    throw new \InvalidArgumentException("Invalid family: $family");
            }
            return $client->request('POST', $uri, [
                'json' => $payload,
            ]);
        }, IdentityLink::class);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteIdentityLink($taskId, $family, $identityId, $type)
    {
        $this->call(function (ClientInterface $client) use ($taskId, $family, $identityId, $type) {
            $uri = uri_template('runtime/tasks/{taskId}/identitylinks/{family}/{identityId}/{type}', [
                'taskId' => $taskId,
                'family' => $family,
                'identityId' => $identityId,
                'type' => $type,
            ]);

            return $client->request('DELETE', $uri);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function createComment($taskId, $message, $saveProcessInstanceId = false)
    {
        $uri = uri_template('runtime/tasks/{taskId}/comments', [
            'taskId' => $taskId,
        ]);

        $payload = [
            'message' => $message,
            'saveProcessInstanceId' => $saveProcessInstanceId,
        ];

        return $this->call(function (ClientInterface $client) use ($uri, $payload) {
            return $client->request('POST', $uri, [
                'json' => $payload,
            ]);
        }, Comment::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getComments($taskId)
    {
        $uri = uri_template('runtime/tasks/{taskId}/comments', [
            'taskId' => $taskId,
        ]);

        return $this->call(function (ClientInterface $client) use ($uri) {
            return $client->request('GET', $uri);
        }, CommentList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getComment($taskId, $commentId)
    {
        $uri = uri_template('runtime/tasks/{taskId}/comments/{commentId}', [
            'taskId' => $taskId,
            'commentId' => $commentId,
        ]);

        return $this->call(function (ClientInterface $client) use ($uri) {
            return $client->request('GET', $uri);
        }, Comment::class);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteComment($taskId, $commentId)
    {
        $uri = uri_template('runtime/tasks/{taskId}/comments/{commentId}', [
            'taskId' => $taskId,
            'commentId' => $commentId,
        ]);

        $this->call(function (ClientInterface $client) use ($uri) {
            return $client->request('DELETE', $uri);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getEvents($taskId)
    {
        $uri = uri_template('runtime/tasks/{taskId}/events', [
            'taskId' => $taskId,
        ]);

        return $this->call(function (ClientInterface $client) use ($uri) {
            return $client->request('GET', $uri);
        }, EventList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getEvent($taskId, $eventId)
    {
        $uri = uri_template('runtime/tasks/{taskId}/events/{eventId}', [
            'taskId' => $taskId,
            'eventId' => $eventId,
        ]);

        return $this->call(function (ClientInterface $client) use ($uri) {
            return $client->request('GET', $uri);
        }, Event::class);
    }

    /**
     * {@inheritdoc}
     */
    public function createAttachment($taskId, $name, $data, $description = null, $type = null)
    {
        $uri = uri_template('runtime/tasks/{taskId}/attachments', [
            'taskId' => $taskId,
        ]);

        $payload = $this->createCreateAttachmentPayload($name, $data, $description, $type);

        return $this->call(function (ClientInterface $client) use ($uri, $payload) {
            return $client->request('POST', $uri, [
                'multipart' => $payload,
            ]);
        }, Attachment::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttachments($taskId)
    {
        $uri = uri_template('runtime/tasks/{taskId}/attachments', [
            'taskId' => $taskId,
        ]);

        return $this->call(function (ClientInterface $client) use ($uri) {
            return $client->request('GET', $uri);
        }, AttachmentList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getAttachment($taskId, $attachmentId)
    {
        $uri = uri_template('runtime/tasks/{taskId}/attachments/{attachmentId}', [
            'taskId' => $taskId,
            'attachmentId' => $attachmentId,
        ]);

        return $this->call(function (ClientInterface $client) use ($uri) {
            return $client->request('GET', $uri);
        }, Attachment::class);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteAttachment($taskId, $attachmentId)
    {
        $uri = uri_template('runtime/tasks/{taskId}/attachments/{attachmentId}', [
            'taskId' => $taskId,
            'attachmentId' => $attachmentId,
        ]);

        $this->call(function (ClientInterface $client) use ($uri) {
            return $client->request('DELETE', $uri);
        });
    }

    protected function callTaskAction($taskId, $action, array $data = [])
    {
        return $this->call(function (ClientInterface $client) use ($taskId, $action, $data) {
            $uri = uri_template('runtime/tasks/{taskId}', [
                'taskId' => $taskId,
            ]);

            $payload = array_merge($data, [
                'action' => $action,
            ]);

            return $client->request('POST', $uri, [
                'json' => $payload,
            ]);
        }, Task::class);
    }

    private function createCreateAttachmentPayload($name, $data, $description, $type)
    {
        $payload = [
            [
                'name' => 'name',
                'contents' => $name,
            ],
        ];

        if ($description !== null) {
            $payload[] = [
                'name' => 'description',
                'contents' => $description,
            ];
        }

        if ($type !== null) {
            $payload[] = [
                'name' => 'type',
                'contents' => $type,
            ];
        }

        $payload[] = [
            'name' => 'attachment',
            'contents' => $data,
        ];

        return $payload;
    }
}
