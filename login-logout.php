<?php

/*
 * @wordpress-plugin
 * Plugin Name:       _ANDYP - Memberpress Login / Logout button
 * Plugin URI:        http://londonparkour.com
 * Description:       <strong>Login/Logout</strong> | Button that changes depending on your login status.
 * Version:           0.1.0
 * Author:            Andy Pearson
 * Author URI:        https://londonparkour.com
 * Domain Path:       /languages
 */

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                            CONFIGURATION                                │
// └─────────────────────────────────────────────────────────────────────────┘
$config = [];

//  ┌─────────────────────────────────────────────────────────────────────────┐
//  │                           Register CONSTANTS                            │
//  └─────────────────────────────────────────────────────────────────────────┘
define( 'ANDYP_LOGINOUT_PATH', __DIR__ );
define( 'ANDYP_LOGINOUT_URL', plugins_url( '/', __FILE__ ) );
define( 'ANDYP_LOGINOUT_FILE',  __FILE__ );

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                         Use composer autoloader                         │
// └─────────────────────────────────────────────────────────────────────────┘
require __DIR__.'/vendor/autoload.php';

// ┌─────────────────────────────────────────────────────────────────────────┐
// │                        	   Initialise    		                     │
// └─────────────────────────────────────────────────────────────────────────┘
new andyp\loginout\initialise;
