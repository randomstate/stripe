<?php


namespace RandomState\Stripe\Fake;


use RandomState\Stripe\Fake;
use RandomState\Stripe\Fake\Traits\CrudMethods;

class Subscriptions extends FakeClient implements \RandomState\Stripe\Contracts\Subscriptions
{
    use CrudMethods;

    protected $items;

    /**
     * @var Crud\Creater
     */
    protected $creater;

    public function __construct(Fake $stripe, SubscriptionItems $items)
    {
        parent::__construct($stripe);
        $this->items = $items;
        
        $this->creater = new Fake\Crud\Creater(function(){
            return $this->generateId();
        }, $this->getResourceClass());

        $this->updater = new Fake\Crud\Updater();

        $handleTrialEnd = function($item) {
            if($item->trial_end ?? false) {
                if($item->trial_end == 'now') {
                    $item->trial_end = (new \DateTime)->getTimestamp();
                }
            }
        };

        $handleCoupon = function($item) {
            if($item['coupon'] ?? false) {
                $coupon = Coupon::constructFrom(['id' => $item['coupon']]);
                $item->refreshFrom(['discount' => ['coupon' => $coupon]], [], true);
                unset($item['coupon']);
            }
        };

        $this->onCreate[] = $handleTrialEnd;
        $this->onUpdate[] = $handleTrialEnd;

        $this->onCreate[] = $handleCoupon;
        $this->onUpdate[] = $handleCoupon;

    }
    
    public function create($params = [])
    {
        $params = $this->processItems($params);

        if($params['trial_from_plan'] ?? false) {
            $plan = $this->stripe->plans()->retrieve($params['items'][0]->plan->id);
            if($plan->trial_period_days) {
                $params['trial_end'] = (new \DateTime('+'.$plan->trial_period_days.' days'))->getTimestamp();
                $params['status'] = 'trialing';
            }
        } elseif ($params['trial_end'] ?? false) {
            if($params['trial_end'] > (new \DateTime)->getTimestamp()) {
                $params['status'] = 'trialing';
            }
        }

        if(!($params['status'] ?? false)) {
            $params['status'] = 'active';
        }

        $this->creater->setOnCreates($this->onCreate);
        $subscription = $this->creater->create($params);
        $this->resources[$subscription->id] = $subscription;

        return $subscription;
    }

    public function update($id, $params)
    {
        $params = $this->processItems($params);

        $found = $this->retrieve($id);
        $this->updater->setOnUpdates($this->onUpdate);

        $subscription = $this->updater->update($found, $params);
        $this->resources[$subscription->id] = $subscription;

        return $subscription;
    }

    protected function processItems($params)
    {
        if(!isset($params['items'])) {
            $params['items'] = [];
        }

        foreach($params['items'] as $key => $item) {
            $existingItem = $this->items()->retrieve($item['id'] ?? null);
            if($existingItem) {
                $existingItem = $this->items()->update($existingItem->id, $item);
            } else {
                $existingItem = $this->items()->create($item);
            }

            $params['items'][$key] = $existingItem;
        }

        return $params;
    }

    public static function idPrefix()
    {
        return "sub_";
    }

    public function getResourceClass()
    {
        return Subscription::class;
    }

    public function items()
    {
        return $this->items;
    }


}