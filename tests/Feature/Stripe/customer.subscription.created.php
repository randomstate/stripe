<?php

return '{
  "created": 1326853478,
  "livemode": false,
  "id": "customer.subscription.created_00000000000000",
  "type": "customer.subscription.created",
  "object": "event",
  "request": null,
  "pending_webhooks": 1,
  "api_version": "2019-03-14",
  "data": {
    "object": {
      "id": "sub_00000000000000",
      "object": "subscription",
      "application_fee_percent": null,
      "billing": "charge_automatically",
      "billing_cycle_anchor": 1538921609,
      "billing_thresholds": null,
      "cancel_at": null,
      "cancel_at_period_end": false,
      "canceled_at": 1539530075,
      "created": 1538316809,
      "current_period_end": 1541600009,
      "current_period_start": 1538921609,
      "customer": "cus_00000000000000",
      "days_until_due": null,
      "default_source": null,
      "discount": null,
      "ended_at": 1539530075,
      "items": {
        "object": "list",
        "data": [
          {
            "id": "si_00000000000000",
            "object": "subscription_item",
            "billing_thresholds": null,
            "created": 1538316809,
            "metadata": {
            },
            "plan": {
              "id": "plan_00000000000000",
              "object": "plan",
              "active": true,
              "aggregate_usage": null,
              "amount": 10000,
              "billing_scheme": "per_unit",
              "created": 1538316808,
              "currency": "gbp",
              "interval": "month",
              "interval_count": 1,
              "livemode": false,
              "metadata": {
              },
              "nickname": null,
              "product": "prod_00000000000000",
              "tiers": null,
              "tiers_mode": null,
              "transform_usage": null,
              "trial_period_days": 7,
              "usage_type": "licensed"
            },
            "quantity": 1,
            "subscription": "sub_00000000000000"
          }
        ],
        "has_more": false,
        "total_count": 1,
        "url": "/v1/subscription_items?subscription=sub_DhUfzPFlQhiMuF"
      },
      "latest_invoice": null,
      "livemode": false,
      "metadata": {
      },
      "plan": {
        "id": "plan_00000000000000",
        "object": "plan",
        "active": true,
        "aggregate_usage": null,
        "amount": 10000,
        "billing_scheme": "per_unit",
        "created": 1538316808,
        "currency": "gbp",
        "interval": "month",
        "interval_count": 1,
        "livemode": false,
        "metadata": {
        },
        "nickname": null,
        "product": "prod_00000000000000",
        "tiers": null,
        "tiers_mode": null,
        "transform_usage": null,
        "trial_period_days": 7,
        "usage_type": "licensed"
      },
      "quantity": 1,
      "schedule": null,
      "start": 1538316809,
      "status": "canceled",
      "tax_percent": null,
      "trial_end": 1538921609,
      "trial_start": 1538316809
    }
  }
}';