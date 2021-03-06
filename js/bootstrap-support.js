/**
 * Support for Bootstrap.
 *
 * @package WP_Community_Theme
 * @since   1.0
 */
jQuery( document ).ready( function( $ ) {

	$( 'table' ).addClass( 'table' );
	$( 'input[type="button"], input[type="submit"], button' ).addClass( 'btn' );
	$( '.pushbutton-wide' ).addClass( 'btn-primary' ).addClass( 'btn-lg' );
	$( '#subscribe-submit .btn' ).addClass( 'btn-primary' ).addClass( 'btn-sm' );
	$( 'input[type="text"], input[type="password"], input[type="email"], select, textarea' ).addClass( 'form-control' );
	$( '#primary select, #secondary select, #footer select' ).addClass( 'form-control' );
    $( '.user-submit').addClass( 'btn-secondary' );

});
