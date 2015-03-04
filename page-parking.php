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
		<div class="col-12">
			<?php the_content(); ?>

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
							<li><span class="title">Hours</span> <span><?php the_field('parking_lot_hours'); ?></span></li>
							<li><span class="title">Rates</span> <span><?php the_field('parking_lot_rates'); ?></span></li>
							<li><span class="title">Payment</span> <span><?php the_field('parking_lot_payment'); ?></span></li>
						</ul>
					</div>
				</div>
	        </div>

	        <?php endwhile; // end of garages loop. ?>
			<?php wp_reset_query(); ?>
		</div>
	</section>
</div><!-- content -->

<?php get_footer(); ?>