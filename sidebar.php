<?php
/**
 * @package WordPress
 */
?>
<div class="sidebar"> <!--  the Sidebar -->
    <?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?> <?php dynamic_sidebar( 'default-sidebar' ); ?>
    <?php endif; ?>
</div>