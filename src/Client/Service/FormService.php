<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午4:26
 */

namespace Activiti\Client\Service;


use Activiti\Client\Model\Form\FormList;
use Activiti\Client\Model\Form\FormSubmit;
use Activiti\Client\Model\Form\FormSubmitResult;

class FormService extends AbstractService implements FormServiceInterface
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
    public function getFormData($taskId, $processDefinitionId)
    {
        return $this->call(function (ClientInterface $client) use ($taskId, $processDefinitionId) {
            return $client->request('GET', uri_template('form/form-data', [
                'taskId' => $taskId,
                'processDefinitionId' => $processDefinitionId
            ]));
        }, FormList::class);
    }

    /**
     * Get list of deployments.
     *
     * @see https://www.activiti.org/userguide/#_submit_task_form_data
     *
     * @param FormSubmit $formSubmit
     * @return FormList
     */
    public function submitTaskFormData(FormSubmit $formSubmit)
    {
        return $this->call(function (ClientInterface $client) use ($formSubmit) {
            return $client->request('POST', 'form/form-data', [
                'json' => $this->serializer->serialize($formSubmit)
            ]);
        }, FormSubmitResult::class);
    }
}