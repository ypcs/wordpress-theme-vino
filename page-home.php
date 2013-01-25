<?php
/**
 * The home template file.
 * 
 * Template Name: Etusivun sivupohja
 * Description: Sivupohja etusivulle.
 *
 * @author Jesse Kuoppala / Kallo Works
 * 
 */

get_header(); ?>

		<div class="vertical-divider left-divider"></div>

		<div id="primary" class="home">
			<header>Poliittiset tiedotteet</header>
			<div id="content" role="main" class="homepage">
			<?php query_posts( array(
						'posts_per_page' => 3,
						'orderby'		 => 'post_date'
					));?>
			<?php if ( have_posts() ) : ?>
				<?php
					global $more;
					$more = 0;
				?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', get_post_format() ); ?>

				<?php endwhile; ?>
				<a href="<?php echo get_permalink(get_option( 'page_for_posts' ) ); ?>" class="bullet">Lue aikaisempia tiedotteita</a>

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
			
		</div><!-- #primary -->
	
		<div class="horizontal-divider" id="divider-below-primary"></div>
		
		<div class="vertical-divider right-divider"></div>

		<div id="left-col">
			
			<?php get_sidebar( 'mainleft' ); ?>
			
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
		
		<div id="right-col">
			<div class="whitebox custom-links">
				<header>Blogeja</header>
				<div>
					<?php $links = get_linkobjects(0, '_id', 3);?>
					<?php foreach($links as $link) { 
								if ($link->link_image) { ?>
									<a target="_blank" class="link-image-wrapper" href="<?php echo $link->link_url; ?>"><span><img src="<?php echo $link->link_image; ?>" alt="<?php echo $link->link_description; ?>"></span></a>
								<?php } else { ?>
									<a target="_blank" class="link-image-wrapper noimage" href="<?php echo $link->link_url; ?>"><span><img src="http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=68" alt="<?php echo $link->link_description; ?>"></span></a>
								<?php  }
								if ($link->link_name) { ?>
									<a class="link-title" href="<?php echo $link->link_url; ?>" target="_blank"><?php echo $link->link_name; ?></a>
									<br />
									<span class="link-desc"><?php echo $link->link_description; ?></span>
								<?php } ?>
								<hr />
					<?php } ?>
					<div style="clear: both"></div>
				</div>
			</div>
				
			<?php get_sidebar( 'facebook' ); ?>
			
		</div>

<?php get_footer(); ?>