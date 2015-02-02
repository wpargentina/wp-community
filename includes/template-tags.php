<?php
/**
 * Custom template tags for this theme.
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

if ( ! function_exists( 'wp_community_content_span' ) ) :
/**
 * Obtain span class for content section.
 *
 * @since  1.0
 *
 * @param  bool   $echo Whether to print the result or not.
 * @return string
 */
function wp_community_content_span( $echo = true ) {
	// Return early if the function is bypassed.
	if ( false !== ( $span = apply_filters( 'wp_community_content_span_before', false, $echo ) ) ) {
		return $span;
	}

	$span = 'col-sm-9';
	if ( ! is_active_sidebar( 'sidebar-primary' ) || ! follet_get_current( 'sidebar_primary_show' ) ) {
		$span = 'col-sm-12';
	}

	$span = apply_filters( 'wp_community_content_span', $span, $echo );

	if ( $echo ) {
		echo $span;
	}

	return $span;
}
endif;

if ( ! function_exists( 'wp_community_footer_column_span' ) ) :
/**
 * Get span class for footer columns.
 *
 * @since  1.0
 * @param  bool   $echo Whether to print the result or not.
 * @return string
 */
function wp_community_footer_column_span( $echo = true ) {
	// Return early if the function is bypassed.
	if ( false !== ( $span = apply_filters( 'wp_community_footer_column_span_before', false, $echo ) ) ) {
		return $span;
	}

	$columns = 0;

	$sidebars = array(
		'sidebar-footer-1' => 'sidebar_footer_1_show',
		'sidebar-footer-2' => 'sidebar_footer_2_show',
		'sidebar-footer-3' => 'sidebar_footer_3_show',
	);

	foreach ( $sidebars as $id => $option ) {
		if ( is_active_sidebar( $id ) && follet_get_current( $option ) ) {
			$columns++;
		}
	}

	if ( ! $columns ) {
		return false;
	}

	$span = 12 / $columns;
	$span = 'col-sm-' . $span;
	$span = apply_filters( 'wp_community_footer_column_span', $span );

	if ( $echo ) {
		echo $span;
	}

	return $span;

}
endif;

if ( ! function_exists( 'wp_community_top_navigation_style' ) ) :
/**
 * Obtain class for selected Bootstrap navigation style.
 *
 * @since 1.0
 */
function wp_community_top_navigation_style() {
	// Return early if the function is bypassed.
	if ( false !== ( $style = apply_filters( 'wp_community_top_navigation_style_before', false ) ) ) {
		return $style;
	}

	$style = follet_get_current( 'top_navigation_style' );
	$style = follet_get_current( 'top_navigation_fix_top' ) ? $style . ' navbar-fixed-top' : $style . ' navbar-static-top';

	$style = apply_filters( 'wp_community_top_navigation_style', $style );

	echo $style;
}
endif;

if ( ! function_exists( 'wp_community_branding_is_visible' ) ) :
/**
 * Check if header should display.
 *
 * @since  1.0
 * @return bool
 */
function wp_community_branding_is_visible() {
	if (   follet_get_current( 'header_show_title' )
		|| follet_get_current( 'header_show_tagline' )
		|| (   follet_get_current( 'header_logo_show' )
			&& follet_get_current( 'header_logo_img' )
		)
	) {
		return true;
	}

	return false;
}
endif;

if ( ! function_exists( 'wp_community_credits' ) ) :
/**
 * Print site and theme credits.
 *
 * @since  1.0
 */
function wp_community_credits() {
	// Return early if the function is bypassed.
	if ( false !== ( $credits = apply_filters( 'wp_community_credits_before', false ) ) ) {
		echo $credits;
		return;
	}

	$credits = sprintf( __( 'Copyright %s', 'wp_argentina' ), '&copy; ' . date( 'Y' ) . ' <a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>. ' ) . sprintf( __( 'Powered by %s', 'wp_argentina' ), '<a href="http://www.wordpress.org/" class="wp-url">WordPress</a> ' . __( 'and', 'wp_argentina' ) . ' <a href="http://github.com/wpargentina/wp-community" class="theme-url">WP Community</a>.' );
	$credits = apply_filters( 'wp_community_footer_credits', $credits );

	echo $credits;
}
endif;
