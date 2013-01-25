<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage ViNO
 * @since ViNO 1.0
 */

get_header(); ?>

	<div id="primary">
		<div id="content" role="main">

			<article id="post-0" class="post error404 not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'twentyeleven' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching, or one of the links below, can help.', 'twentyeleven' ); ?></p>

					<?php get_search_form(); ?>

					<?php the_widget( 'WP_Widget_Recent_Posts', array( 'number' => 10 ), array( 'widget_id' => '404' ) ); ?>

					<div class="widget">
						<h2 class="widgettitle"><?php _e( 'Most Used Categories', 'twentyeleven' ); ?></h2>
						<ul>
						<?php wp_list_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10 ) ); ?>
						</ul>
					</div>

					<?php
					/* translators: %1$s: smilie */
					$archive_content = '<p>' . sprintf( __( 'Try looking in the monthly archives. %1$s', 'twentyeleven' ), convert_smilies( ':)' ) ) . '</p>';
					the_widget( 'WP_Widget_Archives', array('count' => 0 , 'dropdown' => 1 ), array( 'after_title' => '</h2>'.$archive_content ) );
					?>

					<?php the_widget( 'WP_Widget_Tag_Cloud' ); ?>

				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->
	</div><!-- #primary -->

	<div class="horizontal-divider" id="divider-below-primary"></div>
		
	<div class="vertical-divider right-divider"></div>
	
	<div id="right-col">
		
	<?php get_sidebar( 'facebook' ); ?>

	<div class="whitebox">
		<header>Yhteystiedot</header>
		<div>
			<strong>Vihreiden nuorten ja <br />opiskelijoiden liiton toimisto</strong><br />
			<?php echo get_option( 'streetaddress' ); ?>, <?php echo get_option( 'zipcode' ); ?> <?php echo get_option( 'city' ); ?><br />
			<?php echo get_option( 'email' ); ?><br />
			<hr />
			<strong>Puheenjohtajat</strong><br />
			<?php echo get_option( 'pjnimi1' ); ?><br />
			<?php echo get_option( 'pjpuhelin1' ); ?>, <?php echo get_option( 'pjemail1' ); ?><br />
			<?php echo get_option( 'pjnimi2' ); ?><br />
			<?php echo get_option( 'pjpuhelin2' ); ?>, <?php echo get_option( 'pjemail2' ); ?><br />
			<hr />
			<strong>Pääsihteeri</strong>
			<?php echo get_option( 'psnimi' ); ?><br />
			<?php echo get_option( 'pspuhelin' ); ?>, <?php echo get_option( 'psemail' ); ?><br />
		</div>
	</div>
	
	</div>
	
<?php get_footer(); ?>