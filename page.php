<?php
/**
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
			<h1 class="page-title"><?php the_title(); ?></h1>
			<?php the_content(); ?>
		</div>
	</section>
</div><!-- content -->

<?php get_footer(); ?>