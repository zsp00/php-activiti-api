<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\Deployment\Deployment;
use Activiti\Client\Model\Deployment\DeploymentList;
use Activiti\Client\Model\Deployment\DeploymentQuery;

interface DeploymentServiceInterface
{
    /**
     * Get list of deployments.
     *
     * @see https://www.activiti.org/userguide/#_list_of_deployments
     *
     * @param DeploymentQuery|null $query
     * @return DeploymentList
     */
    public function getDeploymentList(DeploymentQuery $query = null);

    /**
     * Get a deployment.
     *
     * @see https://www.activiti.org/userguide/#_get_a_deployment
     *
     * @param string $deploymentId The id of the deployment to get.
     * @return Deployment
     */
    public function getDeployment($deploymentId);

    /**
     * Create a new deployment.
     *
     * @see https://www.activiti.org/userguide/#_create_a_new_deployment
     *
     * @param resource $deployment
     * @return Deployment
     */
    public function createDeployment($deployment);

    /**
     * Delete a deployment.
     *
     * @param string $deploymentId The id of the deployment to delete.
     * @return void
     */
    public function delete($deploymentId);


    /**
     * List resources in a deployment
     * @see https://www.activiti.org/userguide/#_list_resources_in_a_deployment
     *
     * @param string $deploymentId
     * @return void
     */
    public function getDeploymentResources($deploymentId);
}
