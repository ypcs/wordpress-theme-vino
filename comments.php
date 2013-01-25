<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentyeleven_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage ViNO
 * @since ViNO 1.0
 */
?>

<div id="comments">
	<?php if ( post_password_required() ) : ?>
		<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'twentyten' ); ?></p>
		</div>
		<?php return; ?>
	<?php endif; ?>

	<?php if ( comments_open() ) : ?>
		<div class="fb-comments" data-href="<?php the_permalink(); ?>" data-num-posts="10" style="width: 100%;"></div>
	<?php endif; ?>

	<?php if ( ! comments_open() ) : ?>
		<?php /* ?><p><?php _e( 'Comments are closed.', 'twentyten' ); ?></p> */ ?>
	<?php endif; ?>
</div>
