<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Contracts\SubscriptionItems as SubscriptionItems;
use RandomState\Stripe\Fake\Nested\RequestableCollection;
use RandomState\Stripe\Fake\Traits\Fake;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class Subscription extends \Stripe\Subscription
{
    use RuntimeExpansions, Fake;

    /**
     * @var SubscriptionItems
     */
    protected $subscriptionItems;

    public function setSubscriptionItems(SubscriptionItems $items)
    {
        $this->subscriptionItems = $items;

        return $this;
    }

    public function subscriptionItems()
    {
        return $this->subscriptionItems;
    }

    public function &__get($k)
    {
        if($k === 'items') {
            $items = RequestableCollection::constructFrom([
                'data' => parent::__get($k)
            ]);

            return $items;
        }

        if($k === 'plan' && count($this->items->data) == 1) {
            return $this->items->data[0]->plan;
        }

        return parent::__get($k);
    }

    public function save($opts = null)
    {
    }

    public function deleteDiscount($params = null, $opts = null)
    {
        $this->coupon = null;
        $this->discount = null;

        return $this;
    }

    public function cancel($params = null, $opts = null)
    {
        $this->status = 'canceled';

        return $this;
    }
}