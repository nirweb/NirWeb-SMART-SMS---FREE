<?php
/**
 * Plugin Name:       پیامک رایگان ووکامرس و وردپرس نیر وب
 * Plugin URI:        https://nirweb.ir/
 * Description:       کاملترین افزونه پیامک ووکامرس و وردپرس
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            NirWeb
 * Author URI:        https://nirweb.ir/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       nss
 * Domain Path:       /languages
 */
 
if (!defined('ABSPATH')) exit;
if (!function_exists('is_plugin_active')) {
    require_once(ABSPATH . 'wp-admin/includes/plugin.php');
}

define('NIRWEB_SMART_SMS',trailingslashit(plugin_dir_path(__FILE__)));
define('NIRWEB_SMART_SMS_URL',trailingslashit(plugin_dir_url(__FILE__)));
define('nirweb_smart_sms_option', get_option('nirweb_smart_sms_perfix'));


add_action( 'plugins_loaded',function() {
    load_textdomain( 'nss', NIRWEB_SMART_SMS .'languages/nss-'. get_locale() .'.mo' );
});

require_once NIRWEB_SMART_SMS . '/core/includes.php';

//$product_id = 612;
//global $wpdb;
//$phone_numbers =  $wpdb->get_col(
//    $wpdb->prepare("
//     SELECT DISTINCT users.meta_value
//     FROM {$wpdb->prefix}wc_order_product_lookup as orders
//     JOIN {$wpdb->prefix}wc_customer_lookup as customer ON orders.customer_id = customer.customer_id
//     JOIN $wpdb->usermeta as users ON users.user_id = customer.user_id
//    WHERE ( orders.product_id = %d OR orders.variation_id = %d) AND (customer.user_id IS NOT NULL ) AND (meta_key = 'billing_phone')  ",$product_id,$product_id));
//
//$user_ids =  $wpdb->get_results("SELECT user_id FROM {$wpdb->prefix}wc_customer_lookup WHERE customer_id IN ('" .implode("','", $customer_ids). "')", ARRAY_A);
//
//
//$rcpt_nm = $wpdb->get_col("SELECT meta_value FROM $wpdb->usermeta WHERE meta_key = 'billing_phone' WHERE user_id IN ('" .implode("','", $user_ids). "') " );

