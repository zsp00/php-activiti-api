<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\History\HistoryActivityInstance;
use Activiti\Client\Model\History\HistoryQuery;
use Activiti\Client\Model\ProcessInstance\ProcessInstanceList;
use Activiti\Client\Model\Task\Comment;
use Activiti\Client\Model\Task\CommentList;
use GuzzleHttp\ClientInterface;
use function GuzzleHttp\uri_template;

class HistoryService extends AbstractService implements HistoryServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function queryHistoryInstances(HistoryQuery $historyQuery = null)
    {
        return $this->call(function (ClientInterface $client) use ($historyQuery) {
            return $client->request('POST', 'query/historic-activity-instances', [
                'json' => array_filter($this->serializer->serialize($historyQuery)),
            ]);
        }, HistoryActivityInstance::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getHistoryProcessInstanceList(HistoryQuery $historyQuery)
    {
        return $this->call(function (ClientInterface $client) use ($historyQuery) {
            return $client->request('GET', 'history/historic-process-instances', [
                'query' => $this->serializer->serialize($historyQuery),
            ]);
        }, ProcessInstanceList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function historyTask(HistoryQuery $historyQuery)
    {
        return $this->call(function (ClientInterface $client) use ($historyQuery) {
            return $client->request('GET', 'history/historic-task-instances', [
                'query' => $this->serializer->serialize($historyQuery),
            ]);
        }, ProcessInstanceList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getHistoryProcessInstanceComments($processInstanceId)
    {
        return $this->call(function (ClientInterface $client) use ($processInstanceId) {
            return $client->request('GET', uri_template('history/historic-process-instances/{processInstanceId}/comments', [
                'processInstanceId' => $processInstanceId,
            ]));
        }, CommentList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function createProcessInstanceComment($processInstanceId, $message, $saveProcessInstanceId = false)
    {
        $uri = uri_template('history/historic-process-instances/{processInstanceId}/comments', [
            'processInstanceId' => $processInstanceId,
        ]);

        $payload = [
            'message' => $message,
            'saveProcessInstanceId' => $saveProcessInstanceId,
        ];

        return $this->call(function (ClientInterface $client) use ($uri, $payload) {
            return $client->request('POST', $uri, [
                'json' => $payload,
            ]);
        }, Comment::class);
    }
}
