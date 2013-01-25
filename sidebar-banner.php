<?php
/**
 * The Sidebar containing the main widget area.
 *
 * @package WordPress
 * @subpackage ViNO
 * @since ViNO 1.0
 */

if (   ! is_active_sidebar( 'sidebar-2'  )	) return;

?>
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<div id="banner-sidebar" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-2' );?>
		</div><!-- #secondary .widget-area -->
	<?php endif; ?>