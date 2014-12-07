<?php
/**
 * The default search form for this theme.
 *
 * @package WP_Community_Theme
 * @since   1.0
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	<span class="screen-reader-text"><?php _e( 'Search for:', 'wp_argentina' ); ?></span>
	<input type="search" class="search-field form-control" placeholder="<?php _e( 'Search', 'wp_argentina' ); ?>" value="" name="s" title="<?php _e( 'Search for:', 'wp_argentina' ); ?>" />
</form>
