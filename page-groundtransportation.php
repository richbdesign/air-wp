<?php
/**
 * Template Name: Ground Transportation Page
 * Description: Ground Transportation page template
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
        echo '<div class="banner" style="background: url('.$large.') no-repeat center center; background-size: cover;">';
    else :
        echo '<div class="banner">'; ?>
<?php endif; ?>
	<section>
		<div class="col-12">
			<form action="http://maps.google.com/maps" method="get" target="_blank" class="directionform">
				<input type="text" name="saddr" placeholder="Enter your address for directions" />
				<input type="hidden" name="daddr" value="2173 Air Cargo Road Wichita, KS 67209" />
			</form>
		</div>
	</section>
</div><!-- banner -->
<div class="content">
	<section>
		<div class="col-12">
			<?php the_content(); ?>
			<?php wp_reset_query(); ?>
		</div>
	</section>
</div><!-- content -->

<?php get_footer(); ?>