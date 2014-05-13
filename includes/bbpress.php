<?php
/**
 * Custom functions related to bbPress
 *
 * @package wp-community
 */
add_action( 'bbp_template_notices', 'wp_community_notice_edit_user_is_super_admin', 2 );
remove_filter( 'bbp_template_notices', 'bbp_notice_edit_user_is_super_admin', 2 );
function wp_community_notice_edit_user_is_super_admin() {
	if ( is_multisite() && ( bbp_is_single_user() || bbp_is_single_user_edit() ) && current_user_can( 'manage_network_options' ) && is_super_admin( bbp_get_displayed_user_id() ) ) : ?>
		<div class="bbp-template-notice important bg-info">
			<p><?php bbp_is_user_home() || bbp_is_user_home_edit() ? esc_html_e( 'You have super admin privileges.', 'bbpress' ) : esc_html_e( 'This user has super admin privileges.', 'bbpress' ); ?></p>
		</div>
	<?php endif;
}

add_action( 'bbp_template_notices', 'wp_community_notice_edit_user_success', 2 );
remove_filter( 'bbp_template_notices', 'bbp_notice_edit_user_success' );
function wp_community_notice_edit_user_success() {
	if ( isset( $_GET['updated'] ) && ( bbp_is_single_user() || bbp_is_single_user_edit() ) ) : ?>

		<div class="bbp-template-notice updated bg-success">
			<p><?php esc_html_e( 'User updated.', 'bbpress' ); ?></p>
		</div>

	<?php endif;
}
