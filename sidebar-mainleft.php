<?php
/**
 * The Sidebar containing the mainpage left widget area.
 *
 */

if (   ! is_active_sidebar( 'sidebar-1'  )	) return;

?>
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<div id="secondary" class="widget-area" role="complementary">
			<?php dynamic_sidebar( 'sidebar-1' );?>
		</div><!-- #secondary .widget-area -->
	<?php endif; ?>