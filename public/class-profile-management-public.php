<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.manthansparmar.com
 * @since      1.0.0
 *
 * @package    Profile_Management
 * @subpackage Profile_Management/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Profile_Management
 * @subpackage Profile_Management/public
 * @author     Manthan Parmar <manthansparmar7@gmail.com>
 */
class Profile_Management_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Profile_Management_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Profile_Management_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/profile-management-public.css', array(), $this->version, 'all' );

		wp_enqueue_style('select2-css', plugin_dir_url( __FILE__ ) . 'css/select2.min.css', array(), $this->version, 'all' );

		wp_enqueue_style( 'bootstrap.min.css', plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Profile_Management_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Profile_Management_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
    
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/profile-management-public.js', array( 'jquery' ), $this->version, false );

		wp_localize_script( $this->plugin_name, 'frontend_ajax_object',
			array( 
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce'    => wp_create_nonce('profiles_listing_nonce') // Create nonce
			)
		);
    	wp_enqueue_script('select2-js',  plugin_dir_url( __FILE__ ) . 'js/select2.min.js', array( 'jquery' ), $this->version, true );
	}

}
