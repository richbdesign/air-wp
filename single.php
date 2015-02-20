<?php
/**
 * @package WordPress
 */
 
get_header();  //the Header
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

</div><!-- headerpic -->
<div class="content">
	<section>
		<div class="col-3">
			<?php get_sidebar(); ?>
		</div>
		<div class="col-7 bordered">
			<?php while ( have_posts() ) : the_post(); ?>
			 	
			 	<h1 class="post-title"><?php the_title(); ?></h1>
			 	<article <?php post_class(); ?>>
					<?php the_content(); ?>
				</article>
			 
			 <?php endwhile; ?>
		</div>
		<div class="col-2">
			<?php get_sidebar('blog'); ?>
		</div>
	</section>
</div><!-- content -->

<?php get_footer(); //the Footer ?>