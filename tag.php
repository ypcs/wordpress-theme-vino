<?php
/**
 * The template used to display Tag Archive pages
 *
 * @package WordPress
 * @subpackage ViNO
 * @since ViNO 1.0
 */

get_header(); ?>

		<section id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<header class="page-header green-header">
					<h1 class="page-title"><?php
						printf( __( 'Tag Archives: %s', 'twentyeleven' ), '<span>' . single_tag_title( '', false ) . '</span>' );
					?></h1>

					<?php
						$tag_description = tag_description();
						if ( ! empty( $tag_description ) )
							echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
					?>
				</header>

				<?php twentyeleven_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php twentyeleven_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<article id="post-0" class="post no-results not-found">
					<header class="entry-header">
						<h1 class="entry-title"><?php _e( 'Nothing Found', 'twentyeleven' ); ?></h1>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'twentyeleven' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</article><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</section><!-- #primary -->

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
