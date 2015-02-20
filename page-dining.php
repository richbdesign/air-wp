<?php
/**
 * Template Name: Dining Page
 * Description: Dining page template
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
			<?php wp_reset_query(); ?>
	        <?php
	        $diners = new WP_Query(array('post_type' => 'restaurants', 'posts_per_page' => -1));
	        while ($diners->have_posts()) : $diners->the_post();
	        ?>
				<div class="vendor">
		        	<div class="vendorimage">
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail('vendorthumb', array('class' => 'vendorpic')); } ?>
					</div>
					<div class="vendorcontent">
						<div class="dinertop">
							<h3><?php the_title(); ?></h3>
						</div>
						<div class="dinercontent">
							<?php the_content(); ?>
							<ul>
								<li><span>Hours</span> <?php the_field('restaurant_hours'); ?></li>
								<li><span>Location</span> <?php the_field('restaurant_location'); ?></li>
								<li><span>Phone</span> <?php the_field('restaurant_phone_number'); ?></li>
								<li><span>Payment</span> <?php the_field('restaurant_payment'); ?></li>
							</ul>
						</div>
					</div>
				</div>

	    	<?php endwhile; // end of diners loop. ?>
			<?php wp_reset_query(); ?>
		</div>
	</section>
</div><!-- content -->

<?php get_footer(); ?>