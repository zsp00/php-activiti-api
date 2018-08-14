<?php

namespace Activiti\Client\Model\Execution;

use Activiti\Client\Model\AbstractQuery;

class ExecutionQuery extends AbstractQuery
{
    private $id;

    private $activityId;

    private $processDefinitionKey;

    private $processDefinitionId;

    private $processInstanceId;

    private $messageEventSubscriptionName;

    private $signalEventSubscriptionName;

    private $parentId;

    private $tenantId;

    private $tenantIdLike;

    private $withoutTenantId;

    private $sort;

    public function getId() {
      return $this->id;
    }

    public function setId($id) {
      $this->id = $id;
    }

    public function getActivityId() {
      return $this->activityId;
    }

    public function setActivityId($activityId) {
      $this->activityId = $activityId;
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionKey()
    {
        return $this->processDefinitionKey;
    }

    /**
     * @param mixed $processDefinitionKey
     */
    public function setProcessDefinitionKey($processDefinitionKey)
    {
        $this->processDefinitionKey = $processDefinitionKey;
    }


    /**
     * @return mixed
     */
    public function getProcessDefinitionId()
    {
        return $this->processDefinitionId;
    }

    /**
     * @param mixed $processDefinitionId
     */
    public function setProcessDefinitionId($processDefinitionId)
    {
        $this->processDefinitionId = $processDefinitionId;
    }

    /**
     * @return mixed
     */
    public function getProcessInstanceId()
    {
        return $this->processInstanceId;
    }

    /**
     * @param mixed $processInstanceId
     */
    public function setProcessInstanceId($processInstanceId)
    {
        $this->processInstanceId = $processInstanceId;
    }

    /**
     * @return mixed
     */
    public function getMessageEventSubscriptionName()
    {
        return $this->messageEventSubscriptionName;
    }

    /**
     * @param mixed $messageEventSubscriptionName
     */
    public function setMessageEventSubscriptionName($messageEventSubscriptionName)
    {
        $this->messageEventSubscriptionName = $messageEventSubscriptionName;
    }

    /**
     * @return mixed
     */
    public function getSignalEventSubscriptionName()
    {
        return $this->signalEventSubscriptionName;
    }

    /**
     * @param mixed $signalEventSubscriptionName
     */
    public function setSignalEventSubscriptionName($signalEventSubscriptionName)
    {
        $this->signalEventSubscriptionName = $signalEventSubscriptionName;
    }

    /**
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param mixed $parentId
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    }

    /**
     * @return mixed
     */
    public function getTenantId()
    {
        return $this->tenantId;
    }

    /**
     * @param mixed $tenantId
     */
    public function setTenantId($tenantId)
    {
        $this->tenantId = $tenantId;
    }

    /**
     * @return mixed
     */
    public function getTenantIdLike()
    {
        return $this->tenantIdLike;
    }

    /**
     * @param mixed $tenantIdLike
     */
    public function setTenantIdLike($tenantIdLike)
    {
        $this->tenantIdLike = $tenantIdLike;
    }

    /**
     * @return mixed
     */
    public function getWithoutTenantId()
    {
        return $this->withoutTenantId;
    }

    /**
     * @param mixed $withoutTenantId
     */
    public function setWithoutTenantId($withoutTenantId)
    {
        $this->withoutTenantId = $withoutTenantId;
    }

    /**
     * @return mixed
     */
    public function getSort()
    {
        return $this->sort;
    }

    /**
     * @param mixed $sort
     */
    public function setSort($sort)
    {
        $this->sort = $sort;
    }
}
