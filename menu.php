<?php 
/**
 * @package WordPresss
 */
?>

<div class="headerpic">
<header>
	<a href="<?php echo home_url();?>" title="<?php echo get_bloginfo('name');?>"><img src="<?php echo get_template_directory_uri(); ?>/images/logo.png" alt="<?php echo get_bloginfo('name');?>" class="logo retina"/></a>
	<nav class="topnav">
		<?php wp_nav_menu( array( 'theme_location' => 'top' ) ); ?>
		<div class="searchbox" style="display: none;">
			<span>Search:</span>
			<?php echo my_search_form(); ?>
		</div>
	</nav>
</header><!-- header -->
<nav class="mainnav">
	<?php wp_nav_menu( array( 'theme_location' => 'primary' ) ); ?>
</nav><!-- mainnav -->