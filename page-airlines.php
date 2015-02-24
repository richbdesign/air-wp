<?php
/**
 * Template Name: Airlines Page
 * Description: Airlines page template
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
	        $planes = new WP_Query(array('post_type' => 'airlines', 'posts_per_page' => -1));
	        while ($planes->have_posts()) : $planes->the_post();
	        ?>
				<div class="vendor">
		        	<div class="vendorimage">
						<?php if ( has_post_thumbnail() ) { the_post_thumbnail('vendorthumb', array('class' => 'vendorpic')); } ?>
					</div>
					<div class="vendorcontent">
						<div class="dinertop">
							<h3><?php the_title(); ?></h3>
							<span>Gates: <?php the_field('airline_gate'); ?></span>
						</div>
						<div class="dinercontent">
							<ul>
								<li><span>Phone</span> <?php the_field('airline_phone_number'); ?></li>
								<?php
									$spnumber = get_field('spanish_phone_number');
									if (!empty($spnumber)) {
										echo '<li><span>En Espa&ntilde;ol</span> '.$spnumber.'</li>';
									}
								?>
								<li><span>Baggage</span> <?php the_field('airline_baggage'); ?></li>
								<li><span>Non-Stop</span> <?php the_field('airline_non_stop'); ?></li>
							</ul>
						</div>
					</div>
				</div>

	    	<?php endwhile; // end of planes loop. ?>
			<?php wp_reset_query(); ?>
		</div>
	</section>
</div><!-- content -->

<?php get_footer(); ?>