<div class="Market-menu Market-menu_page-cat" style="margin-top:-24px;">
		<div class="Market-category">

	<div class="Market-nav" style="background-image:url(/images/menu/<?=$post->post_name?>.jpg)">
		<div class="Market-gap">
			<div class="title">
				<table><tr><td><h1><? the_title() ?></h1></td></tr></table>
			</div>

			<div class="subcats">
                
                <?
				$slug = $post->post_name;
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
                    
                <div class="item"> 
                
                <a href="/menu/<?=$post->post_name?>/<?=$cat->slug?>/" class="link">
                
                <div class="info">
                <div class="name"><?=$cat->name?></div>
                
                <div class="clear"></div>
                </div>
                <div class="clear"></div>
                </a>
                <div class="clear"></div>
                </div>                    
                    
                    <?
					}
				}
				?>
                
            </div>
        </div>
    </div>