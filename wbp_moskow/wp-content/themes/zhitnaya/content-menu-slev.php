<?
$slug = $post->post_name;
$category = get_category_by_slug( $slug );
$s =  get_category_parents($category->term_id, false, '/', true);
$s = explode('/',$s);
$s = $s[1];

$category = get_category_by_slug( $s );

$args = array(
	'child_of'					=> $category->term_id
	,'parent'                   => $category->term_id
	,'orderby'                  => 'ID'
	,'order'                    => 'ASC'
	,'hide_empty'               => 0
	,'hierarchical'             => 0
	,'exclude'                  => ''
	,'include'                  => ''
	,'number'                   => 0
	,'taxonomy'                 => 'category'
	,'pad_counts'               => false 
);
$categories = get_categories( $args );
?><div class="Market-menu Market-menu_page-cat" style="margin-top:-24px;">
		<div class="Market-nav Market-nav_half" style="background-image:url(/images/menu/<?=$post->post_name?>.jpg)">
	<div class="Market-gap">
		<div class="title">
			<table><tr><td><h1>
				<a href="../" class="nodecor">Кухня</a>&nbsp;→ <? the_title() ?></h1></td></tr></table>
		</div>
		<div class="clear"></div>
	</div>
</div>

<div class="Market-content">
	<div class="with-siblings-wrap">
		<div class="with-siblings">
			<div class="Market-siblings">
    <?
	if( $categories ){
		foreach( $categories as $cat ){ ?>
        <div class="item <?=((substr_count($_SERVER['REQUEST_URI'],'/'.$cat->slug.'/')>0) ? 'itemA' : '')?>">
        <a href="/menu/<?=$s?>/<?=$cat->slug?>/" class="link"><?=$cat->name?></a>
        </div>
		<?
		}
	}
	?>
</div>

			
			<div class="items">
				


				<div class="Market-category">
<?
$cID = get_category_by_slug( $post->post_name );

$my_query = new WP_Query('category__in='.$cID->cat_ID.'&orderby=ID&order=ASC&posts_per_page=50'); 
if ( $my_query->have_posts() ) :
	while ( $my_query->have_posts() ) : $my_query->the_post(); 
		$meta_values = get_post_meta(get_the_ID(), '', false); ?>
		<div class="item">
			<div class="info">
				<div class="name"><? the_title() ?> <div class="mass"><p>/<?=$meta_values["Порция"][0]?></p></div></div>
				<div class="price"><?=$meta_values["Цена"][0]?></div>
			</div>
		</div>
        <?
	endwhile;
endif;


$category = get_category_by_slug( $slug );

$args = array(
	'child_of'					=> $category->term_id
	,'parent'                   => $category->term_id
	,'orderby'                  => 'ID'
	,'order'                    => 'ASC'
	,'hide_empty'               => 0
	,'hierarchical'             => 0
	,'exclude'                  => ''
	,'include'                  => ''
	,'number'                   => 0
	,'taxonomy'                 => 'category'
	,'pad_counts'               => false 
);
$categories = get_categories( $args );

if( $categories ){
	foreach( $categories as $cat ){ ?>
    	<h2 class="Market-category_sub-with-items Market-category_sub-with-items_l1"><?=$cat->name?></h2>
            <div style="padding-left: 20px;">
            
            <?
            $my_query2 = new WP_Query('category__in='.$cat->cat_ID.'&orderby=ID&order=ASC&posts_per_page=50'); 
            if ( $my_query2->have_posts() ) :
                while ( $my_query2->have_posts() ) : $my_query2->the_post(); 
                    $meta_values2 = get_post_meta(get_the_ID(), '', false); ?>
                    <div class="item">
                        <div class="info">
                            <div class="name"><? the_title() ?> <div class="mass"><p>/<?=$meta_values2["Порция"][0]?></p></div></div>
                            <div class="price"><?=$meta_values2["Цена"][0]?></div>
                        </div>
                    </div>
                    <?
                endwhile;
            endif;
			?>
            
            
            </div>
            
            <?
			$cs = get_category_by_slug( $cat->slug );

			$args = array(
				'child_of'					=> $cs->term_id
				,'parent'                   => $cs->term_id
				,'orderby'                  => 'ID'
				,'order'                    => 'ASC'
				,'hide_empty'               => 0
				,'hierarchical'             => 0
				,'exclude'                  => ''
				,'include'                  => ''
				,'number'                   => 0
				,'taxonomy'                 => 'category'
				,'pad_counts'               => false 
			);
			$cs = get_categories( $args );
			
			if( $categories ){
				foreach( $cs as $cs2 ){ ?>
                	<h2 class="Market-category_sub-with-items Market-category_sub-with-items_l2"><?=$cs2->name?></h2>
						<div style="padding-left: 40px;">
                        
                        <?
						$my_query3 = new WP_Query('category__in='.$cs2->cat_ID.'&orderby=ID&order=ASC&posts_per_page=50'); 
						if ( $my_query3->have_posts() ) :
							while ( $my_query3->have_posts() ) : $my_query3->the_post(); 
								$meta_values3 = get_post_meta(get_the_ID(), '', false); ?>
								<div class="item">
									<div class="info">
										<div class="name"><? the_title() ?> <div class="mass"><p>/<?=$meta_values3["Порция"][0]?></p></div></div>
										<div class="price"><?=$meta_values3["Цена"][0]?></div>
									</div>
								</div>
								<?
							endwhile;
						endif;
						?>
                        
                        </div>
			
            <?
				}
			}
	}
}
?>					
				</div>

				
			</div>
			<div class="clear"></div>
		</div>
	</div>
</div>
	<div class="clear"></div>

	</div>
