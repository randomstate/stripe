<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake\Nested\RequestableCollection;
use Stripe\Collection;
use Stripe\Util\Util;

class Customer extends \Stripe\Customer
{
    protected $_sources = [];

    /**
     * @var Collection
     */
    protected $sources;

    protected $dummyCards = [
        'tok_visa',
        'tok_visa_debit',
        'tok_mastercard',
        'tok_mastercard_debit',
        'tok_mastercard_prepaid',
        'tok_amex',
        'tok_discover',
        'tok_diners',
        'tok_jcb',
        'tok_unionpay',
        'tok_br',
        'tok_ca',
        'tok_mx',
        'tok_at',
        'tok_be',
        'tok_dk',
        'tok_fi',
        'tok_fr',
        'tok_de',
        'tok_ie',
        'tok_it',
        'tok_lu',
        'tok_nl',
        'tok_no',
        'tok_pt',
        'tok_ru',
        'tok_es',
        'tok_se',
        'tok_ch',
        'tok_gb',
        'tok_gb_debit',
    ];

    protected $sourcesClient;

    public function __construct($id = null, $opts = null)
    {
        parent::__construct($id, $opts);
        $this->sourcesClient = new Sources;
    }

    public function &__get($k)
    {
        if ($k === 'sources') {
            $this->sources = $this->mockSources();

            return $this->sources;
        }

        return parent::__get($k);
    }

    protected function mockSources()
    {
        $sources = RequestableCollection::constructFrom([
            'data' => $this->sourcesClient->all()
        ]);

        $sources
            ->onCreate(function ($params) {
                $source = $this->sourcesClient->create($params);
                $source->customer = $this->id;

                return $source;
            })
            ->onRetrieve(function ($id) {
                $source =  $this->sourcesClient->retrieve($id);

                return $source;
            })
            ->onAll(function($params) {
                return $this->sourcesClient->all($params);
            })
        ;

        return $sources;
    }
}