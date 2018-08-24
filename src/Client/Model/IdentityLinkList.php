<?php

namespace Activiti\Client\Model;

class IdentityLinkList implements \IteratorAggregate
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
        return new \ArrayIterator($this->items);
    }

    public function groupToUsers() {
        $result = [
            'assignee'  =>  [],
            'candidate' =>  []
        ];
        $items = new \ArrayIterator($this->items);
        foreach($items as $item) {
            $result[$item->getType()][] = $item->getUser();
        }
        return $result;
    }
}
