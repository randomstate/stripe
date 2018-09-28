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

    public function __construct(Events $events)
    {
        $this->events = $events;
    }

    public function record()
    {
        $this->mostRecentEventId = $this->mostRecentEventId();
    }

    public function play()
    {
        $events = $this->events->all([
            'ending_before' => $this->mostRecentEventId,
        ]);

        $this->mostRecentEventId = $this->mostRecentEventId();

        if($this->onEvent) {
            foreach($events->autoPagingIterator() as $event) {
                ($this->onEvent)($event);
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