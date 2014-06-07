<?php

if (function_exists('current_user_can'))
    if (!current_user_can('manage_options')) {
        die('Access Denied');
    }
if (!function_exists('current_user_can')) {
    die('Access Denied');
}



function      html_showStyles($param_values, $op_type)
{


    ?>
	<?php $path_site = plugins_url("images", __FILE__); ?>
<div class="wrap">
	
<div id="poststuff">
	<div class="updated">
		<p><strong>Slider Options is disabled in free version. If you need this functionality, you need to buy the commercial version.</strong></p>
	</div>
	<div class="slider-options-head">
		<div style="float: left;">
			<div><a href="http://huge-it.com/wordpress-plugins-slider-user-manual/" target="_blank">User Manual</a></div>
			<div>This section allows you to configure the Slider options. <a href="http://huge-it.com/wordpress-plugins-slider-user-manual/" target="_blank">More...</a></div>
		</div>
		<div style="float: right;">
			<a class="header-logo-text" href="http://huge-it.com/slider/" target="_blank">
				<div><img width="250px" src="<?php echo $path_site; ?>/huge-it1.png" /></div>
				<div>Get the full version</div>
			</a>
		</div>
	</div>
		<input type="hidden" id="type" name="type" value="<?php echo isset($_POST['type']) ? $_POST['type'] : '1'; ?>"/>
 
		<div id="post-body-content" class="slider-options">
			<div id="post-body-heading">
				<h3>Slides Options</h3>
				

				<a class="save-slider-options button-primary">Save</a>
			</div>
			<div id="slider-options-list">
			<div>
				<img src="<?php echo $path_site; ?>/options-pic.jpg" />
			</div>
		</div>
	</div>
</div>
</div>
<input type="hidden" name="option" value=""/>
<input type="hidden" name="task" value=""/>
<input type="hidden" name="controller" value="options"/>
<input type="hidden" name="op_type" value="styles"/>
<input type="hidden" name="boxchecked" value="0"/>




<?php
}
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  
	  