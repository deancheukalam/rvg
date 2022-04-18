<?php

namespace MailPoet\Premium\AutomaticEmails;

use MailPoet\Util\Helpers;
use MailPoet\WP\Hooks as WPHooks;
use MailPoet\WP\Notice;

class AutomaticEmails {
  const FILTER_PREFIX = 'mailpoet_automatic_email_';

  public $available_groups = array(
    'WooCommerce'
  );

  function init() {
    foreach($this->available_groups as $group) {
      $group_class = sprintf(
        '%1$s\%2$s\%2$s',
        __NAMESPACE__,
        $group
      );

      if(!class_exists($group_class) || !method_exists($group_class, 'init')) {
        $notice = sprintf('%s %s',
          sprintf(__('%s automatic email group is misconfigured.', 'mailpoet-premium'), $group),
          __('Please contact our technical support for assistance.', 'mailpoet-premium')
        );
        Notice::displayWarning($notice);

        continue;
      }

      $group_instance = new $group_class();
      $group_instance->init();
    }
  }

  function getAutomaticEmails() {
    global $wp_filter;

    $registered_groups = preg_grep('!^' . self::FILTER_PREFIX . '(.*?)$!', array_keys($wp_filter));

    if(empty($registered_groups)) return null;

    $automatic_emails = array();
    foreach($registered_groups as $group) {
      $automatic_email = WPHooks::applyFilters($group, array());

      if(!$this->validateAutomaticEmailDataFields($automatic_email) ||
        !$this->validateAutomaticEmailEventsDataFields($automatic_email['events'])
      ) {
        continue;
      }

      // keys associative events array by slug
      $automatic_email['events'] = Helpers::arrayColumn($automatic_email['events'], null, 'slug');
      // keys associative automatic email array by slug
      $automatic_emails[$automatic_email['slug']] = $automatic_email;
    }

    return $automatic_emails;
  }

  function getAutomaticEmailBySlug($email_slug) {
    $automatic_emails = $this->getAutomaticEmails();

    if(empty($automatic_emails)) return null;

    foreach($automatic_emails as $email) {
      if(!empty($email['slug']) && $email['slug'] === $email_slug) return $email;
    }

    return null;
  }

  function getAutomaticEmailEventBySlug($email_slug, $event_slug) {
    $automatic_email = $this->getAutomaticEmailBySlug($email_slug);

    if(empty($automatic_email)) return null;

    foreach($automatic_email['events'] as $event) {
      if(!empty($event['slug']) && $event['slug'] === $event_slug) return $event;
    }

    return null;
  }

  function validateAutomaticEmailDataFields(array $automatic_email) {
    $required_fields = array(
      'slug',
      'title',
      'description',
      'events'
    );

    foreach($required_fields as $field) {
      if(empty($automatic_email[$field])) return false;
    }

    return true;
  }

  function validateAutomaticEmailEventsDataFields(array $automatic_email_events) {
    $required_fields = array(
      'slug',
      'title',
      'description',
      'listingScheduleDisplayText'
    );

    foreach($automatic_email_events as $event) {
      $valid_event = array_diff($required_fields, array_keys($event));
      if(!empty($valid_event)) return false;
    }

    return true;
  }

  function unregisterAutomaticEmails() {
    global $wp_filter;

    $registered_groups = preg_grep('!^' . self::FILTER_PREFIX . '(.*?)$!', array_keys($wp_filter));

    if(empty($registered_groups)) return null;

    array_map(function($group) {
      WPHooks::removeAllFilters($group);
    }, $registered_groups);
  }
}