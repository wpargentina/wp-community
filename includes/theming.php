<?php
/**
 * This file includes functions to manage theming functionality.
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

if ( ! function_exists( 'wp_community_post_author_section_microdata' ) ) :
add_filter( 'wp_community_post_author_section', 'wp_community_post_author_section_microdata' );
/**
 * Apply microdata to post author section.
 *
 * @param  string $output Current content of post author section.
 * @return string         Filtered content.
 * @since  1.0
 */
function wp_community_post_author_section_microdata( $output ) {
	$output = str_replace( '<section', '<section ' . follet_microdata( 'entry-author', false ), $output );
	$output = str_replace( '<a', '<a ' . follet_microdata( 'url', false ), $output );
	return $output;
}
endif;

if ( ! function_exists( 'wp_community_post_comments_section_microdata' ) ) :
add_filter( 'wp_community_post_comments_section', 'wp_community_post_comments_section_microdata' );
/**
 * Apply microdata to post comments section.
 *
 * @param  string $output Current content of post comments section.
 * @return string         Filtered content.
 * @since  1.0
 */
function wp_community_post_comments_section_microdata( $output ) {
	$output = str_replace( '<section', '<section ' . follet_microdata( 'comments-link', false ), $output );
	$output = str_replace( '<a', '<a ' . follet_microdata( 'url', false ), $output );
	return $output;
}
endif;

if ( ! function_exists( 'wp_community_comments_microdata' ) ) :
add_filter( 'wp_community_list_comments', 'wp_community_comments_microdata' );
/**
 * Apply microdata to comments section.
 *
 * @param  string $output Current content of comments section.
 * @return string         Filtered content.
 * @since  1.0
 */
function wp_community_comments_microdata( $output ) {
	$output = str_replace( 'class="comment ', follet_microdata( 'comment', false ) . ' class="comment ', $output );
	$output = str_replace( 'class="comment-author', follet_microdata( 'comment-author', false ) . ' class="comment-author', $output );
	$output = str_replace( '<a ', '<a ' . follet_microdata( 'url', false ) . ' ', $output );
	$output = str_replace( '<img ', '<img ' . follet_microdata( 'image', false ) . ' ', $output );
	$output = str_replace( '<time ', '<time ' . follet_microdata( 'comment-time', false ) . ' ', $output );
	$output = str_replace( 'class="comment-content', follet_microdata( 'comment-content', false ) . ' class="comment-content', $output );
	$output = str_replace( '<a itemprop="url" class=\'comment-reply-link\'', '<a class=\'comment-reply-link\' ' . follet_microdata( 'comment-reply', false ), $output );
	return $output;
}
endif;

if ( ! function_exists( 'wp_community_primary_color' ) ) :
add_action( 'wp_enqueue_scripts', 'wp_community_primary_color' );
/**
 * Add styles when a primary color is set.
 *
 * @return void
 * @since  1.0
 */
function wp_community_primary_color() {
	$primary_color_style = follet_override_stylesheet_colors(
		follet_get_current( 'primary_color' ),
		get_template_directory() . '/css/primary-color.css',
		follet_get_default( 'primary_color' ),
		array( follet_get_default( 'primary_color' ) )
	);
	if ( $primary_color_style ) {
		wp_add_inline_style( 'wp-community-primary-color', $primary_color_style );
	}
}
endif;

if ( ! function_exists( 'wp_community_secondary_color' ) ) :
add_action( 'wp_enqueue_scripts', 'wp_community_secondary_color' );
/**
 * Add styles when a secondary color is set.
 *
 * @return void
 * @since  1.0
 */
function wp_community_secondary_color() {
	$secondary_color_style = follet_override_stylesheet_colors(
		follet_get_current( 'secondary_color' ),
		get_template_directory() . '/css/secondary-color.css',
		follet_get_default( 'secondary_color' ),
		array( follet_get_default( 'secondary_color' ) )
	);
	if ( $secondary_color_style ) {
		wp_add_inline_style( 'wp-community-secondary-color', $secondary_color_style );
	}
}
endif;

if ( ! function_exists( 'wp_community_primary_sidebar_background_color' ) ) :
add_action( 'wp_enqueue_scripts', 'wp_community_primary_sidebar_background_color' );
/**
 * Add styles when a background color for sidebar is set.
 *
 * @return void
 * @since  1.0
 */
function wp_community_primary_sidebar_background_color() {
	$sidebar_background_color_style = follet_override_stylesheet_colors(
		follet_get_current( 'primary_sidebar_background_color' ),
		get_template_directory() . '/css/primary-sidebar-color.css',
		follet_get_default( 'primary_sidebar_background_color' ),
		array( follet_get_default( 'primary_sidebar_background_color' ), 'white' )
	);
	if ( $sidebar_background_color_style ) {
		wp_add_inline_style( 'wp-community-primary-sidebar-color', $sidebar_background_color_style );
	}
}
endif;

if ( ! function_exists( 'wp_community_bootstrap_carousel_control' ) ) :
add_filter( 'agnosia_bootstrap_carousel_control', 'wp_community_bootstrap_carousel_control' );
/**
 * Support for Agnosia Bootstrap Carousel
 *
 * // @TODO: Move to a separated integration file.
 *
 * @see {@link http://wordpress.org/plugins/agnosia-bootstrap-carousel/}
 *
 * @param  string $control HTML for slider control.
 * @return string          Filtered HTML.
 * @since  1.0
 */
function wp_community_bootstrap_carousel_control( $control ) {
	$control = str_replace( '&lsaquo;', '<span class="glyphicon glyphicon-chevron-left"></span>', $control );
	$control = str_replace( '&rsaquo;', '<span class="glyphicon glyphicon-chevron-right"></span>', $control );
	return $control;
}
endif;

if ( ! function_exists( 'wp_community_content_width' ) ) :
add_action( 'init', 'wp_community_content_width' );
/**
 * Set content_width by sidebar availability.
 *
 * @return void
 * @since  1.0
 */
function wp_community_content_width() {

	global $content_width;

	if (   ! is_active_sidebar( 'sidebar-primary' )
		|| ! follet_get_current( 'sidebar_primary_show' )
	) {
		$content_width = 1110;
	} else {
		$content_width = 719;
	}

}
endif;

if ( ! function_exists( 'wp_community_add_page_excerpt' ) ) :
add_action( 'init', 'wp_community_add_page_excerpt' );
/**
 * Enable post excerpts for pages. This is needed to correctly create pages
 * based on the Landing Page template.
 *
 * @return void
 * @since  1.0
 */
function wp_community_add_page_excerpt() {
	add_post_type_support( 'page', 'excerpt' );
}
endif;
