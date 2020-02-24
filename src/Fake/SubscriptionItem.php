<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Fake;
use RandomState\Stripe\Fake\Traits\Ids;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;
use Stripe\StripeObject;

class SubscriptionItem extends \Stripe\SubscriptionItem
{
    use Ids, RuntimeExpansions, Fake;

    public static function constructFrom($values, $opts = null)
    {
        if($values instanceof StripeObject) {
            $values = $values->jsonSerialize();
        }

        if(!($values['id'] ?? false)) {
            $temp = new self;
            $values['id'] = $temp->generateId();
        }

        return parent::constructFrom($values, $opts);
    }

    public function delete($params = null, $opts = null)
    {

    }

    public function save($opts = null)
    {
        $this->fake->subscriptions()->items()->update($this->id, $this->toArray());

        return true;
    }

    public static function idPrefix()
    {
        return 'si_';
    }


}