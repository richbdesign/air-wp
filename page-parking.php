<?php
/**
 * Template Name: Parking Page
 * Description: Parking page template
 *
 * @package WordPress
 */

get_header(); 
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

<?php the_post(); ?>
</div><!-- headerpic -->
<?php $pageheader = get_field('page_header_image');
if (!empty($pageheader)):
    //$size = 'full';
    $large = $pageheader['url'];
        echo '<div class="banner" style="background: url('.$large.') no-repeat center center; background-size: cover;"></div>'; ?>
<?php endif; ?>
<div class="content">
	<section>
		<?php wp_reset_query(); ?>
        <?php
        $garages = new WP_Query(array('post_type' => 'parking-garages', 'posts_per_page' => -1));
        while ($garages->have_posts()) : $garages->the_post();
        ?>

        <div class="col-6">
        	<div class="garage">
				<div class="garagetop">
					<h3><?php the_title(); ?></h3>
				</div>
				<div class="garagecontent">
					<?php the_content(); ?>
					<ul>
						<li><span>Hours</span> <?php the_field('parking_lot_hours'); ?></li>
						<li><span>Rates</span> <?php the_field('parking_lot_rates'); ?></li>
						<li><span>Payment</span> <?php the_field('parking_lot_payment'); ?></li>
					</ul>
				</div>
			</div>
        </div>

        <?php endwhile; // end of garages loop. ?>
		<?php wp_reset_query(); ?>
	</section>
</div><!-- content -->

<?php get_footer(); ?>