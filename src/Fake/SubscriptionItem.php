<?php


namespace RandomState\Stripe\Fake;


class SubscriptionItem extends \Stripe\SubscriptionItem
{
    public static function constructFrom($values, $opts = null)
    {
        $item = parent::constructFrom($values, $opts);

        if (is_string($values['plan'])) {
            $item->plan = Plan::constructFrom(['id' => $values['plan']]);
        }

        return $item;
    }

    public function delete($params = null, $opts = null)
    {

    }
}