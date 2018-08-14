<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午4:39
 */

namespace Activiti\Client\Model\Form;


class EnumValues
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }


    public function getId() {
        return $this->data['id'];
    }

    public function setId($id) {
        $this->data['id'] = $id;
    }

    public function getName() {
        return $this->data['name'];
    }

    public function setName($name) {
        $this->data['name'] = $name;
    }
}