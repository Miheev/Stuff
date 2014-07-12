<?php
get_header(); 



if (is_front_page()): ?>
	<div class="wrap wrap_full">
		<div class="wrap__inner slider">
            <div class="slides">
	            <ul align="left" style="width:30%; float:left; list-style:none;">
					<?php 
                        query_posts('category_name=new&posts_per_page=3'); 
                        if ( have_posts() ) :
                            while ( have_posts() ) : the_post(); 
                                get_template_part( 'content', 'left-post' );   			
                            endwhile;
                        endif;
                    ?>
                </ul>
                <video id="player" class="video-js vjs-default-skin"
                       controls preload="auto"
                       poster="/videos/ReVamp.jpeg"
                       >
                    <source src="/videos/ReVamp - Disdain (Live).mp4" type='video/mp4' />
                    <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
                </video>
			</div>
            
            
            
            <div class="slider-content">
                <div class="ContentBoxes ContentBoxes_eventsIP">
                </div>
            </div>

		</div>
        <div align="right">
        <p></p>
        <table cellpadding="40" cellspacing="1">
            <tr>
				<?php 
                    query_posts('category_name=events&posts_per_page=3'); 
                    if ( have_posts() ) :
                        while ( have_posts() ) : the_post(); 
                            get_template_part( 'content', 'bottom-post' );
                        endwhile;
                    endif;
                ?>
            </tr>
        </table>
        </div>
    </div>

 <? else:?>
 
 <?
	if (have_posts()) :  while (have_posts()) : the_post();
		global $post;
        $ii= get_post_type();
		if (substr_count($_SERVER['REQUEST_URI'],'/gallery/') > 0 && $post->post_name != 'gallery'):
			get_template_part( 'content', 'gallery-left' ); 
			?>
                <div class="main-section">
                    <div class="Gallery-title typo--h3 typo--upc typo--brand_color"><?=the_title()?></div>
                    <div class="Gallery-folder_images">
                        <div class="fotorama" data-nav="thumbs">
                        <?
						$my_query = new WP_Query('category_name='.$post->post_name); 
						if ( $my_query->have_posts() ) :
							while ( $my_query->have_posts() ) : $my_query->the_post(); 
								get_template_part( 'content', 'gallery-previews' );   			
							endwhile;
						endif;
						?>    
                        </div>
                    </div>
                    <script>
                    var gal=new LNGallery({
                        source: $(".Gallery-folder_images .fotorama"),
                        target: $(".Gallery-folder_images"),
                        template_name: "bottom_nav",	// стандартный предопределенный шаблон типа "nav_bottom" который задан уже в LNGallery
                        speed:500,


                    });
                    </script>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </div>
            <?
		elseif (substr_count($_SERVER['REQUEST_URI'],'/menu/') > 0 && $post->post_name != 'menu'):
			$str = explode('/menu/',$_SERVER['REQUEST_URI']);
			$def = explode('/',$str[1]);
			if (count($def) > 1 && strlen($def[1]) > 0):
				get_template_part( 'content', 'menu-slev' );
			else:
				get_template_part( 'content', 'menu-flev' );
			endif;
		
		else:
			if (get_post_type() == 'post'):
				get_template_part( 'content', 'event-more' );
			else:
		 		the_content();
			endif;
		endif;
	endwhile; endif; ?>
 
 
 <? endif; ?>
<?php
get_footer();
