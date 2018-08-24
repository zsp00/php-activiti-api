<?php
/**
 * Created by IntelliJ IDEA.
 * User: zhusipu
 * Date: 2018/8/14
 * Time: 下午9:08
 */
namespace Activiti\Client\Model\Form;
class FormProperties implements \IteratorAggregate
{
    /**
     * @var array
     */
    private $items;

    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * {@inheritdoc}
     */
    public function getIterator()
    {
        $result = [];
        foreach ($this->items as $v) {
            $result[] = new FormProperty($v);
        }
        return $result;
    }
}