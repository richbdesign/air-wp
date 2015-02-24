<?php
/**
 * @package WordPress
 */
 

// Shortcodes

// post type query
add_shortcode( 'list-posts', 'waa_list_posts_shortcode' );
function waa_list_posts_shortcode( $atts ) {
    ob_start();
 	echo '<ul class="transportlist">';
    // define attributes and their defaults
    extract( shortcode_atts( array (
        'posttype' => 'post',
        'order' => 'ASC',
        'orderby' => 'title',
        'posts' => -1,
        'type' => '',
    ), $atts ) );
 
    // define query parameters based on attributes
    $options = array(
        'post_type' => $posttype,
        'order' => $order,
        'orderby' => $orderby,
        'posts_per_page' => $posts,
        'type' => $type,
    );
    $query = new WP_Query( $options );
    $count = 0;
    // run the loop based on the query
    while ($query->have_posts()) : $query->the_post(); ?>
    
    <?php if ($count % 3 == 2) { ?>
        <li class="last">
    <?php } else { ?>
        <li>
    <?php } ?>
    		<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumbnail', array('class' => 'transpic')); } ?>
        	<h4><?php the_title(); ?></h4>
        	<?php $transphone = get_field('transportation_phone_number');
        		if (!empty($transphone)):
                    echo '<span class="phone">'.$transphone.'</span>';?>
                <?php endif; ?>
            <?php $transweb = get_field('transportation_website');
        		if (!empty($transweb)):
                    echo '<span class="web"><a href="http://'.$transweb.'" title="'.get_the_title().'" target="_blank">'.$transweb.'</a></span>';?>
                <?php endif; ?>
        </li>
	<?php $count++;
	endwhile;

	wp_reset_query();
    echo '</ul>';

    $listvariable = ob_get_clean();
    return $listvariable;
 }

// page query
add_shortcode( 'list-pages', 'waa_list_pages_shortcode' );
function waa_list_pages_shortcode( $atts ) {
	ob_start();
	echo '<ul class="landingboxes">';
	
	extract( shortcode_atts( array (
        'pagenames' => array('Please select...'),
    ), $atts ) );

    $pagearray = str_getcsv($pagenames);

    $query = page_names_query( $pagearray ); 
    $count = 0;
    while ($query->have_posts()) : $query->the_post(); ?>

    <li class="link-<?php echo $count ?>"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><div><?php the_title(); ?></div></a></li>

    <?php $count++;
	endwhile;

	wp_reset_query();
    echo '</ul>';

    $listvariable = ob_get_clean();
    return $listvariable;
}

// faq query
add_shortcode( 'list-faq', 'waa_list_faq_shortcode' );
function waa_list_faq_shortcode( $atts ) {
    ob_start();
    
    // define attributes and their defaults
    extract( shortcode_atts( array (
        'posttype' => 'faq',
        'order' => 'ASC',
        'orderby' => 'title',
        'posts' => -1,
        'section' => '',
    ), $atts ) );
 
    // define query parameters based on attributes
    $options = array(
        'post_type' => $posttype,
        'order' => $order,
        'orderby' => $orderby,
        'posts_per_page' => $posts,
        'section' => $section,
    );
    echo '<dl class="accordion" id="'.$section.'">';
    $query = new WP_Query( $options );
    // run the loop based on the query
    while ($query->have_posts()) : $query->the_post(); ?>
    
    <dt><a href=""><?php the_title(); ?></a></dt>
    <dd><?php the_content(); ?></dd>
    
    <?php endwhile;

    wp_reset_query();
    echo '</dl>';

    $listvariable = ob_get_clean();
    return $listvariable;
 }

?>
