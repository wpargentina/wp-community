<?php
/**
 * Manage sidebar functionality.
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

if ( ! function_exists( 'wp_community_sidebars' ) ) :
add_filter( 'follet_sidebars', 'wp_community_sidebars' );
/**
 * Register sidebars for this theme.
 *
 * @since  1.1
 *
 * @param  array $sidebars List of sidebars for this theme.
 * @return array
 */
function wp_community_sidebars( $sidebars ) {
	// Bypass function if sidebars for this theme have been declared before.
	if ( false !== ( $sidebars_before = apply_filters( 'wp_community_sidebars_before', false ) ) ) {
		return array_merge( $sidebars, $sidebars_before );
	}

	$sidebars = array_merge( $sidebars, array(
		/**
		 * Main sidebar.
		 *
		 * @since 1.0
		 */
		'sidebar-primary' => __( 'Primary Sidebar', 'wp_argentina' ),

		/**
		 * Footer sidebars.
		 *
		 * @since 1.0
		 */
		'sidebar-footer-1' => __( 'Footer Sidebar #1', 'wp_argentina' ),
		'sidebar-footer-2' => __( 'Footer Sidebar #2', 'wp_argentina' ),
		'sidebar-footer-3' => __( 'Footer Sidebar #3', 'wp_argentina' ),
	) );

	return $sidebars;
}
endif;
