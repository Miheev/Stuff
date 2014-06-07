<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Sugar & Spice
 */

get_header(); ?>
        <div id="primary" class="content-area">  
            <div id="content" class="site-content" role="main">

            <?php if ( have_posts() ) : ?>

                <?php /* Start the Loop */ ?>
                <?php while ( have_posts() ) : the_post(); ?>

                    <?php
                    if ( of_get_option( 'hp_layout' ) == 'excerpt' ) {
                        get_template_part( 'content', 'loop' );
                    } else if ( of_get_option( 'hp_layout' ) == 'firstfull' ) {
                        get_template_part( 'content', 'firstfull' );                    
                    } else {
                        get_template_part( 'content' );                    
                    }
                    ?>

                <?php endwhile; ?>

                <?php get_template_part('pagination'); ?>

            <?php else : ?>

                <?php get_template_part( 'no-results', 'index' ); ?>

            <?php endif; ?>
                
            </div><!-- #content -->
        </div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>