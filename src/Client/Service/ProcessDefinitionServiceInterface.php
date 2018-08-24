<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\IdentityLink;
use Activiti\Client\Model\IdentityLinkList;
use Activiti\Client\Model\ProcessDefinition\ProcessDefinition;
use Activiti\Client\Model\ProcessDefinition\ProcessDefinitionList;
use Activiti\Client\Model\ProcessDefinition\ProcessDefinitionQuery;
use Activiti\Client\Model\ProcessDefinition\ProcessDefinitionUpdate;

interface ProcessDefinitionServiceInterface
{
    /**
     * Get list of process definitions.
     *
     * @see https://www.activiti.org/userguide/#_list_of_process_definitions
     *
     * @param ProcessDefinitionQuery $query
     * @return ProcessDefinitionList
     */
    public function getProcessDefinitionList(ProcessDefinitionQuery $query);

    /**
     * Get a process definition.
     *
     * @see https://www.activiti.org/userguide/#_get_a_process_definition
     *
     * @param string $processDefinitionId The id of the process definition to get
     * @return ProcessDefinition
     */
    public function getProcessDefinition($processDefinitionId);

    /**
     * Update process definition.
     *
     * @see https://www.activiti.org/userguide/#_update_category_for_a_process_definition
     *
     * @param string $processDefinitionId
     * @param ProcessDefinitionUpdate $data
     * @return ProcessDefinition
     */
    public function update($processDefinitionId, ProcessDefinitionUpdate $data);

    /**
     * Get a process definition resource content.
     *
     * @see https://www.activiti.org/userguide/#_get_a_process_definition_resource_content
     *
     * @param string $processDefinitionId The id of the process definition to get the resource data for.
     * @return mixed
     */
    public function getResourceData($processDefinitionId);

    /**
     *  Suspend a process definition.
     *
     *  @see https://www.activiti.org/userguide/#_suspend_a_process_definition
     *
     * @param string $processDefinitionId The id of the process definition to suspend
     * @param bool $includeProcessInstances Suspend running process-instances ?
     * @param \DateTime|null $date Date when the suspension should be executed
     * @return ProcessDefinition
     */
    public function suspend($processDefinitionId, $includeProcessInstances = null, \DateTime $date = null);

    /**
     * Activate a process definition.
     *
     * @see https://www.activiti.org/userguide/#_activate_a_process_definition
     *
     * @param string $processDefinitionId The id of the process definition to activate
     * @param bool $includeProcessInstances Activate running process-instances ?
     * @param \DateTime|null $date Date when the activation should be executed
     * @return ProcessDefinition
     */
    public function activate($processDefinitionId, $includeProcessInstances = null, \DateTime $date = null);

    /**
     * Get all candidate starters for a process-definition.
     *
     * @see https://www.activiti.org/userguide/#_get_all_candidate_starters_for_a_process_definition
     *
     * @param string $processDefinitionId The id of the process definition to get the identity links for.
     * @return IdentityLinkList
     */
    public function getCandidateStarters($processDefinitionId);

    /**
     * Add a candidate starter (user) to a process definition.
     *
     * @see https://www.activiti.org/userguide/#_add_a_candidate_starter_to_a_process_definition
     *
     * @param string $processDefinitionId The id of the process definition
     * @param string $userId The user id to add as candidate starter
     * @return IdentityLink
     */
    public function addUserCandidateStarter($processDefinitionId, $userId);

    /**
     * Add a candidate starter (group) to a process definition.
     *
     * @see https://www.activiti.org/userguide/#_add_a_candidate_starter_to_a_process_definition
     *
     * @param string $processDefinitionId The id of the process definition
     * @param string $groupId The group id to add as candidate starter
     * @return IdentityLink
     */
    public function addGroupCandidateStarter($processDefinitionId, $groupId);

    /**
     * Delete a candidate starter from a process definition.
     *
     * @see https://www.activiti.org/userguide/#_delete_a_candidate_starter_from_a_process_definition
     *
     * @param string $processDefinitionId The id of the process definition
     * @param string $family Either users or groups, depending on the type of identity link
     * @param string $identityId Either the userId or groupId of the identity to remove as candidate starter
     */
    public function deleteCandidateStarter($processDefinitionId, $family, $identityId);

    /**
     * Get a candidate starter from a process definition
     *
     * @see https://www.activiti.org/userguide/#_get_a_candidate_starter_from_a_process_definition
     *
     * @param string $processDefinitionId The id of the process definition
     * @param string $family Either users or groups, depending on the type of identity link
     * @param string $identityId Either the userId or groupId of the identity to get as candidate starter
     * @return IdentityLink
     */
    public function getCandidateStarter($processDefinitionId, $family, $identityId);

    /**
     * @param $processDefinitionId
     * @return mixed
     */
    public function getImageResource($processDefinitionId);
}
