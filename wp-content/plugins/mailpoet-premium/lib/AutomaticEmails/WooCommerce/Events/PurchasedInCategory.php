<?php

namespace MailPoet\Premium\AutomaticEmails\WooCommerce\Events;

class PurchasedInCategory {
  const SLUG = 'woocommerce_product_purchased_in_category';

  function getEventDetails() {
    return array(
      'slug' => self::SLUG,
      'title' => __('Purchased In This Category', 'mailpoet-premium'),
      'description' => __('Let MailPoet send an email to customers who purchase a product from a specific category.', 'mailpoet-premium'),
      'listingScheduleDisplayText' => __('when product is purchased in %s', 'mailpoet-premium'),
      'soon' => true
    );
  }
}