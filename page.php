<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage ViNO
 * @since ViNO 1.0
 */

get_header(); ?>

		<div id="primary">
			<div id="content" role="main">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<div class="fb-like" data-href="<?php the_permalink(); ?>" data-send="true" data-layout="button_count" data-width="500" data-show-faces="false" style="width: 100%;"></div>
										
					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

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