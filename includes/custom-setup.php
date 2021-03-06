<?php
/**
 * Theme setup. All the functions included here are pluggable.
 *
 * @package WP_Community_Theme
 * @since   1.0
 */

/**
 * Add a hook for custom actions before loading this file.
 */
do_action( 'wp_community_before_actions' );

if ( ! function_exists( 'wp_community_register_options' ) ) :
/**
 * Register options for this theme through Follet Core.
 *
 * @return void
 * @since  1.0
 */
function wp_community_register_options() {

	do_action( 'wp_community_options_register' );

	$options = array(
		'top_navigation_show'              => true,
		'top_navigation_fix_top'           => false,
		'top_navigation_searchform_show'   => false,
		'top_navigation_style'             => 'navbar-default',
		'social_navigation_show'           => true,
		'header_logo_customize'            => false,
		'header_logo_show'                 => false,
		'header_logo_img'                  => '',
		'header_show_title'                => true,
		'header_show_tagline'              => true,
		'primary_color'                    => '#57AAD2',
		'secondary_color'                  => '#d54e21',
		'header_background_color'          => '#57AAD2',
		'header_background_ignore'         => false,
		'primary_sidebar_background_color' => '#FFFFFF',
		'show_footer_in_summary'           => true,
		'footer_show'                      => true,
		'footer_credits_show'              => true,
		'sidebar_primary_show'             => true,
		'sidebar_footer_1_show'            => true,
		'sidebar_footer_2_show'            => true,
		'sidebar_footer_3_show'            => true,
		'load_main_style'                  => true,
		'skip_link_focus'                  => true,
		'post_avatar_show'                 => false,
		'post_author_info_show'            => false,
		'breadcrumbs_show'                 => false,
		'contact_methods_show'             => false,
		'responsive_videos'                => true,
		'contact_methods'                  => array(
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
	);
	foreach ( $options as $name => $default ) {
		if ( ! follet_option_exists( $name ) ) {
			follet_register_option(
				$name,
				$default,
				get_theme_mod( $name, $default )
			);
		}
	}

	do_action( 'wp_community_options_registered' );

}
endif;
add_action( 'wp_community_setup', 'wp_community_register_options' );

if ( ! function_exists( 'wp_community_register_menus' ) ) :
/**
 * Register navigation menus.
 *
 * @return void
 * @since  1.0
 */
function wp_community_register_menus() {
	register_nav_menu(
		'top-menu',
		__( 'Top menu', 'wp_argentina' )
	);
	register_nav_menu(
		'social-menu',
		__( 'Social menu', 'wp_argentina' )
	);
}
endif;
add_action( 'init', 'wp_community_register_menus' );

if ( ! function_exists( 'wp_community_custom_main_style_dependencies' ) ) :
/**
 * Add Dashicons as a dependency for the main style.
 *
 * @param  array $dependencies Current list of dependencies.
 * @return array               Filtered list of dependencies.
 */
function wp_community_custom_main_style_dependencies( $dependencies ) {
	$dependencies[] = 'dashicons';
	return $dependencies;
}
add_filter( 'wp_community_main_style_dependencies', 'wp_community_custom_main_style_dependencies' );
endif;

if ( ! function_exists( 'wp_community_register_sidebars' ) ) :
/**
 * Register sibebars for this theme.
 *
 * @return void
 * @since  1.0
 */
function wp_community_register_sidebars() {

	register_sidebar( array(
		'name'          => __( 'Primary Sidebar', 'wp_argentina' ),
		'id'            => 'sidebar-primary',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><hr class="separator" />',
	) );

	// Footer sidebars:

	register_sidebar( array(
		'name'          => __( 'Footer Sidebar #1', 'follet' ),
		'id'            => 'sidebar-footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><hr class="separator" />',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Sidebar #2', 'follet' ),
		'id'            => 'sidebar-footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><hr class="separator" />',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer Sidebar #3', 'follet' ),
		'id'            => 'sidebar-footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4><hr class="separator" />',
	) );

}
endif;
add_action( 'widgets_init', 'wp_community_register_sidebars' );

/**
 * Add styles for post editor.
 *
 * @return void
 * @since  1.0
 */
function wp_community_add_editor_styles() {

	$template_directory_uri = follet_template_directory_uri();

	add_editor_style( $template_directory_uri . '/fonts/genericons/genericons.css' );
	add_editor_style( $template_directory_uri . '/css/fonts.css' );
	add_editor_style( $template_directory_uri . '/css/icons.css' );
	add_editor_style( $template_directory_uri . '/css/general-colors.css' );
	add_editor_style( $template_directory_uri . '/css/primary-color.css' );
	add_editor_style( $template_directory_uri . '/css/secondary-color.css' );

}
add_action( 'init', 'wp_community_add_editor_styles' );

if ( ! function_exists( 'wp_community_enqueue_scripts' ) ) :
/**
 * Enqueue additional scripts for this theme.
 *
 * @return void
 * @since  1.0
 */
function wp_community_enqueue_scripts() {

	$template_directory_uri = follet_template_directory_uri();

	wp_enqueue_style(
		'genericons',
		$template_directory_uri . '/fonts/genericons/genericons.css',
		false,
		'3.0.3'
	);

	wp_enqueue_style(
		'wp-community-bbpress',
		$template_directory_uri . '/css/bbpress.css',
		false,
		follet()->theme_version
	);

	wp_enqueue_style(
		'wp-community-fonts',
		$template_directory_uri . '/css/fonts.css',
		false,
		follet()->theme_version
	);

	wp_enqueue_style(
		'wp-community-general-colors',
		$template_directory_uri . '/css/general-colors.css',
		false,
		follet()->theme_version
	);

	wp_enqueue_style(
		'wp-community-primary-color',
		$template_directory_uri . '/css/primary-color.css',
		false,
		follet()->theme_version
	);

	wp_enqueue_style(
		'wp-community-secondary-color',
		$template_directory_uri . '/css/secondary-color.css',
		false,
		follet()->theme_version
	);

	wp_enqueue_style(
		'wp-community-primary-sidebar-color',
		$template_directory_uri . '/css/primary-sidebar-color.css',
		false,
		follet()->theme_version
	);

	wp_enqueue_style(
		'wp-community-icons',
		$template_directory_uri . '/css/icons.css',
		false,
		follet()->theme_version
	);

	// Skip Link Focus JS.
	if ( follet_get_current( 'skip_link_focus' ) ) {
		wp_enqueue_script(
			'wp-community-skip-link-focus-fix',
			$template_directory_uri . '/js/min/skip-link-focus-fix.min.js',
			array( 'jquery' ),
			'20130115',
			true
		);
	}

	// Bootstrap support.
	wp_enqueue_script(
		'wp-community-bootstrap-support',
		follet_template_directory_uri(). '/js/min/bootstrap-support.min.js',
		array( 'jquery' ),
		follet()->theme_version,
		true
	);

	wp_enqueue_script(
		'wp-community-content-sidebar-height',
		follet_template_directory_uri(). '/js/min/content-sidebar-height.min.js',
		array( 'jquery' ),
		follet()->theme_version,
		true
	);

	wp_enqueue_script(
		'wp-community-top-navigation-searchform',
		follet_template_directory_uri(). '/js/min/top-navigation-searchform.min.js',
		array( 'jquery' ),
		follet()->theme_version,
		true
	);

	if ( follet_get_current( 'responsive_videos' ) ) {
		wp_enqueue_script(
			'wp-community-resize-videos',
			follet_template_directory_uri(). '/js/min/resize-videos.min.js',
			array( 'jquery' ),
			follet()->theme_version,
			true
		);
	}

}
endif;
add_action( 'wp_enqueue_scripts', 'wp_community_enqueue_scripts' );

if ( ! function_exists( 'wp_community_post_author_section_microdata' ) ) :
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
add_filter( 'wp_community_post_author_section', 'wp_community_post_author_section_microdata' );

if ( ! function_exists( 'wp_community_post_comments_section_microdata' ) ) :
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
add_filter( 'wp_community_post_comments_section', 'wp_community_post_comments_section_microdata' );

if ( ! function_exists( 'wp_community_comments_microdata' ) ) :
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
add_filter( 'wp_community_list_comments', 'wp_community_comments_microdata' );

if ( ! function_exists( 'wp_community_primary_color' ) ) :
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
add_action( 'wp_enqueue_scripts', 'wp_community_primary_color' );

if ( ! function_exists( 'wp_community_secondary_color' ) ) :
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
add_action( 'wp_enqueue_scripts', 'wp_community_secondary_color' );

if ( ! function_exists( 'wp_community_primary_sidebar_background_color' ) ) :
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
add_action( 'wp_enqueue_scripts', 'wp_community_primary_sidebar_background_color' );

if ( ! function_exists( 'wp_community_bootstrap_carousel_control' ) ) :
/**
 * Support for Agnosia Bootstrap Carousel
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
add_filter( 'agnosia_bootstrap_carousel_control', 'wp_community_bootstrap_carousel_control' );

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
add_action( 'after_setup_theme', 'wp_community_content_width' );

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

/**
 * Add a hook for custom actions before loading the next file.
 */
do_action( 'wp_community_after_actions' );
