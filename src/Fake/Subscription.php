<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Nested\RequestableCollection;

class Subscription extends \Stripe\Subscription
{
    public function &__get($k)
    {
        if($k === 'items') {
            $items = parent::__get($k);
            $processed = [];

            foreach($items as $item) {
                $processed[] = SubscriptionItem::constructFrom($item);
            }

            $items = RequestableCollection::constructFrom([
                'data' => $processed
            ]);

            return $items;
        }


        if($k === 'plan' && count($this->items) == 1) {
            return $this->items->data[0]->plan;
        }

        return parent::__get($k);
    }

    public function save($opts = null)
    {
    }

    public function deleteDiscount()
    {
        $this->coupon = null;
        $this->discount = null;
    }

    public function cancel($params = null, $opts = null)
    {
        $this->status = 'canceled';

        return $this;
    }
}