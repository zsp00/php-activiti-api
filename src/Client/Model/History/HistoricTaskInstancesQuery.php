<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/17
 * Time: 下午2:34
 */

namespace Activiti\Client\Model\History;


use Activiti\Client\Model\AbstractQuery;

class HistoricTaskInstancesQuery extends AbstractQuery
{

    private $taskId;

    private $processInstanceId;

    private $processDefinitionKey;

    private $processDefinitionKeyLike;

    private $processDefinitionId;

    private $processDefinitionName;

    private $processDefinitionNameLike;

    private $processBusinessKey;

    private $processBusinessKeyLike;

    private $executionId;

    private $taskDefinitionKey;

    private $taskName;

    private $taskNameLike;

    private $taskDescription;

    private $taskDescriptionLike;

    private $taskCategory;

    private $taskDeleteReason;

    private $taskDeleteReasonLike;

    private $taskAssignee;

    private $taskAssigneeLike;

    private $taskOwner;

    private $taskOwnerLike;

    private $taskInvolvedUser;

    private $taskPriority;

    private $finished;

    private $processFinished;

    private $parentTaskId;

    private $dueDate;

    private $dueDateAfter;

    private $dueDateBefore;

    private $withoutDueDate;

    private $taskCompletedOn;

    private $taskCompletedAfter;

    private $taskCompletedBefore;

    private $taskCreatedOn;

    private $taskCreatedBefore;

    private $taskCreatedAfter;

    private $includeTaskLocalVariables;

    private $includeProcessVariables;

    private $tenantId;

    private $tenantIdLike;

    private $withoutTenantId;

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * @param mixed $taskId
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
    }

    /**
     * @return mixed
     */
    public function getProcessInstanceId()
    {
        return $this->processInstanceId;
    }

    /**
     * @param mixed $processInstanceId
     */
    public function setProcessInstanceId($processInstanceId)
    {
        $this->processInstanceId = $processInstanceId;
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionKey()
    {
        return $this->processDefinitionKey;
    }

    /**
     * @param mixed $processDefinitionKey
     */
    public function setProcessDefinitionKey($processDefinitionKey)
    {
        $this->processDefinitionKey = $processDefinitionKey;
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionKeyLike()
    {
        return $this->processDefinitionKeyLike;
    }

    /**
     * @param mixed $processDefinitionKeyLike
     */
    public function setProcessDefinitionKeyLike($processDefinitionKeyLike)
    {
        $this->processDefinitionKeyLike = $processDefinitionKeyLike;
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionId()
    {
        return $this->processDefinitionId;
    }

    /**
     * @param mixed $processDefinitionId
     */
    public function setProcessDefinitionId($processDefinitionId)
    {
        $this->processDefinitionId = $processDefinitionId;
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionName()
    {
        return $this->processDefinitionName;
    }

    /**
     * @param mixed $processDefinitionName
     */
    public function setProcessDefinitionName($processDefinitionName)
    {
        $this->processDefinitionName = $processDefinitionName;
    }

    /**
     * @return mixed
     */
    public function getProcessDefinitionNameLike()
    {
        return $this->processDefinitionNameLike;
    }

    /**
     * @param mixed $processDefinitionNameLike
     */
    public function setProcessDefinitionNameLike($processDefinitionNameLike)
    {
        $this->processDefinitionNameLike = $processDefinitionNameLike;
    }

    /**
     * @return mixed
     */
    public function getProcessBusinessKey()
    {
        return $this->processBusinessKey;
    }

    /**
     * @param mixed $processBusinessKey
     */
    public function setProcessBusinessKey($processBusinessKey)
    {
        $this->processBusinessKey = $processBusinessKey;
    }

    /**
     * @return mixed
     */
    public function getProcessBusinessKeyLike()
    {
        return $this->processBusinessKeyLike;
    }

    /**
     * @param mixed $processBusinessKeyLike
     */
    public function setProcessBusinessKeyLike($processBusinessKeyLike)
    {
        $this->processBusinessKeyLike = $processBusinessKeyLike;
    }

    /**
     * @return mixed
     */
    public function getExecutionId()
    {
        return $this->executionId;
    }

    /**
     * @param mixed $executionId
     */
    public function setExecutionId($executionId)
    {
        $this->executionId = $executionId;
    }

    /**
     * @return mixed
     */
    public function getTaskDefinitionKey()
    {
        return $this->taskDefinitionKey;
    }

    /**
     * @param mixed $taskDefinitionKey
     */
    public function setTaskDefinitionKey($taskDefinitionKey)
    {
        $this->taskDefinitionKey = $taskDefinitionKey;
    }

    /**
     * @return mixed
     */
    public function getTaskName()
    {
        return $this->taskName;
    }

    /**
     * @param mixed $taskName
     */
    public function setTaskName($taskName)
    {
        $this->taskName = $taskName;
    }

    /**
     * @return mixed
     */
    public function getTaskNameLike()
    {
        return $this->taskNameLike;
    }

    /**
     * @param mixed $taskNameLike
     */
    public function setTaskNameLike($taskNameLike)
    {
        $this->taskNameLike = $taskNameLike;
    }

    /**
     * @return mixed
     */
    public function getTaskDescription()
    {
        return $this->taskDescription;
    }

    /**
     * @param mixed $taskDescription
     */
    public function setTaskDescription($taskDescription)
    {
        $this->taskDescription = $taskDescription;
    }

    /**
     * @return mixed
     */
    public function getTaskDescriptionLike()
    {
        return $this->taskDescriptionLike;
    }

    /**
     * @param mixed $taskDescriptionLike
     */
    public function setTaskDescriptionLike($taskDescriptionLike)
    {
        $this->taskDescriptionLike = $taskDescriptionLike;
    }

    /**
     * @return mixed
     */
    public function getTaskCategory()
    {
        return $this->taskCategory;
    }

    /**
     * @param mixed $taskCategory
     */
    public function setTaskCategory($taskCategory)
    {
        $this->taskCategory = $taskCategory;
    }

    /**
     * @return mixed
     */
    public function getTaskDeleteReason()
    {
        return $this->taskDeleteReason;
    }

    /**
     * @param mixed $taskDeleteReason
     */
    public function setTaskDeleteReason($taskDeleteReason)
    {
        $this->taskDeleteReason = $taskDeleteReason;
    }

    /**
     * @return mixed
     */
    public function getTaskDeleteReasonLike()
    {
        return $this->taskDeleteReasonLike;
    }

    /**
     * @param mixed $taskDeleteReasonLike
     */
    public function setTaskDeleteReasonLike($taskDeleteReasonLike)
    {
        $this->taskDeleteReasonLike = $taskDeleteReasonLike;
    }

    /**
     * @return mixed
     */
    public function getTaskAssignee()
    {
        return $this->taskAssignee;
    }

    /**
     * @param mixed $taskAssignee
     */
    public function setTaskAssignee($taskAssignee)
    {
        $this->taskAssignee = $taskAssignee;
    }

    /**
     * @return mixed
     */
    public function getTaskAssigneeLike()
    {
        return $this->taskAssigneeLike;
    }

    /**
     * @param mixed $taskAssigneeLike
     */
    public function setTaskAssigneeLike($taskAssigneeLike)
    {
        $this->taskAssigneeLike = $taskAssigneeLike;
    }

    /**
     * @return mixed
     */
    public function getTaskOwner()
    {
        return $this->taskOwner;
    }

    /**
     * @param mixed $taskOwner
     */
    public function setTaskOwner($taskOwner)
    {
        $this->taskOwner = $taskOwner;
    }

    /**
     * @return mixed
     */
    public function getTaskOwnerLike()
    {
        return $this->taskOwnerLike;
    }

    /**
     * @param mixed $taskOwnerLike
     */
    public function setTaskOwnerLike($taskOwnerLike)
    {
        $this->taskOwnerLike = $taskOwnerLike;
    }

    /**
     * @return mixed
     */
    public function getTaskInvolvedUser()
    {
        return $this->taskInvolvedUser;
    }

    /**
     * @param mixed $taskInvolvedUser
     */
    public function setTaskInvolvedUser($taskInvolvedUser)
    {
        $this->taskInvolvedUser = $taskInvolvedUser;
    }

    /**
     * @return mixed
     */
    public function getTaskPriority()
    {
        return $this->taskPriority;
    }

    /**
     * @param mixed $taskPriority
     */
    public function setTaskPriority($taskPriority)
    {
        $this->taskPriority = $taskPriority;
    }

    /**
     * @return mixed
     */
    public function getFinished()
    {
        return $this->finished;
    }

    /**
     * @param mixed $finished
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
    }

    /**
     * @return mixed
     */
    public function getProcessFinished()
    {
        return $this->processFinished;
    }

    /**
     * @param mixed $processFinished
     */
    public function setProcessFinished($processFinished)
    {
        $this->processFinished = $processFinished;
    }

    /**
     * @return mixed
     */
    public function getParentTaskId()
    {
        return $this->parentTaskId;
    }

    /**
     * @param mixed $parentTaskId
     */
    public function setParentTaskId($parentTaskId)
    {
        $this->parentTaskId = $parentTaskId;
    }

    /**
     * @return mixed
     */
    public function getDueDate()
    {
        return $this->dueDate;
    }

    /**
     * @param mixed $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @return mixed
     */
    public function getDueDateAfter()
    {
        return $this->dueDateAfter;
    }

    /**
     * @param mixed $dueDateAfter
     */
    public function setDueDateAfter($dueDateAfter)
    {
        $this->dueDateAfter = $dueDateAfter;
    }

    /**
     * @return mixed
     */
    public function getDueDateBefore()
    {
        return $this->dueDateBefore;
    }

    /**
     * @param mixed $dueDateBefore
     */
    public function setDueDateBefore($dueDateBefore)
    {
        $this->dueDateBefore = $dueDateBefore;
    }

    /**
     * @return mixed
     */
    public function getWithoutDueDate()
    {
        return $this->withoutDueDate;
    }

    /**
     * @param mixed $withoutDueDate
     */
    public function setWithoutDueDate($withoutDueDate)
    {
        $this->withoutDueDate = $withoutDueDate;
    }

    /**
     * @return mixed
     */
    public function getTaskCompletedOn()
    {
        return $this->taskCompletedOn;
    }

    /**
     * @param mixed $taskCompletedOn
     */
    public function setTaskCompletedOn($taskCompletedOn)
    {
        $this->taskCompletedOn = $taskCompletedOn;
    }

    /**
     * @return mixed
     */
    public function getTaskCompletedAfter()
    {
        return $this->taskCompletedAfter;
    }

    /**
     * @param mixed $taskCompletedAfter
     */
    public function setTaskCompletedAfter($taskCompletedAfter)
    {
        $this->taskCompletedAfter = $taskCompletedAfter;
    }

    /**
     * @return mixed
     */
    public function getTaskCompletedBefore()
    {
        return $this->taskCompletedBefore;
    }

    /**
     * @param mixed $taskCompletedBefore
     */
    public function setTaskCompletedBefore($taskCompletedBefore)
    {
        $this->taskCompletedBefore = $taskCompletedBefore;
    }

    /**
     * @return mixed
     */
    public function getTaskCreatedOn()
    {
        return $this->taskCreatedOn;
    }

    /**
     * @param mixed $taskCreatedOn
     */
    public function setTaskCreatedOn($taskCreatedOn)
    {
        $this->taskCreatedOn = $taskCreatedOn;
    }

    /**
     * @return mixed
     */
    public function getTaskCreatedBefore()
    {
        return $this->taskCreatedBefore;
    }

    /**
     * @param mixed $taskCreatedBefore
     */
    public function setTaskCreatedBefore($taskCreatedBefore)
    {
        $this->taskCreatedBefore = $taskCreatedBefore;
    }

    /**
     * @return mixed
     */
    public function getTaskCreatedAfter()
    {
        return $this->taskCreatedAfter;
    }

    /**
     * @param mixed $taskCreatedAfter
     */
    public function setTaskCreatedAfter($taskCreatedAfter)
    {
        $this->taskCreatedAfter = $taskCreatedAfter;
    }

    /**
     * @return mixed
     */
    public function getIncludeTaskLocalVariables()
    {
        return $this->includeTaskLocalVariables;
    }

    /**
     * @param mixed $includeTaskLocalVariables
     */
    public function setIncludeTaskLocalVariables($includeTaskLocalVariables)
    {
        $this->includeTaskLocalVariables = $includeTaskLocalVariables;
    }

    /**
     * @return mixed
     */
    public function getIncludeProcessVariables()
    {
        return $this->includeProcessVariables;
    }

    /**
     * @param mixed $includeProcessVariables
     */
    public function setIncludeProcessVariables($includeProcessVariables)
    {
        $this->includeProcessVariables = $includeProcessVariables;
    }

    /**
     * @return mixed
     */
    public function getTenantId()
    {
        return $this->tenantId;
    }

    /**
     * @param mixed $tenantId
     */
    public function setTenantId($tenantId)
    {
        $this->tenantId = $tenantId;
    }

    /**
     * @return mixed
     */
    public function getTenantIdLike()
    {
        return $this->tenantIdLike;
    }

    /**
     * @param mixed $tenantIdLike
     */
    public function setTenantIdLike($tenantIdLike)
    {
        $this->tenantIdLike = $tenantIdLike;
    }

    /**
     * @return mixed
     */
    public function getWithoutTenantId()
    {
        return $this->withoutTenantId;
    }

    /**
     * @param mixed $withoutTenantId
     */
    public function setWithoutTenantId($withoutTenantId)
    {
        $this->withoutTenantId = $withoutTenantId;
    }


}