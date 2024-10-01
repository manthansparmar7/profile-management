<?php

/**
 * Implement all ajax functions for the plugin
 *
 * @link       https://www.manthansparmar.com
 * @since      1.0.0
 *
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 */

/**
 * Implement all ajax functions for the plugin
 *
 * File of AJAX functions
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 * @author     Manthan Parmar <manthansparmar7@gmail.com>
 */

class Profile_Management_Ajax {
    public function __construct() {
        /* ajax functions for profile listing */
        add_action( 'wp_ajax_profiles_listing_ajax', array( $this, 'profiles_listing_ajax_callback') );
        add_action( 'wp_ajax_nopriv_profiles_listing_ajax', array( $this, 'profiles_listing_ajax_callback') );
    }
    /* ajax for profile listing callback */
	function profiles_listing_ajax_callback() {
    /* check nonce */
    check_ajax_referer('profiles_listing_nonce', '_ajax_nonce');

	    if(isset($_POST['page'])){
	        $page = sanitize_text_field($_POST['page']);
	        $cur_page = $page;
	        $page -= 1;
	        $per_page = 5;
	        $start = $page * $per_page;   
	        $profile_search = '';
	        //search filter
            if ( isset($_POST['profile_search']) && $_POST['profile_search'] !== '' ) {
                // Sanitize the input
                $profile_search = sanitize_text_field($_POST['profile_search']);
            }
	        //skills taxonmoy filter
	        $tax_query = array();   
	        if( isset($_POST['selected_skills']) && $_POST['selected_skills'] !==''){  
			    $skillsExplodedAry = explode(',', sanitize_text_field($_POST['selected_skills']));	
	            $tax_query[] =  array(
	                'taxonomy' => 'skills',
	                'field' => 'id',
	                'terms' => $skillsExplodedAry
	            );            
	        }
	         //education taxonmoy filter
	        if( isset($_POST['selected_education']) && $_POST['selected_education'] !==''){
			    $educationExplodedAry = explode(',', sanitize_text_field($_POST['selected_education']));	
	            $tax_query[] =  array(
	                'taxonomy' => 'education',
	                'field' => 'id',
	                'terms' => $educationExplodedAry
	            );            
	        }	
	        //number of jobs completed meta field filter	  
	        $meta_query = array();   
	        if( isset($_POST['profile_num_of_jobs_completed']) && $_POST['profile_num_of_jobs_completed'] !==''){
	            $meta_query[] = array(
                    'key' => '_custom_metabox_num_of_jobs_completed',
                    'value' => sanitize_text_field($_POST['profile_num_of_jobs_completed']),
                    'compare' => '='
                );            
	        }
	        //years of experiance meta field filter	  	       
	        if ( isset($_POST['profile_years_of_experiance']) && $_POST['profile_years_of_experiance'] !=='' ){
	            $meta_query[] =  array(
                    'key' => '_custom_metabox_year_of_experiance',
                    'value' => sanitize_text_field($_POST['profile_years_of_experiance']),
                    'compare' => '='
                );
	        }
	        //star rating meta field filter	 
	        if( isset($_POST['profile_stars_rating_val']) && $_POST['profile_stars_rating_val'] !=='' ){
	            $meta_query[] =  array(
                    'key' => '_custom_metabox_ratings',
                    'value' => sanitize_text_field($_POST['profile_stars_rating_val']),
                    'compare' => '='
                );
	        }
			  //age range slider meta field filter
	        if( isset($_POST['profile_age_range_slider']) && $_POST['profile_age_range_slider'] !=='' ){
	       			$meta_query[] =  array(
                    'key' => 'profile_hidden_age',
                    'value' => sanitize_text_field($_POST['profile_age_range_slider']),
                    'compare' => '<='
                );
	        }
	        $post_type = 'profile'; 
	        //WP Query to fetch profile posts based on filters 
	        $all_profiles_post = new WP_Query(
	            array(
	                'post_type'         => $post_type,
	                'post_status '      => 'publish',
	                's'                 => $profile_search,
	                'orderby'           => 'DATE' ,
	                'order'             => 'DESC',
	                'posts_per_page'    => $per_page,
	                'offset'            => $start,
	                'tax_query'         => $tax_query, //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	                'meta_query'        => $meta_query, //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
	            )
	        );
	        //WP query result output 
            ?>
          <table class="profile_listing">
              <thead>
                  <tr class="table-success">
                      <th><?php esc_html_e( 'No.', 'profile-management' ); ?></th>
                      <th><?php esc_html_e( 'Profile Name', 'profile-management' ); ?></th>
                      <th><?php esc_html_e( 'Age', 'profile-management' ); ?></th>
                      <th><?php esc_html_e( 'Skills', 'profile-management' ); ?></th>
                      <th><?php esc_html_e( 'Education', 'profile-management' ); ?></th>
                      <th><?php esc_html_e( 'Years of experience', 'profile-management' ); ?></th>
                      <th><?php esc_html_e( 'No of jobs completed', 'profile-management' ); ?></th>
                      <th><?php esc_html_e( 'Rating', 'profile-management' ); ?></th>
                  </tr>
              </thead>
              <tbody>
                  <?php if( $all_profiles_post->have_posts() ) :
                      while ( $all_profiles_post->have_posts() ) : $all_profiles_post->the_post(); 
                          $current_post = $all_profiles_post->current_post + 1;
                          for ( $i = 1 ; $i < 5 ; $i++) { 
                              if( $cur_page > $i){
                                  $current_post = $current_post + $per_page;
                              }
                          }
                          $no_of_jobs_completed = get_post_meta(get_the_ID(), '_custom_metabox_num_of_jobs_completed', true);
                          $no_of_jobs_completed = $no_of_jobs_completed ? $no_of_jobs_completed : '-';

                          $person_age = get_post_meta(get_the_ID(), 'profile_hidden_age', true);
                          $person_age = $person_age ? $person_age : '-';

                          $person_year_of_experience = get_post_meta(get_the_ID(), '_custom_metabox_year_of_experiance', true);
                          $person_year_of_experience = $person_year_of_experience ? $person_year_of_experience : '-';

                          $rating_val = get_post_meta(get_the_ID(), '_custom_metabox_ratings', true);

                          $skills_terms = wp_get_post_terms(get_the_ID(), 'skills');
                          $profile_skills = !empty($skills_terms) && !is_wp_error($skills_terms) 
                              ? implode(', ', wp_list_pluck($skills_terms, 'name')) 
                              : '-';

                          $education_terms = wp_get_post_terms(get_the_ID(), 'education');
                          $education_skills = !empty($education_terms) && !is_wp_error($education_terms) 
                              ? implode(', ', wp_list_pluck($education_terms, 'name')) 
                              : '-';
                      ?>
                      <tr class="table-primary">
                          <td><?php echo esc_html($current_post); ?>.</td>
                          <td>
                              <a href="<?php echo esc_url(get_permalink()); ?>" target="_blank">
                                  <?php the_title(); ?>
                              </a>
                          </td>
                          <td><?php echo esc_html( $person_age ); ?></td>
                          <td><?php echo esc_html( $profile_skills ); ?></td>
                          <td><?php echo esc_html( $education_skills ); ?></td>
                          <td><?php echo esc_html( $person_year_of_experience ); ?></td>
                          <td><?php echo esc_html( $no_of_jobs_completed ); ?></td>
                          <td>
                              <ul class="ratingW">
                                  <?php for ($x = 1; $x <= 5; $x++): ?>
                                      <li <?php echo $rating_val >= $x ? "class='on'" : ''; ?>>
                                          <a href="#" class="rating_ajax_result">
                                              <div class="star"></div>
                                          </a>
                                      </li>
                                  <?php endfor; ?>
                              </ul>
                          </td>
                      </tr>
                  <?php endwhile; wp_reset_postdata(); else: ?>
                      <tr>
                          <td colspan="8"><?php esc_html_e( 'No profiles available.', 'profile-management' ); ?></td>
                      </tr>
                  <?php endif; ?>
              </tbody>
          </table>
        <?php
          $no_of_paginations = ceil($all_profiles_post->found_posts / $per_page);
          if ($no_of_paginations > 1):
        ?>
          <div class='profiles-universal-pagination'>
            <ul>
              <?php if ($cur_page > 1): ?>
                <li p='1' class='active'><?php esc_html_e( 'First', 'profile-management' ); ?></li>
                <li p='<?php echo esc_attr($cur_page) - 1; ?>' class='active'><?php esc_html_e( 'Previous', 'profile-management' ); ?></li>
              <?php else: ?>
                <li class='inactive'><?php esc_html_e( 'First', 'profile-management' ); ?></li>
                <li class='inactive'><?php esc_html_e( 'Previous', 'profile-management' ); ?></li>
              <?php endif; ?>

              <?php for ($i = 1; $i <= $no_of_paginations; $i++): ?>
              <li p='<?php echo esc_attr($i); ?>' class='<?php echo (int) $cur_page === (int) $i ? "selected" : "active"; ?>'>
                <?php echo esc_html($i); ?>
              </li>
              <?php endfor; ?>

              <?php if ($cur_page < $no_of_paginations): ?>
                <li p='<?php echo esc_attr($cur_page) + 1; ?>' class='active'><?php esc_html_e( 'Next', 'profile-management' ); ?></li>
                <li p='<?php echo esc_attr($no_of_paginations); ?>' class='active'><?php esc_html_e( 'Last', 'profile-management' ); ?></li>
              <?php else: ?>
                <li class='inactive'><?php esc_html_e( 'Next', 'profile-management' ); ?></li>
                <li class='inactive'><?php esc_html_e( 'Last', 'profile-management' ); ?></li>
              <?php endif; ?>
            </ul>
          </div>
          <?php 
          endif; 
	    }
	    // Always exit to avoid further execution
	    exit();
	}
}
//initialize our Profile_Management_Ajax for ajax functionalities 
new Profile_Management_Ajax();
?>