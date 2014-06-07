<!-- pagination -->
		<?php
			if(function_exists('wp_pagenavi')) :
				wp_pagenavi(); 
			else :
		?>
			<div class="wp-pagenavi">
				<div class="alignleft"><?php next_posts_link('&laquo; '.__('Older posts','sugarspice')) ?></div> 
				<div class="alignright"><?php previous_posts_link(__('Newer posts','sugarspice').' &raquo;') ?></div>
			</div>
		<?php endif; ?>      
<!-- /pagination -->