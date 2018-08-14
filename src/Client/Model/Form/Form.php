<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午4:30
 */

namespace Activiti\Client\Model\Form;


class Form
{

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function getFormKey() {
        return $this->data['formKey'];
    }

    public function setFormKey($formKey) {
        $this->data['formKey'] = $formKey;
    }

    public function getDeploymentId() {
        return $this->data['deploymentId'];
    }

    public function setDeploymentId($deploymentId) {
        $this->data['$deploymentId'] = $deploymentId;
    }

    public function getProcessDefinitionId() {
        return $this->data['processDefinitionId'];
    }

    public function setProcessDefinitionId($processDefinitionId) {
        $this->data['processDefinitionId'] = $processDefinitionId;
    }

    public function getProcessDefinitionUrl() {
        return $this->data['processDefinitionUrl'];
    }

    public function setProcessDefinitionUrl($processDefinitionUrl) {
        $this->data['processDefinitionUrl'] = $processDefinitionUrl;
    }

    public function getTaskId() {
        return $this->data['taskId'];
    }

    public function setTaskId($taskId) {
        $this->data['taskId'] = $taskId;
    }

    public function getTaskUrl() {
        return $this->data['formKey'];
    }

    public function setTaskUrl($taskUrl) {
        $this->data['taskUrl'] = $taskUrl;
    }

    public function getFormProperties() {
        return $this->data['formProperties'];
    }

    public function setFormProperties($formProperties) {
        foreach($formProperties as $formPropertie) {
           $this->data['formProperties'][] = new FormProperties($formPropertie);
        }
    }

}