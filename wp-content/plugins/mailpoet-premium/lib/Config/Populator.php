<?php

namespace MailPoet\Premium\Config;

use MailPoet\Config\Env as ParentEnv;
use MailPoet\Models\Newsletter;

if(!defined('ABSPATH')) exit;

class Populator extends \MailPoet\Config\Populator {
  function __construct() {
    $this->prefix = ParentEnv::$db_prefix;
    $this->models = array(
      'newsletter_option_fields'
    );
  }

  function up() {
    array_map(array($this, 'populate'), $this->models);
  }

  protected function newsletterOptionFields() {
    $fields = array(
      'group',
      'event',
      'sendTo',
      'segment',
      'afterTimeNumber',
      'afterTimeType',
      'meta',
    );

    return array(
      'rows' => array_map(function($field) {
        return array(
          'name' => $field,
          'newsletter_type' => Newsletter::TYPE_AUTOMATIC,
        );
      }, $fields),
      'identification_columns' => array(
        'name',
        'newsletter_type'
      )
    );
  }
}
