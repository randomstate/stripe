<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Ids;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;
use Stripe\StripeObject;

class SubscriptionItem extends \Stripe\SubscriptionItem
{
    use Ids, RuntimeExpansions;

    public static function constructFrom($values, $opts = null)
    {
        if($values instanceof StripeObject) {
            $values = $values->jsonSerialize();
        }

        if(!($values['id'] ?? false)) {
            $temp = new self;
            $values['id'] = $temp->generateId();
        }

        $item = parent::constructFrom($values, $opts);

        if (is_string($values['plan'])) {
            $item->plan = Plan::constructFrom(['id' => $values['plan']]);
        }

        return $item;
    }

    public function delete($params = null, $opts = null)
    {

    }

    public static function idPrefix()
    {
        return 'si_';
    }


}