<?php
/**
 * @package Sugar & Spice
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-meta">
			<?php sugarspice_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
        <?php the_content( __('Continue reading &rarr;', 'sugarspice') ) ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta bottom">
		
		<?php sugarspice_post_meta(); ?>

	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
