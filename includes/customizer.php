<?php
/**
 * Customization management.
 * 
 * This file manages Customizer additions that have not been registered within theme options,
 * such as sections, controls and explanatory texts for some settings.
 *
 * @see @link https://codex.wordpress.org/Theme_Customization_API
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

if ( ! function_exists( 'wp_community_customizer_settings' ) ) :
add_filter( 'Follet\Module\CustomizerModule\customizer_settings', 'wp_community_customizer_settings' );
/**
 * Add non-theme-option settings to the list of Customizer settings.
 *
 * @since  1.0
 *
 * @param  array $settings List of settings to be registered via Customizer.
 * @return array
 */
function wp_community_customizer_settings( $settings ) {
	// Bypass function if settings for this theme have been declared before.
	if ( false !== ( $settings_before = apply_filters( 'wp_community_customizer_settings_before', false ) ) ) {
		return array_merge( $settings, $settings_before );
	}

	$settings = array_merge( $settings, apply_filters( 'wp_community_customizer_settings', array(
		/**
		 * Add postMessage support for site title and description for the Theme Customizer.
		 *
		 * @since 1.0
		 */
		'header_textcolor' => array( 'transport' => 'postMessage' ),

		/**
		 * Explanatory text for top navigation.
		 *
		 * @since 1.0
		 */
		'top_navigation_tip' => array(
			'default'           => _wp_community_top_navigation_tip(),
			'sanitize_callback' => '_wp_community_top_navigation_tip',
			'section'           => 'top_navigation',
			'settings'          => 'top_navigation_tip',
			'priority'          => 10,
			'type'              => 'plain-text',
		),

		/**
		 * Explanatory text for header logo.
		 *
		 * @since 1.0
		 */
		'header_logo_tip' => array(
			'default'           => _wp_community_header_logo_tip(),
			'sanitize_callback' => '_wp_community_header_logo_tip',
			'section'           => 'header_logo',
			'settings'          => 'header_logo_tip',
			'priority'          => 10,
			'type'              => 'plain-text',
		),

		/**
		 * Explanatory text for primary color.
		 *
		 * @since 1.0
		 */
		'primary_color_tip' => array(
			'default'           => _wp_community_primary_color_tip(),
			'sanitize_callback' => '_wp_community_primary_color_tip',
			'section'           => 'colors',
			'priority'          => 2,
			'type'              => 'plain-text',
		),

		/**
		 * Explanatory text for secondary color.
		 *
		 * @since 1.0
		 */
		'secondary_color_tip' => array(
			'default'           => _wp_community_secondary_color_tip(),
			'sanitize_callback' => '_wp_community_secondary_color_tip',
			'section'           => 'colors',
			'settings'          => 'secondary_color_tip',
			'priority'          => 4,
			'type'              => 'plain-text',
		),

		/**
		 * Explanatory text for background color.
		 *
		 * @since 1.0
		 */
		'header_background_color_tip' => array(
			'default'           => _wp_community_header_background_color_tip(),
			'sanitize_callback' => '_wp_community_header_background_color_tip',
			'section'           => 'colors',
			'priority'          => 8,
			'type'              => 'plain-text',
		),
	) ) );
	
	return $settings;
}
endif;

if ( ! function_exists( 'wp_community_customizer_sections' ) ) :
add_filter( 'Follet\Module\CustomizerModule\customizer_sections', 'wp_community_customizer_sections', 10, 2 );
/**
 * Add sections for Customizer.
 *
 * @since 1.0
 *
 * @param  array $sections List of sections to be registered via Customizer.
 * @return array
 */
function wp_community_customizer_sections( $sections ) {
	// Bypass function if sections for this theme have been declared before.
	if ( false !== ( $sections_before = apply_filters( 'wp_community_customizer_sections_before', false ) ) ) {
		return array_merge( $sections, $sections_before );
	}
	
	$sections = array_merge( $sections, apply_filters( 'wp_community_customizer_sections', array(
		/**
		 * Register header logo section.
		 *
		 * @since 1.0
		 */
		'header_logo' => array(
			'title'    => __( 'Header Logo', 'wp_argentina' ),
			'priority' => 21,
			'eval'     => follet_get_current( 'header_logo_customize' ),
		),

		/**
		 * Modify default header image section.
		 *
		 * @since 1.0
		 */
		'header_image' => array(
			'priority' => 22,
		),

		/**
		 * Modify default navigation section.
		 *
		 * @since 1.0
		 */
		'nav' => array(
			'priority' => 30,
		),

		/**
		 * Add top navigation section.
		 *
		 * @since 1.0
		 */
		'top_navigation' => array(
			'title'    => __( 'Top Navigation', 'wp_argentina' ),
			'priority' => 31,
		),

		/**
		 * Add colors section.
		 *
		 * @since 1.0
		 */
		'colors' => array(
			'priority' => 60,
		),
	) ) );

	return $sections;
}
endif;

if ( ! function_exists( 'wp_community_customizer_controls' ) ) :
add_filter( 'Follet\Module\CustomizerModule\customizer_controls', 'wp_community_customizer_controls', 10, 2 );
/**
 * Add or modify non-theme-option controls for Customizer.
 *
 * @since  1.0
 *
 * @param  array $controls List of controls to be registered via Customizer.
 * @return array
 */
function wp_community_customizer_controls( $controls ) {
	// Bypass function if controls for this theme have been declared before.
	if ( false !== ( $controls_before = apply_filters( 'wp_community_customizer_controls_before', false ) ) ) {
		return array_merge( $controls, $controls_before );
	}

	$controls = array_merge( $controls, apply_filters( 'wp_community_customizer_controls', array(
		/**
		 * Modify default background color control.
		 *
		 * @since 1.0
		 */
		'background_color' => array(
			'label'    => __( 'Body Background Color', 'wp_argentina' ),
			'priority' => 12,
		),

		/**
		 * Modify default header text color control.
		 *
		 * @since 1.0
		 */
		'header_textcolor' => array(
			'priority' => 5,
		),
	) ) );

	return $controls;
}
endif;

if ( ! function_exists( 'wp_community_customizer_scripts' ) ) :
add_filter( 'Follet\Module\CustomizerModule\customizer_scripts', 'wp_community_customizer_scripts' );
/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since  1.0
 *
 * @param  array $scripts List of scripts to be registered.
 * @return array
 */
function wp_community_customizer_scripts( $scripts ) {
	// Bypass function if customizer scripts for this theme have been declared before.
	if ( false !== ( $scripts_before = apply_filters( 'wp_community_customizer_scripts_before', false ) ) ) {
		return array_merge( $scripts, $scripts_before );
	}

	$scripts = array_merge( $scripts, apply_filters( 'wp_community_customizer_scripts', array(
		/**
		 * Load main script.
		 *
		 * @since 1.0
		 */
		'wp-community-customizer' => array(
			'src'     => follet_template_directory_uri() . '/js/min/customizer.min.js',
			'version' => '20130508',
		)
	) ) );

	return $scripts;
}
endif;
