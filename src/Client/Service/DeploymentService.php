<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\Deployment\Deployment;
use Activiti\Client\Model\Deployment\DeploymentList;
use Activiti\Client\Model\Deployment\DeploymentQuery;
use Activiti\Client\Model\Deployment\Resource;
use GuzzleHttp\ClientInterface;
use function GuzzleHttp\uri_template;

class DeploymentService extends AbstractService implements DeploymentServiceInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDeploymentList(DeploymentQuery $query = null)
    {
        return $this->call(function (ClientInterface $client) use ($query) {
            return $client->request('GET', 'repository/deployments', [
                'query' => $this->serializer->serialize($query)
            ]);
        }, DeploymentList::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getDeployment($deploymentId)
    {
        return $this->call(function (ClientInterface $client) use ($deploymentId) {
            $uri = uri_template('repository/deployments/{deploymentId}', [
                'deploymentId' => $deploymentId,
            ]);

            return $client->request('GET', $uri);
        }, Deployment::class);
    }

    /**
     * {@inheritdoc}
     */
    public function createDeployment($deployment)
    {
        return $this->call(function (ClientInterface $client) use ($deployment) {
            return $client->request('POST', 'repository/deployments', [
                'multipart' => [
                    [
                        'name' => 'deployment',
                        'contents' => $deployment,
                    ],
                ],
            ]);
        }, Deployment::class);
    }

    /**
     * {@inheritdoc}
     */
    public function delete($deploymentId)
    {
        $this->call(function (ClientInterface $client) use ($deploymentId) {
            $uri = uri_template('repository/deployments/{deploymentId}', [
                'deploymentId' => $deploymentId,
            ]);

            return $client->request('DELETE', $uri);
        });
    }

    /**
     * List resources in a deployment
     * @see https://www.activiti.org/userguide/#_list_resources_in_a_deployment
     *
     * @param string $deploymentId
     * @return void
     */
    public function getDeploymentResources($deploymentId)
    {
        $this->call(function (ClientInterface $client) use ($deploymentId) {
            $uri = uri_template('repository/deployments/{deploymentId}/resources', [
                'deploymentId' => $deploymentId,
            ]);

            return $client->request('GET', $uri);
        }, Resource::class);
    }
}
