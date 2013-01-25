<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage ViNO
 * @since ViNO 1.0
 */
?>
	<div style="clear: both"></div>
	</div><!-- #main -->

	<div class="horizontal-divider" id="divider-above-footer"></div>
	
	<footer id="colophon" role="contentinfo">

			<?php get_sidebar( 'footer' ); ?>

			<div id="site-generator">
				<span id="copyright">Copyright &copy; <?php echo date('Y'); ?> <?php echo get_bloginfo( 'blogname' ); ?></span>
				<span id="made-by"><a href="http://www.kallo.fi" target="_blank">Sivuston toteutus</a>: <a href="http://www.kallo.fi" target="_blank">Kallo Works</a></span>
				<div style="clear: both;"></div>
			</div>
	</footer><!-- #colophon -->
	<div class="horizontal-divider" id="divider-below-footer"></div>
</div><!-- #page-inner -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>