<?php

namespace MailPoet\Premium\AutomaticEmails\WooCommerce\Events;

class AbandonedCart {
  const SLUG = 'woocommerce_abandoned_shopping_cart';

  function getEventDetails() {
    return array(
      'slug' => self::SLUG,
      'title' => __('Abandoned Shopping Cart', 'mailpoet-premium'),
      'description' => __('Send an email to logged-in visitors who have items in their shopping carts but left your website without checking out. Can convert up to 5% of abandoned carts.', 'mailpoet-premium'),
      'listingScheduleDisplayText' => __('when cart is abandoned', 'mailpoet-premium'),
      'soon' => true,
      'badge' => array(
        'text' => __('Must-have', 'mailpoet-premium'),
        'style' => 'red'
      )
    );
  }
}