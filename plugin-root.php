<?php
/**
 * Root plugin file for Digital Canvas custom post types and taxonomies.
 *
 * @package         dc-custom-post-types
 * @author          Caspar Green
 * @license         GPL-3.0+
 * @link            https://www.digitalcanvasllc.com/
 *
 * @wordpress-plugin
 * Plugin Name:     Custom Post Types and Taxonomies
 * Plugin URI:      https://www.digitalcanvasllc.com/
 * Description:     Custom post types and taxonomies.
 * Version:         1.0.0
 * Author:          Digital Canvas, LLC.
 * Author URI:      https://digitalcanvasllc.com/
 * Text Domain:     dc-post-tax
 * Requires WP:     4.9
 * Requires PHP:    7.4
 */

namespace DigitalCanvas\CustomPostTypes;

if (! defined('ABSPATH')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}

if (canLoad()) {
    require_once(__DIR__ . '/vendor/autoload.php');
    add_action('plugins_loaded', __NAMESPACE__ . '\init', 20);
    register_deactivation_hook(__FILE__, __NAMESPACE__ . '\deactivate');
}

/**
 * Check the requirements for loading the plugin.
 *
 * @return bool
 * @since  1.0.0
 */
function canLoad(): bool
{
    return version_compare($GLOBALS['wp_version'], '4.9', '>=')
        && version_compare(phpversion(), '7.4', '>=');
}

/**
 * Initialize.
 *
 * @return void
 * @since  1.0.0
 */
function init(): void
{
    $config     = include plugin_dir_path(__FILE__) . 'config/config.php';
    $plugin     = new Plugin($config);
    $plugin->init();
}

/**
 * Deactivate.
 *
 * @return void
 * @since 1.0.0
 *
 */
function deactivate(): void
{
    flush_rewrite_rules();
    update_option('dc_custom_post_types_config_hash', false);
}
