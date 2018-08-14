<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午4:24
 */

namespace Activiti\Client\Service;

use Activiti\Client\Model\Form\FormList;
use Activiti\Client\Model\Form\FormSubmit;
use Activiti\Client\Model\Form\FormSubmitResult;

interface FormServiceInterface
{
    /**
     * Get list of deployments.
     *
     * @see https://www.activiti.org/userguide/#_get_form_data
     *
     * @param taskId $taskId
     * @param processDefinitionId $processDefinitionId
     * @return FormList
     */
    public function getFormData($taskId, $processDefinitionId);

    /**
     * Get list of deployments.
     *
     * @see https://www.activiti.org/userguide/#_submit_task_form_data
     *
     * @param FormSubmit $formSubmit
     * @return FormSubmitResult
     */
    public function submitTaskFormData(FormSubmit $formSubmit);
}