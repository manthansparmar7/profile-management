<?php

/**
 * Implement all shortcode functions for the plugin
 *
 * @link       https://www.manthansparmar.com
 * @since      1.0.0
 *
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 */

/**
 * Implement all shortcode functions for the plugin
 *
 * File of shortcode functions
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 * @author     Manthan Parmar <manthansparmar7@gmail.com>
 */

class Profile_Management_Shortcodes {
    public function __construct() {
    //shortcode for CPT -> Profile listing
        add_shortcode( 'profile_listing', array( $this, 'profile_listing_shortcode_callback') );
    }
    //callback funcion of ebooks listing shortcode
	function profile_listing_shortcode_callback() { 
		ob_start(); ?>
		<div class="container">
			<!--Grid column-->
			<div class="col-md-12 col-xl-12">
				<form name="profile_filter" class="profile_filter">
				<div class="row">
					<div class="col-md-12">
					<div class="md-form">
						<label for="subject" class=""><?php esc_html_e( 'Search by Profile Name', 'profile-management' ); ?></label>
						<input type="text" id="subject" name="subject" class="form-control search_profile">
					</div>
					</div>
				</div>
				<!--Grid row-->
				<div class="row">
					<!--Grid column-->
					<div class="col-md-6">
					<div class="md-form">
						<?php  
						$techology_terms = get_terms(array(
							'taxonomy' => 'skills',
							'hide_empty' => false,
						));
						$technology_ids = array();
						$technology_ids = wp_list_pluck( $techology_terms,'term_id' ); 
						if( !empty($technology_ids) && isset($technology_ids) ){ ?> 
						<label><?php esc_html_e( 'Skills', 'profile-management' ); ?></label>
						<select name="profiles_technology_filter" class="form-control profiles_technology_filter" multiple> 
							<?php foreach ($technology_ids as $technology) { ?>
							<option value="<?php echo esc_attr($technology); ?>"> <?php echo esc_html( get_term( $technology  )->name ); ?></option> 
							<?php } ?> 
						</select> 
						<?php }
						?>
					</div>
					</div>
					<!--Grid column-->
					<div class="col-md-6">
					<div class="md-form">
						<?php  
						$level_terms = get_terms(array(
							'taxonomy' => 'education',
							'hide_empty' => false,
						));
						$level_ids = array();
						$level_ids = wp_list_pluck( $level_terms, 'term_id' ); 
						if( !empty($level_ids) && isset($level_ids) ){ ?>
						<label><?php esc_html_e( 'Education', 'profile-management' ); ?></label>
						<select name="profile_education_filter" class="form-control profile_education_filter" multiple>
							<?php foreach ($level_ids as $level) { ?> 
							<option value="<?php echo esc_attr($level); ?>"><?php echo esc_html( get_term( $level )->name ); ?></option> 
							<?php } ?>
						</select> 
						<?php }
						?>
					</div>
					</div>
				</div>
				<!--Grid row-->
				<div class="row">
					<!--Grid column-->
					<div class="col-md-6">
					<div class="md-form">
						<div class="slidecontainer">
						<input type="hidden" class="age_range_slider_val" value="">
						<label><?php esc_html_e( 'Minimum Age', 'profile-management' ); ?></label>
						<input type="range" min="20" max="60" value="40" class="slider age_slider" id="age_slider">
						<p class="selected_age_text"><?php esc_html_e( 'Selected age:', 'profile-management' ); ?> <span id="age_range_slider_html_val" style="font-weight: bold;"></span></p>
						</div>
					</div>
					</div>
					<!--Grid column-->
					<div class="col-md-6">
					<div class="md-form">
						<input type="hidden" class="stars_rating_val" value="">
						<label><?php esc_html_e( 'Ratings', 'profile-management' ); ?></label>
						<ul class="ratingW main">
						<?php for ($x = 1; $x <= 5; $x++) { ?> 
						<li><a href="javascript:void(0);">
							<div class="star"></div>
						</a></li>
						<?php } ?>
						</ul>
					</div>
					</div>
				</div>
				<!--Grid row-->
				<div class="row">
					<div class="col-md-6">
					<div class="md-form">
						<label><?php esc_html_e( 'No. of jobs completed', 'profile-management' ); ?></label>
						<input type="number" class="form-control num_of_jobs_completed" min="1" max="10">
					</div>
					</div>
					<!--Grid column-->
					<div class="col-md-6">
					<div class="md-form">
						<label><?php esc_html_e( 'Years of experience', 'profile-management' ); ?></label>
						<input type="number" class="form-control years_of_experiance" min="1" max="30">
					</div>
					</div>
				</div>
				<!--Grid row-->
				<div class="row">
					<div class="col-md-12">
					<div class="md-form">
						<br />
						<input type="submit" class="profile_filter_submit" value="<?php esc_attr_e( 'SEARCH', 'profile-management' ); ?>">
						</div>
					</div>
				</div>
				</form>
			</div>
		</div>
		<div class="profiles_universal_container"></div>
		<div class="cust_loader"></div>
		<?php
		return ob_get_clean();
	}
}
//initialize our Profile_Management_Shortcodes
new Profile_Management_Shortcodes();
?>