<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
<?php
$Popupwfb_errors = array();
$Popupwfb_success = '';
$Popupwfb_error_found = FALSE;

// Preset the form fields
$form = array(
	'Popupwfb_width' => '',
	'Popupwfb_timeout' => '',
	'Popupwfb_title' => '',
	'Popupwfb_content' => '',
	'Popupwfb_group' => '',
	'Popupwfb_status' => '',
	'Popupwfb_expiration' => '',
	'Popupwfb_id' => ''
);

// Form submitted, check the data
if (isset($_POST['Popupwfb_form_submit']) && $_POST['Popupwfb_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('Popupwfb_form_add');
	
	$form['Popupwfb_width'] = isset($_POST['Popupwfb_width']) ? $_POST['Popupwfb_width'] : '';
	if ($form['Popupwfb_width'] == '')
	{
		$Popupwfb_errors[] = __('Please enter the popup window width, only number.', 'popupwfb');
		$Popupwfb_error_found = TRUE;
	}
	
	$form['Popupwfb_timeout'] = isset($_POST['Popupwfb_timeout']) ? $_POST['Popupwfb_timeout'] : '';
	if ($form['Popupwfb_timeout'] == '')
	{
		$Popupwfb_errors[] = __('Please enter popup timeout, only number.', 'popupwfb');
		$Popupwfb_error_found = TRUE;
	}

	$form['Popupwfb_title'] = isset($_POST['Popupwfb_title']) ? $_POST['Popupwfb_title'] : '';
	if ($form['Popupwfb_title'] == '')
	{
		$Popupwfb_errors[] = __('Please enter popup title.', 'popupwfb');
		$Popupwfb_error_found = TRUE;
	}
	
	$form['Popupwfb_content'] = isset($_POST['Popupwfb_content']) ? $_POST['Popupwfb_content'] : '';
	if ($form['Popupwfb_content'] == '')
	{
		$Popupwfb_errors[] = __('Please enter popup message.', 'popupwfb');
		$Popupwfb_error_found = TRUE;
	}
	
	$form['Popupwfb_group'] = isset($_POST['Popupwfb_group']) ? $_POST['Popupwfb_group'] : '';
	if ($form['Popupwfb_group'] == '')
	{
		$Popupwfb_errors[] = __('Please select available group for your popup message.', 'popupwfb');
		$Popupwfb_error_found = TRUE;
	}
	
	$form['Popupwfb_status'] = isset($_POST['Popupwfb_status']) ? $_POST['Popupwfb_status'] : '';
	if ($form['Popupwfb_status'] == '')
	{
		$Popupwfb_errors[] = __('Please select popup status.', 'popupwfb');
		$Popupwfb_error_found = TRUE;
	}
	
	$form['Popupwfb_expiration'] = isset($_POST['Popupwfb_expiration']) ? $_POST['Popupwfb_expiration'] : '';
	

	//	No errors found, we can add this Group to the table
	if ($Popupwfb_error_found == FALSE)
	{
		$sql = $wpdb->prepare(
			"INSERT INTO `".Popupwfb_Table."`
			(`Popupwfb_width`, `Popupwfb_timeout`, `Popupwfb_title`, `Popupwfb_content`, `Popupwfb_group`, `Popupwfb_status`, `Popupwfb_expiration`)
			VALUES(%s, %s, %s, %s, %s, %s, %s)",
			array($form['Popupwfb_width'], $form['Popupwfb_timeout'], $form['Popupwfb_title'], $form['Popupwfb_content'], $form['Popupwfb_group'], $form['Popupwfb_status'], $form['Popupwfb_expiration'])
		);
		$wpdb->query($sql);
		
		$Popupwfb_success = __('New details was successfully added.', 'popupwfb');
		
		// Reset the form fields
		$form = array(
			'Popupwfb_width' => '',
			'Popupwfb_timeout' => '',
			'Popupwfb_title' => '',
			'Popupwfb_content' => '',
			'Popupwfb_group' => '',
			'Popupwfb_status' => '',
			'Popupwfb_expiration' => '',
			'Popupwfb_id' => ''
		);
	}
}

if ($Popupwfb_error_found == TRUE && isset($Popupwfb_errors[0]) == TRUE)
{
	?>
	<div class="error fade">
		<p><strong><?php echo $Popupwfb_errors[0]; ?></strong></p>
	</div>
	<?php
}
if ($Popupwfb_error_found == FALSE && strlen($Popupwfb_success) > 0)
{
	?>
	  <div class="updated fade">
		<p><strong><?php echo $Popupwfb_success; ?> <a href="<?php echo POPUPWFB_ADMIN_URL; ?>"><?php _e('Click here', 'popupwfb'); ?></a> 
			<?php _e('to view the details', 'popupwfb'); ?></strong></p>
	  </div>
	  <?php
	}
?>
<script language="JavaScript" src="<?php echo POPUPWFB_PLUGIN_URL; ?>/pages/setting.js"></script>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php _e('Popup with fancybox', 'popupwfb'); ?></h2>
	<form name="Popupwfb_form" method="post" action="#" onsubmit="return _Popupwfb_submit()"  >
      <h3><?php _e('Add details', 'popupwfb'); ?></h3>
      
		<label for="tag-a"><?php _e('Popup width', 'popupwfb'); ?></label>
		<input name="Popupwfb_width" type="text" id="Popupwfb_width" value="500" size="20" maxlength="4" />
		<p><?php _e('Enter your popup window width. (Ex: 500)', 'popupwfb'); ?></p>
		
		<label for="tag-a"><?php _e('Popup timeout', 'popupwfb'); ?></label>
		<input name="Popupwfb_timeout" type="text" id="Popupwfb_timeout" value="3000" size="20" maxlength="5" />
		<p><?php _e('Enter your popup window timeout in millisecond. (Ex: 3000)', 'popupwfb'); ?></p>
		
		<label for="tag-a"><?php _e('Popup title', 'popupwfb'); ?></label>
		<input name="Popupwfb_title" type="text" id="Popupwfb_title" value="" size="50" maxlength="250" />
		<p><?php _e('Enter your popup title.', 'popupwfb'); ?></p>
	  
	  	<label for="tag-a"><?php _e('Popup message', 'popupwfb'); ?></label>
		<?php wp_editor("", "Popupwfb_content"); ?>
		<p><?php _e('Enter your popup message.', 'popupwfb'); ?></p>
		
		<label for="tag-a"><?php _e('Popup display', 'popupwfb'); ?></label>
		<select name="Popupwfb_status" id="Popupwfb_status">
			<option value='YES' selected="selected">Yes</option>
			<option value='NO'>No</option>
		</select>
		<p><?php _e('Please select your popup display status. (Select NO if you want to hide the popup in front end)', 'popupwfb'); ?></p>
		
		<label for="tag-a"><?php _e('Popup group', 'popupwfb'); ?></label>
	    <select name="Popupwfb_group" id="Popupwfb_group">
		<option value=''>Select</option>
		<?php
		$sSql = "SELECT distinct(Popupwfb_group) as Popupwfb_group FROM `".Popupwfb_Table."` order by Popupwfb_group";
		$myDistinctData = array();
		$arrDistinctDatas = array();
		$myDistinctData = $wpdb->get_results($sSql, ARRAY_A);
		$i = 1;
		foreach ($myDistinctData as $DistinctData)
		{
			$arrDistinctData[$i]["Popupwfb_group"] = strtoupper($DistinctData['Popupwfb_group']);
			$i = $i+1;
		}
		for($j=$i; $j<$i+10; $j++)
		{
			$arrDistinctData[$j]["Popupwfb_group"] = "GROUP" . $j;
		}
		//$arrDistinctDatas = array_unique($arrDistinctData, SORT_REGULAR);
		foreach ($arrDistinctData as $arrDistinct)
		{
			?><option value='<?php echo strtoupper($arrDistinct["Popupwfb_group"]); ?>'><?php echo strtoupper($arrDistinct["Popupwfb_group"]); ?></option><?php
		}
		?>
		</select>
		<p><?php _e('Please select available group for your popup message.', 'popupwfb'); ?></p>
		
		<label for="tag-title"><?php _e('Expiration date', 'popupwfb'); ?></label>
		<input name="Popupwfb_expiration" type="text" id="Popupwfb_expiration" value="9999-12-31" maxlength="10" />
		<p><?php _e('Please enter the expiration date in this format YYYY-MM-DD <br /> 9999-12-31 : Is equal to no expire.', 'popupwfb'); ?></p>
	  
      <input name="Popupwfb_id" id="Popupwfb_id" type="hidden" value="">
      <input type="hidden" name="Popupwfb_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button" value="<?php _e('Submit', 'popupwfb'); ?>" type="submit" />
        <input name="publish" lang="publish" class="button" onclick="_Popupwfb_redirect()" value="<?php _e('Cancel', 'popupwfb'); ?>" type="button" />
        <input name="Help" lang="publish" class="button" onclick="_Popupwfb_help()" value="<?php _e('Help', 'popupwfb'); ?>" type="button" />
      </p>
	  <?php wp_nonce_field('Popupwfb_form_add'); ?>
    </form>
</div>
<p class="description">
	<?php _e('Check official website for more information', 'popupwfb'); ?>
	<a target="_blank" href="<?php echo Popupwfb_FAV; ?>"><?php _e('click here', 'popupwfb'); ?></a>
</p>
</div>