        <li style="padding:15px 0;">
       <?
	   $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
	   ?><img align="left" src="<?=$url?>" width="200" style="margin:10px;"><p style="text-align:center;"><?=strip_tags(get_the_content());?><br /><span style="margin:0 auto;"><a href="<?php the_permalink(); ?>">Подробнее</a> </span>   </p>
        
        </li>
        <br />
