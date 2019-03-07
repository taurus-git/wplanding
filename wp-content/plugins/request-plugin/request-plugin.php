<?php
/*
 * Plugin name: Request Plugin
 * Version: 1.0
 * Description: Plugin for requests
 * Author: admin
 * Author URI: https://google.com
 */


// Setup

// Includes
include ( 'includes/activate.php' );
include ( 'includes/init.php' );
include ( 'settings-page.php' );

// Hooks
register_activation_hook( __FILE__, 'rp_activate_plugin' );
add_action( 'init', 'request_init' );

//Shotrcodes