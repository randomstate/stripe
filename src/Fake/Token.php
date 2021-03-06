<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Traits\Fake;
use RandomState\Stripe\Fake\Traits\RuntimeExpansions;

class Token extends \Stripe\Token
{
    use RuntimeExpansions, Fake;

    public static function constructFrom($values, $opts = null)
    {
        if($card = ($values['card'] ?? false)) {
            $values['card'] = [
              'id' => uniqid('card_'),
              'exp_month' => $card['exp_month'],
              'exp_year' => $card['exp_year'],
              'last4' => substr($card['number'], -4, 4),
            ];
        }

        $values['used'] = false;

        return parent::constructFrom($values, $opts);
    }
}