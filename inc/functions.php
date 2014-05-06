<?php
/**
 * Custom functions for the theme
 *
 *
 * @package wp-community
 */



function wp_community_icons() {
	wp_enqueue_style( 'wp-community-icons', get_stylesheet_uri(), array( 'dashicons' ), '1.0' );
}

add_action( 'wp_enqueue_scripts', 'wp_community_icons' );


if ( ! function_exists( 'wp_community_logo' ) ) {

	function wp_community_logo( $args = array() ) {

		$defaults = apply_filters( 'wp_community_logo_default_args', array(
								'echo'			=> true,
								'link'			=> home_url(),
								'alt'			=> get_bloginfo( 'name' ),
								'title'			=> get_bloginfo( 'name' ),
								'text_title'	=> true,
								'logo'			=> '',
								'logo_retina'	=> '',
								'width'			=> '',
								'height'		=> '',
								'before'		=> '',
								'after'			=> '',
								'before_title'	=> '<h1 class="site-title">',
								'after_title'	=> '</h1>')
				);


		$args = wp_parse_args( $args, $defaults );

		$args = apply_filters( 'wp_community_logo_args', $args );

		do_action( 'wp_community_logo_before', $args );

		$output = '';

		$output .= $args['before'];

		$output .= $args['before_title'];

		if ( apply_filters( 'wp_community_logo_enable_link', true ) ){
			$output .= '<a href="' . $args['link'] . '" title="' . $args['title'] . '">';
		}

		if ( $args['text_title'] ) :

			$output .= '<span class="text-logo">' . $args['title'] . '</span>';

		elseif ( $args['logo'] <> '' ) :

			$output .= '<img id="default-logo" src="' . $args['logo'] . '" alt="' . $args['alt'] . '" />';

			if ( $args['logo_retina'] <> '' ){
				$output .= '<img id="retina-logo" src="' . $args['logo_retina'] . '" alt="' . $args['alt'] . '" />';
			} else {
				$output .= '<img id="retina-logo" src="' . $args['logo'] . '" alt="' . $args['alt'] . '" />';
			}

		else:
			$output .= '<img id="default-logo" src="' . get_stylesheet_directory_uri() . '/images/logo.png" alt="' . $args['alt'] . '" />';
			$output .= '<img id="retina-logo" src="' . get_stylesheet_directory_uri() . '/images/logo@2x.png" alt="' . $args['alt'] . '" />';
		endif;

		if ( apply_filters( 'wp_community_logo_enable_link', true ) ){
			$output .=	'</a>';
		}

		$output .= $args['after_title'];

		$output .= $args['after'];

		$output = apply_filters( 'wp_community_logo_html', $output, $args );

		if ( $args['echo'] == true ) echo $output;
		else return $output;

		do_action( 'wp_community_logo_after', $args );

	}

}

if ( ! function_exists( 'wp_community_fonts' ) ) {

	function wp_community_fonts() { ?>
		<link href='http<?php if ( is_ssl() ) echo 's'; ?>://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
		<link href='http<?php if ( is_ssl() ) echo 's'; ?>://fonts.googleapis.com/css?family=Roboto+Slab' rel='stylesheet' type='text/css'>
	<?php
	}

}

add_action( 'wp_head', 'wp_community_fonts', 15 );