<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午1:21
 */

namespace Activiti\Client\Model\Task;


class Activities
{
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }


    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data)
    {
        $this->data = $data;
    }

}