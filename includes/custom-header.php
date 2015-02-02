<?php
/**
 * Implementation of the Custom Header feature.
 *
 * @link http://codex.wordpress.org/Custom_Headers
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

if ( ! function_exists( 'wp_community_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see    wp_community_theme_support()
 *
 * @since  1.0
 */
function wp_community_header_style() {
	// Return early if custom header is not supported.
	if ( ! current_theme_supports( 'custom-header' ) ) {
		return;
	}

	$header_text_color = get_header_textcolor();

	?>
	<style type="text/css">
	<?php if ( get_header_image() ) : ?>
		#main-header {
			background-image: url('<?php header_image(); ?>');
		}
	<?php endif; ?>
	<?php if ( follet_get_current( 'header_background_ignore' ) ) : ?>
		#main-header {
			background-color: transparent;
		}
	<?php else : ?>
		#main-header {
			background-color: <?php echo follet_get_current( 'header_background_color' ); ?>;
		}
	<?php endif; ?>
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		.site-title,
		.site-description {
			display: none;
		}
			<?php if (   follet_get_current( 'header_logo_customize' )
				     and follet_get_current( 'header_logo_show' )
				     and follet_get_current( 'header_logo_img' ) ) : ?>
				.site-title.site-logo {
					display: block;
				}
			<?php endif; ?>
			clip: rect(1px, 1px, 1px, 1px);
		<?php elseif ( HEADER_TEXTCOLOR != $header_text_color ) : // If the user has set a custom color for the text use that. ?>
			.site-branding .site-title a,
			.site-branding .site-description {
				color: #<?php echo $header_text_color; ?>;
			}
		<?php endif; ?>
	</style>
	<?php
}
endif;

if ( ! function_exists( 'wp_community_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see   wp_community_theme_support()
 *
 * @since 1.0
 */
function wp_community_admin_header_style() {
	?>

	<?php if ( follet_get_current( 'load_main_style' ) ) : ?>
		<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
	<?php endif; ?>
	<link rel="stylesheet" href="<?php echo follet_template_directory_uri() . '/styles/fonts.css'; ?>">
	<style>
		body {
			background-color: transparent;
		}
		#main-header h1 {
			margin-bottom: 0;
		}
	</style>

	<?php

}
endif;

if ( ! function_exists( 'wp_community_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see   wp_community_theme_support()
 *
 * @since 1.0
 */
function wp_community_admin_header_image() {

	$style = sprintf( ' style="color:#%s;"', get_header_textcolor() );

	$color = follet_get_current( 'header_background_ignore' )
		   ? 'transparent' : follet_get_current( 'header_background_color' );

	$image = get_header_image()
	       ? ' background-image: url(' . get_header_image() . ')' : '';

	?>
	<header id="main-header" class="site-header" role="banner" style="background-color: <?php echo $color ; ?>;<?php echo $image; ?>">

		<div class="site-branding <?php follet_container_class( 'site-branding' ); ?>">
			<?php

			if (    follet_get_current( 'header_logo_show' )
				and $header_logo_img = follet_get_current( 'header_logo_img' ) ) : ?>

				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php echo $header_logo_img; ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>">
					</a>
				</h1>

			<?php else : ?>

				<?php if ( follet_get_current( 'header_show_title' ) ) : ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" <?php echo $style; ?>><?php bloginfo( 'name' ); ?></a>
					</h1>
				<?php endif; ?>

				<?php if ( follet_get_current( 'header_show_tagline' ) ) : ?>
					<h2 class="site-description" <?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
				<?php endif; ?>

			<?php endif; ?>

		</div>

	</header>

	<?php
}
endif;
