	<div class="wrap wrap_page-content">
		<div class="wrap__inner">
			<div class="lego-blocks">
				<div class="lego-block lego-block_ver">
						<div class="gap typo">
							<h1><? the_title() ?></h1>
<?

/**
 *
 * Build slider for page-holidays and page-photoevents
 * */
$postid = get_the_ID();
$curcat=wp_get_post_categories($postid);
if (array_search('8', $curcat) !==false || array_search('9', $curcat) !==false) :?>
<div class="main-section">
<!--                    <div class="Gallery-title typo--h3 typo--upc typo--brand_color">--><?//=the_title()?><!--</div>-->
                    <div class="Gallery-folder_images">
                        <div class="fotorama" data-nav="thumbs">
                            <?
                            $c = get_the_content();
                            $w = array('<p', '</p>');
                            $f = array('<h3', '</h3>');
                            $c = str_replace($w,$f,$c);
                            echo $c;
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
<?php elseif (array_search('7', $curcat) !==false) :?>
    <div class="main-section">
                <?
                $c = get_the_content();
                $w = array('<p', '</p>');
                $f = array('<h3', '</h3>');
                $c = str_replace($w,$f,$c);
                echo $c;
                ?>

    </div>
    <div class="clear"></div>
<?php else:

$c = get_the_content();
$w = array('<p', '</p>');
$f = array('<h3', '</h3>');
$c = str_replace($w,$f,$c);
echo $c;
?>

							<hr noshade />
						</div>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>