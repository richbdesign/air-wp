<?php
/**
 * @package WordPress
 */
?>
<div class="sidebar"> <!--  the Sidebar -->
    <?php if ( is_active_sidebar( 'blog-sidebar' ) ) : ?> <?php dynamic_sidebar( 'blog-sidebar' ); ?>
    <?php endif; ?>
</div>