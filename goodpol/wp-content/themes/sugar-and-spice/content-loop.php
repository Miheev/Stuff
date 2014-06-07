<?php
/**
 * @package Sugar & Spice
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('excerpt cf'); ?>>
    <div class="post-thumbnail">
    <?php if (has_post_thumbnail()) { ?>
       <a href="<?php the_permalink(); ?>">
         <?php the_post_thumbnail( ); ?>
       </a>	
    <?php } ?>
    </div>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<?php if ( 'post' == get_post_type() ) : ?>
		<div class="entry-meta">
			<?php sugarspice_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-summary">
		<?php echo get_the_excerpt(); ?>
        <a class="more-link entry-meta" href="<?php the_permalink(); ?>"><?php _e('Continue reading &rarr;', 'sugarspice'); ?></a>
        
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'sugarspice' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-summary -->

</article><!-- #post-## -->
