<? get_header(); ?>

<div class="wrap wrap_page-title">
	<div class="wrap__inner">
		<h1 class="page-title typo--h1">Пресса о ресторане</h1>
	</div>
</div>

<div class="wrap wrap_page-content">
	<div class="wrap__inner">
    	<? 
			if (have_posts()) :  
				while (have_posts()) : 
					the_post();
					global $post;  
					get_template_part( 'content', 'news-list' );
				endwhile; 
			endif; 
		?>
    </div>
</div>

<? get_footer(); ?>