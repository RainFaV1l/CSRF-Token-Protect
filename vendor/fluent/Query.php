<?php

namespace vendor\fluent;

class Query extends Fluent
{
    private array $conditions = [];

    public function setCondition($field, $operator, $value)
    {
        $this->conditions[] = [
            'field' => $field,
            'operator' => $operator,
            'value' => $value,
        ];
    }

    public function execute()
    {
        return [
            'conditions' => $this->conditions,
        ];
    }
}