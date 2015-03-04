<?php
/**
 * Template Name: Home Page
 * Description: Home page template
 *
 * @package WordPress
 */

get_header(); 
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

<?php the_post(); ?>
<div class="changebanner">
	<section>
		<h3>It Changes Today</h3>
		<a href="#" title="View our new terminal" class="viewbtn">View our new terminal</a>
	</section>
</div><!-- changebanner -->
<div class="pictures" style="display: none; position: relative;">
	<section>
		<?php include("images/close.svg"); ?>
		<div class="offset-10">
			<div id="slider" class="flexslider">
				<ul class="slides">

					<?php wp_reset_query(); ?>
					<?php
					$imageslides = new WP_Query(array('post_type' => 'terminal-images', 'posts_per_page' => -1));
					while ($imageslides->have_posts()) : $imageslides->the_post();
					?>

					<li><?php if ( has_post_thumbnail() ) { the_post_thumbnail('full', array('class' => 'terminalpic')); } ?></li>

					<?php endwhile; // end of imageslides loop. ?>
					<?php wp_reset_query(); ?>

				</ul>
			</div>
			<div id="carousel" class="flexslider">
				<ul class="slides">
					
					<?php
					$imagethumbs = new WP_Query(array('post_type' => 'terminal-images', 'posts_per_page' => -1));
					while ($imagethumbs->have_posts()) : $imagethumbs->the_post();
					?>

					<li><?php if ( has_post_thumbnail() ) { the_post_thumbnail('full', array('class' => 'terminalpic')); } ?></li>

					<?php endwhile; // end of imagethumbs loop. ?>

				</ul>
			</div>
		</div>
	</section>
</div><!-- pictures -->
<div class="calloutcontainer">
	<div class="transparentfixer"></div>
	<section class="callouts">
		<div class="col-4 thickest">
			<h4>Flight Search</h4>
			Flight Search Data
		</div>
		<div class="col-6 thicker">
			<h4>Parking</h4>
			Parking Data
		</div>
		<div class="col-2">
			<?php get_template_part( 'weather'); ?>
		</div>
	</section>
</div><!-- calloutcontainer -->
</div><!-- headerpic -->
<div class="main">
	<section>
		<div class="col-12">
			<div id="promoslider" class="flexslider">
				<ul class="slides">

				<?php wp_reset_query(); ?>
				<?php
				$promoposts = new WP_Query(array('post_type' => 'promos', 'posts_per_page' => 3, 'orderby' => 'date'));
				while ($promoposts->have_posts()) : $promoposts->the_post();
				?>
							
					<li title="<?php the_title(); ?>"><?php if ( has_post_thumbnail() ) { the_post_thumbnail('full', array('class' => 'promopic')); } ?></li>
							
				<?php endwhile; // end of promoposts loop. ?>
				<?php wp_reset_query(); ?>

				</ul>
			</div>
			<div class="promotitles">
				<ul class="slidenav">
					
					<?php
					$imagetitles = new WP_Query(array('post_type' => 'promos', 'posts_per_page' => 3, 'orderby' => 'date'));
					while ($imagetitles->have_posts()) : $imagetitles->the_post();
					?>

					<li><?php the_title(); ?></li>

					<?php endwhile; // end of imagethumbs loop. ?>

				</ul>
			</div>
		</div>
	</section>
</div><!-- main -->
<div class="bottomcallouts">
	<section>
		<div class="col-3">
			<div class="inner firstinner">
				<h4>News</h4>
				<a href="/news" title="Catch up on the latest at ICT.">
					<span>Catch up on the latest at ICT.</span>
					<?php include("images/circlearrow.svg"); ?>
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="inner">
				<h4>Sign up Today!</h4>
				<a href="#" title="Sign up for our Thank Again! program and get great deals.">
					<span>Sign up for our Thank Again! program and get great deals.</span>
					<?php include("images/circlearrow.svg"); ?>
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="inner">
				<h4>Flight View</h4>
				<a href="http://flightaware.com/live/airport/KICT" title="Fly with one of our many airline partners." target="_blank">
					<span>Fly with one of our many airline partners.</span>
					<?php include("images/circlearrow.svg"); ?>
				</a>
			</div>
		</div>
		<div class="col-3">
			<div class="inner lastinner">
				<h4>Fight Guide</h4>
				<a href="http://aus.fltmaps.com/en" title="Track a flight." target="_blank">
					<span>Track a flight.</span>
					<?php include("images/circlearrow.svg"); ?>
				</a>
			</div>
		</div>
	</section>
</div><!-- callouts -->

<?php get_footer(); ?>