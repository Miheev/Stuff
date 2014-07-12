<?
/*
Template Name: Extra
*/

get_header();
?>
<!--<script>$= jQuery.noConflict();</script>-->
    <div class="wrap wrap_gallery-content">
        <div class="wrap__inner">
            <div class="content content_2col">
                <div class="aside aside_dark">
                    <div class="gallery-cats">
                        <div class="item typo--h3 typo--upc typo--light typo--brand_color-light">
                            <a href="/interior/"><br>
                                Интерьер<br>
                            </a>
                        </div>
                        <div class="item typo--h3 typo--upc typo--light typo--brand_color-light">
                            <a href="/food/"><br>
                                Блюда<br>
                            </a>
                        </div>
                        <div class="item typo--h3 typo--upc typo--light typo--brand_color-light">
                            <a href="/video/"><br>
                                Видео<br>
                            </a>
                        </div>
                        <div class="item typo--h3 typo--upc typo--light typo--brand_color-light">
                            <a href="/photoevents/"><br>
                                Фотографии событий<br>
                            </a>
                        </div>
                        <div class="item typo--h3 typo--upc typo--light typo--brand_color-light">
                            <a href="/holidays/"><br>
                                Фотографии детских праздников<br>
                            </a>
                        </div>
                        <div class="item typo--h3 typo--upc typo--light typo--brand_color-light">
                            <a href="/guests/"><br>
                                Наши гости<br>
                            </a>
                        </div>
                    </div></div>
                <div class="main-section">
                    <div class="Gallery-title typo--h3 typo--upc typo--brand_color"><?=the_title()?></div>
                    <div class="Gallery-folder_images foto-events">
<?php //echo do_shortcode('[metaslider id=2127]');
                $the_query = get_posts( array('category' => '7') );

                foreach ( $the_query as $post ) : setup_postdata( $post ); ?>
                    <div class="post-preview">
                        <a href="<?php the_permalink(); ?>">
                            <h4><?php the_title(); ?></h4>
                            <div><?php the_post_thumbnail('bones-thumb-600'); ?></div>
                        </a>
                    </div>
                <?php endforeach;
                wp_reset_postdata();
?>
                    </div>
                </div>
                <div class="clear"></div>
                <p></p></div>
            <p></p></div>
        <p></p></div>
<br style="clear:both" />
<br />
<?php get_footer(); ?>
