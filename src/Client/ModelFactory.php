<?php

namespace Activiti\Client;

use Activiti\Client\Model\Deployment\Deployment;
use Activiti\Client\Model\Deployment\DeploymentList;
use Activiti\Client\Model\Deployment\Resource;
use Activiti\Client\Model\Deployment\ResourceData;
use Activiti\Client\Model\Deployment\ResourceList;
use Activiti\Client\Model\Execution\Execution;
use Activiti\Client\Model\Execution\ExecutionList;
use Activiti\Client\Model\Form\Form;
use Activiti\Client\Model\Form\FormList;
use Activiti\Client\Model\Form\FormSubmitResult;
use Activiti\Client\Model\Group\Group;
use Activiti\Client\Model\Group\GroupList;
use Activiti\Client\Model\Group\GroupMember;
use Activiti\Client\Model\IdentityLink;
use Activiti\Client\Model\IdentityLinkList;
use Activiti\Client\Model\Management\Engine;
use Activiti\Client\Model\Management\EngineProperties;
use Activiti\Client\Model\ProcessDefinition\ProcessDefinition;
use Activiti\Client\Model\ProcessDefinition\ProcessDefinitionList;
use Activiti\Client\Model\ProcessInstance\ProcessInstance;
use Activiti\Client\Model\ProcessInstance\ProcessInstanceList;
use Activiti\Client\Model\Task\Activities;
use Activiti\Client\Model\Task\Attachment;
use Activiti\Client\Model\Task\AttachmentList;
use Activiti\Client\Model\Task\Comment;
use Activiti\Client\Model\Task\CommentList;
use Activiti\Client\Model\Task\Event;
use Activiti\Client\Model\Task\EventList;
use Activiti\Client\Model\Task\Task;
use Activiti\Client\Model\Task\TaskList;
use Activiti\Client\Model\User\User;
use Activiti\Client\Model\User\UserInfo;
use Activiti\Client\Model\User\UserInfoList;
use Activiti\Client\Model\User\UserList;
use Activiti\Client\Model\Variable;
use Activiti\Client\Model\VariableList;

class ModelFactory implements ModelFactoryInterface
{
    /**
     * @inheritdoc
     */
    public function createAttachment(array $data)
    {
        return new Attachment($data);
    }

    /**
     * @inheritdoc
     */
    public function createAttachmentList(array $data)
    {
        foreach ($data as $i => $item) {
            $data[$i] = $this->createAttachment($item);
        }

        return new AttachmentList($data);
    }

    /**
     * @inheritdoc
     */
    public function createBinaryVariable(array $data)
    {
        return new BinaryVariable($data);
    }

    /**
     * @inheritdoc
     */
    public function createComment(array $data)
    {
        return new Comment($data);
    }

    /**
     * @inheritdoc
     */
    public function createCommentList(array $data)
    {
        foreach ($data as $i => $item) {
            $data[$i] = $this->createComment($item);
        }

        return new CommentList($data);
    }

    /**
     * @inheritdoc
     */
    public function createDeployment(array $data)
    {
        return new Deployment($data);
    }

    /**
     * @inheritdoc
     */
    public function createDeploymentList(array $data)
    {
        foreach ($data['data'] as $i => $deploymentData) {
            $data['data'][$i] = $this->createDeployment($deploymentData);
        }

        return new DeploymentList($data);
    }

    /**
     * @inheritdoc
     */
    public function createEngine(array $data)
    {
        return new Engine($data);
    }

    /**
     * @inheritdoc
     */
    public function createEngineProperties(array $data)
    {
        return new EngineProperties($data);
    }

    /**
     * @inheritdoc
     */
    public function createEvent(array $data)
    {
        return new Event($data);
    }

    /**
     * @inheritdoc
     */
    public function createEventList(array $data)
    {
        foreach ($data as $i => $item) {
            $data[$i] = $this->createEvent($item);
        }

        return new EventList($data);
    }

    /**
     * @inheritdoc
     */
    public function createGroup(array $data)
    {
        return new Group($data);
    }

    /**
     * @inheritdoc
     */
    public function createGroupList(array $data)
    {
        foreach ($data['data'] as $i => $groupData) {
            $data['data'][$i] = $this->createGroup($groupData);
        }

        return new GroupList($data);
    }

    /**
     * @inheritdoc
     */
    public function createGroupMember(array $data)
    {
        return new GroupMember($data);
    }

    /**
     * @inheritdoc
     */
    public function createIdentityLink(array $data)
    {
        return new IdentityLink($data);
    }

    /**
     * @inheritdoc
     */
    public function createIdentityLinkList(array $data)
    {
        foreach ($data as $i => $item) {
            $data[$i] = $this->createIdentityLink($item);
        }

        return new IdentityLinkList($data);
    }

    /**
     * @inheritdoc
     */
    public function createProcessDefinition(array $data)
    {
        return new ProcessDefinition($data);
    }

    /**
     * @inheritdoc
     */
    public function createProcessDefinitionList(array $data)
    {
        foreach ($data['data'] as $i => $processDefinitionData) {
            $data['data'][$i] = $this->createProcessDefinition($processDefinitionData);
        }

        return new ProcessDefinitionList($data);
    }

    /**
     * @inheritdoc
     */
    public function createProcessInstance(array $data)
    {
        foreach ($data['variables'] as $i => $variableData) {
            $data['variables'][$i] = $this->createVariable($variableData);
        }

        return new ProcessInstance($data);
    }

    /**
     * @inheritdoc
     */
    public function createProcessInstanceList(array $data)
    {
        foreach ($data['data'] as $i => $processInstanceData) {
            $data['data'][$i] = $this->createProcessInstance($processInstanceData);
        }

        return new ProcessInstanceList($data);
    }

    /**
     * @inheritdoc
     */
    public function createResource(array $data)
    {
        return new Resource($data);
    }

    /**
     * @inheritdoc
     */
    public function createResourceList(array $data)
    {
        $result = [];
        foreach($data as $v) {
            $result[] = new Resource($result);
        }
        return new ResourceList($result);
    }

    /**
     * @inheritdoc
     */
    public function createTask(array $data)
    {
        foreach ($data['variables'] as $i => $variableData) {
            $data['variables'][$i] = $this->createVariable($variableData);
        }

        return new Task($data);
    }

    /**
     * @inheritdoc
     */
    public function createTaskList(array $data)
    {
        foreach ($data['data'] as $i => $taskData) {
            $data['data'][$i] = $this->createTask($taskData);
        }

        return new TaskList($data);
    }

    /**
     * @inheritdoc
     */
    public function createUser(array $data)
    {
        return new User($data);
    }

    /**
     * @inheritdoc
     */
    public function createUserInfo(array $data)
    {
        return new UserInfo($data);
    }

    /**
     * @inheritdoc
     */
    public function createUserInfoList(array $data)
    {
        foreach ($data as $i => $item) {
            $data[$i] = $this->createUserInfo($item);
        }

        return new UserInfoList($data);
    }

    /**
     * @inheritdoc
     */
    public function createUserList(array $data)
    {
        foreach ($data['data'] as $i => $userData) {
            $data['data'][$i] = $this->createUser($userData);
        }

        return new UserList($data);
    }

    /**
     * @inheritdoc
     */
    public function createVariable(array $data)
    {
        return new Variable($data);
    }

    /**
     * @inheritdoc
     */
    public function createVariableList(array $data)
    {
        foreach ($data as $i => $item) {
            $data[$i] = $this->createVariable($item);
        }

        return new VariableList($data);
    }

    public function createExecution(array $data)
    {
        return new Execution($data);
    }

    public function createExecutionList(array $data)
    {
        foreach ($data['data'] as $i => $taskData) {
            $data['data'][$i] = $this->createExecution($taskData);
        }

        return new ExecutionList($data);
    }

    public function createActivities(array $data) {
        return new Activities($data);
    }

    public function createForm(array $data)
    {
        $form = new Form([]);
        foreach($data as $k => $v) {
            $form->{'set'.ucfirst($k)}($v);
        }
        return $form;
    }

    public function createFormList(array $data)
    {
        foreach($data['data'] as $i => $form) {
            $data['data'][$i] = $this->createForm($form);
        }
        return new FormList($data);
    }

    public function createFormSubmitResult(array $data){
        return new FormSubmitResult($data);
    }
}
