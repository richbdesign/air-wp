<?php

// hot fares custom post type
function hot_fares_post() {
	$labels = array(
		'name'               => _x( 'Hot Fares', 'post type general name' ),
		'singular_name'      => _x( 'Hot Fare', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'hot fare' ),
		'add_new_item'       => __( 'Add New Hot Fare' ),
		'edit_item'          => __( 'Edit Hot Fare' ),
		'new_item'           => __( 'New Hot Fare' ),
		'all_items'          => __( 'All Hot Fares' ),
		'view_item'          => __( 'View Hot Fare' ),
		'search_items'       => __( 'Search Hot Fares' ),
		'not_found'          => __( 'No hot fares found' ),
		'not_found_in_trash' => __( 'No hot fares found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Hot Fares'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Hot Fares',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => '/wp-content/themes/flywichita/images/custom/fares.png',
		'supports'      => array( 'title' ),
		'has_archive'   => true,
	);
	register_post_type( 'hot-fares', $args );	
}
add_action( 'init', 'hot_fares_post' );

// airlines custom post type
function airlines_post() {
	$labels = array(
		'name'               => _x( 'Airlines', 'post type general name' ),
		'singular_name'      => _x( 'Airline', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'airline' ),
		'add_new_item'       => __( 'Add New Airline' ),
		'edit_item'          => __( 'Edit Airline' ),
		'new_item'           => __( 'New Airline' ),
		'all_items'          => __( 'All Airlines' ),
		'view_item'          => __( 'View Airline' ),
		'search_items'       => __( 'Search Airlines' ),
		'not_found'          => __( 'No airlines found' ),
		'not_found_in_trash' => __( 'No airlines found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Airlines'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Airlines',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => '/wp-content/themes/flywichita/images/custom/airline.png',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
	);
	register_post_type( 'airlines', $args );	
}
add_action( 'init', 'airlines_post' );

// ground transportation custom post type
function transportation_post() {
	$labels = array(
		'name'               => _x( 'Ground Transportation', 'post type general name' ),
		'singular_name'      => _x( 'Ground Transportation', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'ground transportation' ),
		'add_new_item'       => __( 'Add New Ground Transportation' ),
		'edit_item'          => __( 'Edit Ground Transportation' ),
		'new_item'           => __( 'New Ground Transportation' ),
		'all_items'          => __( 'All Ground Transportation' ),
		'view_item'          => __( 'View Ground Transportation' ),
		'search_items'       => __( 'Search Ground Transportation' ),
		'not_found'          => __( 'No ground transportation found' ),
		'not_found_in_trash' => __( 'No ground transportation found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Ground Transportation'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Ground Transportation',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => '/wp-content/themes/flywichita/images/custom/transportation.png',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
	);
	register_post_type( 'transportation', $args );	
}
add_action( 'init', 'transportation_post' );

// hook into the init action and call create_gt_taxonomies() when it fires
add_action( 'init', 'create_gt_taxonomies', 0 );

// create one taxonomy, types for the post type "transportation"
function create_gt_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Types', 'taxonomy general name' ),
		'singular_name' => _x( 'Type', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Types' ),
		'all_items' => __( 'All Types' ),
		'parent_item' => __( 'Parent Type' ),
		'parent_item_colon' => __( 'Parent Type:' ),
		'edit_item' => __( 'Edit Type' ),
		'update_item' => __( 'Update Type' ),
		'add_new_item' => __( 'Add New Type' ),
		'new_item_name' => __( 'New Type' ),
	); 	

	register_taxonomy( 'type', array( 'transportation' ), array(
		'hierarchical' => true,
		'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'types' ),
	));
	
};

// parking garages custom post type
function parking_garages_post() {
	$labels = array(
		'name'               => _x( 'Parking Garages', 'post type general name' ),
		'singular_name'      => _x( 'Parking Garage', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'parking garage' ),
		'add_new_item'       => __( 'Add New Parking Garage' ),
		'edit_item'          => __( 'Edit Parking Garage' ),
		'new_item'           => __( 'New Parking Garage' ),
		'all_items'          => __( 'All Parking Garages' ),
		'view_item'          => __( 'View Parking Garage' ),
		'search_items'       => __( 'Search Parking Garages' ),
		'not_found'          => __( 'No parking garages found' ),
		'not_found_in_trash' => __( 'No parking garages found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Parking Garages'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Parking Garages',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => '/wp-content/themes/flywichita/images/custom/parking.png',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
	);
	register_post_type( 'parking-garages', $args );	
}
add_action( 'init', 'parking_garages_post' );

// restaurants custom post type
function restaurants_post() {
	$labels = array(
		'name'               => _x( 'Restaurants', 'post type general name' ),
		'singular_name'      => _x( 'Restaurant', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'restaurant' ),
		'add_new_item'       => __( 'Add New Restaurant' ),
		'edit_item'          => __( 'Edit Restaurant' ),
		'new_item'           => __( 'New Restaurant' ),
		'all_items'          => __( 'All Restaurants' ),
		'view_item'          => __( 'View Restaurant' ),
		'search_items'       => __( 'Search Restaurants' ),
		'not_found'          => __( 'No restaurants found' ),
		'not_found_in_trash' => __( 'No restaurants found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Restaurants'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Restaurants',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => '/wp-content/themes/flywichita/images/custom/restaurant.png',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
	);
	register_post_type( 'restaurants', $args );	
}
add_action( 'init', 'restaurants_post' );

// shops custom post type
function shops_post() {
	$labels = array(
		'name'               => _x( 'Shops', 'post type general name' ),
		'singular_name'      => _x( 'Shop', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'shop' ),
		'add_new_item'       => __( 'Add New Shop' ),
		'edit_item'          => __( 'Edit Shop' ),
		'new_item'           => __( 'New Shop' ),
		'all_items'          => __( 'All Shops' ),
		'view_item'          => __( 'View Shop' ),
		'search_items'       => __( 'Search Shops' ),
		'not_found'          => __( 'No shops found' ),
		'not_found_in_trash' => __( 'No shops found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Shops'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Shops',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => '/wp-content/themes/flywichita/images/custom/shop.png',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
	);
	register_post_type( 'shops', $args );	
}
add_action( 'init', 'shops_post' );

// terminal images custom post type
function terminal_images_post() {
	$labels = array(
		'name'               => _x( 'Terminal Images', 'post type general name' ),
		'singular_name'      => _x( 'Terminal Image', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'terminal image' ),
		'add_new_item'       => __( 'Add New Terminal Image' ),
		'edit_item'          => __( 'Edit Terminal Image' ),
		'new_item'           => __( 'New Terminal Image' ),
		'all_items'          => __( 'All Terminal Images' ),
		'view_item'          => __( 'View Terminal Image' ),
		'search_items'       => __( 'Search Terminal Images' ),
		'not_found'          => __( 'No terminal images found' ),
		'not_found_in_trash' => __( 'No terminal images found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Terminal Images'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Terminal Images',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => '/wp-content/themes/flywichita/images/custom/image.png',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
	);
	register_post_type( 'terminal-images', $args );	
}
add_action( 'init', 'terminal_images_post' );

// promos custom post type
function promos_post() {
	$labels = array(
		'name'               => _x( 'Promos', 'post type general name' ),
		'singular_name'      => _x( 'Promo', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'promo' ),
		'add_new_item'       => __( 'Add New Promo' ),
		'edit_item'          => __( 'Edit Promo' ),
		'new_item'           => __( 'New Promo' ),
		'all_items'          => __( 'All Promos' ),
		'view_item'          => __( 'View Promo' ),
		'search_items'       => __( 'Search Promos' ),
		'not_found'          => __( 'No promos found' ),
		'not_found_in_trash' => __( 'No promos found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Promos'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Promos',
		'public'        => true,
		'menu_position' => 5,
		'menu_icon' => '/wp-content/themes/flywichita/images/custom/promo.png',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
	);
	register_post_type( 'promos', $args );	
}
add_action( 'init', 'promos_post' );

// faq custom post type
function faq_post() {
	$labels = array(
		'name'               => _x( 'FAQ', 'post type general name' ),
		'singular_name'      => _x( 'FAQ', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'faq' ),
		'add_new_item'       => __( 'Add New FAQ' ),
		'edit_item'          => __( 'Edit FAQ' ),
		'new_item'           => __( 'New FAQ' ),
		'all_items'          => __( 'All FAQs' ),
		'view_item'          => __( 'View FAQ' ),
		'search_items'       => __( 'Search FAQs' ),
		'not_found'          => __( 'No faqs found' ),
		'not_found_in_trash' => __( 'No faqs found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'FAQs'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'FAQs',
		'public'        => true,
		'menu_position' => 5,
		//'menu_icon' => '/wp-content/themes/flywichita/images/custom/faq.png',
		'supports'      => array( 'title', 'editor', 'thumbnail' ),
		'has_archive'   => true,
	);
	register_post_type( 'faq', $args );	
}
add_action( 'init', 'faq_post' );

// hook into the init action and call create_gt_taxonomies() when it fires
add_action( 'init', 'create_faq_taxonomies', 0 );

// create one taxonomy, sections for the post type "faq"
function create_faq_taxonomies() {

	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name' => _x( 'Sections', 'taxonomy general name' ),
		'singular_name' => _x( 'Section', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Sections' ),
		'all_items' => __( 'All Sections' ),
		'parent_item' => __( 'Parent Section' ),
		'parent_item_colon' => __( 'Parent Section:' ),
		'edit_item' => __( 'Edit Section' ),
		'update_item' => __( 'Update Section' ),
		'add_new_item' => __( 'Add New Section' ),
		'new_item_name' => __( 'New Section' ),
	); 	

	register_taxonomy( 'section', array( 'faq' ), array(
		'hierarchical' => true,
		'labels' => $labels, /* NOTICE: Here is where the $labels variable is used */
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'sections' ),
	));
	
};

?>