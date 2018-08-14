<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午4:56
 */

namespace Activiti\Client\Model\Form;


class FormSubmitResult
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getId() {
        return $this->data['id'];
    }

    public function setId($id) {
        $this->data['id'] = $id;
    }

    public function getUrl()
    {
        return $this->data['url'];
    }

    public function setUrl($url)
    {
        $this->data['url'] = $url;
    }

    public function getBusinessKey()
    {
        return $this->data['businessKey'];
    }

    public function setBusinessKey($businessKey)
    {
        $this->data['businessKey'] = $businessKey;
    }

    public function getSuspended()
    {
        return $this->data['suspended'];
    }

    public function setSuspended($suspended)
    {
        $this->data['suspended'] = $suspended;
    }

    public function getProcessDefinitionId()
    {
        return $this->data['processDefinitionId'];
    }

    public function setProcessDefinitionId($processDefinitionId)
    {
        $this->data['processDefinitionId'] = $processDefinitionId;
    }

    public function getProcessDefinitionUrl()
    {
        return $this->data['processDefinitionUrl'];
    }

    public function setProcessDefinitionUrl($processDefinitionUrl)
    {
        $this->data['processDefinitionUrl'] = $processDefinitionUrl;
    }

    public function getActivityId()
    {
        return $this->data['activityId'];
    }

    public function setActivityId($activityId)
    {
        $this->data['activityId'] = $activityId;
    }


}