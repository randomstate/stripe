<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake;
use RandomState\Stripe\Fake\Crud\Creater;
use RandomState\Stripe\Fake\Traits\Deletable;
use RandomState\Stripe\Fake\Traits\Ids;
use RandomState\Stripe\Fake\Traits\Listable;
use RandomState\Stripe\Fake\Traits\Retrievable;
use RandomState\Stripe\Fake\Traits\Updatable;
use Stripe\TaxRate;

class SubscriptionItems extends FakeClient implements \RandomState\Stripe\Contracts\SubscriptionItems
{
    use Ids, Retrievable, Updatable, Listable, Deletable {
        Updatable::resolveExpansions insteadof Listable;
    }

    /**
     * @var Creater
     */
    protected $creater;

    /**
     * @var Crud\Updater
     */
    protected $updater;

    public function __construct(Fake $stripe)
    {
        parent::__construct($stripe);
        $this->creater = new Creater(
            function() {
                return $this->generateId();
            },
            $this->getResourceClass()
        );

        $this->creater->onCreate(function(SubscriptionItem $item) {
            $item->fake = $this->stripe;
        });

        $this->updater = new Fake\Crud\Updater();
    }

    public function create($params = [])
    {
        if($params['plan'] ?? false) {
            $params['plan'] = $this->stripe->plans()->retrieve($params['plan']);
        }

        $params['quantity'] = $params['quantity'] ?? 1;

        if($params['tax_rates'] ?? false) {
            foreach($params['tax_rates'] as $key => $rate) {
                $params['tax_rates'][$key] = TaxRate::constructFrom(['id' => $rate]);
            }
        }

        $item = $this->creater->create($params);
        $this->resources[$item->id] = $item;

        return clone $item;
    }

    public function update($id, $params)
    {
        if($params['plan'] ?? false) {
            $params['plan'] = $this->stripe->plans()->retrieve($params['plan']);
        }

        $found = $this->retrieve($id);
        $this->updater->setOnUpdates($this->onUpdate);

        $item = $this->updater->update($found, $params);
        $this->resources[$item->id] = $item;

        return $item;
    }

    public static function idPrefix()
    {
        return SubscriptionItem::idPrefix();
    }

    public function getResourceClass()
    {
        return SubscriptionItem::class;
    }


}