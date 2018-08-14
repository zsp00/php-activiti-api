<?php

namespace Activiti\Client;

use Activiti\Client\Service\DeploymentServiceInterface;
use Activiti\Client\Service\GroupServiceInterface;
use Activiti\Client\Service\ManagementServiceInterface;
use Activiti\Client\Service\ProcessDefinitionServiceInterface;
use Activiti\Client\Service\ProcessInstanceServiceInterface;
use Activiti\Client\Service\TaskServiceInterface;
use Activiti\Client\Service\UserServiceInterface;

interface ServiceFactoryInterface
{
    /**
     * @return DeploymentServiceInterface
     */
    public function createDeploymentService();

    /**
     * @return GroupServiceInterface
     */
    public function createGroupService();

    /**
     * @return ManagementServiceInterface
     */
    public function createManagementService();

    /**
     * @return ProcessDefinitionServiceInterface
     */
    public function createProcessDefinitionService();

    /**
     * @return ProcessInstanceServiceInterface
     */
    public function createProcessInstanceService();

    /**
     * @return TaskServiceInterface
     */
    public function createTaskService();

    /**
     * @return UserServiceInterface
     */
    public function createUserService();

    /**
     * @return ExecutionServiceInterface
     */
    public function createExecutionService();
}
