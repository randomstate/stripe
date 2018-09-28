# randomstate/stripe

A stripe (PHP) wrapper for seriously easy testing. Brought to you with ❤️ from Random State.

> **This package is still being tested in real-life. I'm confident that it does what it says it does but there may still be a number of paths in the code that don't exactly fake over the stripe API.** 

## Installation

`composer require randomstate/stripe`

### Laravel

* Create a Service Provider object - e.g. `php artisan make:provider BillingServiceProvider`
* Add it into your app.php `providers` array
* Bind your billing provider

For Stripe:
```php
public function register() {
    $this->app->bind(\RandomState\Stripe\BillingProvider::class, \RandomState\Stripe\Stripe::class);
    $this->app->bind(\RandomState\Stripe\Stripe::class, function() {
        return new \RandomState\Stripe\Stripe(env("STRIPE_SECRET"));
    });
}
```

For testing, you can bind the `BillingProvider` contract to `\RandomState\Stripe\Fake::class` and use it
as if you were interacting with stripe.

## Usage

Each provider conforms to the `BillingProvider` contract but essentially follows the natural way that the stripe API
works.

E.g.

```php

$stripe->charges()->create([
    'amount' => 100,
    // etc
])

$stripe->subscriptions()->items()->retrieve($itemId); // etc
```

## Testing Helpers

This package comes out of the box with the following helpful features:
* starting_after, ending_before and limit support during `all` queries
* Webhook spoofing using event data. In Laravel you might do something like this to fake webhook calls:

```php

$webhooks = new WebhookListener($this->stripe->events());
$webhooks->record();

// perform actions

$events = $webhooks->play();

// Alternatively,
$events = $webhooks->during(function() {
    // perform actions
});


// Forward webhooks to your controllers in Laravel like so:
$webhooks->listen(function(Event $event) {
    $this->postJson('/my/webhooks/endpoint', $event->jsonSerialize());
});

$webhooks->during(function() {
     // perform actions and all events will be played automatically by sending the data as 
     // a POST request to your webhook endpoint as defined above.
});
```

## License

MIT. Use at your own risk, we accept no liability for how this code is used.