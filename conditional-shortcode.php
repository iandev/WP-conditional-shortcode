<?php
/*
  Plugin Name: Conditional Shortcode
  Plugin URI:
  Description: Adds a conditional type of shortcode.  If expression E evaluates to true, then shortcode A is executed, otherwise shortcode B is executed.
  Author: Ian Herbert Third Mind Inc.
  Author URI: http://www.thirdmind.com
  Version: 0.1
 */

error_reporting(0);

// Added check because of activation hook and theme embedded code
if (!defined('CONDSHORT_VERSION')) {
    define('CONDSHORT_VERSION', '0.1');
}

define('CONDSHORT_ABSPATH', dirname(__FILE__));
define('CONDSHORT_RELPATH', plugins_url() . '/' . basename(CONDSHORT_ABSPATH));
define('CONDSHORT_CORE_ABSPATH', CONDSHORT_ABSPATH . '/core');
define('CONDSHORT_CORE_RELPATH', CONDSHORT_RELPATH . '/core');
require_once CONDSHORT_CORE_ABSPATH . '/interfaces.php';
require_once CONDSHORT_CORE_ABSPATH . '/expression_generator.php';
require_once CONDSHORT_CORE_ABSPATH . '/shortcode_generator.php';
require_once CONDSHORT_CORE_ABSPATH . '/core.php';

add_action('plugins_loaded', 'condshort_init');
register_activation_hook(__FILE__, 'condshort_upgrade_init');
register_deactivation_hook(__FILE__, 'condshort_deactivate_init');

function condshort_init() {
    if (is_admin()) {

    }
    $core = new CondShortCore(new ExpressionGenerator(), new ShortcodeGenerator());
}

/**
 * Upgrade hook.
 */
function condshort_upgrade_init() {

    //require_once CONDSHORT_ABSPATH . '/upgrade.php';
    //abb_upgrade();
}

function condshort_deactivate_init() {

}
