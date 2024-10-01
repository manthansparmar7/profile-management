<?php


/**
 * Implement all metabox for the plugin
 *
 * @link       https://www.manthansparmar.com
 * @since      1.0.0
 *
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 */

/**
 * Implement all metabox for the plugin
 *
 * File of shortcode functions
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 * @author     Manthan Parmar <manthansparmar7@gmail.com>
 */

class CustomMetaboxes {
    private $metaboxes = array(
        array(
            'id'       => 'custom_metabox_dob',
            'title'    => 'Date of birth',
            'callback' => 'metaboxCallbackDob'
        ),
        array(
            'id'       => 'custom_metabox_hobbies',
            'title'    => 'Hobbies',
            'callback' => 'metaboxCallbackHobbies'
        ),
        array(
            'id'       => 'custom_metabox_interests',
            'title'    => 'Interests',
            'callback' => 'metaboxCallbackInterests'
        ),       
        array(
            'id'       => 'custom_metabox_year_of_experiance',
            'title'    => 'Years of experience',
            'callback' => 'metaboxCallbackYearOfExperiance'
        ),
        array(
            'id'       => 'custom_metabox_ratings',
            'title'    => 'Ratings',
            'callback' => 'metaboxCallbackRatings'
        ),
        array(
            'id'       => 'custom_metabox_num_of_jobs_completed',
            'title'    => 'No. of jobs completed',
            'callback' => 'metaboxCallbackNumOfJobCompleted'
        ),
    );

    public function __construct() {
        // Hook into WordPress initialization
        add_action('add_meta_boxes', array($this, 'addMetaboxes'));
        // Hook to save metabox data
        add_action('save_post', array($this, 'saveMetaboxes'));
    }

    public function addMetaboxes() {
        foreach ($this->metaboxes as $metabox) {
            add_meta_box(
                $metabox['id'],              // Metabox ID
                $metabox['title'],           // Metabox title
                array( $this , $metabox['callback']),   // Callback function to display content
                'profile',                      // Post type (e.g., post, page)
                'normal',                    
                'high'                      
            );
        }
    }
    //callback function for DOB metabox
    public function metaboxCallbackDob($post) {
        $dob = get_post_meta($post->ID, '_custom_metabox_dob', true);
        wp_nonce_field('save_custom_metabox', 'profile_detail_page_nonce'); // Add nonce field
        // Use gmdate() to avoid issues with runtime timezone changes
        $max_date = gmdate('Y-m-d', strtotime('-20 years')); // 20 years before today
        ?>
        <label for="custom_metabox_dob">Enter DOB:</label>
        <input type="date" id="custom_metabox_dob" name="custom_metabox_dob" value="<?php echo esc_attr($dob); ?>" max="<?php echo esc_attr($max_date); ?>">
        <input type="hidden" value="<?php echo esc_attr($dob); ?>">
        <?php
    }
    //callback function for hobbies metabox
    public function metaboxCallbackHobbies($post) {
        $hobbies = get_post_meta($post->ID, '_custom_metabox_hobbies', true);
        ?>
        <label for="custom_metabox_hobbies"><?php esc_html_e( 'Enter hobbies: ', 'profile-management' ); ?></label>
        <input type="text" id="custom_metabox_hobbies" name="custom_metabox_hobbies" value="<?php echo esc_attr($hobbies); ?>" />
        <p><b> <?php esc_html_e( 'Eg. Reading, Singing, Dancing', 'profile-management' ); ?></b></p>
        <?php
    }
    //callback function for intrests metabox
    public function metaboxCallbackInterests($post) {
        $interests = get_post_meta($post->ID, '_custom_metabox_interests', true);
        ?>
        <label for="custom_metabox_interests"><?php esc_html_e( 'Enter interests: ', 'profile-management' ); ?></label>
        <input type="text" id="custom_metabox_interests" name="custom_metabox_interests" value="<?php echo esc_attr($interests); ?>" />
        <p><b> <?php esc_html_e( 'Eg. Travel, Art, Movies', 'profile-management' ); ?></b></p>
        <?php
    }
    //callback function for total year of experiance metabox
    public function metaboxCallbackYearOfExperiance($post) {
        $year_of_experiance = get_post_meta($post->ID, '_custom_metabox_year_of_experiance', true);
        ?>
        <label for="custom_metabox_year_of_experiance"><?php esc_html_e( 'Enter experiance: ', 'profile-management' ); ?></label>
        <input type="number" id="custom_metabox_year_of_experiance" name="custom_metabox_year_of_experiance" value="<?php echo esc_attr($year_of_experiance); ?>" min="1" max="30" />
        <?php
    }
    //callback function for rating metabox
    public function metaboxCallbackRatings($post) {
        $ratings = get_post_meta($post->ID, '_custom_metabox_ratings', true);
        ?>
        <label for="custom_metabox_ratings"> <?php esc_html_e( 'Enter rating:', 'profile-management' ); ?></label>
        <select name="custom_metabox_ratings" id="custom_metabox_ratings" name="custom_metabox_ratings" value="<?php echo esc_attr($ratings); ?>">
            <option value="" selected=""> <?php esc_html_e( 'Rate out of five stars:', 'profile-management' ); ?></option>
            <?php for ($x = 1; $x <= 5; $x++) { ?>
            <option value="<?php echo esc_attr($x); ?>" <?php print ($x === (int) $ratings) ? "selected" : ""; ?>><?php echo esc_html($x); ?><?php esc_html_e( ' star', 'profile-management' ); ?></option>
            <?php } ?>
        </select>
        <?php
    }
    //callback function for num of jobs completed metabox
    public function metaboxCallbackNumOfJobCompleted($post) {
        $num_of_jobs_completed = get_post_meta($post->ID, '_custom_metabox_num_of_jobs_completed', true);
        ?>
        <label for="custom_metabox_num_of_jobs_completed"><?php esc_html_e( 'Enter number of jobs completed:', 'profile-management' ); ?></label>
        <input type="number" id="custom_metabox_num_of_jobs_completed" name="custom_metabox_num_of_jobs_completed" value="<?php echo esc_attr($num_of_jobs_completed); ?>" min="1" max="10" />
        <?php
    }
    //Save and Update metabox values
    public function saveMetaboxes($postId) {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
        if (!isset($_POST['profile_detail_page_nonce']) || !wp_verify_nonce(sanitize_text_field($_POST['profile_detail_page_nonce']), 'save_custom_metabox')) return;

        if (!current_user_can('edit_post', $postId)) return;
        $flage=1;
        foreach ($this->metaboxes as $metabox) {
            $field_name = $metabox['id'];
            if (isset($_POST[$field_name])) {
                update_post_meta($postId, '_' . $field_name, sanitize_text_field($_POST[$field_name]));
                if(  $flage === 1 && $field_name === 'custom_metabox_dob' ){
                    $calculate_age = ageCalculator(sanitize_text_field($_POST[$field_name]));
                    update_post_meta($postId, 'profile_hidden_age', $calculate_age);
                    $flage=0;
                }
            }
        }
    }
}
// Instantiate the class
new CustomMetaboxes();