<?php

namespace MailPoet\Premium\AutomaticEmails\WooCommerce\Events;

use MailPoet\Models\Subscriber;
use MailPoet\Newsletter\Scheduler\Scheduler;
use MailPoet\Premium\AutomaticEmails\WooCommerce\WooCommerce;
use MailPoet\WP\Hooks;

class FirstPurchase {
  const SLUG = 'woocommerce_first_purchase';
  const ORDER_TOTAL_SHORTCODE = '[woocommerce:order_total]';
  const ORDER_DATE_SHORTCODE = '[woocommerce:order_date]';

  function init() {
    Hooks::addFilter('mailpoet_newsletter_shortcode', array(
      $this,
      'handleOrderTotalShortcode'
    ), 10, 4);
    Hooks::addFilter('mailpoet_newsletter_shortcode', array(
      $this,
      'handleOrderDateShortcode'
    ), 10, 4);
    Hooks::addAction('woocommerce_payment_complete', array(
      $this,
      'scheduleEmailWhenOrderIsPlaced'
    ), 10, 1);
  }

  function getEventDetails() {
    return array(
      'slug' => self::SLUG,
      'title' => __('First Purchase', 'mailpoet-premium'),
      'description' => __('Let MailPoet send an email to customers who make their first purchase.', 'mailpoet-premium'),
      'listingScheduleDisplayText' => __('when first purchase is made', 'mailpoet-premium'),
      'badge' => array(
        'text' => __('Must-have', 'mailpoet-premium'),
        'style' => 'red'
      ),
      'shortcodes' => array(
        array(
          'text' => __('Order amount', 'mailpoet-premium'),
          'shortcode' => self::ORDER_TOTAL_SHORTCODE
        ),
        array(
          'text' => __('Order date', 'mailpoet-premium'),
          'shortcode' => self::ORDER_DATE_SHORTCODE
        )
      )
    );
  }

  function handleOrderDateShortcode($shortcode, $newsletter, $subscriber, $queue) {
    if($shortcode !== self::ORDER_DATE_SHORTCODE) return $shortcode;

    $default_value = date_i18n(get_option('date_format'));
    if(!$queue) return $default_value;

    $meta = $queue->getMeta();
    return (!empty($meta['order_date'])) ? date_i18n(get_option('date_format'), $meta['order_date']) : $default_value;
  }

  function handleOrderTotalShortcode($shortcode, $newsletter, $subscriber, $queue) {
    if($shortcode !== self::ORDER_TOTAL_SHORTCODE) return $shortcode;

    $default_value = wc_price(0);
    if(!$queue) return $default_value;

    $meta = $queue->getMeta();
    return (!empty($meta['order_amount'])) ? wc_price($meta['order_amount']) : $default_value;
  }

  function scheduleEmailWhenOrderIsPlaced($order_id) {
    $order_details = wc_get_order($order_id);
    if(!$order_details || !$order_details->get_customer_id()) return;

    $customer_order_count = wc_get_customer_order_count($order_details->get_customer_id());
    if($customer_order_count > 1) return;

    $meta = array(
      'order_amount' => $order_details->total,
      'order_date' => $order_details->get_date_created()->getTimestamp(),
      'order_id' => $order_details->get_id()
    );

    $subscriber = Subscriber::where('wp_user_id', $order_details->get_customer_id())->findOne();
    if(!$subscriber) return;

    Scheduler::scheduleAutomaticEmail(WooCommerce::SLUG, self::SLUG, $scheduling_condition = false, $subscriber->id, $meta);
  }
}