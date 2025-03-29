<?php
/**
 * Plugin Name: Organic Menu Switcher
 * Description: Detects organic traffic and switches menu accordingly.
 * Version: 1.0
 * Author: Jenish
 */

if (!defined('ABSPATH')) exit;

// ✅ Start Session Properly
function start_custom_session() {
    if (!session_id()) session_start();
}
add_action('init', 'start_custom_session');

// ✅ Detect Organic Traffic
function detect_organic_traffic() {
    if (!isset($_SESSION['is_organic'])) {
        $_SESSION['is_organic'] = 0; // Default: Not Organic
        
        if (!empty($_SERVER['HTTP_REFERER'])) {
            $organic_sources = ['google.', 'bing.', 'yahoo.', 'duckduckgo.', 'baidu.', 'yandex.'];
            foreach ($organic_sources as $source) {
                if (stripos($_SERVER['HTTP_REFERER'], $source) !== false) {
                    $_SESSION['is_organic'] = 1; // User is organic
                    break;
                }
            }
        }
    }
}
add_action('init', 'detect_organic_traffic');

// ✅ Apply Menu Switch Logic
function custom_menu_based_on_source($args) {
    if (!session_id()) session_start();

    if (isset($_SESSION['is_organic']) && $_SESSION['is_organic'] == 1) {
        $args['theme_location'] = 'organic_menu';
    } else {
        $args['theme_location'] = 'default_menu';
    }

    return $args;
}
add_filter('wp_nav_menu_args', 'custom_menu_based_on_source');

// ✅ Register Menus
function register_custom_menus() {
    register_nav_menus(array(
        'organic_menu' => __('Organic Menu', 'yourtheme'),
        'default_menu' => __('Default Menu', 'yourtheme')
    ));
}
add_action('after_setup_theme', 'register_custom_menus');

?>
