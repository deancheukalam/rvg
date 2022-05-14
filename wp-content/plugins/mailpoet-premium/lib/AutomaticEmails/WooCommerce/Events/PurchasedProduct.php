<?php

namespace MailPoet\Premium\AutomaticEmails\WooCommerce\Events;

use MailPoet\Models\Subscriber;
use MailPoet\Newsletter\Scheduler\Scheduler;
use MailPoet\Premium\AutomaticEmails\WooCommerce\WooCommerce;
use MailPoet\Util\Helpers;
use MailPoet\WP\Hooks;

class PurchasedProduct {
  const SLUG = 'woocommerce_product_purchased';

  function init() {
    remove_all_filters('woocommerce_product_purchased_get_products');
    Hooks::addFilter(
      'woocommerce_product_purchased_get_products',
      array(
        $this,
        'getProducts'
      )
    );
    Hooks::addAction('woocommerce_payment_complete', array(
      $this,
      'scheduleEmailWhenProductIsPurchased'
    ), 10, 1);
  }

  function getEventDetails() {
    return array(
      'slug' => self::SLUG,
      'title' => __('Purchased This Product', 'mailpoet-premium'),
      'description' => __('Let MailPoet send an email to customers who purchase a specific product.', 'mailpoet-premium'),
      'listingScheduleDisplayText' => __('when %s is purchased', 'mailpoet-premium'),
      'options' => array(
        'type' => 'remote',
        'multiple' => true,
        'remoteQueryMinimumInputLength' => 3,
        'remoteQueryFilter' => 'woocommerce_product_purchased_get_products',
        'placeholder' => __('Start typing to search for products...', 'mailpoet-premium'),
      )
    );
  }

  function getProducts($product_search_query) {
    $args = array(
      'post_type' => 'product',
      'post_status' => 'publish',
      's' => $product_search_query,
      'orderby' => 'title',
      'order' => 'ASC'
    );
    $woocommerce_products = new \WP_Query($args);
    $woocommerce_products = $woocommerce_products->get_posts();
    if(empty($woocommerce_products)) return;

    return array_map(function($product) {
      return array(
        'id' => $product->ID,
        'name' => $product->post_title
      );
    }, $woocommerce_products);
  }

  function scheduleEmailWhenProductIsPurchased($order_id) {
    $order_details = wc_get_order($order_id);
    if(!$order_details || !$order_details->get_customer_id()) return;

    $ordered_products = array_map(function($product) {
      return $product->get_product_id();
    }, $order_details->get_items());

    $scheduling_condition = function($automatic_email) use ($ordered_products) {
      $meta = $automatic_email->getMeta();

      if(empty($meta['option'])) return false;

      $meta_products = Helpers::arrayColumn($meta['option'], 'id');
      $matched_products = array_intersect($meta_products, $ordered_products);

      return !empty($matched_products);
    };

    $subscriber = Subscriber::where('wp_user_id', $order_details->get_customer_id())->findOne();
    if(!$subscriber) return;

    Scheduler::scheduleAutomaticEmail(WooCommerce::SLUG, self::SLUG, $scheduling_condition, $subscriber->id);
  }
}