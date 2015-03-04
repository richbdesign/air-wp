<?php 
/**
 * @package WordPress
 */
?>

</div><!-- headerpic -->
<div class="content">
	<section>
		<div class="col-3">
			<?php get_sidebar(); ?>
		</div>
		<div class="col-7 bordered">
			<?php if (is_category()) { ?>
			<h1 class="pagetitle">
				<span><?php _e("Category Archives:", "flywichita"); ?></span> <?php single_cat_title(); ?>
			</h1>
			<?php } elseif (is_tag()) { ?> 
				<h1 class="pagetitle">
					<span><?php _e("Tag Archives:", "flywichita"); ?></span> <?php single_tag_title(); ?>
				</h1>
			<?php } elseif (is_author()) { ?>
				<?php
				if(get_query_var('author_name')) :
				    $curauth = get_user_by('slug', get_query_var('author_name'));
				else :
				    $curauth = get_userdata(get_query_var('author'));
				endif;?>
				<h1 class="pagetitle">
					<span><?php _e("Posts By:", "flywichita"); ?></span> <?php echo $curauth->display_name; ?>
				</h1>
			<?php } elseif (is_day()) { ?>
				<h1 class="pagetitle">
					<span><?php _e("Daily Archives:", "flywichita"); ?></span> <?php the_time('l, F j, Y'); ?>
				</h1>
			<?php } elseif (is_month()) { ?>
			    <h1 class="pagetitle">
			    	<span><?php _e("Monthly Archives:", "flywichita"); ?></span> <?php the_time('F Y'); ?>
			    </h1>
			<?php } elseif (is_year()) { ?>
			    <h1 class="pagetitle">
			    	<span><?php _e("Yearly Archives:", "flywichita"); ?></span> <?php the_time('Y'); ?>
			    </h1>
			<?php } elseif (is_404()) { ?>
			    <h1 class="pagetitle">
			    	<span><?php _e("Error 404", "flywichita"); ?></span>
			    </h1>
			<?php } else { ?>
			    <h1 class="pagetitle">
			    	Air Port News
			    </h1>
			<?php } ?>
				
				<?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
		
					<article <?php post_class(); ?>>
						<h2 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h2>
						<p class="meta">Posted on: <?php echo get_the_date(); ?></p>
						<p><?php the_excerpt(); ?></p>
					</article>
				
				<?php endwhile; ?>
				
				<?php /* Display navigation to next/previous pages when applicable */ ?>
				
				<?php if (  $wp_query->max_num_pages > 1 ) : ?>
				
				  <!-- Begin Pagination -->
				  <?php if (function_exists("emm_paginate")) {
				      emm_paginate();
				  } ?>	        	
				  
				<?php endif; ?>
		</div>
		<div class="col-2">
			<?php get_sidebar('blog'); ?>
		</div>
	</section>
</div><!-- content -->