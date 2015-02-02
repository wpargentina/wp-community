<?php
/**
 * Manage navigation functionality.
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

if ( ! function_exists( 'wp_community_menus' ) ) :
add_filter( 'follet_menus', 'wp_community_menus' );
/**
 * Register navigation menus.
 *
 * @since  1.0
 *
 * @param  array $menus List of theme menus.
 * @return array
 */
function wp_community_menus( $menus ) {
	// Bypass function if sidebars for this theme have been declared before.
	if ( false !== ( $menus_before = apply_filters( 'wp_community_menus_before', false ) ) ) {
		return array_merge( $menus, $menus_before );
	}

	$menus = array_merge( $menus, array(
		/**
		 * Register top navigation menu.
		 *
		 * @since 1.0
		 */
		'top-menu' => __( 'Top menu', 'wp_argentina' ),

		/**
		 * Register social menu.
		 *
		 * @since 1.0
		 */
		'social-menu' => __( 'Social menu', 'wp_argentina' ),
	) );

	$menus = apply_filters( 'wp_community_menus', $menus );

	return $menus;
}
endif;
