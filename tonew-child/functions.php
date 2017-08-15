<?php #DD348F
if ( function_exists( 'generate_blog_get_defaults' ) ) :
	if ( !function_exists( 'mantle_new_blog_defaults' ) ) :
		add_filter( 'generate_blog_option_defaults','mantle_new_blog_defaults' );
		function mantle_new_blog_defaults( $new_defaults )
		{
			$new_defaults[ 'excerpt_length' ] = '55';
			$new_defaults[ 'read_more' ] = __('Read more...','generate-blog');
			$new_defaults[ 'masonry' ] = 'false';
			$new_defaults[ 'masonry_width' ] = 'width2';
			$new_defaults[ 'masonry_most_recent_width' ] = 'width4';
			$new_defaults[ 'masonry_load_more' ] = __('+ More','generate-blog');
			$new_defaults[ 'masonry_loading' ] = 'Loading...';
			$new_defaults[ 'post_image' ] = 'true';
			$new_defaults[ 'post_image_position' ] = 'post-image-above-header';
			$new_defaults[ 'post_image_alignment' ] = 'post-image-aligned-center';
			$new_defaults[ 'post_image_width' ] = '';
			$new_defaults[ 'post_image_height' ] = '';
			$new_defaults[ 'date' ] = 'true';
			$new_defaults[ 'author' ] = 'true';
			$new_defaults[ 'categories' ] = 'true';
			$new_defaults[ 'tags' ] = 'true';
			$new_defaults[ 'comments' ] = 'true';
			$new_defaults[ 'column_layout' ] = 0;
			$new_defaults[ 'columns' ] = '50';
			$new_defaults[ 'featured_column' ] = 0;
			
			return $new_defaults;
		}
	endif;
endif;
add_action( 'admin_notices', 'mantle_reset_customizer_settings' );
function mantle_reset_customizer_settings() {
	global $pagenow;
	$generate_settings = get_option('generate_settings');
	
	if ( empty($generate_settings) )
		return;
	
	if ( is_admin() && $pagenow == "themes.php" && isset( $_GET['activated'] ) ) {
		?>
		<div class="updated settings-error notice is-dismissible">
			<p>
				<?php printf( __( '<strong>Almost done!</strong> Previous GeneratePress options detected in your database. Please <a href="%s">click here</a> to delete your current options for Mantle to take full effect.','mantle' ), admin_url('themes.php?page=generate-options#gen-delete') ); ?>
			</p>
		</div>
		<?php
	}
}
/**
 * Remove unnecessary actions
 */
add_action('wp','mantle_setup');
function mantle_setup()
{
	remove_action('generate_after_header','generate_featured_page_header', 10);
	
	if ( !function_exists( 'generate_blog_get_defaults' ) ) :
		remove_action( 'generate_after_entry_header', 'generate_post_image' );
		
		if ( function_exists('generate_page_header') ) :
			remove_action( 'generate_after_entry_header', 'generate_page_header_post_image' );
			add_action( 'generate_before_content', 'generate_page_header_post_image' );
		endif;
	endif;
}
/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'mantle_scripts' );
function mantle_scripts() {

	if ( ! function_exists( 'generate_menu_plus_setup' ) ) :
		wp_enqueue_script( 'stickynav', get_stylesheet_directory_uri() . '/js/scripts.js', array(), GENERATE_VERSION, true );
	endif;
	
}
if ( !function_exists( 'mantle_new_defaults' ) ) :
add_filter( 'generate_option_defaults','mantle_new_defaults' );
function mantle_new_defaults( $new_defaults )
{
	$new_defaults[ 'hide_title' ] = '';
	$new_defaults[ 'hide_tagline' ] = '';
	$new_defaults[ 'logo' ] = '';
	$new_defaults[ 'container_width' ] = '1100';
	$new_defaults[ 'header_layout_setting' ] = 'fluid-header';
	$new_defaults[ 'nav_alignment_setting' ] = 'center';
	$new_defaults[ 'header_alignment_setting' ] = 'center';
	$new_defaults[ 'nav_layout_setting' ] = 'fluid-nav';
	$new_defaults[ 'nav_position_setting' ] = 'nav-above-header';
	$new_defaults[ 'nav_search' ] = 'enable';
	$new_defaults[ 'nav_dropdown_type' ] = 'hover';
	$new_defaults[ 'content_layout_setting' ] = 'separate-containers';
	$new_defaults[ 'layout_setting' ] = 'left-sidebar';
	$new_defaults[ 'blog_layout_setting' ] = 'left-sidebar';
	$new_defaults[ 'single_layout_setting' ] = 'left-sidebar';
	$new_defaults[ 'post_content' ] = 'full';
	$new_defaults[ 'footer_layout_setting' ] = 'fluid-footer';
	$new_defaults[ 'footer_widget_setting' ] = '2';
	$new_defaults[ 'back_to_top' ] = '';
	$new_defaults[ 'background_color' ] = '#E456A4';
	$new_defaults[ 'text_color' ] = '#E456A4';
	$new_defaults[ 'link_color' ] = '#1e73be';
	$new_defaults[ 'link_color_hover' ] = '#E456A4';
	$new_defaults[ 'link_color_visited' ] = '';
	
	return $new_defaults;
}
endif;
/**
 * Set default options
 */
if ( !function_exists( 'mantle_get_color_defaults' ) ) :
add_filter( 'generate_color_option_defaults','mantle_get_color_defaults' );
function mantle_get_color_defaults()
{
	$mantle_color_defaults[	'header_background_color' ] = '#ffffff';
	$mantle_color_defaults[	'header_text_color' ] = '#E456A4';
	$mantle_color_defaults[	'header_link_color' ] = '';
	$mantle_color_defaults[	'header_link_hover_color' ] = '';
	$mantle_color_defaults[	'site_title_color' ] = '#E456A4';
	$mantle_color_defaults[	'site_tagline_color' ] = '#999999';
	$mantle_color_defaults[	'navigation_background_color' ] = '#E359A4';
	$mantle_color_defaults[	'navigation_text_color' ] = '#FFFFFF';
	$mantle_color_defaults[	'navigation_background_hover_color' ] = '#ED83BD';
	$mantle_color_defaults[	'navigation_text_hover_color' ] = '#ffffff';
	$mantle_color_defaults[	'navigation_background_current_color' ] = '#ED83BD';
	$mantle_color_defaults[	'navigation_text_current_color' ] = '#ffffff';
	$mantle_color_defaults[	'subnavigation_background_color' ] = '#ED83BD';
	$mantle_color_defaults[	'subnavigation_text_color' ] = '#ffffff';
	$mantle_color_defaults[	'subnavigation_background_hover_color' ] = '';
	$mantle_color_defaults[	'subnavigation_text_hover_color' ] = '#AA005D';
	$mantle_color_defaults[	'subnavigation_background_current_color' ] = '';
	$mantle_color_defaults[	'subnavigation_text_current_color' ] = '#AA005D';
	$mantle_color_defaults[	'content_background_color' ] = '#FFFFFF';
	$mantle_color_defaults[	'content_text_color' ] = '#3a3a3a';
	$mantle_color_defaults[	'content_link_color' ] = '';
	$mantle_color_defaults[	'content_link_hover_color' ] = '';
	$mantle_color_defaults[	'content_title_color' ] = '';
	$mantle_color_defaults[	'blog_post_title_color' ] = '#E359A4';
	$mantle_color_defaults[	'blog_post_title_hover_color' ] = '#E456A4';
	$mantle_color_defaults[	'entry_meta_text_color' ] = '#E359A4';
	$mantle_color_defaults[	'entry_meta_link_color' ] = '#3F81B1';
	$mantle_color_defaults[	'entry_meta_link_color_hover' ] = '#E359A4';
	$mantle_color_defaults[	'h1_color' ] = '';
	$mantle_color_defaults[	'h2_color' ] = '';
	$mantle_color_defaults[	'h3_color' ] = '';
	$mantle_color_defaults[	'sidebar_widget_background_color' ] = '#FFFFFF';
	$mantle_color_defaults[	'sidebar_widget_text_color' ] = '#3a3a3a';
	$mantle_color_defaults[	'sidebar_widget_link_color' ] = '#686868';
	$mantle_color_defaults[	'sidebar_widget_link_hover_color' ] = '#E359A4';
	$mantle_color_defaults[	'sidebar_widget_title_color' ] = '#000000';
	$mantle_color_defaults[	'footer_widget_background_color' ] = '#ffffff';
	$mantle_color_defaults[	'footer_widget_text_color' ] = '#E456A4';
	$mantle_color_defaults[	'footer_widget_link_color' ] = '';
	$mantle_color_defaults[	'footer_widget_link_hover_color' ] = '';
	$mantle_color_defaults[	'footer_widget_title_color' ] = '#E456A4';
	$mantle_color_defaults[	'footer_background_color' ] = '#E359A4';
	$mantle_color_defaults[	'footer_text_color' ] = '#ffffff';
	$mantle_color_defaults[	'footer_link_color' ] = '#ffffff';
	$mantle_color_defaults[	'footer_link_hover_color' ] = '#f5f5f5';
	$mantle_color_defaults[	'form_background_color' ] = '#FAFAFA';
	$mantle_color_defaults[	'form_text_color' ] = '#3F81B1';
	$mantle_color_defaults[	'form_background_color_focus' ] = '#FFFFFF';
	$mantle_color_defaults[	'form_text_color_focus' ] = '#3F81B1';
	$mantle_color_defaults[	'form_border_color' ] = '#CCCCCC';
	$mantle_color_defaults[	'form_border_color_focus' ] = '#BFBFBF';
	$mantle_color_defaults[	'form_button_background_color' ] = '#3F81B1';
	$mantle_color_defaults[	'form_button_background_color_hover' ] = '#E359A4';
	$mantle_color_defaults[	'form_button_text_color' ] = '#FFFFFF';
	$mantle_color_defaults[	'form_button_text_color_hover' ] = '#FFFFFF';
	
	return $mantle_color_defaults;
}
endif;
/**
 * Set default options
 */
if ( !function_exists('mantle_get_default_fonts') ) :
add_filter( 'generate_font_option_defaults','mantle_get_default_fonts' );
function mantle_get_default_fonts( $mantle_font_defaults )
{
	$mantle_font_defaults[ 'font_body' ] = 'Open Sans';
	$mantle_font_defaults[ 'font_body_category' ] = 'sans-serif';
	$mantle_font_defaults[ 'font_body_variants' ] = '300,300italic,regular,italic,600,600italic,700,700italic,800,800italic';
	$mantle_font_defaults[ 'body_font_weight' ] = 'normal';
	$mantle_font_defaults[ 'body_font_transform' ] = 'none';
	$mantle_font_defaults[ 'body_font_size' ] = '15';
	$mantle_font_defaults[ 'font_site_title' ] = 'inherit';
	$mantle_font_defaults[ 'site_title_font_weight' ] = '300';
	$mantle_font_defaults[ 'site_title_font_transform' ] = 'none';
	$mantle_font_defaults[ 'site_title_font_size' ] = '60';
	$mantle_font_defaults[ 'mobile_site_title_font_size' ] = '30';
	$mantle_font_defaults[ 'font_site_tagline' ] = 'inherit';
	$mantle_font_defaults[ 'site_tagline_font_weight' ] = 'normal';
	$mantle_font_defaults[ 'site_tagline_font_transform' ] = 'none';
	$mantle_font_defaults[ 'site_tagline_font_size' ] = '15';
	$mantle_font_defaults[ 'font_navigation' ] = 'inherit';
	$mantle_font_defaults[ 'navigation_font_weight' ] = 'normal';
	$mantle_font_defaults[ 'navigation_font_transform' ] = 'none';
	$mantle_font_defaults[ 'navigation_font_size' ] = '15';
	$mantle_font_defaults[ 'font_widget_title' ] = 'inherit';
	$mantle_font_defaults[ 'widget_title_font_weight' ] = '300';
	$mantle_font_defaults[ 'widget_title_font_transform' ] = 'none';
	$mantle_font_defaults[ 'widget_title_font_size' ] = '20';
	$mantle_font_defaults[ 'widget_content_font_size' ] = '15';
	$mantle_font_defaults[ 'font_heading_1' ] = 'inherit';
	$mantle_font_defaults[ 'heading_1_weight' ] = '300';
	$mantle_font_defaults[ 'heading_1_transform' ] = 'none';
	$mantle_font_defaults[ 'heading_1_font_size' ] = '50';
	$mantle_font_defaults[ 'mobile_heading_1_font_size' ] = '30';
	$mantle_font_defaults[ 'font_heading_2' ] = 'inherit';
	$mantle_font_defaults[ 'heading_2_weight' ] = '300';
	$mantle_font_defaults[ 'heading_2_transform' ] = 'none';
	$mantle_font_defaults[ 'heading_2_font_size' ] = '40';
	$mantle_font_defaults[ 'mobile_heading_2_font_size' ] = '25';
	$mantle_font_defaults[ 'font_heading_3' ] = 'inherit';
	$mantle_font_defaults[ 'heading_3_weight' ] = '300';
	$mantle_font_defaults[ 'heading_3_transform' ] = 'none';
	$mantle_font_defaults[ 'heading_3_font_size' ] = '30';
	$mantle_font_defaults[ 'font_heading_4' ] = 'inherit';
	$mantle_font_defaults[ 'heading_4_weight' ] = '300';
	$mantle_font_defaults[ 'heading_4_transform' ] = 'none';
	$mantle_font_defaults[ 'heading_4_font_size' ] = '20';
	$mantle_font_defaults[ 'footer_font_size' ] = '17';
	
	return $mantle_font_defaults;
}
endif;
/**
 * Prints the Post Image to post excerpts
 */
if ( ! function_exists( 'mantle_post_image' ) && !function_exists( 'generate_blog_get_defaults' ) ) :
	add_action( 'generate_before_content', 'mantle_post_image' );
	function mantle_post_image()
	{
		if ( !has_post_thumbnail() )
			return;
			
		if ( 'post' == get_post_type() && !is_single() ) {
		?>
			<div class="post-image">
				<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
			</div>
		<?php
		}
	}
endif;
/**
 * Add page header above content
 * @since 1.0.2
 */
add_action( 'generate_before_content', 'mantle_featured_page_header' );
function mantle_featured_page_header()
{
	if ( function_exists('generate_page_header') )
		return;

	if ( is_page() ) :
		
		generate_featured_page_header_area('page-header-image');
	
	endif;
}
/**
 * Add dynamic CSS
 * @since 0.4
 */
function mantle_custom_css()
{

	$generate_settings = wp_parse_args( 
		get_option( 'generate_settings', array() ), 
		generate_get_defaults() 
	);

	if ( function_exists( 'generate_spacing_get_defaults' ) ) :
		
		$spacing_settings = wp_parse_args( 
			get_option( 'generate_spacing_settings', array() ), 
			generate_spacing_get_defaults() 
		);
			
	endif;
	
	if ( function_exists( 'generate_blog_get_defaults' ) ) :
		
		$blog_settings = wp_parse_args( 
			get_option( 'generate_blog_settings', array() ), 
			generate_blog_get_defaults() 
		);
			
	endif;
	
	if ( function_exists('generate_spacing_get_defaults') ) :
		$top_padding = $spacing_settings['content_top'];
		$right_padding = $spacing_settings['content_right'];
		$bottom_padding = $spacing_settings['content_bottom'];
		$left_padding = $spacing_settings['content_left'];
		$menu_height = $spacing_settings['menu_item_height'];
	else :
		$top_padding = 40;
		$right_padding = 40;
		$bottom_padding = 40;
		$left_padding = 40;
		$menu_height = 50;
	endif;
	
	$return = '';
		
	if ( function_exists( 'generate_blog_get_defaults' ) ) :
		if ( '' == $blog_settings['post_image_position'] ) :
			$return .= '.separate-containers .post-image, .separate-containers .inside-article .page-header-image-single, .separate-containers .inside-article .page-header-image, .separate-containers .inside-article .page-header-content-single, .no-sidebar .inside-article .page-header-image-single, .no-sidebar .inside-article .page-header-image, article .inside-article .page-header-post-image { margin: ' . $bottom_padding . 'px -' . $right_padding . 'px ' . $bottom_padding . 'px -' . $left_padding . 'px }';
		else :
			$return .= '.separate-containers .post-image, .separate-containers .inside-article .page-header-image-single, .separate-containers .inside-article .page-header-image, .separate-containers .inside-article .page-header-content-single, .no-sidebar .inside-article .page-header-image-single, .no-sidebar .inside-article .page-header-image, article .inside-article .page-header-post-image { margin: -' . $top_padding . 'px -' . $right_padding . 'px ' . $bottom_padding . 'px -' . $left_padding . 'px }';
		endif;
	else :
		$return .= '.separate-containers .post-image, .separate-containers .inside-article .page-header-image-single, .separate-containers .inside-article .page-header-image, .separate-containers .inside-article .page-header-content-single, .no-sidebar .inside-article .page-header-image-single, .no-sidebar .inside-article .page-header-image, article .inside-article .page-header-post-image { margin: -' . $top_padding . 'px -' . $right_padding . 'px ' . $bottom_padding . 'px -' . $left_padding . 'px }';
	endif;
	
	$return .= '.nav-above-header {padding-top: ' . $menu_height . 'px}';
	$return .= '.stickynav.nav-below-header .site-header {margin-bottom: ' . $menu_height . 'px}';
	
	if ( 'contained-nav' == $generate_settings['nav_layout_setting'] ) :
		$return .= '@media screen and (min-width: ' . $generate_settings['container_width'] . 'px) { body.stickynav.nav-below-header #site-navigation, body.nav-above-header #site-navigation, body.stickynav.nav-above-header #site-navigation { left: 50%; width: 100%; max-width: ' . $generate_settings['container_width'] . 'px; margin-left: -' . $generate_settings['container_width'] / 2 . 'px; } }';
		$return .= '@media screen and (min-width: 768px) and (max-width: ' . ($generate_settings['container_width'] - 1) . 'px){ body.stickynav.nav-below-header #site-navigation, body.nav-above-header #site-navigation, body.stickynav.nav-above-header #site-navigation { width: 100%; } }';
	endif;
	
	return $return;
}
/**
 * Enqueue scripts and styles
 */
add_action( 'wp_enqueue_scripts', 'mantle_css', 50 );
function mantle_css() {
	wp_add_inline_style( 'generate-style', mantle_custom_css() );
}
/**
*Force login function
*/
function v_getUrl() {
  $url  = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
  $url .= '://' . $_SERVER['SERVER_NAME'];
  $url .= in_array( $_SERVER['SERVER_PORT'], array('80', '443') ) ? '' : ':' . $_SERVER['SERVER_PORT'];
  $url .= $_SERVER['REQUEST_URI'];
  return $url;
}
function v_forcelogin() {
  if( !is_user_logged_in() ) {
    $url = v_getUrl();
    $whitelist = apply_filters('v_forcelogin_whitelist', array());
    $redirect_url = apply_filters('v_forcelogin_redirect', $url);
    if( preg_replace('/\?.*/', '', $url) != preg_replace('/\?.*/', '', wp_login_url()) && !in_array($url, $whitelist) ) {
      wp_safe_redirect( wp_login_url( $redirect_url ), 302 ); exit();
    }
  }
}
add_action('init', 'v_forcelogin');
/**
 * Custom login page css
 */
function my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/login/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');
/**
 * Hide remember me checkbox
 */
add_action('login_head', 'do_not_remember_me');
function do_not_remember_me()
{
echo '<style type="text/css">.forgetmenot { display:none; }</style>';
}
/**
 * Hide wordpress logo h1 
 */
add_action('login_enqueue_scripts','hide_logo');
function hide_logo(){
echo '<style>
#login h1{display:none;}
</style>';
}
/**
 * Disable admin bar on the frontend of your website
 * for subscribers.
 */
function themeblvd_disable_admin_bar() {
    if ( ! current_user_can('edit_posts') ) {
        add_filter('show_admin_bar', '__return_false');
    }
}
add_action( 'after_setup_theme', 'themeblvd_disable_admin_bar' );
 
/**
 * Redirect back to homepage and not allow access to
 * WP admin for Subscribers.
 */
function themeblvd_redirect_admin(){
    if ( ! defined('DOING_AJAX') && ! current_user_can('edit_posts') ) {
        wp_redirect( site_url() );
        exit;      
    }
}
add_action( 'admin_init', 'themeblvd_redirect_admin' );
/**
 * Hide wordpress version  and many more...
 */
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
function remove_version() {
return '';
}
// Hide Hello Wordpress 
remove_action('welcome_panel', 'wp_welcome_panel');
/**
 * Filter Force Login to allow exceptions for specific URLs.
 *
 * @return array An array of URLs. Must be absolute.
 */
function my_forcelogin_whitelist( $whitelist ) {
  $whitelist[] = site_url( '//' );
  return $whitelist;
}
add_filter('v_forcelogin_whitelist', 'my_forcelogin_whitelist', 10, 1);
//default redirect user 
function admin_default_page() {
  return '/questions';
}
add_filter('login_redirect', 'admin_default_page');

//limin post 
