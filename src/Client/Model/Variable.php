<?php

namespace Activiti\Client\Model;

class Variable
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getName()
    {
        return $this->data['name'];
    }

    public function getValue()
    {
        return $this->data['value'];
    }

    public function getValueUrl()
    {
        return $this->data['valueUrl'];
    }

    public function getType()
    {
        return $this->data['type'];
    }

    public function getScope()
    {
        return $this->data['scope'];
    }

    public function getData() {
        return $this->data;
    }
}
