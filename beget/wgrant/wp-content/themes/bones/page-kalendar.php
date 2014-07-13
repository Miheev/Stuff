<?php get_header();

function mb_str_replace($needle, $replacement, $haystack) {
    return implode($replacement, mb_split($needle, $haystack));
}

?>

			<div id="content">

				<div id="inner-content" class="wrap cf">

						<div id="main" class="m-all t-2of3 d-5of7 cf" role="main">
                            <div class="inner">
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title" itemprop="headline"><?php the_title(); ?></h1>

<!--									<p class="byline vcard">-->
<!--										--><?php //printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
<!--									</p>-->

								</header> <?php // end article header ?>

								<section class="entry-content cf" itemprop="articleBody">
									<?php
										// the content (pretty self explanatory huh)
										the_content();

										/*
										 * Link Pages is used in case you have posts that are set to break into
										 * multiple pages. You can remove this if you don't plan on doing that.
										 *
										 * Also, breaking content up into multiple pages is a horrible experience,
										 * so don't do it. While there are SOME edge cases where this is useful, it's
										 * mostly used for people to get more ad views. It's up to you but if you want
										 * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
										 *
										 * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
										 *
										*/
										wp_link_pages( array(
											'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
											'after'       => '</div>',
											'link_before' => '<span>',
											'link_after'  => '</span>',
										) );


                                    if (isset($_GET['ctime']) && !empty($_GET['ctime']))
                                        $url= 'http://www.roboforex.ru/analytics/economic-calendar/'.$_GET['ctime'];
                                    else
                                        $url= 'http://www.roboforex.ru/analytics/economic-calendar/?utm_source=google&utm_medium=cpc&utm_campaign=economic-calendar&utm_content=calendar';

                                    $ch = curl_init($url);
                                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


                                    $res = curl_exec($ch);
                                    if ($res === false)
                                        throw new \Exception('Could not get reply: ' . curl_error($ch));

                                    $tmp= explode('class="table events', $res);
                                    $tmp2= explode('</table', $tmp[1]);
                                    $mat= '<table class="table events"'. $tmp2[0] .'</table>';
                                    //$mat= str_replace('src="/"', 'src="http://www.roboforex.ru/"', $tmp3);
                                    //echo $mat;
									?>
                                    <div class="ss-caption">
                                        <a href="/kalendar?ctime=recentnext">Текущие</a>
                                        <a href="/kalendar?ctime=today">Сегодня</a>
                                        <a href="/kalendar?ctime=tomorrow">Завтра</a>
                                        <a href="/kalendar?ctime=thisweek">Текущая неделя</a>
                                        <a href="/kalendar?ctime=nextweek">След. неделя</a>
                                    </div>
                                    <?php echo $mat; ?>
                                    <script class="script">
                                     ( function( $ ) {
                                        $(document).ready(function(){
//                                            $.jsonp({
//                                                url:      "http://www.roboforex.ru/analytics/economic-calendar/?utm_source=google&utm_medium=cpc&utm_campaign=economic-calendar&utm_content=calendar",
//                                                success: function(data){
//                                                    //$('script.script').parent().append(data);
//                                                    console.log(data);
//                                                }
//                                            });
                                            $('.e-name img').each (function(){
                                                $(this).attr('src' ,'http://www.roboforex.ru' + $(this).attr('src'));
                                            });
                                        });
                                     } )( jQuery );

                                    </script>
<!--                                    <iframe class="calendar" src="http://www.roboforex.ru/analytics/economic-calendar/?utm_source=google&utm_medium=cpc&utm_campaign=economic-calendar&utm_content=calendar"></iframe>-->
								</section> <?php // end article section ?>

								<footer class="article-footer cf">

								</footer>

								<?php //comments_template(); ?>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry cf">
										<header class="article-header">
											<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
										<section class="entry-content">
											<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>
</div>
						</div>

						<?php get_sidebar(); ?>

				</div>

			</div>
</div></div><!-- h-fix-->
<?php get_footer(); ?>
