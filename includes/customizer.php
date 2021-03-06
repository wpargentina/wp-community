<?php
/**
 * Customization management.
 *
 * @see {@link https://codex.wordpress.org/Theme_Customization_API}
 *
 * @package WP_Community_Theme
 * @since   1.0
 */

/**
 * Add a hook for custom actions before loading this file.
 */
do_action( 'wp_community_before_customizer' );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param  WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 * @since  1.0
 */
function wp_community_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'wp_community_customize_register', 10 );

/**
 * Customizations for Top Navigation.
 *
 * @param  WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 * @since  1.0
 */
function wp_community_customize_top_navigation( $wp_customize ) {

	$wp_customize->get_section( 'nav' )->priority = 30;

	$wp_customize->add_section( 'top_navigation' , array(
		'title'    => __( 'Top Navigation', 'wp_argentina' ),
		'priority' => 31,
	) );

	$wp_customize->add_setting( 'top_navigation_tip', array(
		'default'           => _wp_community_top_navigation_tip(),
		'sanitize_callback' => '_wp_community_top_navigation_tip',
	) );

	$wp_customize->add_control(
		new Follet_Plain_Text_Control(
			$wp_customize,
			'top_navigation_tip',
			array(
				'section'  => 'top_navigation',
				'settings' => 'top_navigation_tip',
				'priority' => 10,
			)
		)
	);

	$wp_customize->add_setting( 'top_navigation_show', array(
		'default'           => follet_get_default( 'top_navigation_show' ),
		'transport'         => 'refresh',
		'sanitize_callback' => '_wp_community_sanitize_boolean',
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'top_navigation_show',
			array(
				'label'    => __( 'Show Top Navigation', 'wp_argentina' ),
				'section'  => 'top_navigation',
				'settings' => 'top_navigation_show',
				'priority' => 20,
				'type'     => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting( 'top_navigation_fix_top', array(
		'default'           => follet_get_default( 'top_navigation_fix_top' ),
		'transport'         => 'refresh',
		'sanitize_callback' => '_wp_community_sanitize_boolean',
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'top_navigation_fix_top',
			array(
				'label'    => __( 'Fix to Top', 'wp_argentina' ),
				'section'  => 'top_navigation',
				'settings' => 'top_navigation_fix_top',
				'priority' => 30,
				'type'     => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting( 'top_navigation_searchform_show', array(
		'default'           => false,
		'transport'         => 'refresh',
		'sanitize_callback' => '_wp_community_sanitize_boolean',
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'top_navigation_searchform_show',
			array(
				'label'    => __( 'Show Search Form', 'wp_argentina' ),
				'section'  => 'top_navigation',
				'settings' => 'top_navigation_searchform_show',
				'priority' => 40,
				'type'     => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting( 'top_navigation_style', array(
		'default'           => follet_get_default( 'top_navigation_style' ),
		'transport'         => 'refresh',
		'sanitize_callback' => '_wp_community_sanitize_top_navigation_style',
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'top_navigation_style',
			array(
				'label'    => __( 'Color Scheme', 'wp_argentina' ),
				'section'  => 'top_navigation',
				'settings' => 'top_navigation_style',
				'priority' => 50,
				'type'     => 'radio',
				'choices'  => array(
					'navbar-default' => __( 'Light', 'wp_argentina' ),
					'navbar-inverse' => __( 'Dark', 'wp_argentina' ),
				),
			)
		)
	);

}
add_action( 'customize_register', 'wp_community_customize_top_navigation' );

/**
 * Allow to upload a custom logo to replace the header text.
 *
 * @param  WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 * @since  1.0
 */
function wp_community_customize_header_logo( $wp_customize ) {

	if ( follet_get_current( 'header_logo_customize' ) ) {

		$wp_customize->add_section( 'header_logo' , array(
			'title'    => __( 'Header Logo', 'wp_argentina' ),
			'priority' => $wp_customize->get_section( 'title_tagline' )->priority + 1,
		) );

		$wp_customize->add_setting( 'header_logo_tip', array(
			'default'           => _wp_community_header_logo_tip(),
			'sanitize_callback' => '_wp_community_header_logo_tip',
		) );

		$wp_customize->add_control(
			new wp_community_Plain_Text_Control(
				$wp_customize,
				'header_logo_tip',
				array(
					'section'  => 'header_logo',
					'settings' => 'header_logo_tip',
					'priority' => 10,
				)
			)
		);

		$wp_customize->add_setting( 'header_logo_show', array(
			'default'           => follet_get_default( 'header_logo_show' ),
			'transport'         => 'refresh',
			'sanitize_callback' => '_wp_community_sanitize_boolean',
		) );

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'header_logo_show',
				array(
					'label'    => __( 'Show instead of Site Title & Tagline', 'wp_argentina' ),
					'section'  => 'header_logo',
					'settings' => 'header_logo_show',
					'priority' => 30,
					'type'     => 'checkbox',
				)
			)
		);

		$wp_customize->add_setting( 'header_logo_img', array(
			'default'           => follet_get_default( 'header_logo_img' ),
			'transport'         => 'refresh',
			'sanitize_callback' => '_wp_community_sanitize_upload',
		) );

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'header_logo_img',
				array(
					'label'      => __( 'Header Logo', 'wp_argentina' ),
					'section'    => 'header_logo',
					'settings'   => 'header_logo_img',
					'priority'   => 20,
				)
			)
		);

	}

}
add_action( 'customize_register', 'wp_community_customize_header_logo' );

/**
 * Relocate header image section.
 *
 * @param  WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 * @since  1.0
 */
function wp_community_customize_title_tagline( $wp_customize ) {
	$wp_customize->get_section( 'header_image' )->priority = $wp_customize->get_section( 'title_tagline' )->priority + 2;
}
add_action( 'customize_register', 'wp_community_customize_title_tagline' );

/**
 * Manage primary, secondary, sidebar background and header background colors.
 *
 * @param  WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 * @since  1.0
 */
function wp_community_customize_colors( $wp_customize ) {

	$wp_customize->get_section( 'colors' )->priority = 60;
	$wp_customize->get_control( 'background_color' )->label = __( 'Body Background Color', 'wp_argentina' );
	$wp_customize->get_control( 'header_textcolor' )->priority = 5;
	$wp_customize->get_control( 'background_color' )->priority = 12;

	$wp_customize->add_setting( 'primary_color', array(
		'default'           => follet_get_default( 'primary_color' ),
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
				'label'    => __( 'Primary Color', 'wp_argentina' ),
				'section'  => 'colors',
				'settings' => 'primary_color',
				'priority' => 1,
			)
		)
	);

	$wp_customize->add_setting( 'primary_color_tip', array(
		'default'           => _wp_community_primary_color_tip(),
		'sanitize_callback' => '_wp_community_primary_color_tip',
	) );

	$wp_customize->add_control(
		new Follet_Plain_Text_Control(
			$wp_customize,
			'primary_color_tip',
			array(
				'section'  => 'colors',
				'settings' => 'primary_color_tip',
				'priority' => 2,
			)
		)
	);

	$wp_customize->add_setting( 'secondary_color', array(
		'default'           => follet_get_default( 'secondary_color' ),
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'secondary_color',
			array(
				'label'    => __( 'Secondary Color', 'wp_argentina' ),
				'section'  => 'colors',
				'settings' => 'secondary_color',
				'priority' => 3,
			)
		)
	);

	$wp_customize->add_setting( 'secondary_color_tip', array(
		'default'           => _wp_community_secondary_color_tip(),
		'sanitize_callback' => '_wp_community_secondary_color_tip',
	) );

	$wp_customize->add_control(
		new Follet_Plain_Text_Control(
			$wp_customize,
			'secondary_color_tip',
			array(
				'section'  => 'colors',
				'settings' => 'secondary_color_tip',
				'priority' => 4,
			)
		)
	);

	$wp_customize->add_setting( 'header_background_color', array(
		'default'           => follet_get_default( 'header_background_color' ),
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_background_color',
			array(
				'label'    => __( 'Header Background Color', 'wp_argentina' ),
				'section'  => 'colors',
				'settings' => 'header_background_color',
				'priority' => 7,
			)
		)
	);

	$wp_customize->add_setting( 'header_background_color_tip' , array(
		'default'   => _wp_community_header_background_color_tip(),
		'sanitize_callback' => '_wp_community_header_background_color_tip',
	) );

	$wp_customize->add_control(
		new Follet_Plain_Text_Control(
			$wp_customize,
			'header_background_color_tip',
			array(
				'section'  => 'colors',
				'settings' => 'header_background_color_tip',
				'priority' => 8,
			)
		)
	);


	$wp_customize->add_setting( 'header_background_ignore', array(
		'default'           => follet_get_default( 'header_background_ignore' ),
		'transport'         => 'refresh',
		'sanitize_callback' => '_wp_community_sanitize_boolean',
	) );

	$wp_customize->add_control(
		new WP_Customize_Control(
			$wp_customize,
			'header_background_ignore',
			array(
				'label'    => __( 'Ignore Header Background Color', 'wp_argentina' ),
				'section'  => 'colors',
				'settings' => 'header_background_ignore',
				'priority' => 9,
				'type'     => 'checkbox',
			)
		)
	);

	$wp_customize->add_setting( 'primary_sidebar_background_color', array(
		'default'           => follet_get_default( 'primary_sidebar_background_color' ),
		'transport'         => 'refresh',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_sidebar_background_color',
			array(
				'label'    => __( 'Primary Sidebar Background Color', 'wp_argentina' ),
				'section'  => 'colors',
				'settings' => 'primary_sidebar_background_color',
				'priority' => 11,
			)
		)
	);

}
add_action( 'customize_register', 'wp_community_customize_colors' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @return void
 * @since  1.0
 */
function wp_community_customize_preview_js() {
	wp_enqueue_script(
		'wp_community_customizer', follet_template_directory_uri() . '/js/min/customizer.min.js',
		array( 'customize-preview' ),
		'20130508',
		true
	);
}
add_action( 'customize_preview_init', 'wp_community_customize_preview_js' );

/**
 * Add a hook for custom actions before loading the next file.
 */
do_action( 'wp_community_after_customizer' );
