<?php

/**
 * Replies Loop - Single Reply
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<div id="post-<?php bbp_reply_id(); ?>" class="bbp-reply">

	<div <?php bbp_reply_class(); ?>>

		<div class="bbp-reply-author">

			<?php do_action( 'bbp_theme_before_reply_author_details' ); ?>

			<?php bbp_reply_author_link( array( 'sep' => '<br />', 'size' => '50' ) ); ?>

			<?php do_action( 'bbp_theme_after_reply_author_details' ); ?>

		</div><!-- .bbp-reply-author -->

		<div class="bbp-reply-content">

			<div class="bbp-reply-header">

				<div class="bbp-meta">

					<span class="bbp-reply-author-name">

						<a href="<?php bbp_reply_author_url(); ?>"><?php echo get_the_author_meta( 'display_name' ); ?></a>

						<?php if ( bbp_is_user_keymaster() ) : ?>

							<?php do_action( 'bbp_theme_before_reply_author_admin_details' ); ?>

							<span class="bbp-reply-ip"><?php bbp_author_ip( bbp_get_reply_id() ); ?></span>

							<?php do_action( 'bbp_theme_after_reply_author_admin_details' ); ?>

						<?php endif; ?>

					</span>

					<span class="bbp-reply-post-date">
						@
						<a href="<?php bbp_reply_url(); ?>" class="bbp-reply-permalink">
							<?php bbp_reply_post_date(); ?>
						</a>
					</span>

					<?php if ( bbp_is_single_user_replies() ) : ?>

					<span class="bbp-header">
						<?php _e( 'in reply to: ', 'bbpress' ); ?>
						<a class="bbp-topic-permalink" href="<?php bbp_topic_permalink( bbp_get_reply_topic_id() ); ?>"><?php bbp_topic_title( bbp_get_reply_topic_id() ); ?></a>
					</span>

					<?php endif; ?>

				</div><!-- .bbp-meta -->

			</div><!-- #post-<?php bbp_reply_id(); ?> -->

			<?php do_action( 'bbp_theme_before_reply_content' ); ?>

			<?php bbp_reply_content(); ?>

			<?php do_action( 'bbp_theme_after_reply_content' ); ?>

		</div><!-- .bbp-reply-content -->

		<div class="bbp-reply-footer">

			<?php do_action( 'bbp_theme_before_reply_admin_links' ); ?>

			<?php
				bbp_reply_admin_links( array(
					'sep' => '',
				) );
			?>

			<?php do_action( 'bbp_theme_after_reply_admin_links' ); ?>

		</div>

	</div>

</div><!-- .reply -->
