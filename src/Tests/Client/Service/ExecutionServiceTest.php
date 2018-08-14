<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午12:10
 */

namespace Activiti\Tests\Client\Service;


use Activiti\Client\ModelFactoryInterface;
use Activiti\Client\ObjectSerializerInterface;
use Activiti\Client\Service\ExecutionService;
use GuzzleHttp\ClientInterface;

class ExecutionServiceTest extends AbstractServiceTest
{

    public function testGetExecution() {
        $executionId = $this->getExampleExecutionId();
        $expected = $this->getExampleExecution();
        $client = $this->createClient($this->createJsonResponse($expected, 200));
        $actual = $this
            ->createExecutionService($client)
            ->getExecution($executionId);
        $this->assertRequestMethod('GET');
        $this->assertRequestUri('runtime/executions/' . $executionId);
    }

    private function createExecutionService(ClientInterface $client, ObjectSerializerInterface $objectSerializer = null)
    {
        $modelFactory = $this->createMock(ModelFactoryInterface::class);
        if ($objectSerializer === null) {
            $objectSerializer = $this->createMock(ObjectSerializerInterface::class);
        }

        return new ExecutionService($client, $modelFactory, $objectSerializer);
    }

    public function getExampleExecutionId () {
        return 5;
    }

    public function getExampleExecution() {
        return [
            'id'    =>  5,
            'url'   =>  'http://localhost:8081/runtime/executions/5',
            'parentId'  =>  null,
            'parentUrl' =>  null,
            'processInstanceId' =>  5,
            'processInstanceUrl'    =>  'http://localhost:8081/runtime/process-instances/5',
            'suspended' =>  false,
            'activityId'    =>  null,
            'tenantId'  =>  null
        ];
    }

}