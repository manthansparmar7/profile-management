<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.manthansparmar.com
 * @since      1.0.0
 *
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 * @author     Manthan Parmar <manthansparmar7@gmail.com>
 */

class Profile_Management_Activator {

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public $posttype_slug = 'profile';

    public function __construct() {
        // Hook into the activation and deactivation actions
        register_activation_hook(__FILE__, array($this, 'activate'));
        // Hook into the init action to register custom post type
        add_action('init', array($this, 'registerPostTypeProfile'));
        add_action('init', array($this, 'registerTaxonomySkills'));
        add_action('init', array($this, 'registerTaxonomyEducations'));
    }

    public function activate() {
        // Code to run on plugin activation
        $this->registerPostTypeProfile();
        $this->registerTaxonomySkills();
        $this->registerTaxonomyEducations();
    }

    public function registerPostTypeProfile() {
        $singular_posttype_name = 'Profile';
        $plural_posttype_name = 'Profiles';
        $labels = array(
        'name'                  => _x( $plural_posttype_name, 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( $singular_posttype_name, 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( $singular_posttype_name, 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x(  $singular_posttype_name, 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New ' . $singular_posttype_name , 'textdomain' ),
        'new_item'              => __( 'New '. $singular_posttype_name, 'textdomain' ),
        'edit_item'             => __( 'Edit '. $singular_posttype_name, 'textdomain' ),
        'view_item'             => __( 'View '. $singular_posttype_name, 'textdomain' ),
        'all_items'             => __( 'All ' .  $plural_posttype_name, 'textdomain' ),
        'search_items'          => __( 'Search ' .  $plural_posttype_name, 'textdomain' ),
        'parent_item_colon'     => __( 'Parent : '.  $plural_posttype_name, 'textdomain' ),
        'not_found'             => __( 'No ' . $plural_posttype_name . ' found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No ' . $plural_posttype_name . ' found in Trash.', 'textdomain' ),
        );
        $args = array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => $this->posttype_slug ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'menu_icon'             => 'dashicons-admin-users',
            'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        );
        register_post_type(  $this->posttype_slug , $args );
    }

    public function registerTaxonomySkills() {
        $taxonomy_slug = 'skills';
        $singular_taxonomy_name = 'Skill';
        $plural_taxonomy_name = 'Skills';
        $labels = array(
            'name'              => __( $singular_taxonomy_name , 'text-domain'),
            'singular_name'     => __( $singular_taxonomy_name , 'text-domain'),
            'search_items'      => __('Search ' .  $plural_taxonomy_name, 'text-domain'),
            'all_items'         => __('All ' .  $plural_taxonomy_name, 'text-domain'),
            'parent_item'       => __('Parent ' . $singular_taxonomy_name, 'text-domain'),
            'parent_item_colon' => __('Parent ' . $singular_taxonomy_name . ':', 'text-domain'),
            'edit_item'         => __('Edit ' . $singular_taxonomy_name, 'text-domain'),
            'update_item'       => __('Update ' . $singular_taxonomy_name, 'text-domain'),
            'add_new_item'      => __('Add New ' . $singular_taxonomy_name, 'text-domain'),
            'new_item_name'     => __('New '  .$singular_taxonomy_name . ' Name', 'text-domain'),
            'menu_name'         => __( $plural_taxonomy_name . '', 'text-domain'),
        );

        $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => $taxonomy_slug ),
        );
        register_taxonomy( $taxonomy_slug , array( $this->posttype_slug ), $args);
    }

    public function registerTaxonomyEducations() {
        $taxonomy_slug = 'education';
        $taxonomy_name = 'Education';
        $labels = array(
            'name'              => __( $taxonomy_name , 'text-domain'),
            'singular_name'     => __( $taxonomy_name , 'text-domain'),
            'search_items'      => __('Search ' .  $taxonomy_name, 'text-domain'),
            'all_items'         => __('All ' .  $taxonomy_name, 'text-domain'),
            'parent_item'       => __('Parent ' . $taxonomy_name, 'text-domain'),
            'parent_item_colon' => __('Parent ' . $taxonomy_name . ':', 'text-domain'),
            'edit_item'         => __('Edit ' . $taxonomy_name, 'text-domain'),
            'update_item'       => __('Update ' . $taxonomy_name, 'text-domain'),
            'add_new_item'      => __('Add New ' . $taxonomy_name, 'text-domain'),
            'new_item_name'     => __('New '  .$taxonomy_name . ' Name', 'text-domain'),
            'menu_name'         => __( $taxonomy_name . '', 'text-domain'),
        );

        $args = array(
            'labels'            => $labels,
            'hierarchical'      => true,
            'public'            => true,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => $taxonomy_slug ),
        );
        register_taxonomy( $taxonomy_slug , array( $this->posttype_slug ), $args );
    }
}

// Instantiate the class
new Profile_Management_Activator();