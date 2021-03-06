<?php


namespace RandomState\Stripe\Fake\Nested;


use Closure;
use Stripe\Collection;

class RequestableCollection extends Collection
{
    protected $onCreate;
    protected $onRetrieve;
    protected $onAll;

    protected $onGet;

    public function create($params = null, $opts = null)
    {
        return ($this->onCreate ?? $this->dummy())($params, $opts);
    }

    public function retrieve($id, $params = null, $opts = null)
    {
        return ($this->onRetrieve ?? $this->dummy())($id, $params, $opts);
    }

    public function all($params = null, $opts = null)
    {
        return ($this->onAll ?? $this->dummy())($params, $opts);
    }


    public function onCreate(Closure $closure)
    {
        $this->onCreate = $closure;

        return $this;
    }

    public function onRetrieve(Closure $closure)
    {
        $this->onRetrieve = $closure;

        return $this;
    }

    public function onAll(Closure $closure)
    {
        $this->onAll = $closure;

        return $this;
    }

    public function onGet(Closure $closure)
    {
        $this->onGet = $closure;

        return $this;
    }

    public function &__get($k)
    {
        if($this->onGet) {
            $value = ($this->onGet)($k);

            if($value) {
                return $value;
            }
        }

        return parent::__get($k);
    }

    protected function dummy()
    {
        return function($params, $opts){};
    }
}