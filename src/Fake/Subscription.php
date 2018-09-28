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

        return parent::__get($k);
    }

    public function cancel($params = null, $opts = null)
    {
        $this->status = 'canceled';

        return $this;
    }
}