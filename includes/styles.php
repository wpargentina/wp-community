<?php
/**
 * Register additional styles for this theme.
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

if ( ! function_exists( 'wp_community_styles' ) ) :
add_filter( 'follet_styles', 'wp_community_styles' );
/**
 * Load additional styles for this theme.
 *
 * @since 1.0
 *
 * @param  array $styles List of styles to be registered.
 * @return array
 */
function wp_community_styles( $styles ) {
	// Bypass function if styles for this theme have been declared before.
	if ( false !== ( $styles_before = apply_filters( 'wp_community_styles_before', false ) ) ) {
		return array_merge( $styles, $styles_before );
	}

	$template_directory_uri = follet_template_directory_uri();

	$styles = array_merge( $styles, apply_filters( 'wp_community_styles', array(
		/**
		 * Load Genericons font-face.
		 *
		 * @since 1.0
		 */
		'genericons' => array(
			'src'     => $template_directory_uri . '/fonts/genericons/genericons.css',
			'version' => '3.0.3',
		),

		/**
		 * Load styles for bbPress compatibility.
		 *
		 * @since 1.0
		 */
		'wp-community-bbpress' => $template_directory_uri . '/css/bbpress.css',

		/**
		 * Load custom font-related styles for this theme.
		 *
		 * @since 1.0
		 */
		'wp-community-fonts' => $template_directory_uri . '/css/fonts.css',

		/**
		 * Load styles for general colors.
		 *
		 * @since 1.0
		 */
		'wp-community-general-colors' => $template_directory_uri . '/css/general-colors.css',

		/**
		 * Load styles for primary color.
		 *
		 * @since 1.0
		 */
		'wp-community-primary-color' => $template_directory_uri . '/css/primary-color.css',

		/**
		 * Load styles for secondary color.
		 *
		 * @since 1.0
		 */
		'wp-community-secondary-color' => $template_directory_uri . '/css/secondary-color.css',

		/**
		 * Load styles for primary sidebar color.
		 *
		 * @since 1.0
		 */
		'wp-community-primary-sidebar-color' => $template_directory_uri . '/css/primary-sidebar-color.css',

		/**
		 * Load icon-related styles for this theme.
		 *
		 * @since 1.0
		 */
		'wp-community-icons' => $template_directory_uri . '/css/icons.css',
	) ) );

	return $styles;
}
endif;

if ( ! function_exists( 'wp_community_main_style_dependencies' ) ) :
add_filter( 'follet_main_style_dependencies', 'wp_community_main_style_dependencies' );
/**
 * Add dependencies for the main style.
 *
 * @since 1.0
 *
 * @param  array $dependencies Current list of dependencies.
 * @return array               Filtered list of dependencies.
 */
function wp_community_main_style_dependencies( $dependencies ) {
	// Bypass function if styles for this theme have been declared before.
	if ( false !== ( $dependencies_before = apply_filters( 'wp_community_main_style_dependencies_before', false ) ) ) {
		return array_merge( $dependencies, $dependencies_before );
	}

	$dependencies = array_merge( $dependencies, apply_filters( 'wp_community_main_style_dependencies', array(
		/**
		 * Add Dashicons.
		 *
		 * @since 1.0
		 */
		'dashicons',
	) ) );

	return $dependencies;
}
endif;
