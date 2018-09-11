<?php

namespace Activiti\Client\Model\History;

class HistoricTaskInstances
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getId()
    {
        return $this->data['id'];
    }

    public function getUrl()
    {
        return $this->data['url'];
    }

    public function getOwner()
    {
        return $this->data['owner'];
    }

    public function getAssignee()
    {
        return $this->data['assignee'];
    }

    public function getDelegationState()
    {
        return $this->data['delegationState'];
    }

    public function getName()
    {
        return $this->data['name'];
    }

    public function getDescription()
    {
        return $this->data['description'];
    }

    public function getCreateTime()
    {
        return $this->data['createTime'];
    }

    public function getDueDate()
    {
        return $this->data['dueDate'];
    }

    public function getPriority()
    {
        return $this->data['priority'];
    }

    public function getSuspended()
    {
        return $this->data['suspended'];
    }

    public function getTaskDefinitionKey()
    {
        return $this->data['taskDefinitionKey'];
    }

    public function getTenantId()
    {
        return $this->data['tenantId'];
    }

    public function getCategory()
    {
        return $this->data['category'];
    }

    public function getFormKey()
    {
        return $this->data['formKey'];
    }

    public function getParentTaskId()
    {
        return $this->data['parentTaskId'];
    }

    public function getParentTaskUrl()
    {
        return $this->data['parentTaskUrl'];
    }

    public function getExecutionId()
    {
        return $this->data['executionId'];
    }

    public function getExecutionUrl()
    {
        return $this->data['executionUrl'];
    }

    public function getProcessInstanceId()
    {
        return $this->data['processInstanceId'];
    }

    public function getProcessInstanceUrl()
    {
        return $this->data['processInstanceUrl'];
    }

    public function getProcessDefinitionId()
    {
        return $this->data['processDefinitionId'];
    }

    public function getProcessDefinitionUrl()
    {
        return $this->data['processDefinitionUrl'];
    }

    public function getTaskVariables()
    {
        return $this->data['taskVariables'];
    }

    public function getProcessVariables()
    {
        return $this->data['processVariables'];
    }

    public function getData() {
        $result = $this->data;
        foreach($result['variables'] as $k=>$v){
            $result['variables'][$k] = $v->getData();
        }
        return $result;
    }
}
