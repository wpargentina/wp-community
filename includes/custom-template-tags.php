<?php
/**
 * Custom template tags for this theme.
 *
 * All the functions in this file can be plugged or hooked in.
 *
 * @package WP_Community_Theme
 * @since   1.0
 */

/**
 * Add a hook for custom actions before loading this file.
 */
do_action( 'wp_community_before_custom_template_tags' );

if ( ! function_exists( 'wp_community_content_span' ) ) :
/**
 * Obtain span class for content section.
 *
 * Take on this function by declaring it before this file is loaded.
 *
 * @param  boolean $return Whether to return the result instead of echo it.
 * @return void
 * @since  1.0
 */
function wp_community_content_span( $return = false ) {
	$span = 'col-sm-9';
	if (   ! is_active_sidebar( 'sidebar-primary' )
		|| ! follet_get_current( 'sidebar_primary_show' )
	) {
		$span = 'col-sm-12';
	}
	$span = apply_filters( 'wp_community_content_span', $span );
	if ( $return ) {
		return $span;
	}
	echo $span;
}
endif;

if ( ! function_exists( 'wp_community_footer_column_span' ) ) :
/**
 * Get span class for footer columns.
 *
 * @param  boolean     $return If set to true, the content will be returned instead of echoed.
 * @return void|string
 */
function wp_community_footer_column_span( $return = false ) {

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

	if ( $return ) {
		return $span;
	}

	echo $span;

}
endif;

if ( ! function_exists( 'wp_community_top_navigation_style' ) ) :
/**
 * Obtain class for selected Bootstrap navigation style.
 *
 * @return void
 */
function wp_community_top_navigation_style() {
	$style = follet_get_current( 'top_navigation_style' );
	$style = follet_get_current( 'top_navigation_fix_top' )
	         ? $style . ' navbar-fixed-top' : $style . ' navbar-static-top';
	echo $style;
}
endif;

if ( ! function_exists( 'wp_community_branding_is_visible' ) ) :
/**
 * Check if header should display.
 *
 * @return boolean
 * @since  1.0
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
 * @return void
 * @since  1.0
 */
function wp_community_credits() {
	$credits = sprintf( __( 'Copyright %s', 'wp_community' ), '&copy; ' . date( 'Y' ) . ' <a href="' . home_url() . '">' . get_bloginfo( 'name' ) . '</a>. ' ) . sprintf( __( 'Powered by %s', 'wp_community' ), '<a href="http://www.wordpress.org/" class="wp-url">WordPress</a> ' . __( 'and', 'wp_community' ) . ' <a href="http://github.com/wpargentina/wp-community" class="theme-url">WP Community</a>.' );
	$credits = apply_filters( 'wp_community_footer_credits', $credits );
	echo $credits;
}
endif;

/**
 * Add a hook for custom actions before loading the next file.
 */
do_action( 'wp_community_after_custom_template_tags' );
