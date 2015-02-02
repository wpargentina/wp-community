<?php
/**
 * Load basic dependencies and bootstrap theme.
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

if ( ! function_exists( 'wp_community_load_follet_core' ) ) :
add_action( 'wp_community_setup', 'wp_community_load_follet_core' );
/**
 * Load Follet Core framework.
 *
 * @since 1.0
 */
function wp_community_load_follet_core() {
	require get_template_directory() . '/includes/follet-core/follet-load.php';
}
endif;

if ( ! function_exists( 'wp_community_load_dependencies' ) ) :
add_action( 'wp_community_setup', 'wp_community_load_dependencies' );
/**
 * Load theme dependencies.
 *
 * @since  1.0
 */
function wp_community_load_dependencies() {
	// Load all files inside `./includes`.
	follet_load_library( get_template_directory() . '/includes/' );
}
endif;

/**
 * Execute setup tasks.
 */
do_action( 'wp_community_setup' );

/**
 * Execute tasks after setup.
 */
do_action( 'wp_community_after_setup' );
