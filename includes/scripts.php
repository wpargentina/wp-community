<?php
/**
 * Register additional scripts for this theme.
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

if ( ! function_exists( 'wp_community_scripts' ) ) :
add_action( 'follet_scripts', 'wp_community_scripts' );
/**
 * Register additional scripts for this theme.
 *
 * @since  1.0
 *
 * @param  array $scripts List of scripts to be registered.
 * @return array
 */
function wp_community_scripts( $scripts ) {
	// Bypass function if scripts for this theme have been declared before.
	if ( false !== ( $scripts_before = apply_filters( 'wp_community_scripts_before', false ) ) ) {
		return array_merge( $scripts, $scripts_before );
	}

	$template_directory_uri = follet_template_directory_uri();

	$scripts = array_merge( $scripts, apply_filters( 'wp_community_scripts', array(
		/**
		 * Skip Link Focus JS.
		 *
		 * @since 1.0
		 */
		'wp-community-skip-link-focus-fix' => array(
			'src'     => $template_directory_uri . '/js/min/skip-link-focus-fix.min.js',
			'version' => '20130115',
			'eval'    => follet_get_current( 'skip_link_focus' ),
		),

		/**
		 * Additional JS for Bootstrap support.
		 *
		 * @since 1.0
		 */
		'wp-community-bootstrap-support' => $template_directory_uri . '/js/min/bootstrap-support.min.js',

		/**
		 * Control height of primary sidebar.
		 *
		 * @since 1.0
		 */
		'wp-community-content-sidebar-height' => $template_directory_uri . '/js/min/content-sidebar-height.min.js',

		/**
		 * Manage effects for search form in top navigation menu.
		 *
		 * @since 1.0
		 */
		'wp-community-top-navigation-searchform' => $template_directory_uri . '/js/min/top-navigation-searchform.min.js',

		/**
		 * Resize width and height of videos.
		 *
		 * @since 1.0
		 */
		'wp-community-resize-videos' => array(
			'src'  => $template_directory_uri . '/js/min/resize-videos.min.js',
			'eval' => follet_get_current( 'responsive_videos' ),
		),
	) ) );

	return $scripts;
}
endif;
