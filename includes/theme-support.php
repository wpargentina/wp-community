<?php
/**
 * Manage additional supported features.
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

if ( ! function_exists( 'wp_community_theme_support' ) ) :
add_filter( 'follet_theme_support', 'wp_community_theme_support' );
/**
 * Setup additional theme support.
 *
 * @since  1.0
 *
 * @param  array $theme_support List of supported features.
 * @return array
 */
function wp_community_theme_support( $theme_support ) {
	$theme_support = array_merge( $theme_support, apply_filters( 'wp_community_theme_support', array(
		/**
		 * Setup the WordPress core custom header feature.
		 *
		 * @uses   wp_community_header_style()
		 * @uses   wp_community_admin_header_style()
		 * @uses   wp_community_admin_header_image()
		 *
		 * @since  1.0
		 */
		'custom-header' => apply_filters( 'wp_community_custom_header_args', array(
			'default-text-color'     => 'FFFFFF',
			'header-text'            => true,
			'width'                  => 1000,
			'height'                 => 250,
			'flex-height'            => true,
			'wp-head-callback'       => 'wp_community_header_style',
			'admin-head-callback'    => 'wp_community_admin_header_style',
			'admin-preview-callback' => 'wp_community_admin_header_image',
		) ),
	) ) );

	return $theme_support;
}
endif;
