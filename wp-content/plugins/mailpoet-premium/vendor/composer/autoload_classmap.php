<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'MailPoet\\Premium\\API\\JSON\\v1\\AutomaticEmails' => $baseDir . '/lib/API/JSON/v1/AutomaticEmails.php',
    'MailPoet\\Premium\\API\\JSON\\v1\\DynamicSegments' => $baseDir . '/lib/API/JSON/v1/DynamicSegments.php',
    'MailPoet\\Premium\\API\\JSON\\v1\\NewsletterLinks' => $baseDir . '/lib/API/JSON/v1/NewsletterLinks.php',
    'MailPoet\\Premium\\API\\JSON\\v1\\Stats' => $baseDir . '/lib/API/JSON/v1/Stats.php',
    'MailPoet\\Premium\\AutomaticEmails\\AutomaticEmails' => $baseDir . '/lib/AutomaticEmails/AutomaticEmails.php',
    'MailPoet\\Premium\\AutomaticEmails\\WooCommerce\\Events\\AbandonedCart' => $baseDir . '/lib/AutomaticEmails/WooCommerce/Events/AbandonedCart.php',
    'MailPoet\\Premium\\AutomaticEmails\\WooCommerce\\Events\\BigSpender' => $baseDir . '/lib/AutomaticEmails/WooCommerce/Events/BigSpender.php',
    'MailPoet\\Premium\\AutomaticEmails\\WooCommerce\\Events\\FirstPurchase' => $baseDir . '/lib/AutomaticEmails/WooCommerce/Events/FirstPurchase.php',
    'MailPoet\\Premium\\AutomaticEmails\\WooCommerce\\Events\\PurchasedInCategory' => $baseDir . '/lib/AutomaticEmails/WooCommerce/Events/PurchasedInCategory.php',
    'MailPoet\\Premium\\AutomaticEmails\\WooCommerce\\Events\\PurchasedProduct' => $baseDir . '/lib/AutomaticEmails/WooCommerce/Events/PurchasedProduct.php',
    'MailPoet\\Premium\\AutomaticEmails\\WooCommerce\\WooCommerce' => $baseDir . '/lib/AutomaticEmails/WooCommerce/WooCommerce.php',
    'MailPoet\\Premium\\Config\\Activator' => $baseDir . '/lib/Config/Activator.php',
    'MailPoet\\Premium\\Config\\Database' => $baseDir . '/lib/Config/Database.php',
    'MailPoet\\Premium\\Config\\Env' => $baseDir . '/lib/Config/Env.php',
    'MailPoet\\Premium\\Config\\Hooks' => $baseDir . '/lib/Config/Hooks.php',
    'MailPoet\\Premium\\Config\\Initializer' => $baseDir . '/lib/Config/Initializer.php',
    'MailPoet\\Premium\\Config\\Localizer' => $baseDir . '/lib/Config/Localizer.php',
    'MailPoet\\Premium\\Config\\Menu' => $baseDir . '/lib/Config/Menu.php',
    'MailPoet\\Premium\\Config\\Migrator' => $baseDir . '/lib/Config/Migrator.php',
    'MailPoet\\Premium\\Config\\Populator' => $baseDir . '/lib/Config/Populator.php',
    'MailPoet\\Premium\\Config\\Renderer' => $baseDir . '/lib/Config/Renderer.php',
    'MailPoet\\Premium\\DynamicSegments\\Exceptions\\ErrorSavingException' => $baseDir . '/lib/DynamicSegments/Exceptions/ErrorSavingException.php',
    'MailPoet\\Premium\\DynamicSegments\\Exceptions\\InvalidSegmentTypeException' => $baseDir . '/lib/DynamicSegments/Exceptions/InvalidSegmentTypeException.php',
    'MailPoet\\Premium\\DynamicSegments\\Filters\\EmailAction' => $baseDir . '/lib/DynamicSegments/Filters/EmailAction.php',
    'MailPoet\\Premium\\DynamicSegments\\Filters\\Filter' => $baseDir . '/lib/DynamicSegments/Filters/Filter.php',
    'MailPoet\\Premium\\DynamicSegments\\Filters\\UserRole' => $baseDir . '/lib/DynamicSegments/Filters/UserRole.php',
    'MailPoet\\Premium\\DynamicSegments\\Filters\\WooCommerceCategory' => $baseDir . '/lib/DynamicSegments/Filters/WooCommerceCategory.php',
    'MailPoet\\Premium\\DynamicSegments\\Filters\\WooCommerceProduct' => $baseDir . '/lib/DynamicSegments/Filters/WooCommerceProduct.php',
    'MailPoet\\Premium\\DynamicSegments\\FreePluginConnectors\\AddToNewslettersSegments' => $baseDir . '/lib/DynamicSegments/FreePluginConnectors/AddToNewslettersSegments.php',
    'MailPoet\\Premium\\DynamicSegments\\FreePluginConnectors\\AddToSubscribersFilters' => $baseDir . '/lib/DynamicSegments/FreePluginConnectors/AddToSubscribersFilters.php',
    'MailPoet\\Premium\\DynamicSegments\\FreePluginConnectors\\SendingNewslettersSubscribersFinder' => $baseDir . '/lib/DynamicSegments/FreePluginConnectors/SendingNewslettersSubscribersFinder.php',
    'MailPoet\\Premium\\DynamicSegments\\FreePluginConnectors\\SubscribersBulkActionHandler' => $baseDir . '/lib/DynamicSegments/FreePluginConnectors/SubscribersBulkActionHandler.php',
    'MailPoet\\Premium\\DynamicSegments\\FreePluginConnectors\\SubscribersListingsHandlerFactory' => $baseDir . '/lib/DynamicSegments/FreePluginConnectors/SubscribersListingsHandlerFactory.php',
    'MailPoet\\Premium\\DynamicSegments\\Mappers\\DBMapper' => $baseDir . '/lib/DynamicSegments/Mappers/DBMapper.php',
    'MailPoet\\Premium\\DynamicSegments\\Mappers\\FormDataMapper' => $baseDir . '/lib/DynamicSegments/Mappers/FormDataMapper.php',
    'MailPoet\\Premium\\DynamicSegments\\Persistence\\Loading\\Loader' => $baseDir . '/lib/DynamicSegments/Persistence/Loading/Loader.php',
    'MailPoet\\Premium\\DynamicSegments\\Persistence\\Loading\\SingleSegmentLoader' => $baseDir . '/lib/DynamicSegments/Persistence/Loading/SingleSegmentLoader.php',
    'MailPoet\\Premium\\DynamicSegments\\Persistence\\Loading\\SubscribersCount' => $baseDir . '/lib/DynamicSegments/Persistence/Loading/SubscribersCount.php',
    'MailPoet\\Premium\\DynamicSegments\\Persistence\\Loading\\SubscribersIds' => $baseDir . '/lib/DynamicSegments/Persistence/Loading/SubscribersIds.php',
    'MailPoet\\Premium\\DynamicSegments\\Persistence\\Saver' => $baseDir . '/lib/DynamicSegments/Persistence/Saver.php',
    'MailPoet\\Premium\\Models\\DynamicSegment' => $baseDir . '/lib/Models/DynamicSegment.php',
    'MailPoet\\Premium\\Models\\DynamicSegmentFilter' => $baseDir . '/lib/Models/DynamicSegmentFilter.php',
    'MailPoet\\Premium\\Models\\NewsletterExtraData' => $baseDir . '/lib/Models/NewsletterExtraData.php',
    'MailPoet\\Premium\\Models\\SubscribersInDynamicSegment' => $baseDir . '/lib/Models/SubscribersInDynamicSegment.php',
    'MailPoet\\Premium\\Newsletter\\GATracking' => $baseDir . '/lib/Newsletter/GATracking.php',
    'MailPoet\\Premium\\Newsletter\\Stats' => $baseDir . '/lib/Newsletter/Stats.php',
    'MailPoet\\Premium\\Newsletter\\Stats\\SubscriberEngagement' => $baseDir . '/lib/Newsletter/Stats/SubscriberEngagement.php',
);