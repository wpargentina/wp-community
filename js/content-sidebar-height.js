/**
 * Support for content and sidebar height.
 *
 * @package WP_Community_Theme
 * @since   1.0
 */
jQuery( document ).ready( function( $ ) {
	$( '#primary' ).css( 'min-height', $( '#secondary' ).outerHeight() );
});
