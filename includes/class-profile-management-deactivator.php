<?php

/**
 * Fired during plugin deactivation
 *
 * @link       https://www.manthansparmar.com
 * @since      1.0.0
 *
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 * @author     Manthan Parmar <manthansparmar7@gmail.com>
 */
class Profile_Management_Deactivator {

	/**
	 * The slug for the custom post type.
	 *
	 * @since    1.0.0
	 */
	public $posttype_slug = 'profile';

    /**
     * Constructor to hook into deactivation action.
     */
    public function __construct() {
        // Hook into the deactivation action
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
    }

    /**
     * Code to run on plugin deactivation.
     * This function no longer flushes rewrite rules.
     *
     * @since    1.0.0
     */
    public function deactivate() {
        $this->deregisterCustomPostType();
        // No flush_rewrite_rules() call here
    }

    /**
     * Deregister the custom post type.
     *
     * @since    1.0.0
     */
    public function deregisterCustomPostType() {
        unregister_post_type($this->posttype_slug);
    }
}

// Instantiate the class Profile_Management_Deactivator
new Profile_Management_Deactivator();