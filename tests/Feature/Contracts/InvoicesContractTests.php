<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;


use Stripe\Invoice;
use Stripe\InvoiceLineItem;

trait InvoicesContractTests
{

    abstract protected function getClient();
    abstract protected function getInvoiceItemsClient();
    abstract protected function getCustomersClient();

    /**
     * @test
     */
    public function can_create_an_invoice()
    {
        $customer = $this->getCustomersClient()->create();
        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $invoice = $this->getClient()->create([
            'customer' => $customer->id,
            'description' => 'My test invoice',
        ]);

        $this->assertInstanceOf(Invoice::class, $invoice);
        $this->assertNotNull($invoice->id);
        $this->assertEquals('My test invoice', $invoice->description);
        $this->assertEquals(5000, $invoice->total);
    }

    /**
     * @test
     */
    public function can_retrieve_an_invoice()
    {
        $customer = $this->getCustomersClient()->create();
        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $invoice = $this->getClient()->create([
            'customer' => $customer->id,
            'description' => 'My test invoice',
        ]);

        $found = $this->getClient()->retrieve($invoice->id);

        $this->assertEquals($invoice->id, $found->id);
    }

    /**
     * @test
     */
    public function can_update_an_invoice()
    {
        $customer = $this->getCustomersClient()->create();
        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $invoice = $this->getClient()->create([
            'customer' => $customer->id,
            'description' => 'My test invoice',
        ]);

        $this->getClient()->update($invoice->id, [
            'description' => 'updated',
        ]);

        $found = $this->getClient()->retrieve($invoice->id);

        $this->assertEquals('updated', $found->description);
    }

    /**
     * @test
     */
    public function can_finalize_an_invoice()
    {
        $customer = $this->getCustomersClient()->create();
        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $invoice = $this->getClient()->create([
            'customer' => $customer->id,
            'description' => 'My test invoice',
        ]);

        $invoice->finalizeInvoice();
        $this->assertEquals('open', $invoice->status);
    }

    /**
     * @test
     */
    public function can_pay_an_invoice()
    {
        $customer = $this->getCustomersClient()->create();
        $customer->sources->create(['source' => 'tok_visa']);

        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $invoice = $this->getClient()->create([
            'customer' => $customer->id,
            'description' => 'My test invoice',
        ]);

        $this->assertEquals(5000, $invoice->amount_remaining);
        $invoice->pay();
        $this->assertEquals(0, $invoice->amount_remaining);
    }

    /**
     * @test
     */
    public function can_send_an_invoice_for_manual_payment()
    {
        $customer = $this->getCustomersClient()->create(['email' => 'john@example.com']);
        $customer->sources->create(['source' => 'tok_visa']);

        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $invoice = $this->getClient()->create([
            'customer' => $customer->id,
            'description' => 'My test invoice',
            'collection_method' => 'send_invoice',
            'due_date' => (new \DateTime('+1 day'))->getTimestamp(),
        ]);

        $this->assertInstanceOf(Invoice::class, $invoice->sendInvoice());
    }

    /**
     * @test
     */
    public function can_void_an_invoice()
    {
        $customer = $this->getCustomersClient()->create();
        $customer->sources->create(['source' => 'tok_visa']);

        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $invoice = $this->getClient()->create([
            'customer' => $customer->id,
            'description' => 'My test invoice',
        ]);


        $invoice->finalizeInvoice();
        $invoice->voidInvoice();

        $this->assertEquals('void', $invoice->status);
    }

    /**
     * @test
     */
    public function can_mark_an_invoice_as_uncollectible()
    {
        $customer = $this->getCustomersClient()->create();
        $customer->sources->create(['source' => 'tok_visa']);

        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $invoice = $this->getClient()->create([
            'customer' => $customer->id,
            'description' => 'My test invoice',
        ]);


        $invoice->finalizeInvoice();
        $invoice->markUncollectible();

        $this->assertEquals('uncollectible', $invoice->status);
    }

    /**
     * @test
     */
    public function can_retrieve_an_invoices_line_items()
    {
        $customer = $this->getCustomersClient()->create();
        $customer->sources->create(['source' => 'tok_visa']);

        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $invoice = $this->getClient()->create([
            'customer' => $customer->id,
            'description' => 'My test invoice',
        ]);

        $this->assertCount(1,  $invoice->lines->all()->data);
        $this->assertInstanceOf(InvoiceLineItem::class,  $invoice->lines->all()->data[0]);
    }

    /**
     * @test
     */
    public function can_retrieve_an_upcoming_invoice_for_a_customer()
    {
        $customer = $this->getCustomersClient()->create();
        $customer->sources->create(['source' => 'tok_visa']);

        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $upcoming = $this->getClient()->upcoming(['customer' => $customer->id]);

        $this->assertEquals(5000, $upcoming->total);
    }

    /**
     * @test
     */
    public function can_retrieve_an_upcoming_invoice_line_items()
    {
        $customer = $this->getCustomersClient()->create();
        $customer->sources->create(['source' => 'tok_visa']);

        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $upcoming = $this->getClient()->upcoming(['customer' => $customer->id]);

        $this->assertEquals(5000, $upcoming->lines->all()->data[0]->amount);
    }

    /**
     * @test
     */
    public function can_list_all_invoices()
    {
        $now = time();

        $customer = $this->getCustomersClient()->create();
        $customer->sources->create(['source' => 'tok_visa']);

        $this->getInvoiceItemsClient()->create([
            'customer' => $customer->id,
            'amount' => 5000,
            'currency' => 'usd'
        ]);

        $this->getClient()->create([
            'customer' => $customer->id,
            'description' => 'My test invoice',
        ]);

        $invoices = $this->getClient()->all(['created' => ['gte' => $now]]);
        $this->assertCount(1, $invoices->data);
    }
}