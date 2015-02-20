<?php
/**
 * @package WordPress
 */

get_header(); 
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

<section class="main">
	<div class="grid grid-pad">
		<div class="col-1-1 borderdiv">
			<h1 class="page-title">Error 404</h1>
			<h2><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'ventsafe' ); ?></h2>
			<p>It seems we can't find what you're looking for. Try heading back to the <a href="/" title="home page">home page</a>.</p>
		</div>
	</div>s
</section><!-- main -->

<?php get_footer(); ?>