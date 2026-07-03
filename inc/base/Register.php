<?php
/**
 * @author Hieu "Jin" Phan Trung
 ** The Register class handles the registration of scripts, styles, and shortcodes for the theme.
 */

namespace gpweb\inc\base;

class Register extends BaseController {
  /**
   ** An array of shortcodes.
   * @var array
   */
  protected $shortcodes;
  protected $module_scripts = [];
  /**
   * Registers the necessary actions and filters.
   */
  public function register() {
    add_action( 'wp_head', [ $this, 'registerCSSLayers' ], 5 );
    add_action( 'wp_enqueue_scripts', [$this, 'overrideWPGlobalStyle'], 20 );
    add_action( 'wp_enqueue_scripts', [$this, 'enqueue'], 110 );
    add_action( 'wp_enqueue_scripts', [$this, 'setTypeForModuleScripts'], 120 );
    // Add AOS init script in the header
    add_action( 'wp_footer', function() {
      echo '<script> AOS.init(); </script>';
    }, 130 );
    $this->setShortcodes();
    add_action( 'init', [$this, 'registerShortcodes'] );
  }
  /**
   * Summary of registerCSSLayers
   * * Setting a CSS layers order
   * @return void
   */
  public function registerCSSLayers() : void {
    echo '<style id="jins-layers-level">@layer flatsome, wp-global, reset, base, utilities, components;</style>';
  }

  /**
   * Sets the shortcodes.
   */
  protected function setShortcodes() {
    $this->shortcodes = [
      new \gpweb\shortcodes\JinsSocials( 'jins_socials' ),
      new \gpweb\shortcodes\PhoneNumbers( 'phone_numbers' ),
    ];
  }
  
  /**
   * Enqueues the necessary scripts and styles.
   */
  public function enqueue() {
    $this->enqueueScript( 'aos', '2.3.4' );
    $this->enqueueStyle( 'aos', '2.3.4' );

    $this->enqueueStyle( 'theme-init', time() );
    $this->enqueueStyle( 'google-symbols', null, 'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200' );

    $this->enqueueStyle( 'jins-header', time() );
    $this->enqueueStyle( 'jins-footer', time() );

    // * Enqueue swiper for page that needs it
    if( is_front_page() ) {
      $this->enqueueScript( 'swiper', '12.2.0' );
      $this->enqueueStyle( 'swiper', '12.2.0' );
    }

    if( is_front_page() ) {
      // $this->enqueueScript( 'gpw-home-page', time() );
      $this->enqueueStyle( 'jins-home-page', time() );
    }

    if( is_page( [51] ) ) {
      $this->enqueueStyle( 'jins-contact-page', time() );
    }

    if( is_home() || is_category() ) {
      $this->enqueueStyle( 'jins-category-post-page', time() );
    }

    if( is_single() ) {
      $this->enqueueStyle( 'jins-single-post-page', time() );
    }

    if( is_post_type_archive( 'clubs' ) ) {
      $this->enqueueStyle( 'jins-archive-clubs-page', time() );
    }
  }
  public function setTypeForModuleScripts() {
    if( empty( $this->module_scripts ) ) {
      return;
    }
    add_filter( 'script_loader_tag', function( $tag, $handle, $src ) {
      if( in_array( $handle, $this->module_scripts ) ) {
        $tag = '<script type="module" src="' . esc_url( $src ) . '"></script>';
      }
      return $tag;
    }, 10, 3 );
  }
  /**
   ** Enqueue single script 
   */
  protected function enqueueScript( string $script_name, ?string $version = null, bool $is_module = false, string $url = '', array $dependencies = [], bool $in_footer = true ) {
    if( $is_module ) {
      $this->module_scripts[] = $script_name;
    }
    $url = $url === '' ? "{$this->theme_url}/assets/js/{$script_name}.min.js" : $url;
    wp_enqueue_script( $script_name, $url, $dependencies, $version, $in_footer );
  }

  /**
   ** Enqueue single style
   */
  public function enqueueStyle( string $style_name, ?string $version = null, string $url = '', array $dependencies = [], string $media = 'all' ) {
    $url = $url === '' ? "{$this->theme_url}/assets/css/{$style_name}.min.css" : $url;
    wp_enqueue_style( $style_name, $url, $dependencies, $version, $media );
  }

  /**
   * * Registers the shortcodes.
   * * Loops through the shortcodes array and registers each shortcode.
   */
  public function registerShortcodes() {
    foreach( $this->shortcodes as $shortcode ) {
      add_shortcode( $shortcode->getShortcodeName(), [$shortcode, 'shortcodeCallback'] );
    }
  }
  public function overrideWPGlobalStyle() {
    // 1. Get the generated stylesheet from WP
    $stylesheet = wp_get_global_stylesheet();
    if ( empty( $stylesheet ) ) return;

    $wrappedStylesheet = sprintf( '@layer wp-global { %s }', $stylesheet );

    // 2. Remove the default output
    wp_dequeue_style( 'global-styles' );
    wp_deregister_style( 'global-styles' );

    // 3. Register a new handle and add the wrapped CSS
    wp_register_style( 'global-styles', false );
    wp_add_inline_style( 'global-styles', $wrappedStylesheet );
    wp_enqueue_style( 'global-styles' );
  }
}