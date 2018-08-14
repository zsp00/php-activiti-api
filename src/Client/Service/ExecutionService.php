<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\Execution\Execution;
use Activiti\Client\Model\Execution\ExecutionList;
use Activiti\Client\Model\Execution\ExecutionQuery;

class ExecutionService extends AbstractService implements ExecutionServiceInterface
{

    /**
     * {@inheritdoc}
     */
    public function getExecution($executionId)
    {
        return $this->call(function (ClientInterface $client) use ($executionId) {
            return $client->request('GET', 'runtime/executions/{executionId}', [
                'executionId' => $executionId
            ]);
        }, Execution::class);
    }


    /**
     * {@inheritdoc}
     */
    public function getActivities($executionId)
    {
        return $this->call(function (ClientInterface $client) use ($executionId) {
            return $client->request('GET', 'runtime/executions/{executionId}/activities', [
                'executionId' => $executionId
            ]);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getExecutionsList(ExecutionQuery $query = null)
    {
        return $this->call(function (ClientInterface $client) use ($query) {
            return $client->request('GET', 'runtime/executions', [
                'query' => $query
            ]);
        }, ExecutionList::class);
    }
}