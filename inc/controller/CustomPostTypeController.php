<?php
/**
 * @author Hieu "Jin" Phan Trung
 * * Custom post type controller
 * Handling resgister custom post type
 */
namespace gpweb\inc\controller;
class CustomPostTypeController {
  private static CustomPostTypeController $instance;
  private array $postTypes;
  public static function getInstance() : CustomPostTypeController {
    if( !isset( self::$instance ) ) {
      self::$instance = new CustomPostTypeController();
    }
    return self::$instance;
  }
  public function register() {
    add_action( 'init', [$this, 'registerCustomPostType'] );
  }
  public function setCustomPostType() {
    $this->postTypes = [
      [
        'post_type'       => 'clubs',
        'name'            => _x( 'Clubs', 'Post Type General Name', 'gpw' ),
        'singular_name'   => _x( 'Club', 'Post Type Singular Name', 'gpw' ),
        'description'     => _x( 'Information about local clubs, societies, and member organizations, including location, meeting times, and contact details.', 'Post Type description', 'gpw' ),
        'supports'        => [ 'title', 'excerpt', 'page-attributes', 'thumbnail', 'comments' ],
        'taxonomies'      => ['music', 'clubs-type'],
        'has_archive'     => true,
        'public'          => true,
        'menu_position'   => 20,
        'menu_icon'       => 'dashicons-admin-multisite',
        'rewrite'         => true,
        'show_in_rest'    => true,
        'capability_type' => 'post',
      ]
    ];
  }
  public function registerCustomPostType() {
    $this->setCustomPostType();
    if( empty( $this->postTypes ) ) {
      return;
    }
    foreach( $this->postTypes as $postType ) {
      $public             = $postType['public']             ?? false;
      $publicly_queryable = $postType['publicly_queryable'] ?? $public;
      $show_ui            = $postType['show_ui']            ?? $public;
      $show_in_menu       = $postType['show_in_menu']       ?? $show_ui;
      $show_in_nav_menus  = $postType['show_in_nav_menus']  ?? $public;
      $show_in_admin_bar  = $postType['show_in_menu']       ?? $show_in_menu;
      register_post_type( $postType['post_type'], [
        'label'               => $postType['name'],
        'labels'              => $this->generateLabels( $postType ),
        'public'              => $public,
        'publicly_queryable'  => $publicly_queryable,
        'show_ui'             => $show_ui,
        'show_in_menu'        => $show_in_menu,
        'show_in_admin_bar'   => $show_in_admin_bar,
        'show_in_nav_menus'   => $show_in_nav_menus,
        'can_export'          => true,
        'description'         => $postType['description']         ?? '',
        'supports'            => $postType['supports']            ?? ['title', 'editor'],
        'taxonomies'          => $postType['taxonomies']          ?? [],
        'hierarchical'        => $postType['hierarchical']        ?? false,
        'menu_position'       => $postType['menu_position']       ?? 100,
        'menu_icon'           => $postType['menu_icon']           ?? 'dashicons-admin-generic',
        'has_archive'         => $postType['has_archive']         ?? false,
        'exclude_from_search' => $postType['exclude_from_search'] ?? false,
        'capability_type'     => $postType['capability_type']     ?? 'post',
        'rewrite'             => $postType['rewrite']             ?? false,
        'show_in_rest'        => $postType['show_in_rest']        ?? true,
      ] );
    }
  }
  private function generateLabels( $postTypeData ) {
    return [
      'name'                  => $postTypeData['name'],
      'singular_name'         => $postTypeData['singular_name'],
      'menu_name'             => $postTypeData['name'],
      'name_admin_bar'        => $postTypeData['singular_name'],
      'archives'              => "{$postTypeData['name']} archive",
      'attributes'            => "{$postTypeData['name']} attributes",
      'parent_item_colon'     => "{$postTypeData['singular_name']} parent",
      'all_items'             => "All {$postTypeData['singular_name']}",
      'add_new_item'          => "Add new {$postTypeData['singular_name']}",
      'add_new'               => 'Add New',
      'new_item'              => "New {$postTypeData['singular_name']}",
      'edit_item'             => "Edit {$postTypeData['singular_name']}",
      'update_item'           => "Update {$postTypeData['singular_name']}",
      'view_item'             => "View {$postTypeData['singular_name']}",
      'view_items'            => "View {$postTypeData['name']}",
      'search_items'          => "Search {$postTypeData['name']}",
      'not_found'             => "{$postTypeData['singular_name']} not found",
      'not_found_in_trash'    => "{$postTypeData['singular_name']} not found in Trash",
      'featured_image'        => 'Featured Image',
      'set_featured_image'    => 'Set featured image',
      'remove_featured_image' => 'Remove featured image',
      'use_featured_image'    => 'Use as featured image',
      'insert_into_item'      => "Insert into {$postTypeData['singular_name']}",
      'uploaded_to_this_item' => "Uploaded to this {$postTypeData['singular_name']}",
      'items_list'            => "{$postTypeData['name']} list",
      'items_list_navigation' => "{$postTypeData['name']} list navigation",
      'filter_items_list'     => "Filter {$postTypeData['name']} list",
    ];
  }
}