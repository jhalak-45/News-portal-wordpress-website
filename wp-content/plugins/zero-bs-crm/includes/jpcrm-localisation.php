<?php
/**
 * 
 * Herein lie various functions designed to make localisation easier.
 * 
 */

// prevent direct access
if ( ! defined( 'ZEROBSCRM_PATH' ) ) exit;

/**
 * Creates a timezone-aware datetime string
 * 
 * @param int Unix timestamp
 * @param string DateTime formatting string (e.g. 'Y-m-d H:i')
 * 
 * @return string formatted datetime string
 */
function jpcrm_uts_to_datetime_str( $timestamp, $format=false ) {

	// default to WP format
	if ( !$format ) {
		$format = get_option('date_format') . ' ' . get_option('time_format');
	}

	// create DateTime object from UTS
	$date_obj = new DateTime( '@'.$timestamp );

	// set timezone for object
	$date_obj->setTimezone( new DateTimeZone( wp_timezone_string() ) );

	// return formatted string
	return $date_obj->format( $format );

}

/**
 * Creates a timezone-aware date string
 * This is a wrapper of jpcrm_uts_to_datetime_str()
 * 
 * @param int Unix timestamp
 * @param string DateTime formatting string (e.g. 'Y-m-d')
 * 
 * @return string formatted date string
 */
function jpcrm_uts_to_date_str( $timestamp, $format=false ) {

	// default to WP format
	if ( !$format ) {
		$format = get_option('date_format');
	}

	return jpcrm_uts_to_datetime_str( $timestamp, $format );

}

/**
 * Creates a timezone-aware time string
 * This is a wrapper of jpcrm_uts_to_datetime_str()
 * 
 * @param int Unix timestamp
 * @param string DateTime formatting string (e.g. 'H:i')
 * 
 * @return string formatted time string
 */
function jpcrm_uts_to_time_str( $timestamp, $format=false ) {

	// default to WP format
	if ( !$format ) {
		$format = get_option('time_format');
	}

	return jpcrm_uts_to_datetime_str( $timestamp, $format );

}

/**
 * Returns WP timezone offset string (e.g. -10:00)
 * 
 * @return string timezone offset string
 */
function jpcrm_get_wp_timezone_offset() {
	$date_obj = new DateTime();
	$date_obj->setTimezone( new DateTimeZone( wp_timezone_string() ) );
	return $date_obj->format( 'P' );
}