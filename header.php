<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage ViNO
 * @since ViNO 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<meta name="author" content="<?php bloginfo('name'); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="keywords" content="<?php echo get_option('keywords'); ?>" />
<meta property="og:image" content="http://www.vino.fi/ronsy/wp-content/themes/ronsy/images/ronsy-logo.png"/>
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'twentyeleven' ), max( $paged, $page ) );

	?></title>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/jquery-1.8.0.min.js"></script>
<script type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/siteactions.js"></script>
<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700' rel='stylesheet' type='text/css'>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->
<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div id="fb-root"></div>
<script>
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/fi_FI/all.js#xfbml=1&appId=273129302797162";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div id="top-row">
	<div id="top-row-content">
		
		<div id="in-other-languages">
			<a href="<?php echo esc_url( get_site_url(1) );?>/in-english">in english</a>
			<span> | </span>
			<a href="<?php echo esc_url( get_site_url(1) );?>/pa-svenska">på svenska</a>
		</div>
		
		<div id="top-row-menu">
		<?php wp_nav_menu( array(
				'theme_location' => 'top',
				'items_wrap' => '<div id="%1$s" class="%2$s">%3$s</div>',
				'before' => '<span> | </span>',
				'walker' => new Custom_walker_for_toprow()
				) ); ?>
		</div>
		
		<div style="clear: both"></div>
	</div>
</div>
<div id="page" class="hfeed">
<div id="page-inner">
	<header id="branding" role="banner">
			<div id="title">
				<a id="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_template_directory_uri();?>/images/ronsy-logo.png" alt="<?php echo get_bloginfo('blogname');?>" /></a>
				
				<a id="back-to-vino" href="<?php echo esc_url( get_site_url(1) );?>" title="Takaisin ViNOn sivuille"><span>Takaisin ViNOn sivuille</span></a>
				
				<div style="clear: both"></div>
			</div>
			
			<div class="horizontal-divider"></div>
			
			<nav id="access" role="navigation">
				<h3 class="assistive-text"><?php _e( 'Main menu', 'twentyeleven' ); ?></h3>
				<?php /* Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff. */ ?>
				<div class="skip-link"><a class="assistive-text" href="#content" title="<?php esc_attr_e( 'Skip to primary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to primary content', 'twentyeleven' ); ?></a></div>
				<div class="skip-link"><a class="assistive-text" href="#secondary" title="<?php esc_attr_e( 'Skip to secondary content', 'twentyeleven' ); ?>"><?php _e( 'Skip to secondary content', 'twentyeleven' ); ?></a></div>
				<a id="home-button" href="<?php echo esc_url( get_site_url(1) );?>" title="Vihreiden nuorten ja opiskelijoiden liitto"></a>
				<?php /* Our navigation menu. If one isn't filled out, wp_nav_menu falls back to wp_page_menu. The menu assigned to the primary location is the one used. If one isn't assigned, the menu with the lowest ID is used. */ ?>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_id' => 'menu-main' ) ); ?>
				<?php /* Navigation menu for mobile devices */?>
				<?php wp_nav_menu( array( 
						'theme_location' => 'primary',
						'container_id' => 'menu-select',
						'items_wrap' => '<select id="%1$s" class="%2$s">%3$s</select>',
						'walker' => new Custom_walker_for_responsive()
						) ); ?>
				<div style="clear: both"></div>
			</nav><!-- #access -->
			
				
			
			<div class="horizontal-divider"></div>
			
			<div id="banner-holder">
				<div id="banner">
					<?php
						// Check to see if the header image has been removed
						$header_image = get_header_image();
						if ( $header_image ) :
							// Compatibility with versions of WordPress prior to 3.4.
							if ( function_exists( 'get_custom_header' ) ) {
								// We need to figure out what the minimum width should be for our featured image.
								// This result would be the suggested width if the theme were to implement flexible widths.
								$header_image_width = get_theme_support( 'custom-header', 'width' );
							} else {
								$header_image_width = HEADER_IMAGE_WIDTH;
							}
							?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<?php
							// The header image
							// Check if this is a post or page, if it has a thumbnail, and if it's a big one
							if ( is_singular() && has_post_thumbnail( $post->ID ) &&
									( /* $src, $width, $height */ $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), array( $header_image_width, $header_image_width ) ) ) &&
									$image[1] >= $header_image_width ) :
								// Houston, we have a new header image!
								echo get_the_post_thumbnail( $post->ID, 'post-thumbnail' );
							else :
								// Compatibility with versions of WordPress prior to 3.4.
								if ( function_exists( 'get_custom_header' ) ) {
									$header_image_width  = get_custom_header()->width;
									$header_image_height = get_custom_header()->height;
								} else {
									$header_image_width  = HEADER_IMAGE_WIDTH;
									$header_image_height = HEADER_IMAGE_HEIGHT;
								}
								?>
							<img src="<?php header_image(); ?>" width="<?php echo $header_image_width; ?>" height="<?php echo $header_image_height; ?>" alt="" />
						<?php endif; // end check for featured image or standard header ?>
					</a>
					<?php endif; // end check for removed header image ?>
				
				</div>
				<?php get_sidebar( 'banner' );?>
			</div>
						
			<div class="horizontal-divider" id="divider-below-banner"></div>
			
	</header><!-- #branding -->


	<div id="main">
