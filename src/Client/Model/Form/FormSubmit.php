<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午4:47
 */

namespace Activiti\Client\Model\Form;


class FormSubmit
{
    private $taskId;

    private $properties;

    private $businessKey;

    private $processDefinitionId;

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * @param mixed $taskId
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
    }

    /**
     * @return mixed
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * @param mixed $properties
     */
    public function setProperties(FormProperties $properties)
    {
        $this->properties = $properties;
    }

    /**
     * @return mixed
     */
    public function getBusinessKey()
    {
        return $this->businessKey;
    }

    /**
     * @param mixed $businessKey
     */
    public function setBusinessKey($businessKey)
    {
        $this->businessKey = $businessKey;
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

}