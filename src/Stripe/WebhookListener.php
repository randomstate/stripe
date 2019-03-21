<?php


namespace RandomState\Stripe\Stripe;


use Closure;
use Stripe\Event;

class WebhookListener
{
    /**
     * @var Events
     */
    protected $events;

    /**
     * @var string
     */
    protected $mostRecentEventId;

    /**
     * @var Closure
     */
    protected $onEvent;

    /**
     * @var WebhookSigner
     */
    protected $signer;

    public function __construct(Events $events, WebhookSigner $signer = null)
    {
        $this->events = $events;
        $this->signer = $signer;
    }

    public function record()
    {
        $this->mostRecentEventId = $this->mostRecentEventId();
    }

    public function play()
    {
        $events = $this->events->all([
            'ending_before' => $this->mostRecentEventId,
            'limit' => 100,
        ]);

        $this->mostRecentEventId = $this->mostRecentEventId();

        if($this->onEvent) {
            foreach($events->autoPagingIterator() as $event) {
                $signature = $this->signer ? $this->signer->sign($event) : null;
                ($this->onEvent)($event, $signature);
            }
        }

        return $events->autoPagingIterator();
    }

    public function during(Closure $closure)
    {
        $this->record();
        $closure();
        return $this->play();
    }

    protected function mostRecentEventId()
    {
        $events = $this->events->all(['limit' => 1]);

        if (count($events->data) > 0) {
            return array_values($events->data)[0]->id;
        }

        return null;
    }

    public function listen(Closure $onEvent)
    {
        $this->onEvent = $onEvent;
    }
}