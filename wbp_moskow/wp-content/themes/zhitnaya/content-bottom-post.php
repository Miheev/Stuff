<?
	   $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
                <td>
                     <img src="<?=$url?>" width="300"><p align="center"><?=strip_tags(get_the_content());?></p>
                     <p align="center"><a href="<?php the_permalink(); ?>">Подробнее</a></p>
                </td>
