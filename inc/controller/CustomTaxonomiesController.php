<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Custom Taxonomies Controller
 */
namespace gpweb\inc\controller;
class CustomTaxonomiesController {
  private static CustomTaxonomiesController $instance;
  private array $taxonomies;
  public static function getInstance() : CustomTaxonomiesController {
    if( !isset( self::$instance ) ) {
      self::$instance = new CustomTaxonomiesController();
    }
    return self::$instance;
  }
  public function register() {
    add_action( 'init', [$this, 'registerTaxonomies'] );
  }
  private function setTaxonomies() {
    $this->taxonomies = [
      [
        'slug'         => 'music',
        'name'         => __( 'Music', 'gpw' ),
        'description'  => __( 'Type of music is using in the club.', 'gpw' ),
        'rewrite'      => [ 'en' => 'music', 'vi' => 'nhac' ],
        'hierarchical' => true,
        'show_in_rest' => true,
      ],
      [
        'slug'         => 'clubs-type',
        'name'         => __( 'Clubs type', 'gpw' ),
        'description'  => __( 'Type of clubs.', 'gpw' ),
        'rewrite'      => [ 'en' => 'clubs-type', 'vi' => 'loai-clubs' ],
        'hierarchical' => true,
        'show_in_rest' => true,
      ],
    ];
  }
  public function registerTaxonomies() {
    $this->setTaxonomies();
    if( empty( $this->taxonomies ) ) {
      return;
    }
    foreach( $this->taxonomies as $taxonomy ) {
      register_taxonomy( $taxonomy['slug'], 'clubs', [
        'hierarchical'          => $taxonomy['hierarchical'] ?? false,
        'public'                => true,
        'labels'                => $this->generateTaxonomyLabels( $taxonomy['name'] ),
        'show_ui'               => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var'             => true,
        'show_admin_column'     => true,
        'show_in_rest'          => true,
        'rewrite'               => [ 'slug' => $taxonomy['rewrite'][JINS_CURRENT_LANGUAGE] ],
        'sort'                  => true,
      ] );
    }
  }
  private function generateTaxonomyLabels( $taxName ) {
    return [
      'name'          => _x( $taxName, 'taxonomy general name', 'gpw' ),
      'singular_name' => _x( $taxName, 'taxonomy singular name', 'gpw' ),
    ];
  }
}