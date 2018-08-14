<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\Execution\Execution;

class ExecutionService extends AbstractService implements ExecutionServiceInterface
{
  public function getExecution($executionId) {
    return $this->call(function (ClientInterface $client) use ($query) {
      return $client->request('GET', 'runtime/executions/{executionId}', [
          'executionId' =>  $executionId
      ]);
  }, Execution::class);
  }
}