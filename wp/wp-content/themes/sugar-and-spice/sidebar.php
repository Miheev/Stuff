<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Sugar & Spice
 */
?>
        <?php do_action( 'before_sidebar' ); ?>
        <?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
        
        <div id="sidebar" class="widget-area" role="complementary">
        
            <?php dynamic_sidebar( 'sidebar-1' ); ?>
        
        </div><!-- #sidebar -->
        
        <?php endif; // end sidebar widget area ?>
