<?php

namespace Activiti\Client\Model\History;


class HistoryActivityInstance
{
    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->data['id'];
    }

    /**
     * @return mixed
     */
    public function getActivityId()
    {
        return $this->data['activityId'];
    }

    /**
     * @return mixed
     */
    public function getActivityName()
    {
        return $this->data['activityName'];
    }

    /**
     * @return mixed
     */
    public function getActivityType()
    {
        return $this->data['activityType'];
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionId()
    {
        return $this->data['processDefinitionId'];
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionUrl()
    {
        return $this->data['processDefinitionUrl'];
    }

    /**
     * @return mixed
     */
    public function getProcessInstanceId()
    {
        return $this->data['processInstanceId'];
    }

    /**
     * @return mixed
     */
    public function getProcessInstanceUrl()
    {
        return $this->data['processInstanceUrl'];
    }

    /**
     * @return mixed
     */
    public function getExecutionId()
    {
        return $this->data['executionId'];
    }

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->data['taskId'];
    }

    /**
     * @return mixed
     */
    public function getCalledProcessInstanceId()
    {
        return $this->data['calledProcessInstanceId'];
    }

    /**
     * @return mixed
     */
    public function getAssignee()
    {
        return $this->data['assignee'];
    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->data['startTime'];
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->data['endTime'];
    }

    /**
     * @return mixed
     */
    public function getDurationInMillis()
    {
        return $this->data['durationInMillis'];
    }

    /**
     * @return mixed
     */
    public function getTenantId()
    {
        return $this->data['tenantId'];
    }
}
