<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Contracts\InvoiceItems as InvoiceItems;
use RandomState\Stripe\Fake\Nested\RequestableCollection;
use RandomState\Stripe\Fake\Traits\CrudMethods;
use Stripe\InvoiceLineItem;

class Invoices implements \RandomState\Stripe\Contracts\Invoices
{
    use CrudMethods;

    /**
     * @var InvoiceItems
     */
    protected $items;

    public function __construct(InvoiceItems $items)
    {
        $this->items = $items;

        $this->onCreate[] = $this->lineItemPopulator();
    }

    protected function lineItemPopulator()
    {
        return function (Invoice $invoice) {
            $invoice->lines = RequestableCollection::constructFrom([
                'data' => array_map(function(InvoiceItem $item) {
                    return InvoiceLineItem::constructFrom([
                        'id' => uniqid('il_'),
                        'amount' => $item->amount,
                        'invoice_item' => $item->id,
                        'currency' => $item->currency,
                        'description' => $item->description,
                        'metadata' => $item->metadata,
                        'subscription' => $item->subscription,
                        'subscription_item' => $item->subscription_item,
                        'tax_rates' => $item->tax_rates,
                    ]);
                }, $this->items()->all()->data)
            ]);

            $invoice->lines->onAll(function($params) use($invoice) {
                return $invoice->lines;
            });
        };
    }

    public static function idPrefix()
    {
        return 'in_';
    }

    public function getResourceClass()
    {
        return Invoice::class;
    }

    public function items(): InvoiceItems
    {
        return $this->items;
    }


    public function upcoming($params = null, $opts = null)
    {
        $populator = $this->lineItemPopulator();
        $invoice = Invoice::constructFrom([]);

        $populator($invoice);
        return $invoice;
    }
}