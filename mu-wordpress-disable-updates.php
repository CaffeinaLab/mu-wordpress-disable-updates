<?php

/*
 * Plugin Name: Disable WordPress Updates
 * Plugin URI:  https://github.com/CaffeinaLab/mu-wordpress-disable-updates
 * Version:     1.0.0
 * Description: Disable all WordPress core/plugins updates
 * Author:      Stefano Azzolini
 * Author URI:  http://caffeina.it
 * License:     MIT
 */


/**
 * Disable Update Filters
 */
foreach([
    'auto_update_plugin'                => '__return_zero',
    'allow_dev_auto_core_updates'       => '__return_zero',
    'allow_major_auto_core_updates'     => '__return_zero',
    'pre_transient_update_plugins'      => '__return_zero',
    'pre_site_transient_update_plugins' => '__return_zero',
] as $filter => $callback) add_filter($filter, $callback);

/**
 * Remove Update Actions
 */
foreach([
    'admin_init'            => '_maybe_update_plugins',
    'load-plugins.php'      => 'wp_update_plugins',
    'load-update.php'       => 'wp_update_plugins',
    'wp_update_plugins'     => 'wp_update_plugins',
    'load-update-core.php'  => 'wp_update_plugins',
] as $action => $callback) remove_action($action, $callback);
