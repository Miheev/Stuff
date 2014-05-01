<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="cf">

						<div id="main" class="m-all t-2of3 d-5of7 cf hentry" role="main">
                            <?php echo do_shortcode("[metaslider id=67]"); ?>
<!--                            --><?php //echo do_shortcode("[si-contact-form form='1']"); ?>
<!--                            --><?php //echo do_shortcode('[popupwfancybox id="2"]'); ?>

									<article class="cf">
											<header class="article-header">
												<h1><?php _e( 'Добро Пожаловать!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p>Основная информация</p>
										</section>
										<footer class="article-footer">
												<p>Дополнительная информация</p>
										</footer>
									</article>

						</div>

					<?php get_sidebar(); ?>

				</div>

			</div>

</div></div><!-- h-fix-->
<?php get_footer(); ?>

