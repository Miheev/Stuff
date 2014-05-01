<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<div class="wrap">
<?php
$did = isset($_GET['did']) ? $_GET['did'] : '0';

// First check if ID exist with requested ID
$sSql = $wpdb->prepare(
	"SELECT COUNT(*) AS `count` FROM ".Popupwfb_Table."
	WHERE `Popupwfb_id` = %d",
	array($did)
);
$result = '0';
$result = $wpdb->get_var($sSql);

if ($result != '1')
{
	?><div class="error fade"><p><strong><?php _e('Oops, selected details doesnt exist.', 'popupwfb'); ?></strong></p></div><?php
}
else
{
	$Popupwfb_errors = array();
	$Popupwfb_success = '';
	$Popupwfb_error_found = FALSE;
	
	$sSql = $wpdb->prepare("
		SELECT *
		FROM `".Popupwfb_Table."`
		WHERE `Popupwfb_id` = %d
		LIMIT 1
		",
		array($did)
	);
	$data = array();
	$data = $wpdb->get_row($sSql, ARRAY_A);
	
	// Preset the form fields
	$form = array(
		'Popupwfb_width' => $data['Popupwfb_width'],
		'Popupwfb_timeout' => $data['Popupwfb_timeout'],
		'Popupwfb_title' => $data['Popupwfb_title'],
		'Popupwfb_content' => $data['Popupwfb_content'],
		'Popupwfb_group' => $data['Popupwfb_group'],
		'Popupwfb_status' => $data['Popupwfb_status'],
		'Popupwfb_expiration' => $data['Popupwfb_expiration'],
		'Popupwfb_extra1' => $data['Popupwfb_extra1'],
		'Popupwfb_id' => $data['Popupwfb_id']
	);
}
// Form submitted, check the data
if (isset($_POST['Popupwfb_form_submit']) && $_POST['Popupwfb_form_submit'] == 'yes')
{
	//	Just security thingy that wordpress offers us
	check_admin_referer('Popupwfb_form_edit');
	
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
		$sSql = $wpdb->prepare(
				"UPDATE `".Popupwfb_Table."`
				SET `Popupwfb_width` = %s,
				`Popupwfb_timeout` = %s,
				`Popupwfb_title` = %s,
				`Popupwfb_content` = %s,
				`Popupwfb_group` = %s,
				`Popupwfb_status` = %s,
				`Popupwfb_expiration` = %s
				WHERE Popupwfb_id = %d
				LIMIT 1",
				array($form['Popupwfb_width'], $form['Popupwfb_timeout'], $form['Popupwfb_title'], $form['Popupwfb_content'], $form['Popupwfb_group'], $form['Popupwfb_status'], $form['Popupwfb_expiration'], $did)
			);
		$wpdb->query($sSql);
		$Popupwfb_success = __('Details was successfully updated.', 'popupwfb');
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
    <p><strong><?php echo $Popupwfb_success; ?> <a href="<?php echo POPUPWFB_ADMIN_URL; ?>"><?php _e('Click here', 'popupwfb'); ?></a> <?php _e('to view the details', 'popupwfb'); ?></strong></p>
  </div>
  <?php
}
?>
<script language="JavaScript" src="<?php echo POPUPWFB_PLUGIN_URL; ?>/pages/setting.js"></script>
<div class="form-wrap">
	<div id="icon-edit" class="icon32 icon32-posts-post"><br></div>
	<h2><?php _e('Popup with fancybox', 'popupwfb'); ?></h2>
	<form name="Popupwfb_form" method="post" action="#" onsubmit="return _Popupwfb_submit()"  >
      <h3><?php _e('Update details', 'popupwfb'); ?></h3>
	  
	    <label for="tag-a"><?php _e('Popup width', 'popupwfb'); ?></label>
		<input name="Popupwfb_width" type="text" id="Popupwfb_width" value="<?php echo $form['Popupwfb_width']; ?>" size="20" maxlength="4" />
		<p><?php _e('Enter your popup window width. (Ex: 500)', 'popupwfb'); ?></p>
		
		<label for="tag-a"><?php _e('Popup timeout', 'popupwfb'); ?></label>
		<input name="Popupwfb_timeout" type="text" id="Popupwfb_timeout" value="<?php echo $form['Popupwfb_timeout']; ?>" size="20" maxlength="5" />
		<p><?php _e('Enter your popup window timeout in millisecond. (Ex: 3000)', 'popupwfb'); ?></p>
		
		<label for="tag-a"><?php _e('Popup title', 'popupwfb'); ?></label>
		<input name="Popupwfb_title" type="text" id="Popupwfb_title" value="<?php echo esc_html(stripslashes($form['Popupwfb_title'])); ?>" size="50" maxlength="250" />
		<p><?php _e('Enter your popup title.', 'popupwfb'); ?></p>
	  
	  	<label for="tag-a"><?php _e('Popup message', 'popupwfb'); ?></label>
		<?php wp_editor(stripslashes($form['Popupwfb_content']), "Popupwfb_content"); ?>
		<p><?php _e('Enter your popup message.', 'popupwfb'); ?></p>
		
		<label for="tag-a"><?php _e('Popup display', 'popupwfb'); ?></label>
		<select name="Popupwfb_status" id="Popupwfb_status">
			<option value='YES' <?php if($form['Popupwfb_status'] == 'YES') { echo "selected='selected'" ; } ?>>Yes</option>
			<option value='NO' <?php if($form['Popupwfb_status'] == 'NO') { echo "selected='selected'" ; } ?>>No</option>
		</select>
		<p><?php _e('Please select your popup display status. (Select NO if you want to hide the popup in front end)', 'popupwfb'); ?></p>
		
		<label for="tag-a"><?php _e('Popup group', 'popupwfb'); ?></label>
	    <select name="Popupwfb_group" id="Popupwfb_group">
		<option value=''>Select</option>
		<?php
		$sSql = "SELECT distinct(Popupwfb_group) as Popupwfb_group FROM `".Popupwfb_Table."` order by Popupwfb_group";
		$myDistinctData = array();
		$arrDistinctDatas = array();
		$thisselected = "";
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
			if(strtoupper($form['Popupwfb_group']) == strtoupper($arrDistinct["Popupwfb_group"])) 
			{ 
				$thisselected = "selected='selected'" ; 
			}
			?><option value='<?php echo strtoupper($arrDistinct["Popupwfb_group"]); ?>' <?php echo $thisselected; ?>><?php echo strtoupper($arrDistinct["Popupwfb_group"]); ?></option><?php
			$thisselected = "";
		}
		?>
		</select>
		<p><?php _e('Please select available group for your popup message.', 'popupwfb'); ?></p>
		
		<label for="tag-title"><?php _e('Expiration date', 'popupwfb'); ?></label>
		<input name="Popupwfb_expiration" type="text" id="Popupwfb_expiration" value="<?php echo substr($form['Popupwfb_expiration'],0,10); ?>" maxlength="10" />
		<p><?php _e('Please enter the expiration date in this format YYYY-MM-DD <br /> 9999-12-31 : Is equal to no expire.', 'popupwfb'); ?></p>
	  
      <input name="Popupwfb_id" id="Popupwfb_id" type="hidden" value="<?php echo $form['Popupwfb_id']; ?>">
      <input type="hidden" name="Popupwfb_form_submit" value="yes"/>
      <p class="submit">
        <input name="publish" lang="publish" class="button add-new-h2" value="<?php _e('Submit', 'popupwfb'); ?>" type="submit" />
        <input name="publish" lang="publish" class="button add-new-h2" onclick="_Popupwfb_redirect()" value="<?php _e('Cancel', 'popupwfb'); ?>" type="button" />
        <input name="Help" lang="publish" class="button add-new-h2" onclick="_Popupwfb_help()" value="<?php _e('Help', 'popupwfb'); ?>" type="button" />
      </p>
	  <?php wp_nonce_field('Popupwfb_form_edit'); ?>
    </form>
</div>
<p class="description">
	<?php _e('Check official website for more information', 'popupwfb'); ?>
	<a target="_blank" href="<?php echo Popupwfb_FAV; ?>"><?php _e('click here', 'popupwfb'); ?></a>
</p>
</div>