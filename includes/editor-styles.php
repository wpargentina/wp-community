<?php
/**
 * Register additional editor styles for this theme.
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

if ( ! function_exists( 'wp_community_editor_styles' ) ) :
add_filter( 'follet_editor_styles', 'wp_community_editor_styles' );
/**
 * Add styles for post editor.
 *
 * // TODO: add reference links.
 *
 * @since  1.0
 *
 * @param  array $editor_styles List of editor styles to be registered.
 * @return array
 */
function wp_community_editor_styles( $editor_styles ) {
	// Bypass function if editor styles for this theme have been declared before.
	if ( false !== ( $editor_styles_before = apply_filters( 'wp_community_editor_styles_before', false ) ) ) {
		return array_merge( $editor_styles, $editor_styles_before );
	}

	$template_directory_uri = follet_template_directory_uri();

	$editor_styles = array_merge( $editor_styles, array(
			'genericons'      => $template_directory_uri . '/fonts/genericons/genericons.css',
			'fonts'           => $template_directory_uri . '/css/fonts.css',
			'icons'           => $template_directory_uri . '/css/icons.css',
			'general-colors'  => $template_directory_uri . '/css/general-colors.css',
			'primary-color'   => $template_directory_uri . '/css/primary-color.css',
			'secondary-color' => $template_directory_uri . '/css/secondary-color.css',
		)
	);

	$editor_styles = apply_filters( 'wp_community_editor_styles', $editor_styles );

	return $editor_styles;
}
endif;
