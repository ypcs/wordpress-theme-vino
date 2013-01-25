<?php
/**
 * The template for displaying content in the single.php template
 *
 * @package WordPress
 * @subpackage ViNO
 * @since ViNO 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'twentyeleven' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'twentyeleven' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', __( ', ', 'twentyeleven' ) );
		?>
		<?php if( !empty( $categories_list ) ) {?>
		<span class="entry-categories">Kategoria(t): <?php echo $categories_list; ?>. </span>	
		<?php } ?>
		<span class="entry-author">Kirjoittaja: <?php if(get_the_author_firstname() && get_the_author_lastname()) echo get_the_author_firstname()." ".get_the_author_lastname().", ";?></span>
		<span class="entry-time"><?php echo esc_html( get_the_date() ); ?></span>
		
		<?php edit_post_link( __( 'Edit', 'twentyeleven' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
