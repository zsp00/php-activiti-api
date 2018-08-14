<?php

namespace Activiti\Client;

use Activiti\Client\Service\DeploymentService;
use Activiti\Client\Service\GroupService;
use Activiti\Client\Service\ManagementService;
use Activiti\Client\Service\ProcessDefinitionService;
use Activiti\Client\Service\ProcessInstanceService;
use Activiti\Client\Service\TaskService;
use Activiti\Client\Service\UserService;
use GuzzleHttp\ClientInterface;
use Activiti\Client\Service\ExecutionService;

class ServiceFactory implements ServiceFactoryInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @var ModelFactoryInterface
     */
    private $modelFactory;

    /**
     * @var ObjectSerializerInterface
     */
    private $objectSerializer;

    public function __construct(ClientInterface $client, ModelFactoryInterface $modelFactory, ObjectSerializerInterface $objectSerializer)
    {
        $this->client = $client;
        $this->modelFactory = $modelFactory;
        $this->objectSerializer = $objectSerializer;
    }

    /**
     * {@inheritdoc}
     */
    public function createDeploymentService()
    {
        return new DeploymentService($this->client, $this->modelFactory, $this->objectSerializer);
    }

    /**
     * {@inheritdoc}
     */
    public function createGroupService()
    {
        return new GroupService($this->client, $this->modelFactory, $this->objectSerializer);
    }

    /**
     * {@inheritdoc}
     */
    public function createManagementService()
    {
        return new ManagementService($this->client, $this->modelFactory, $this->objectSerializer);
    }

    /**
     * {@inheritdoc}
     */
    public function createProcessDefinitionService()
    {
        return new ProcessDefinitionService($this->client, $this->modelFactory, $this->objectSerializer);
    }

    /**
     * {@inheritdoc}
     */
    public function createProcessInstanceService()
    {
        return new ProcessInstanceService($this->client, $this->modelFactory, $this->objectSerializer);
    }

    /**
     * {@inheritdoc}
     */
    public function createTaskService()
    {
        return new TaskService($this->client, $this->modelFactory, $this->objectSerializer);
    }

    /**
     * {@inheritdoc}
     */
    public function createUserService()
    {
        return new UserService($this->client, $this->modelFactory, $this->objectSerializer);
    }

    /**
     * {@inheritdoc}
     */
    public function createExecutionService() {
        return new ExecutionService($this->client, $this->modelFactory, $this->objectSerializer);
    }
}
