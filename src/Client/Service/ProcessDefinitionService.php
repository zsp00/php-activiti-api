<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\IdentityLinkList;
use Activiti\Client\Model\IdentityLink;
use Activiti\Client\Model\ProcessDefinition\ProcessDefinition;
use Activiti\Client\Model\ProcessDefinition\ProcessDefinitionList;
use Activiti\Client\Model\ProcessDefinition\ProcessDefinitionQuery;
use Activiti\Client\Model\ProcessDefinition\ProcessDefinitionUpdate;
use GuzzleHttp\ClientInterface;
use function GuzzleHttp\uri_template;

class ProcessDefinitionService extends AbstractService implements ProcessDefinitionServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getProcessDefinitionList(ProcessDefinitionQuery $query)
    {
        return $this->call(function (ClientInterface $client) use ($query) {
            return $client->request('GET', 'repository/process-definitions', [
                'query' => $this->serializer->serialize($query),
            ]);
        }, ProcessDefinitionList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getProcessDefinition($processDefinitionId)
    {
        return $this->call(function (ClientInterface $client) use ($processDefinitionId) {
            $uri = uri_template('repository/process-definitions/{processDefinitionId}', [
                'processDefinitionId' => $processDefinitionId,
            ]);

            return $client->request('GET', $uri);
        }, ProcessDefinition::class);
    }

    /**
     * {@inheritdoc}
     */
    public function update($processDefinitionId, ProcessDefinitionUpdate $data)
    {
        return $this->call(function (ClientInterface $client) use ($processDefinitionId, $data) {
            $uri = uri_template('repository/process-definitions/{processDefinitionId}', [
                'processDefinitionId' => $processDefinitionId,
            ]);

            return $client->request('PUT', $uri, [
                'json' => $this->serializer->serialize($data)
            ]);
        }, ProcessDefinition::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getResourceData($processDefinitionId)
    {
        return $this->call(function (ClientInterface $client) use ($processDefinitionId) {
            $uri = uri_template('repository/process-definitions/{processDefinitionId}/resourcedata', [
                'processDefinitionId' => $processDefinitionId,
            ]);

            return $client->request('GET', $uri);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function suspend($processDefinitionId, $includeProcessInstances = null, \DateTime $date = null)
    {
        return $this->callProcessDefinitionAction($processDefinitionId, 'suspend', $includeProcessInstances, $date);
    }

    /**
     * {@inheritdoc}
     */
    public function activate($processDefinitionId, $includeProcessInstances = null, \DateTime $date = null)
    {
        return $this->callProcessDefinitionAction($processDefinitionId, 'activate', $includeProcessInstances, $date);
    }

    /**
     * {@inheritdoc}
     */
    public function getCandidateStarters($processDefinitionId)
    {
        return $this->call(function (ClientInterface $client) use ($processDefinitionId) {
            $uri = uri_template('repository/process-definitions/{processDefinitionId}/identitylinks', [
                'processDefinitionId' => $processDefinitionId,
            ]);

            return $client->request('GET', $uri);
        }, IdentityLinkList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function addUserCandidateStarter($processDefinitionId, $userId)
    {
        return $this->call(function (ClientInterface $client) use ($processDefinitionId, $userId) {
            $uri = uri_template('repository/process-definitions/{processDefinitionId}/identitylinks', [
                'processDefinitionId' => $processDefinitionId,
            ]);

            return $client->request('POST', $uri, [
                'json' => [
                    'userId' => $userId,
                ],
            ]);
        }, IdentityLink::class);
    }

    /**
     * {@inheritdoc}
     */
    public function addGroupCandidateStarter($processDefinitionId, $groupId)
    {
        return $this->call(function (ClientInterface $client) use ($processDefinitionId, $groupId) {
            $uri = uri_template('repository/process-definitions/{processDefinitionId}/identitylinks', [
                'processDefinitionId' => $processDefinitionId,
            ]);

            return $client->request('POST', $uri, [
                'json' => [
                    'groupId' => $groupId,
                ],
            ]);
        }, IdentityLink::class);
    }

    /**
     * {@inheritdoc}
     */
    public function deleteCandidateStarter($processDefinitionId, $family, $identityId)
    {
        $this->call(function (ClientInterface $client) use ($processDefinitionId, $family, $identityId) {
            $uri = uri_template('repository/process-definitions/{processDefinitionId}/identitylinks/{family}/{identityId}', [
                'processDefinitionId' => $processDefinitionId,
                'family' => $family,
                'identityId' => $identityId,
            ]);

            return $client->request('DELETE', $uri);
        });
    }

    /**
     * {@inheritdoc}
     */
    public function getCandidateStarter($processDefinitionId, $family, $identityId)
    {
        return $this->call(function (ClientInterface $client) use ($processDefinitionId, $family, $identityId) {
            $uri = uri_template('repository/process-definitions/{processDefinitionId}/identitylinks/{family}/{identityId}', [
                'processDefinitionId' => $processDefinitionId,
                'family' => $family,
                'identityId' => $identityId,
            ]);

            return $client->request('GET', $uri);
        }, IdentityLink::class);
    }

    protected function callProcessDefinitionAction($processDefinitionId,
                                                   $action,
                                                   $includeProcessInstances = null,
                                                   \DateTime $date = null)
    {
        $uri = uri_template('repository/process-definitions/{processDefinitionId}', [
            'processDefinitionId' => $processDefinitionId,
        ]);

        $payload = [
            'action' => $action,
            'includeProcessInstances' => $includeProcessInstances,
            'date' => $date ? $date->format('Y-m-d\TH:i:s\Z') : null,
        ];

        return $this->call(function (ClientInterface $client) use ($uri, $payload) {
            return $client->request('PUT', $uri, [
                'json' => $payload,
            ]);
        }, ProcessDefinition::class);
    }


    public function getImageResource($processDefinitionId){
        return $this->call(function (ClientInterface $client) use ($processDefinitionId) {
            $uri = uri_template('repository/process-definitions/{processDefinitionId}/image', [
                'processDefinitionId' => $processDefinitionId,
            ]);

            return $client->request('GET', $uri);
        });
    }
}
