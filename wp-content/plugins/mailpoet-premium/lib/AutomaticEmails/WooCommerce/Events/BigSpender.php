<?php

namespace MailPoet\Premium\AutomaticEmails\WooCommerce\Events;

class BigSpender {
  const SLUG = 'woocommerce_big_spender';

  function getEventDetails() {
    return array(
      'slug' => self::SLUG,
      'title' => __('Big Spender', 'mailpoet-premium'),
      'description' => __('Let MailPoet send an email to customers who have spent a certain amount to thank them, possibly with a coupon.', 'mailpoet-premium'),
      'listingScheduleDisplayText' => __('when customer spends %s', 'mailpoet-premium'),
      'soon' => true,
      'badge' => array(
        'text' => __('Smart to have', 'mailpoet-premium'),
        'style' => 'teal'
      )
    );
  }
}