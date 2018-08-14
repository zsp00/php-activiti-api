<?php

namespace Activiti\Client\Model\Execution;

use Activiti\Client\Model\AbstractQuery;

class ExecutionQuery extends AbstractQuery
{
    private $id;

    public function getId() {
      return $this->id;
    }

    public function setId($id) {
      $this->id = $id;
    }

}
