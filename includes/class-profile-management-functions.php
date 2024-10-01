<?php

/**
 * Implement all common functions used for the plugin
 *
 * @link       https://www.manthansparmar.com
 * @since      1.0.0
 *
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 */

/**
 * Implement all common functions used for the plugin
 *
 * File of common functions
 * @package    Profile_Management
 * @subpackage Profile_Management/includes
 * @author     Manthan Parmar <manthansparmar7@gmail.com>
 */

function ageCalculator($dob){
    if(!empty($dob)){
        $birthdate = new DateTime($dob);
        $today   = new DateTime('today');
        $age = $birthdate->diff($today)->y;
        return $age;
    }else{
        return 0;
    }
}