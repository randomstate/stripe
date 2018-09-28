<?php


namespace RandomState\Stripe\Fake;


class DummySourceFactory
{

    public function build($params)
    {
        $id = uniqid('card_');

        if ($this->isCardTokenCard($params)) {
            return Card::constructFrom(array_merge($params, [
                'id' => $id,
                'last4' => substr(array_search($params['source'], static::$cardNumbers), -4, 4),
            ]));
        } elseif ($this->isCardNumberedCard($params)) {
            return Card::constructFrom([
                'id' => $id,
                'exp_month' => (new \DateTime())->format('M'),
                'exp_year' => (new \DateTime())->format('Y'),
                'cvc' => str_pad(rand(0, 999), 3, 0),
                'last4' => substr($params['source']['number'], -4, 4),
            ]);

        } elseif ($this->isDirectSource($params)) {
            return Source::constructFrom([
                'id' => $params['source'],
            ]);
        }
    }

    public static $cardNumbers = [
        '4242424242424242' => 'tok_visa',
        '4000056655665556' => 'tok_visa_debit',
        '5555555555554444' => 'tok_mastercard',
        '2223003122003222' => 'tok_mastercard',
        '5200828282828210' => 'tok_mastercard_debit',
        '5105105105105100' => 'tok_mastercard_prepaid',
        '378282246310005' => 'tok_amex',
        '371449635398431' => 'tok_amex',
        '6011111111111117' => 'tok_discover',
        '6011000990139424' => 'tok_discover',
        '30569309025904' => 'tok_diners',
        '38520000023237' => 'tok_diners',
        '3566002020360505' => 'tok_jcb',
        '6200000000000005' => 'tok_unionpay',

        '4000000760000002' => 'tok_br',
        '4000001240000000' => 'tok_ca',
        '4012888888881881' => 'n/a',
        '4000004840000008' => 'tok_mx',

        '4000000400000008' => 'tok_at',
        '4000000560000004' => 'tok_be',
        '4000002080000001' => 'tok_dk',
        '4000002460000001' => 'tok_fi',
        '4000002500000003' => 'tok_fr',
        '4000002760000016' => 'tok_de',
        '4000003720000005' => 'tok_ie',
        '4000003800000008' => 'tok_it',
        '4000004420000006' => 'tok_lu',
        '4000005280000002' => 'tok_nl',
        '4000005780000007' => 'tok_no',
        '4000006200000007' => 'tok_pt',
        '4000006430000009' => 'tok_ru',
        '4000007240000007' => 'tok_es',
        '4000007520000008' => 'tok_se',
        '4000007560000009' => 'tok_ch',
        '4000008260000000' => 'tok_gb',
        '4000058260000005' => 'tok_gb_debit',

        '4000000360000006' => 'tok_au',
        '4000001560000002' => 'tok_cn',
        '4000003440000004' => 'tok_hk',
        '4000003920000003' => 'tok_jp',
        '3530111333300000' => 'tok_jcb',
        '4000005540000008' => 'tok_nz',
        '4000007020000003' => 'tok_sg',
    ];

    private function isCardNumberedCard($params)
    {
        if (!($params['source'] ?? false)) {
            return false;
        }

        if(!($params['source']['type'] ?? false)) {
            return false;
        }

        $isCard = $params['source']['type'] === 'card';

        return ($isCard && (static::$cardNumbers[$params['source']['number']] ?? false));
    }

    private function isCardTokenCard($params)
    {
        if (!($params['source'] ?? false)) {
            return false;
        }

        return array_search($params['source'], static::$cardNumbers) > -1;
    }

    private function isDirectSource($params)
    {
        return $params['source'] ?? false;
    }


}