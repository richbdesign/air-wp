<?php
/**
 * @package WordPress
 */
?>
<div class="sidebar"> <!--  the Sidebar -->
    <?php if ( is_active_sidebar( 'default-sidebar' ) ) : ?> <?php dynamic_sidebar( 'default-sidebar' ); ?>
    <?php else : ?><p>You need to drag a widget into your sidebar in the WordPress Admin</p>
    <?php endif; ?>
</div>