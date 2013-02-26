<?php
/**
 * Twenty Eleven functions and definitions
 *
 * Sets up the theme and provides some helper functions. Some helper functions
 * are used in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * The first function, twentyeleven_setup(), sets up the theme by registering support
 * for various features in WordPress, such as post thumbnails, navigation menus, and the like.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook. The hook can be removed by using remove_action() or
 * remove_filter() and you can attach your own function to the hook.
 *
 * We can remove the parent theme's hook only after it is attached, which means we need to
 * wait until setting up the child theme:
 *
 * <code>
 * add_action( 'after_setup_theme', 'my_child_theme_setup' );
 * function my_child_theme_setup() {
 *     // We are providing our own filter for excerpt_length (or using the unfiltered value)
 *     remove_filter( 'excerpt_length', 'twentyeleven_excerpt_length' );
 *     ...
 * }
 * </code>
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage ViNO
 * @since ViNO 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 635;

/**
 * Tell WordPress to run twentyeleven_setup() when the 'after_setup_theme' hook is run.
 */
add_action( 'after_setup_theme', 'twentyeleven_setup' );

if ( ! function_exists( 'twentyeleven_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override twentyeleven_setup() in a child theme, add your own twentyeleven_setup to your child theme's
 * functions.php file.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To style the visual editor.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links, custom headers
 * 	and backgrounds, and post formats.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_setup() {

	/* Make Twenty Eleven available for translation.
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on Twenty Eleven, use a find and replace
	 * to change 'twentyeleven' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'twentyeleven', get_template_directory() . '/languages' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

	// Grab Twenty Eleven's Ephemera widget.
	require( get_template_directory() . '/inc/widgets.php' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// Registering navigation menus
	register_nav_menu( 'primary', __( 'Primary Menu', 'twentyeleven' ) );
	register_nav_menu( 'top', __( 'Yläpalkin valikko', 'twentyeleven') );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image' ) );

	// This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	add_theme_support( 'post-thumbnails' );

	// Add support for custom headers.
	$custom_header_support = array(
		// The default header text color.
		'default-text-color' => '000',
		// The height and width of our custom header.
		'width' => apply_filters( 'twentyeleven_header_image_width', 950 ),
		'height' => apply_filters( 'twentyeleven_header_image_height', 230 ),
		// Support flexible heights.
		'flex-height' => true,
		// Random image rotation by default.
		'random-default' => true,
		// Callback for styling the header.
		'wp-head-callback' => 'twentyeleven_header_style',
		// Callback for styling the header preview in the admin.
		'admin-head-callback' => 'twentyeleven_admin_header_style',
		// Callback used to display the header preview in the admin.
		'admin-preview-callback' => 'twentyeleven_admin_header_image',
	);
	
	add_theme_support( 'custom-header', $custom_header_support );

	if ( ! function_exists( 'get_custom_header' ) ) {
		// This is all for compatibility with versions of WordPress prior to 3.4.
		//define( 'HEADER_TEXTCOLOR', $custom_header_support['default-text-color'] );
		define( 'NO_HEADER_TEXT', true);
		define( 'HEADER_IMAGE', '' );
		define( 'HEADER_IMAGE_WIDTH', $custom_header_support['width'] );
		define( 'HEADER_IMAGE_HEIGHT', $custom_header_support['height'] );
		add_custom_image_header( $custom_header_support['wp-head-callback'], $custom_header_support['admin-preview-callback'] );
		add_custom_background();
	}

	// We'll be using post thumbnails for custom header images on posts and pages.
	// We want them to be the size of the header image that we just defined
	// Larger images will be auto-cropped to fit, smaller ones will be ignored. See header.php.
	set_post_thumbnail_size( $custom_header_support['width'], $custom_header_support['height'], true );

	// Add Twenty Eleven's custom image sizes.
	// Used for large feature (header) images.
	add_image_size( 'large-feature', $custom_header_support['width'], $custom_header_support['height'], true );
	// Used for featured posts if a large-feature doesn't exist.
	add_image_size( 'small-feature', 500, 300 );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'default_banner' => array(
			'url' => '%s/images/headers/banner.jpg',
			'thumbnail_url' => '%s/images/headers/banner-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Oletusbanneri', 'twentyeleven' )
		),
		'default_banner02' => array(
			'url' => '%s/images/headers/banner02.jpg',
			'thumbnail_url' => '%s/images/headers/banner02-thumbnail.jpg',
			/* translators: header image description */
			'description' => __( 'Oletusbanneri 2', 'twentyeleven' )
		)
	) );
}
endif; // twentyeleven_setup

if ( ! function_exists( 'twentyeleven_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail.
	if ( $text_color == HEADER_TEXTCOLOR )
		return;
		
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $text_color ) :
	?>
		#site-title,
		#site-description {
			position: absolute !important;
			clip: rect(1px 1px 1px 1px); /* IE6, IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		#site-title a,
		#site-description {
			color: #<?php echo $text_color; ?> !important;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // twentyeleven_header_style


if ( ! function_exists( 'twentyeleven_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 * Create your own twentyeleven_posted_on to override in a child theme
 *
 * @since Twenty Eleven 1.0
 */
function twentyeleven_posted_on() {
	/*printf( __( '<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s" pubdate>%4$s</time></a><span class="by-author"> <span class="sep"> by </span> <span class="author vcard"><a class="url fn n" href="%5$s" rel="author">%6$s</a></span></span>', 'twentyeleven' ),
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		get_the_author()
	);*/
	$time = esc_attr( get_the_time() );
	$date = esc_attr( get_the_date( 'c' ) );
	$date_html = esc_html( get_the_date() );
	$author = get_the_author();
	?>
	<time class="entry-date" datetime="<?php echo $date; ?>" pubdate><?php echo $date_html; ?></time>
	<span class="by-author"><?php echo $author; ?></span>
	<?php 
}
endif;


/**
 * Custom contact info
 *
 * @author Jesse Kuoppala / Kallo Works
 * @since 1.0
 */

add_action('admin_menu','add_global_custom_options');

function add_global_custom_options() {
	add_options_page('Yhteystiedot', 'Yhteystiedot', 'manage_options', 'functions','global_custom_options');
}


function global_custom_options()
{
	?>
<div class="wrap">
<form method="post" action="options.php">
<h2>Yhteystiedot</h2>
<?php wp_nonce_field('update-options') ?>
			
<table>
	<tr>
		<td valign="top" style="padding-right: 25px;">
			<h2>Toimisto</h2>
			<p><strong>Katuosoite:</strong><br />
			<input type="text" name="streetaddress" size="45" value="<?php echo get_option('streetaddress'); ?>" />
			</p>
			<p><strong>Postinumero:</strong><br />
			<input type="text" name="zipcode" size="45" value="<?php echo get_option('zipcode'); ?>" />
			</p>
			<p><strong>Kaupunki:</strong><br />
			<input type="text" name="city" size="45" value="<?php echo get_option('city'); ?>" />
			</p>
			<p><strong>Sähköposti:</strong><br />
			<input type="text" name="email" size="45" value="<?php echo get_option('email'); ?>" />
			</p>
			
			<h2>Pääsihteeri</h2>
			<p><strong>Nimi:</strong><br />
			<input type="text" name="psnimi" size="45" value="<?php echo get_option('psnimi'); ?>" />
			</p>
			<p><strong>Puhelin:</strong><br />
			<input type="text" name="pspuhelin" size="45" value="<?php echo get_option('pspuhelin'); ?>" />
			</p>
			<p><strong>Sähköposti:</strong><br />
			<input type="text" name="psemail" size="45" value="<?php echo get_option('psemail'); ?>" />
			</p>	
		</td>
		<td valign="top" style="padding-right: 25px;">
			<h2>Puheenjohtajat</h2>
			
			<h4>Puheenjohtaja 1</h4>
			<p><strong>Nimi:</strong><br />
			<input type="text" name="pjnimi1" size="45" value="<?php echo get_option('pjnimi1'); ?>" />
			</p>
			<p><strong>Puhelin:</strong><br />
			<input type="text" name="pjpuhelin1" size="45" value="<?php echo get_option('pjpuhelin1'); ?>" />
			</p>
			<p><strong>Sähköposti:</strong><br />
			<input type="text" name="pjemail1" size="45" value="<?php echo get_option('pjemail1'); ?>" />
			</p>
			
			<h4>Puheenjohtaja 2</h4>
			<p><strong>Nimi:</strong><br />
			<input type="text" name="pjnimi2" size="45" value="<?php echo get_option('pjnimi2'); ?>" />
			</p>
			<p><strong>Puhelin:</strong><br />
			<input type="text" name="pjpuhelin2" size="45" value="<?php echo get_option('pjpuhelin2'); ?>" />
			</p>
			<p><strong>Sähköposti:</strong><br />
			<input type="text" name="pjemail2" size="45" value="<?php echo get_option('pjemail2'); ?>" />
			</p>
		</td>
		<td valign="top">
			<h2>Avainsanat</h2>
			<p>Avainsanat auttavat hakukoneita ja ihmisiä löytämään sivustonne.<p>
			<p>Listatkaa avainsanat pilkulla erotettuna. (esim. vino,vihreät,politiikka)</p>
			<p>Huom! Avainsanan ei tarvitse olla yksittäinen sana. (esim. "vihreiden nuorten ja opiskelijoiden liitto" voi olla myös yksi avainsana)
			<p><strong>Avainsanat:</strong><br />
			<input type="text" name="keywords" size="45" value="<?php echo get_option('keywords'); ?>" />
			</p>
		</td>
	</tr>
</table>

<p><input type="submit" name="Submit" value="Tallenna" /></p>
<input type="hidden" name="action" value="update" />
<input type="hidden" name="page_options" value="streetaddress,zipcode,city,email,pjnimi1,pjpuhelin1,pjemail1,pjnimi2,pjpuhelin2,pjemail2,psnimi,pspuhelin,psemail,keywords" />

</form>
</div>
<?php
}

/**
 * Custom Walker for Top Menu
 * 
 * @author Jesse Kuoppala / Kallo Works
 * @since 1.0
 */
class Custom_walker_for_toprow extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
	}

	function end_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
	}

	function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr( $class_names ) . '"';

		$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
		$id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output .= '<span' . $id . $value .$class_names .'>';
		$item_output .= $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;
		$item_output .= '</span>';

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	/**
	 * @see Walker::end_el()
	 * @since 3.0.0
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item Page data object. Not used.
	 * @param int $depth Depth of page. Not Used.
	 */
	function end_el(&$output, $item, $depth) {}
}

/**
 * Method to find mark first and last items in menu for easier styling
 * 
 * @author Jesse Kuoppala / Kallo Works
 *   
 */
function nav_menu_classes( $items ) {
	$pos = strrpos($items, 'class="menu-item', -1);
	$items=substr_replace($items, 'menu-item-last ', $pos+7, 0);

	$pos = strpos($items, 'class="menu-item');
	$items=substr_replace($items, 'menu-item-first ', $pos+7, 0);

	return $items;
}
add_filter( 'wp_nav_menu_items', 'nav_menu_classes' );

/**
 * Walker for responsive layout dropdown menu
 * 
 * @author Jesse Kuoppala / Kallo Works
 *
 */
class Custom_walker_for_responsive extends Walker_Nav_Menu{
	function start_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth);
	}

	function end_lvl(&$output, $depth){
		$indent = str_repeat("\t", $depth);
	}

	function start_el(&$output, $item, $depth, $args){
		$item->title = str_repeat("&nbsp;", $depth * 4).$item->title;
		parent::start_el(&$output, $item, $depth, $args);
		$value .= ! empty( $item->url )        ? ' value="'   . esc_attr( $item->url        ) .'"' : '';
		$output = str_replace('<li', '<option '.$value, $output);
	}

	function end_el(&$output, $item, $depth){
		$output .= "</option>\n";
	}
}

/**
 *  Hide unnecessary pages from admin menu
 *  
 */
add_action( 'admin_menu',  'remove_unnecessary_menus', 999);

function remove_unnecessary_menus() {
	remove_menu_page( 'edit-comments.php' );
}

function vino_styles() {
	wp_enqueue_style('google-webfonts', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,200italic,300italic,400italic,600italic,700italic,900italic|Yanone+Kaffeesatz:400,700', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'vino_styles');

function vino_scripts() {
	wp_enqueue_script('siteactions', plugins_url('/js/siteactions.js', __FILE__), array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'vino_scripts');