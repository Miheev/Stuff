<?
$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
?>
<div class="Articles-index Articles-index_lego lego-blocks">
    <div class="lego-block lego-block_ver item">
        <div class="lego-block__content">
            <div class="gap typo">
                <a href="<?php the_permalink(); ?>" class="name"><? the_title() ?></a>
				<? the_content() ?>
                <hr class="separator" noshade />
            </div>
        </div>
        <div class="lego-block__image">
            <div class="gap">
                <a href="<?php the_permalink(); ?>"><img src="<?=$url?>" /></a>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>