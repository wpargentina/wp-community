<?php
/**
 * Register theme options and Customizer settings.
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

if ( ! function_exists( 'wp_community_options' ) ) :
add_filter( 'follet_options', 'wp_community_options' );
/**
 * Register options for this theme through Follet Core.
 *
 * @since  1.1
 *
 * @param  array $options List of theme options to be registered.
 * @return array
 */
function wp_community_options( $options ) {
	// Bypass function if options for this theme have been declared before.
	if ( false !== ( $options_before = apply_filters( 'wp_community_options_before', false ) ) ) {
		return array_merge( $options, $options_before );
	}

	$options = array_merge( $options, array(
		/**
		 * Top navigation options.
		 *
		 * @since 1.0
		 */
		'top_navigation_show'            => array(
			'label'    => __( 'Show Top Navigation', 'wp_argentina' ),
			'section'  => 'top_navigation',
			'default'  => true,
			'priority' => 20,
			'type'     => 'checkbox',
		),
		'top_navigation_fix_top'         => array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => '_wp_community_sanitize_boolean',
			'label'             => __( 'Fix to Top', 'wp_argentina' ),
			'section'           => 'top_navigation',
			'settings'          => 'top_navigation_fix_top',
			'priority'          => 30,
			'type'              => 'checkbox',
		),
		'top_navigation_searchform_show' => array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => '_wp_community_sanitize_boolean',
			'label'             => __( 'Show Search Form', 'wp_argentina' ),
			'section'           => 'top_navigation',
			'settings'          => 'top_navigation_searchform_show',
			'priority'          => 40,
			'type'              => 'checkbox',
		),
		'top_navigation_style'           => array(
			'default'           => 'navbar-default',
			'transport'         => 'refresh',
			'sanitize_callback' => '_wp_community_sanitize_top_navigation_style',
			'label'             => __( 'Color Scheme', 'wp_argentina' ),
			'section'           => 'top_navigation',
			'settings'          => 'top_navigation_style',
			'priority'          => 50,
			'type'              => 'radio',
			'choices'           => array(
				'navbar-default' => __( 'Light', 'wp_argentina' ),
				'navbar-inverse' => __( 'Dark', 'wp_argentina' ),
			),
		),

		/**
		 * Social navigation options.
		 *
		 * @since 1.0
		 */
		'social_navigation_show' => true,

		/**
		 * Header logo options.
		 *
		 * @since 1.0
		 */
		'header_logo_customize' => false,
		'header_logo_img'       => array(
			'default'           => '',
			'transport'         => 'refresh',
			'sanitize_callback' => '_wp_community_sanitize_upload',
			'label'             => __( 'Header Logo', 'wp_argentina' ),
			'section'           => 'header_logo',
			'priority'          => 20,
			'type'              => 'image',
		),
		'header_logo_show'      => array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => '_wp_community_sanitize_boolean',
			'label'             => __( 'Show instead of Site Title & Tagline', 'wp_argentina' ),
			'section'           => 'header_logo',
			'priority'          => 30,
			'type'              => 'checkbox',
		),
		'header_show_title'     => true,
		'header_show_tagline'   => true,

		/**
		 * Color options.
		 *
		 * @since 1.0
		 */
		'primary_color'                    => array(
			'default'           => '#57AAD2',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
			'label'             => __( 'Primary Color', 'wp_argentina' ),
			'section'           => 'colors',
			'priority'          => 1,
			'type'              => 'color',
		),
		'secondary_color'                  => array(
			'default'           => '#d54e21',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
			'label'             => __( 'Secondary Color', 'wp_argentina' ),
			'section'           => 'colors',
			'priority'          => 3,
			'type'              => 'color',
		),
		'header_background_color'          => array(
			'default'           => '#57AAD2',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
			'label'             => __( 'Header Background Color', 'wp_argentina' ),
			'section'           => 'colors',
			'settings'          => 'header_background_color',
			'priority'          => 7,
			'type'              => 'color',
		),
		'header_background_ignore'         => array(
			'default'           => false,
			'transport'         => 'refresh',
			'sanitize_callback' => '_wp_community_sanitize_boolean',
			'label'             => __( 'Ignore Header Background Color', 'wp_argentina' ),
			'section'           => 'colors',
			'settings'          => 'header_background_ignore',
			'priority'          => 9,
			'type'              => 'checkbox',
		),
		'primary_sidebar_background_color' => array(
			'default'           => '#FFFFFF',
			'transport'         => 'refresh',
			'sanitize_callback' => 'sanitize_hex_color',
			'label'             => __( 'Primary Sidebar Background Color', 'wp_argentina' ),
			'section'           => 'colors',
			'settings'          => 'primary_sidebar_background_color',
			'priority'          => 11,
			'type'              => 'color',
		),

		/**
		 * Primary sidebar options.
		 *
		 * @since 1.0
		 */
		'sidebar_primary_show' => true,

		/**
		 * Footer options.
		 *
		 * @since 1.0
		 */
		'show_footer_in_summary' => true,
		'footer_show'            => true,
		'footer_credits_show'    => true,
		'sidebar_footer_1_show'  => true,
		'sidebar_footer_2_show'  => true,
		'sidebar_footer_3_show'  => true,

		/**
		 * Other non-customizer options.
		 *
		 * @since 1.0
		 */
		'load_main_style'       => true,
		'skip_link_focus'       => true,
		'post_avatar_show'      => false,
		'post_author_info_show' => false,
		'breadcrumbs_show'      => false,
		'contact_methods_show'  => false,
		'responsive_videos'     => true,
		'contact_methods'       => array(
			'feed'       => 'RSS',
			'wordpress'  => 'WordPress',
			'twitter'    => 'Twitter',
			'facebook'   => 'Facebook',
			'googleplus' => 'Google',
			'linkedin'   => 'LinkedIn',
			'github'     => 'Github',
			'pinterest'  => 'Pinterest',
			'flickr'     => 'Flickr',
			'instagram'  => 'Instagram',
			'vimeo'      => 'Vimeo',
			'youtube'    => 'YouTube',
		)
	) );

	$options = apply_filters( 'wp_community_options', $options );

	return $options;
}
endif;
