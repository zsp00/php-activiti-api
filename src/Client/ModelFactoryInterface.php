<?php

namespace Activiti\Client;

interface ModelFactoryInterface
{
    public function createAttachment(array $data);

    public function createAttachmentList(array $data);

    public function createBinaryVariable(array $data);

    public function createComment(array $data);

    public function createCommentList(array $data);

    public function createDeployment(array $data);

    public function createDeploymentList(array $data);

    public function createEngine(array $data);

    public function createEngineProperties(array $data);

    public function createEvent(array $data);

    public function createEventList(array $data);

    public function createGroup(array $data);

    public function createGroupList(array $data);

    public function createGroupMember(array $data);

    public function createIdentityLink(array $data);

    public function createIdentityLinkList(array $data);

    public function createProcessDefinition(array $data);

    public function createProcessDefinitionList(array $data);

    public function createProcessInstance(array $data);

    public function createProcessInstanceList(array $data);

    public function createResource(array $data);
    
    public function createResourceList(array $data);

    public function createTask(array $data);

    public function createTaskList(array $data);

    public function createUser(array $data);

    public function createUserInfo(array $data);

    public function createUserInfoList(array $data);

    public function createUserList(array $data);

    public function createVariable(array $data);

    public function createVariableList(array $data);

    public function createExecution(array $data);

    public function createExecutionList(array $data);

    public function createActivities(array $data);

    public function createForm(array $data);

    public function createFormList(array $data);

    public function createFormSubmitResult(array $data);

    public function createHistoricTaskInstances(array $data);

    public function createHistoricTaskInstancesList(array $data);

}
