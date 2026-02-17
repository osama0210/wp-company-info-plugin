<?php
/**
* Plugin Name: Company Info
* Description: Adds basic company information to WordPress.
* Version: 1.0.0
* Author: Osama Alasmi
* Text Domain: company-info
*/

defined('ABSPATH') || exit;

define('CI_PLUGIN_URL', plugin_dir_url(__FILE__));

require_once __DIR__ . '/includes/class-ci-admin-page.php';
require_once __DIR__ . '/includes/class-ci-shortcodes.php';
require_once __DIR__ . '/includes/class-ci-dashboard-widget.php';
require_once __DIR__ . '/includes/class-ci-media-page.php';