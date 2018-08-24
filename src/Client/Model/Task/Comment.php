<?php

namespace Activiti\Client\Model\Task;

class Comment
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

    public function getAuthor()
    {
        return $this->data['author'];
    }

    public function getMessage()
    {
        return $this->data['message'];
    }

    public function getTime()
    {
        return $this->data['time'];
    }

    public function getTaskId()
    {
        return $this->data['taskId'];
    }

    public function getTaskUrl()
    {
        return $this->data['taskUrl'];
    }

    public function getProcessInstanceId()
    {
        return $this->data['processInstanceId'];
    }

    public function getProcessInstanceUrl()
    {
        return $this->data['processInstanceUrl'];
    }

    public function getData() {
        return $this->data;
    }
}
