<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Nested\RequestableCollection;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class Subscription extends \Stripe\Subscription
{
    use RuntimeExpansions;

    public static function constructFrom($values, $opts = null)
    {
        $sub = parent::constructFrom($values, $opts);
        $sub->refreshFrom(['status' => 'active'], $opts, true);

        return $sub;
    }

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