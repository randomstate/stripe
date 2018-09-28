<?php


namespace RandomState\Stripe\Stripe\Operations;


class ListOperator
{
    protected $operators = [];
    protected $defaultOperators = [];

    public function __construct()
    {
        $this->defaultOperators = [
            new ReverseChronologicalOrder(),
        ];

        $this->operators = [
            'ending_before' => new EndingBefore(),
            'starting_after' => new StartingAfter(),
            'limit' => new LimitOperator(),
        ];
    }

    public function apply(array $operators = null, $items)
    {
        // Defaults
        foreach ($this->defaultOperators as $operator) {
            $items = $operator->apply($items);
        }

        if(!$operators) {
            return $items;
        }

        foreach ($this->operators as $operatorKey => $operator) {
            if(in_array($operatorKey, array_keys($operators))) {
                $opts = $operators[$operatorKey];
                $items = $this->getOperator($operatorKey)->apply($items, $opts);
            }
        }

        return $items;
    }

    protected function getOperator($operator)
    {
        return $this->operators[$operator];
    }
}