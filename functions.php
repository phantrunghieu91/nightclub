<?php
defined( 'ABSPATH' ) || exit;

// Placeholder image id constant
define( 'PLACEHOLDER_IMAGE_ID', 104 );
define( 'JINS_CURRENT_LANGUAGE', function_exists( 'pll_current_language' ) ? pll_current_language() : 'vi' );
if( function_exists( 'wc_get_page_id' ) ) {
  define( 'GPW_SHOP_PAGE_ID', wc_get_page_id( 'shop' ) );
}

// Turn off auto gen <p> of contact form 7
add_filter( 'wpcf7_autop_or_not', function() {
  return false;
} );

// Load autoload
if( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
  require_once __DIR__ . '/vendor/autoload.php';
}

// Register services
if( class_exists( 'gpweb\\inc\\ThemeInit' ) ) {
  gpweb\inc\ThemeInit::register_services();
}

// Import custom helper functions
require_once __DIR__ . '/inc/helper_functions.php';