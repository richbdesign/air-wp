<?php 
/**
 * @package WordPress
 */

// LOAD JQUERY FROM CDN
//add_action( 'init', 'Wps_jquery_register' );

//function Wps_jquery_register() {

//if ( !is_admin() ) {

    //wp_deregister_script( 'jquery' );
    //wp_register_script( 'jquery', ( 'https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js' ), false, null, true );
    //wp_enqueue_script( 'jquery' );
//}
//}


 //-----------------------------------------

// CUSTOMIZE ADMIN MENU ORDER
   function Wps_custom_menu_order($menu_ord) {
       if (!$menu_ord) return true;
       return array(
        'index.php', // this represents the dashboard link
        'edit.php?post_type=page', // this is the default page menu
        'edit.php', // this is the default POST admin menu
        'edit.php?post_type=terminal-images',
        'edit.php?post_type=promos',
        'edit.php?post_type=hot-fares',
        'edit.php?post_type=airlines',
        'edit.php?post_type=transportation',
        'edit.php?post_type=parking-garages',
        'edit.php?post_type=restaurants',
        'edit.php?post_type=shops',
    );
   }
   add_filter('custom_menu_order', 'Wps_custom_menu_order');
   add_filter('menu_order', 'Wps_custom_menu_order');

    //-----------------------------------------
   
   
   
   //This theme supports editor styles
add_editor_style("/css/layout-style.css");

// Custom Pagination
/**
 * Retrieve or display pagination code.
 *
 * The defaults for overwriting are:
 * 'page' - Default is null (int). The current page. This function will
 *      automatically determine the value.
 * 'pages' - Default is null (int). The total number of pages. This function will
 *      automatically determine the value.
 * 'range' - Default is 3 (int). The number of page links to show before and after
 *      the current page.
 * 'gap' - Default is 3 (int). The minimum number of pages before a gap is 
 *      replaced with ellipses (...).
 * 'anchor' - Default is 1 (int). The number of links to always show at begining
 *      and end of pagination
 * 'before' - Default is '<div class="emm-paginate">' (string). The html or text 
 *      to add before the pagination links.
 * 'after' - Default is '</div>' (string). The html or text to add after the
 *      pagination links.
 * 'next_page' - Default is '__('&raquo;')' (string). The text to use for the 
 *      next page link.
 * 'previous_page' - Default is '__('&laquo')' (string). The text to use for the 
 *      previous page link.
 * 'echo' - Default is 1 (int). To return the code instead of echo'ing, set this
 *      to 0 (zero).
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @return string HTML content, if not displaying.
 */
function emm_paginate($args = null) {
	$defaults = array(
		'page' => null, 'pages' => null, 
		'range' => 3, 'gap' => 3, 'anchor' => 1,
		'before' => '<ul class="pagination">', 'after' => '</ul>',
		'title' => __('<li class="unavailable"></li>'),
		'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
		'echo' => 1
	);

	$r = wp_parse_args($args, $defaults);
	extract($r, EXTR_SKIP);

	if (!$page && !$pages) {
		global $wp_query;

		$page = get_query_var('paged');
		$page = !empty($page) ? intval($page) : 1;

		$posts_per_page = intval(get_query_var('posts_per_page'));
		$pages = intval(ceil($wp_query->found_posts / $posts_per_page));
	}
	
	$output = "";
	if ($pages > 1) {	
		$output .= "$before<li>$title</li>";
		$ellipsis = "<li class='unavailable'>...</li>";

		if ($page > 1 && !empty($previouspage)) {
			$output .= "<li><a href='" . get_pagenum_link($page - 1) . "'>$previouspage</a></li>";
		}
		
		$min_links = $range * 2 + 1;
		$block_min = min($page - $range, $pages - $min_links);
		$block_high = max($page + $range, $min_links);
		$left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
		$right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

		if ($left_gap && !$right_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $pages, $page)
			);
		}
		else if ($left_gap && $right_gap) {
			$output .= sprintf('%s%s%s%s%s', 
				emm_paginate_loop(1, $anchor), 
				$ellipsis, 
				emm_paginate_loop($block_min, $block_high, $page), 
				$ellipsis, 
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else if ($right_gap && !$left_gap) {
			$output .= sprintf('%s%s%s', 
				emm_paginate_loop(1, $block_high, $page),
				$ellipsis,
				emm_paginate_loop(($pages - $anchor + 1), $pages)
			);
		}
		else {
			$output .= emm_paginate_loop(1, $pages, $page);
		}

		if ($page < $pages && !empty($nextpage)) {
			$output .= "<li><a href='" . get_pagenum_link($page + 1) . "'>$nextpage</a></li>";
		}

		$output .= $after;
	}

	if ($echo) {
		echo $output;
	}

	return $output;
}

/**
 * Helper function for pagination which builds the page links.
 *
 * @access private
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param int $start The first link page.
 * @param int $max The last link page.
 * @return int $page Optional, default is 0. The current page.
 */
function emm_paginate_loop($start, $max, $page = 0) {
	$output = "";
	for ($i = $start; $i <= $max; $i++) {
		$output .= ($page === intval($i)) 
			? "<li class='current'><a href='#'>$i</a></li>" 
			: "<li><a href='" . get_pagenum_link($i) . "'>$i</a></li>";
	}
	return $output;
}

// Custom CSS for the login page
// Create wp-login.css in your theme folder
function wpfme_loginCSS() {
	echo '<link rel="stylesheet" type="text/css" href="'.get_bloginfo('template_directory').'/css/wp-login.css"/>';
}
add_action('login_head', 'wpfme_loginCSS');

// Stop images getting wrapped up in p tags when they get dumped out with the_content() for easier theme styling
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

// Custom Dashboard Widget
add_action('wp_dashboard_setup', 'my_custom_dashboard_widgets');
	function my_custom_dashboard_widgets() {
	global $wp_meta_boxes;
	wp_add_dashboard_widget('custom_info_widget', 'Website Information', 'custom_dashboard_info');
}

function custom_dashboard_info() {
	include(TEMPLATEPATH . "/custom-widget.php");
}

//Custom Excerpt
function new_excerpt_more($more) {
    global $post;
	return '&hellip; <a href="'. get_permalink($post->ID) . '" class="more">Read More</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

//admin favicon
function favicon4admin() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_directory').'/images/favicon.ico" />';
}
add_action( 'admin_head', 'favicon4admin' );

//custom search form
function my_search_form( $form ) {

    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
    <input type="text" value="" name="s" id="s" />
    </form>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form' );

// Post Thumbnails
if ( function_exists( 'add_theme_support' ) ) { add_theme_support( 'post-thumbnails', array( 'post', 'page', 'transportation', 'terminal-images', 'promos', 'hot-fares', 'airlines', 'parking-garages', 'restaurants', 'shops' ) ); }
add_image_size( 'vendorthumb', 337, 290, true );
//add_image_size( 'testphoto', 167, 120, true );

// Get Page Slug
function the_slug($echo=false){
	$slug = basename(get_permalink());
	do_action('before_slug', $slug);
	$slug = apply_filters('slug_filter', $slug);
	if( $echo ) echo $slug;
	do_action('after_slug', $slug);
	return $slug;
}

//page names query
function page_names_query( $n = array() ) {
  static $pages;
  if ( is_null($pages) && ! empty($n) && is_array($n) ) {
    $pages = array_filter( array_map('sanitize_title', $n) );
    if ( ! empty($pages) ) {
      // using this function itself to filter next query
      add_filter('posts_where', __FUNCTION__, 999 ); 
      return new WP_Query('post_type=page'); // return the filtered query
    } else { // no valid page names passed
      $pages = NULL;
      return new WP_Query('p=-1'); // return a WP_Query with no posts
    }
  } elseif( current_filter() === 'posts_where' && ! empty($pages) && is_string($n) ) {
    $w = ' AND post_name IN (';
    global $wpdb;
    foreach ( $pages as $page ) { $w .= $wpdb->prepare('%s,', $page); }
    $pages = NULL; // reset static variable
    remove_filter('posts_where', __FUNCTION__, 999 ); // remove filter
    return $n . rtrim($w, ',') . ')';
  }
}

?>