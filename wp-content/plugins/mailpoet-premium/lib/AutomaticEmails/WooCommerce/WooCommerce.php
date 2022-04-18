<?php

namespace MailPoet\Premium\AutomaticEmails\WooCommerce;

use MailPoet\Premium\AutomaticEmails\AutomaticEmails;
use MailPoet\WP\Hooks;
use MailPoet\WP\Notice;

class WooCommerce {
  const SLUG = 'woocommerce';
  const EVENTS_FILTER = 'mailpoet_woocommerce_events';

  public $available_events = array(
    'AbandonedCart',
    'BigSpender',
    'FirstPurchase',
    'PurchasedInCategory',
    'PurchasedProduct'
  );
  private $_woocommerce_enabled;

  function __construct() {
    $this->_woocommerce_enabled = $this->isWoocommerceEnabled();
  }

  function init() {
    Hooks::addFilter(
      AutomaticEmails::FILTER_PREFIX . self::SLUG,
      array(
        $this,
        'setupGroup'
      )
    );
    Hooks::addFilter(
      self::EVENTS_FILTER,
      array(
        $this,
        'setupEvents'
      )
    );
  }

  function setupGroup() {
    return array(
      'slug' => self::SLUG,
      'beta' => true,
      'title' => __('WooCommerce', 'mailpoet-premium'),
      'description' => __('Automatically send an email when there is a new WooCommerce product, order and some other action takes place.', 'mailpoet-premium'),
      'events' => Hooks::applyFilters(self::EVENTS_FILTER, array())
    );
  }

  function setupEvents($events) {
    $custom_event_details = (!$this->_woocommerce_enabled) ? array(
      'actionButtonTitle' => __('WooCommerce is required', 'mailpoet-premium'),
      'actionButtonLink' => 'https://en-ca.wordpress.org/plugins/woocommerce/'
    ) : array();

    foreach($this->available_events as $event) {
      $event_class = sprintf(
        '%s\Events\%s',
        __NAMESPACE__,
        $event
      );
      if(!class_exists($event_class) || !method_exists($event_class, 'getEventDetails')) {
        $notice = sprintf('%s %s',
          sprintf(__('WooCommerce %s event is misconfigured.', 'mailpoet-premium'), $event),
          __('Please contact our technical support for assistance.', 'mailpoet-premium')
        );
        Notice::displayWarning($notice);

        continue;
      }

      $event_instance = new $event_class();

      if(method_exists($event_class, 'init')) {
        $event_instance->init();
      }

      $event_details = array_merge($event_instance->getEventDetails(), $custom_event_details);
      $events[] = $event_details;
    }

    return $events;
  }

  function isWoocommerceEnabled() {
    return class_exists('WooCommerce');
  }
}