<?php
/*
 * Plugin name: Request Plugin
 * Version: 1.0
 * Description: Plugin for requests
 * Author: admin
 * Author URI: https://google.com
 */

// Includes
include ( 'includes/init.php' );
include ( 'settings-page.php' );

// Hooks
add_action( 'init', 'request_init' );

