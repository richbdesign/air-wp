<?php
/**
 * @package WordPress
 */
?>

<?php
	if ( ! is_front_page() ) {
		get_template_part( 'callout-bottom');
	}
?>

<footer>
	<nav class="footernav">
		<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>
	</nav>
	<div class="col-9">
		<p><strong>Wichita Dwight D. Eisenhower National Airport</strong><br>
			<?php the_field('airport_address', 'option'); ?><br>
			&copy; <?php echo date("Y");?>, Wichita Airport Authority<br>
			An Enterprise Fund of the <a href="http://wichita.gov" title="City of Wichita" target="_blank">City of Wichita</a></p>
	</div>
	<div class="col-3">
		<h4>Follow us</h4>
		<p>Terms &amp; Conditions | Privacy Policy</p>
	</div>
</footer><!--footer -->

<?php wp_footer(); ?>

<script src="<?php echo get_template_directory_uri(); ?>/js/bjqs-1.3.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider-min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/app.min.js"></script>

</body>
</html>