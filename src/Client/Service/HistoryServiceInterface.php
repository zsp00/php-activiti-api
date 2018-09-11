<?php

namespace Activiti\Client\Service;

use Activiti\Client\Model\History\HistoricTaskInstancesQuery;
use Activiti\Client\Model\History\HistoryQuery;
use Activiti\Client\Model\Task\CommentList;
use Activiti\Client\Model\Task\TaskList;
use app\common\model\Task;

interface HistoryServiceInterface
{
    /**
     * Query for historic activity instances
     *
     * @see https://www.activiti.org/userguide/#_query_for_historic_activity_instances
     *
     * @param HistoryQuery $historyQuery
     * @return mixed
     */
    public function queryHistoryInstances(HistoryQuery $historyQuery);


    /**
     * List of historic process instances
     *
     * @see https://www.activiti.org/userguide/#restHistoricProcessInstancesGet
     *
     * @param HistoryQuery $historyQuery
     * @return mixed
     */
    public function getHistoryProcessInstanceList(HistoryQuery $historyQuery);

    /**
     * Get historic task instances
     *
     * @see https://www.activiti.org/userguide/#restHistoricTaskInstancesGet
     *
     * @param HistoricTaskInstancesQuery $historyQuery
     * @return TaskList
     */
    public function historyTask(HistoricTaskInstancesQuery $historicTaskInstancesQuery);

    /**
     * @see https://www.activiti.org/userguide/#_get_a_comment_on_a_historic_process_instance
     * @param $processInstanceId
     * @return CommentList
     */
    public function getHistoryProcessInstanceComments($processInstanceId);

    /**
     * @see https://www.activiti.org/userguide/#_create_a_new_comment_on_a_historic_process_instance
     * @param $processInstanceId
     * @param $message
     * @param $saveProcessInstanceId
     * @return mixed
     */
    public function createProcessInstanceComment($processInstanceId, $message, $saveProcessInstanceId = false);
}
