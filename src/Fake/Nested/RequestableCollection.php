<?php


namespace RandomState\Stripe\Fake\Nested;


use Closure;
use Stripe\Collection;

class RequestableCollection extends Collection
{
    protected $onCreate;
    protected $onRetrieve;
    protected $onAll;

    public function create($params = null, $opts = null)
    {
        return ($this->onCreate)($params, $opts);
    }

    public function retrieve($id, $params = null, $opts = null)
    {
        return ($this->onRetrieve)($id, $params, $opts);
    }

    public function all($params = null, $opts = null)
    {
        return ($this->onAll)($params, $opts);
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
}