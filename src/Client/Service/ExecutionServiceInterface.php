<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\Execution\Execution;
use Activiti\Client\Model\Execution\ExecutionQuery;

interface ExecutionServiceInterface
{

  /**
     * Get list of deployments.
     *
     * @see https://www.activiti.org/userguide/#_get_an_execution
     *
     * @param executionId $executionId
     * @return Execution
     */
    public function getExecution($executionId);
}