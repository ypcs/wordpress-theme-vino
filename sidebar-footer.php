<?php
/**
 * The Footer widget areas.
 *
 * @package WordPress
 * @subpackage ViNO
 * @since ViNO 1.0
 */
?>

<?php
	/* The footer widget area is triggered if any of the areas
	 * have widgets. So let's check that first.
	 *
	 * If none of the sidebars have widgets, then let's bail early.
	 */
	if (   ! is_active_sidebar( 'sidebar-3'  )	) return;
	// If we get this far, we have widgets. Let do this.
?>
<div id="supplementary" <?php twentyeleven_footer_sidebar_class(); ?>>
	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
	<div id="footer-sidebar" class="widget-area" role="complementary">
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	</div><!-- #first .widget-area -->
	<?php endif; ?>
</div><!-- #supplementary -->