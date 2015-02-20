<?php
/**
 * Template Name: Landing Page
 * Description: Landing page template
 *
 * @package WordPress
 */

get_header(); 
get_template_part( 'menu', 'index' ); //the  menu + logo/site title ?>

<?php the_post(); ?>
</div><!-- headerpic -->
<div class="landing">
        <section>
                <div class="col-12">
                        <?php the_content(); ?>
                </div>
        </section>
</div><!-- landing -->

<?php get_footer(); ?>