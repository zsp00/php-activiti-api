<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午4:26
 */

namespace Activiti\Client\Service;


use Activiti\Client\Model\Form\Form;
use Activiti\Client\Model\Form\FormList;
use Activiti\Client\Model\Form\FormSubmit;
use Activiti\Client\Model\Form\FormSubmitResult;
use GuzzleHttp\ClientInterface;
use function GuzzleHttp\uri_template;

class FormService extends AbstractService implements FormServiceInterface
{

    /**
     * {@inheritdoc}
     */
    public function getFormDataByTaskId($taskId)
    {
        return $this->call(function (ClientInterface $client) use ($taskId) {
            return $client->request('GET', 'form/form-data', [
                    'query' => [
                        'taskId' => $taskId
                    ]
                ]
            );
        }, Form::class);
    }

    /**
     * {@inheritdoc}
     */
    public function getFormDataByProcessDefinitionId($processDefinitionId)
    {
        return $this->call(function (ClientInterface $client) use ($processDefinitionId) {
            return $client->request('GET', uri_template('form/form-data', [
                'query' => [
                    'processDefinitionId' => $processDefinitionId
                ]
            ]));
        }, FormList::class);
    }

    /**
     * {@inheritdoc}
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