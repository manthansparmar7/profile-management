(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

//Following code is for profile listing using ajax
jQuery(document).ready(function() {
    jQuery('.profile_education_filter').select2(); // Assuming you are using the Select2 library
    jQuery('.profiles_technology_filter').select2(); // Assuming you are using the Select2 library
	var ajaxurl = '/multidots_practical/wp-admin/admin-ajax.php';
	function profile_load_all_posts(page){
		//search filter value
		var profile_search_val = '';
		if( jQuery('.search_profile').val() != ''){
			profile_search_val = jQuery('.search_profile').val();
		}
		//number of jobs completed filter value
		var profile_num_of_jobs_completed_val = '';
		if( jQuery('.num_of_jobs_completed').val() != ''){
			profile_num_of_jobs_completed_val = jQuery('.num_of_jobs_completed').val();
		}
		//number of jobs completed filter value
		var profile_years_of_experiance_val = '';
		if( jQuery('.years_of_experiance').val() != ''){
			profile_years_of_experiance_val = jQuery('.years_of_experiance').val();
		}
		//age range sider filter value
		var age_range_slider_val = '';
		if( jQuery('.age_range_slider_val').val() != ''){
			age_range_slider_val = jQuery('.age_range_slider_val').val();
		}	
		//star rating filter value
		var stars_rating_val = '';
		if( jQuery('.stars_rating_val').val() != ''){
			stars_rating_val = jQuery('.stars_rating_val').val();
		}
		//education filter value
		var selected_education_vals = jQuery(".profile_education_filter  option:selected").map(function () {
        	return jQuery(this).val();
    	}).get().join(',');
		//skilss filter value
		var selected_skills_vals = jQuery(".profiles_technology_filter  option:selected").map(function () {
        	return jQuery(this).val();
    	}).get().join(',');
    	//Ajax function
		jQuery.ajax({
			type: 'POST',
			url: frontend_ajax_object.ajaxurl,
			data: { 
				page: page, 
				action: "profiles_listing_ajax", 
				profile_search: profile_search_val,
				selected_skills: selected_skills_vals,
				selected_education: selected_education_vals,
				profile_num_of_jobs_completed : profile_num_of_jobs_completed_val,
				profile_years_of_experiance : profile_years_of_experiance_val,
				profile_stars_rating_val : stars_rating_val,
				profile_age_range_slider : age_range_slider_val,
				_ajax_nonce: frontend_ajax_object.nonce // Pass the nonce
			},
			success: function (result) {
				jQuery(".cust_loader").hide();    
				jQuery(".profiles_universal_container").show();                      									
				jQuery(".profiles_universal_container").html(result);
			}, 
			beforeSend: function() {
				jQuery(".cust_loader").show();                      				
				jQuery(".profiles_universal_container").hide();                      				
		    }
		});   
	}
	//Loads all profiles
  	profile_load_all_posts(1);
  	//Pagination click event
	jQuery(document).on("click",".profiles-universal-pagination li.active",function() {
		var page = jQuery(this).attr('p');
		profile_load_all_posts(page);
	});
  	//Form Filter button click event	
	jQuery(".profile_filter").submit(function(e){
		e.preventDefault();
  		profile_load_all_posts(1);	  
	});
	//Rating start click event
	function ratingStar(star){
		star.click(function(){
			var stars = jQuery('.ratingW.main').find('li');
			stars.removeClass('on');
			var thisIndex = jQuery(this).parents('li').index();
			for(var i=0; i <= thisIndex; i++){
				stars.eq(i).addClass('on');
			}
	    putAge(thisIndex+1);
		});
	}
	function putAge(i){
	 	jQuery('.stars_rating_val').val(i);
	}
	jQuery(function(){
		if(jQuery('.ratingW.main').length > 0){
			ratingStar(jQuery('.ratingW.main li a'));
		}
	});
	//Age rangle slider start click event
	jQuery(".slider.age_slider").on("input", function(e) {
		jQuery('.selected_age_text').show();
		jQuery("#age_range_slider_html_val").text( jQuery(e.target).val() )
		jQuery('.age_range_slider_val').val( jQuery(e.target).val() );
	});
});

// You can use JavaScript to handle the selected date
            // Optionally, you can add a listener to set the max date dynamically
            document.addEventListener('DOMContentLoaded', function() {
                const dobInput = document.getElementById('custom_metabox_dob');
                const maxDate = new Date();
                maxDate.setFullYear(maxDate.getFullYear() - 20);
                dobInput.max = maxDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD
            });