<?php

namespace Activiti\Client\Model\Execution;

class Execution
{

    /**
     * @var array
     */
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getId() {
        return $this->data['id'];
    }

    public function setId($id) {
        $this->data['id'] = $id;
    }

    public function getUrl() {
        return $this->data['url'];
    }

    public function setUrl($url) {
        $this->data['url'] = $url;
    }

    public function getParentId() {
        return $this->data['parentId'];
    }

    public function setParentId($parentId) {
        $this->data['parentId'] = $parentId;
    }

    public function getParentUrl() {
        return $this->data['parentUrl'];
    }

    public function setParentUrl($parentUrl) {
        $this->data['parentUrl'] = $parentUrl;
    }

    public function getProcessInstanceId() {
        return $this->data['processInstanceId'];
    }

    public function setProcessInstanceId($processInstanceId) {
        $this->data['processInstanceId'] = $processInstanceId;
    }

    public function getProcessInstanceUrl() {
        return $this->data['processInstanceUrl'];
    }

    public function setProcessInstanceUrl($processInstanceUrl) {
        $this->data['processInstanceUrl'] = $processInstanceUrl;
    }

    public function getSuspended() {
        return $this->data['suspended'];
    }

    public function setSuspended($suspended) {
        $this->data['suspended'] = $suspended;
    }

    public function getActivityId() {
        return $this->data['activityId'];
    }

    public function setActivityId($activityId) {
        $this->data['activityId'] = $activityId;
    }

    public function getTenantId() {
        return $this->data['tenantId'];
    }

    public function setTenantId($tenantId) {
        $this->data['tenantId'] = $tenantId;
    }
}