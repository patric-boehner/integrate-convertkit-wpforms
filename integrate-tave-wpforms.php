<?php
/**
 * Plugin Name: Integrate Tave and WPForms
 * Plugin URI:  https://www.billerickson.net/how-to-setup-convertkit-with-a-wordpress-form
 * Description: Create ConvertKit signup forms using WPForms
 * Version:     1.1.0
 * Author:      Bill Erickson
 * Author URI:  https://www.billerickson.net
 * Text Domain: integrate-tave-wpforms
 * Domain Path: /languages
 * License:     GPLv2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 2, as published by the
 * Free Software Foundation.  You may NOT assume that you can use any other
 * version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.
 *
 * @package    Integrate_Tave_WPForms
 * @since      1.0.1
 * @copyright  Copyright (c) 2017, Bill Erickson
 * @license    GPL-2.0+
 */

 // Exit if accessed directly
 if ( ! defined( 'ABSPATH' ) ) exit;

 // Plugin version
 define( 'INTEGRATE_TAVE_WPFORMS_VERSION', '1.1.1' );

/**
 * Load the class
 *
 */
function integrate_tave_wpforms() {

    load_plugin_textdomain( 'integrate-tave-wpforms', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

    require_once( plugin_dir_path( __FILE__ ) . 'class-integrate-tave-wpforms.php' );

}
add_action( 'wpforms_loaded', 'integrate_tave_wpforms' );
