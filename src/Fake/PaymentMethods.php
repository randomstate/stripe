<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake;
use RandomState\Stripe\Fake\Traits\CruMethods;

class PaymentMethods extends FakeClient implements \RandomState\Stripe\Contracts\PaymentMethods
{
    use CruMethods;

    /**
     * @var DummySourceFactory
     */
    protected $dummyFactory;

    public function __construct(Fake $stripe)
    {
        parent::__construct($stripe);
        $this->dummyFactory = new DummySourceFactory($stripe);
    }

    public function retrieve($params)
    {
        $id = $params['id'] ?? $params;

        $item = $this->resources[$id] ?? null;

        if(!$item) {
            $pm = $this->dummyFactory->build($params);
            if(!$pm) {
                return null;
            }
            $this->resources[$pm->id] = $pm;
            $item = $pm;
        }

        $expands = $params['expand'] ?? [];
        $this->resolveExpansions($item, $expands);

        if(!$item) {
            return null;
        }

        return $item;
    }

    public function getResourceClass()
    {
        return PaymentMethod::class;
    }

    public static function idPrefix()
    {
        return 'pm_';
    }
}