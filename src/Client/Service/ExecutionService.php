<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\Execution\Execution;
use Activiti\Client\Model\Execution\ExecutionList;
use Activiti\Client\Model\Execution\ExecutionQuery;
use Activiti\Client\Model\Task\Activities;
use GuzzleHttp\ClientInterface;
use function GuzzleHttp\uri_template;

class ExecutionService extends AbstractService implements ExecutionServiceInterface
{

    /**
     * {@inheritdoc}
     */
    public function getExecution($executionId)
    {
        return $this->call(function (ClientInterface $client) use ($executionId) {
            return $client->request('GET', uri_template('runtime/executions/{executionId}', [
                'executionId' => $executionId
            ]));
        }, Execution::class);
    }


    /**
     * {@inheritdoc}
     */
    public function getActivities($executionId)
    {
        return $this->call(function (ClientInterface $client) use ($executionId) {
            return $client->request('GET', uri_template('runtime/executions/{executionId}/activities', [
                'executionId' => $executionId
            ]));
        }, Activities::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getExecutionList(ExecutionQuery $query = null)
    {
        return $this->call(function (ClientInterface $client) use ($query) {
            return $client->request('GET', 'runtime/executions', [
                'query' => $this->serializer->serialize($query)
            ]);
        }, ExecutionList::class);
    }
}