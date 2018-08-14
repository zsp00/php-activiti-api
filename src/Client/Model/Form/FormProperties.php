<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午4:34
 */

namespace Activiti\Client\Model\Form;


class FormProperties
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

    public function getType() {
        return $this->data['type'];
    }

    public function setType($type) {
        $this->data['type'] = $type;
    }

    public function getBalue() {
        return $this->data['value'];
    }

    public function setValue($value) {
        $this->data['value'] = $value;
    }

    public function getReadable() {
        return $this->data['readable'];
    }

    public function setReadable($readable) {
        $this->data['readable'] = $readable;
    }

    public function getWritable() {
        return $this->data['writable'];
    }

    public function setWritable($writable) {
        $this->data['writable'] = $writable;
    }

    public function getRequired() {
        return $this->data['required'];
    }

    public function setRequired($required) {
        $this->data['required'] = $required;
    }

    public function getDatePattern() {
        return $this->data['datePattern'];
    }

    public function setDatePattern($datePattern) {
        $this->data['datePattern'] = $datePattern;
    }

    public function getEnumValues() {
        return $this->data['enumValues'];
    }

    public function setEnumValues($enumValues) {
        foreach($enumValues as $enumValue) {
            $this->data['enumValues'][] = new EnumValues($enumValue);
        }
    }
}