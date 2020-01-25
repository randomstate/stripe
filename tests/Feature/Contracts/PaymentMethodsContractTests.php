<?php


namespace RandomState\Tests\Stripe\Feature\Contracts;

use RandomState\Stripe\Contracts\Customers;
use RandomState\Stripe\Contracts\PaymentMethods;
use Stripe\PaymentMethod;

trait PaymentMethodsContractTests
{
    /**
     * @var PaymentMethods
     */
    protected $paymentMethodsClient;

    /**
     * @var Customers
     */
    protected $customersClient;

    protected function setUp()
    {
        parent::setUp();
        $this->paymentMethodsClient = $this->getPaymentMethodsClient();
        $this->customersClient = $this->getCustomersClient();
    }

    abstract public function getPaymentMethodsClient();
    abstract public function getCustomersClient();


    /**
     * @test
     */
    public function can_create_payment_method()
    {
        $pm = $this->paymentMethodsClient->create([
            'type' => 'card',
            'card' => ['token' => 'tok_visa_debit'],
        ]);

        $this->assertInstanceOf(PaymentMethod::class, $pm);
        $this->assertNotNull($pm->id);
    }

    /**
     * @test
     */
    public function can_retrieve_payment_method()
    {
        $pm = $this->paymentMethodsClient->create([
            'type' => 'card',
            'card' => ['token' => 'tok_visa_debit'],
        ]);

        $found = $this->paymentMethodsClient->retrieve($pm->id);

        $this->assertEquals($pm->id, $found->id);
    }

    /**
     * @test
     */
    public function can_attach_payment_method_to_customer()
    {
        $customer = $this->customersClient->create();
        $pm = $this->paymentMethodsClient->create([
            'type' => 'card',
            'card' => ['token' => 'tok_visa_debit'],
        ]);

        $pm->attach(['customer' => $customer->id]);

        $this->assertEquals($customer->id, $pm->customer);
    }

    /**
     * @test
     */
    public function can_update_payment_method()
    {
        $customer = $this->customersClient->create();
        $pm = $this->paymentMethodsClient->create([
            'type' => 'card',
            'card' => ['token' => 'tok_visa_debit'],
        ]);

        $pm->attach(['customer' => $customer]);

        $updated = $this->paymentMethodsClient->update($pm->id, ['metadata' => ['test' => 'test']]);

        $this->assertEquals('test', $updated->metadata->test);
    }

    /**
     * @test
     */
    public function can_list_customer_payment_methods()
    {
        $customer = $this->customersClient->create();
        $customer2 = $this->customersClient->create();
        $pm = $this->paymentMethodsClient->create([
            'type' => 'card',
            'card' => ['token' => 'tok_visa_debit'],
        ]);

        $pm->attach(['customer' => $customer->id]);

        $pms = $this->paymentMethodsClient->all([
            'customer' => $customer->id,
            'type' => 'card',
        ]);

        $otherPms = $this->paymentMethodsClient->all([
            'customer' => $customer2->id,
            'type' => 'card',
        ]);

        $this->assertCount(1, $pms->data);
        $this->assertEquals($pm->id, $pms->data[0]->id);
        $this->assertCount(0, $otherPms->data);
    }

    /**
     * @test
     */
    public function can_detach_payment_method_from_customer()
    {
        $customer = $this->customersClient->create();
        $pm = $this->paymentMethodsClient->create([
            'type' => 'card',
            'card' => ['token' => 'tok_visa_debit'],
        ]);

        $pm->attach(['customer' => $customer->id]);
        $this->assertEquals($customer->id, $pm->customer);

        $pm->detach();
        $this->assertNull($pm->customer);
    }
}