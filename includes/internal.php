<?php
/**
 * Private functions for this theme go here.
 *
 * Keep in mind that they are not meant to be reused.
 *
 * @package   WP_Community
 * @author    WP Argentina <andres@wpargentina.org>
 * @license   GPL-2.0+
 * @link      http://github.com/wpargentina/wp-community
 * @copyright 2014-2015 WP Argentina
 * @since     1.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( '_wp_community_top_navigation_tip' ) ) :
/**
 * Sanitize top_navigation_tip setting.
 *
 * @internal
 *
 * @since  1.0
 * @return string
 */
function _wp_community_top_navigation_tip() {
	return '<p>' . apply_filters( 'wp_community_top_navigation_tip', sprintf( __( '%1$sTip:%2$s Even with "Show Top Navigation" checked, Top Navigation will not show if you have not set a custom menu under Navigation > Top Menu.', 'wp_argentina' ), '<strong>', '</strong>' ) ) . '</p>';
}
endif;

if ( ! function_exists( '_wp_community_header_logo_tip' ) ) :
/**
 * Sanitize header_logo_tip setting.
 *
 * @internal
 *
 * @since  1.0
 * @return string
 */
function _wp_community_header_logo_tip() {
	return '<p>' . apply_filters( 'wp_community_header_logo_tip', sprintf( __( 'Here you can upload your own logo and use it instead of the Site Title & Tagline values.', 'wp_argentina' ), '<strong>', '</strong>' ) ) . '</p>';
}
endif;

if ( ! function_exists( '_wp_community_primary_color_tip' ) ) :
/**
 * Sanitize primary_color_tip setting.
 *
 * @internal
 *
 * @since  1.0
 * @return string
 */
function _wp_community_primary_color_tip() {
	return '<div style="margin-bottom: 10px;">' . apply_filters( 'wp_community_primary_color_tip', __( 'This is the main color of the theme. It is used for links, separators, buttons and backgrounds for widget titles in the primary sidebar.', 'wp_argentina' ) ) . '</div>';
}
endif;

if ( ! function_exists( '_wp_community_secondary_color_tip' ) ) :
/**
 * Sanitize secondary_color_tip setting.
 *
 * @internal
 *
 * @since  1.0
 * @return string
 */
function _wp_community_secondary_color_tip() {
	return '<div style="margin-bottom: 10px;">' . apply_filters( 'wp_community_secondary_color_tip', __( 'This is the alternative color for the theme. It is used for contrasts such as link hovers and a number of design elements.', 'wp_argentina' ) ) . '</div>';
}
endif;

if ( ! function_exists( '_wp_community_header_background_color_tip' ) ) :
/**
 * Sanitize header_background_color_tip setting.
 *
 * @internal
 *
 * @since  1.0
 * @return string
 */
function _wp_community_header_background_color_tip() {
	return '<div style="margin-bottom: 5px;">' . apply_filters( 'wp_community_header_background_color_tip', __( 'This color will display as the header background when you have not set a header image. You can choose to ignore this setting if you want a transparent background.', 'wp_argentina' ) ) . '</div>';
}
endif;

if ( ! function_exists( '_wp_community_sanitize_top_navigation_style' ) ) :
/**
 * Sanitize top_navigation_style setting.
 *
 * @internal
 *
 * @since  1.0
 *
 * @param  string $value
 * @return string
 */
function _wp_community_sanitize_top_navigation_style( $value ) {
	$value = ( 'navbar-inverse' == $value ) ? $value : 'navbar-default';

	return $value;
}
endif;

if ( ! function_exists( '_wp_community_sanitize_upload' ) ) :
/**
 * Sanitize uploads.
 *
 * @internal
 *
 * @since  1.0
 *
 * @param  string $value
 * @return string
 */
function _wp_community_sanitize_upload( $value ) {
	$filetype = wp_check_filetype( $value );

	if ( ! $filetype['ext'] ) {
		$value = '';
	}

	return $value;
}
endif;

if ( ! function_exists( '_wp_community_sanitize_boolean' ) ) :
/**
 * Sanitize boolean values.
 *
 * @internal
 *
 * @since  1.0
 *
 * @param  bool $value
 * @return bool
 */
function _wp_community_sanitize_boolean( $value ) {
	$value = ( true === $value ) ? true : false;

	return $value;
}
endif;
