<?php if(preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF'])) { die('You are not allowed to call this page directly.'); } ?>
<?php
// Form submitted, check the data
if (isset($_POST['frm_Popupwfb_display']) && $_POST['frm_Popupwfb_display'] == 'yes')
{
	$did = isset($_GET['did']) ? $_GET['did'] : '0';
	
	$Popupwfb_success = '';
	$Popupwfb_success_msg = FALSE;
	
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
		// Form submitted, check the action
		if (isset($_GET['ac']) && $_GET['ac'] == 'del' && isset($_GET['did']) && $_GET['did'] != '')
		{
			//	Just security thingy that wordpress offers us
			check_admin_referer('Popupwfb_form_show');
			
			//	Delete selected record from the table
			$sSql = $wpdb->prepare("DELETE FROM `".Popupwfb_Table."`
					WHERE `Popupwfb_id` = %d
					LIMIT 1", $did);
			$wpdb->query($sSql);
			
			//	Set success message
			$Popupwfb_success_msg = TRUE;
			$Popupwfb_success = __('Selected record was successfully deleted.', 'popupwfb');
		}
	}
	
	if ($Popupwfb_success_msg == TRUE)
	{
		?><div class="updated fade"><p><strong><?php echo $Popupwfb_success; ?></strong></p></div><?php
	}
}
?>
<div class="wrap">
  <div id="icon-edit" class="icon32 icon32-posts-post"></div>
    <h2><?php _e('Popup with fancybox', 'popupwfb'); ?>
	<a class="add-new-h2" href="<?php echo POPUPWFB_ADMIN_URL; ?>&amp;ac=add"><?php _e('Add New', 'popupwfb'); ?></a></h2>
    <div class="tool-box">
	<?php
		$sSql = "SELECT * FROM `".Popupwfb_Table."` order by Popupwfb_id desc";
		$myData = array();
		$myData = $wpdb->get_results($sSql, ARRAY_A);
		?>
		<script language="JavaScript" src="<?php echo POPUPWFB_PLUGIN_URL; ?>/pages/setting.js"></script>
		<form name="frm_Popupwfb_display" method="post">
      <table width="100%" class="widefat" id="straymanage">
        <thead>
          <tr>
            <th class="check-column" scope="col"><input type="checkbox" name="Popupwfb_group_item[]" /></th>
			<th scope="col"><?php _e('Id', 'popupwfb'); ?></th>
			<th scope="col"><?php _e('Title', 'popupwfb'); ?></th>
            <th scope="col"><?php _e('Width', 'popupwfb'); ?></th>
			<th scope="col"><?php _e('Timeout', 'popupwfb'); ?></th>
			<th scope="col"><?php _e('Group', 'popupwfb'); ?></th>
			<th scope="col"><?php _e('Status', 'popupwfb'); ?></th>
			<th scope="col"><?php _e('Expiration', 'popupwfb'); ?></th>
          </tr>
        </thead>
		<tfoot>
          <tr>
            <th class="check-column" scope="col"><input type="checkbox" name="Popupwfb_group_item[]" /></th>
			<th scope="col"><?php _e('Id', 'popupwfb'); ?></th>
			<th scope="col"><?php _e('Title', 'popupwfb'); ?></th>
            <th scope="col"><?php _e('Width', 'popupwfb'); ?></th>
			<th scope="col"><?php _e('Timeout', 'popupwfb'); ?></th>
			<th scope="col"><?php _e('Group', 'popupwfb'); ?></th>
			<th scope="col"><?php _e('Status', 'popupwfb'); ?></th>
			<th scope="col"><?php _e('Expiration', 'popupwfb'); ?></th>
          </tr>
        </tfoot>
		<tbody>
			<?php 
			$i = 0;
			if(count($myData) > 0 )
			{
				foreach ($myData as $data)
				{
					?>
					<tr class="<?php if ($i&1) { echo'alternate'; } else { echo ''; }?>">
						<td align="left"><input type="checkbox" value="<?php echo $data['Popupwfb_id']; ?>" name="Popupwfb_group_item[]"></td>
						<td><?php echo $data['Popupwfb_id']; ?></td>
						<td><?php echo stripslashes($data['Popupwfb_title']); ?>
						<div class="row-actions">
						<span class="edit">
						<a title="Edit" href="<?php echo POPUPWFB_ADMIN_URL; ?>&amp;ac=edit&amp;did=<?php echo $data['Popupwfb_id']; ?>"><?php _e('Edit', 'popupwfb'); ?></a> | </span>
						<span class="trash">
						<a onClick="javascript:_Popupwfb_delete('<?php echo $data['Popupwfb_id']; ?>')" href="javascript:void(0);"><?php _e('Delete', 'popupwfb'); ?></a></span> 
						</div>
						</td>
						<td><?php echo $data['Popupwfb_width']; ?></td>
						<td><?php echo $data['Popupwfb_timeout']; ?></td>
						<td><?php echo $data['Popupwfb_group']; ?></td>
						<td><?php echo $data['Popupwfb_status']; ?></td>
						<td><?php echo substr($data['Popupwfb_expiration'],0,10); ?></td>
					</tr>
					<?php 
					$i = $i+1; 
				} 	
			}
			else
			{
				?><tr><td colspan="8" align="center"><?php _e('No records available.', 'popupwfb'); ?></td></tr><?php 
			}
			?>
		</tbody>
        </table>
		<?php wp_nonce_field('Popupwfb_form_show'); ?>
		<input type="hidden" name="frm_Popupwfb_display" value="yes"/>
      </form>	
	  <div class="tablenav">
	  <h2>
	  <a class="button add-new-h2" href="<?php echo POPUPWFB_ADMIN_URL; ?>&amp;ac=add"><?php _e('Add New', 'popupwfb'); ?></a>
	  <a class="button add-new-h2" href="<?php echo POPUPWFB_ADMIN_URL; ?>&amp;ac=set"><?php _e('Popup Setting', 'popupwfb'); ?></a>
	  <a class="button add-new-h2" target="_blank" href="<?php echo Popupwfb_FAV; ?>"><?php _e('Help', 'popupwfb'); ?></a>
	  </h2>
	  </div>
	  <div style="height:5px"></div>
	<h3><?php _e('Plugin configuration option', 'popupwfb'); ?></h3>
	<ol>
		<li><?php _e('Drag and drop the widget (Display entire website)', 'popupwfb'); ?>.</li>
		<li><?php _e('Add popup into specific  post or page using short code', 'popupwfb'); ?></li>
		<li><?php _e('Add directly in to the theme using PHP code', 'popupwfb'); ?></li>
	</ol>
	<p class="description">
		<?php _e('Check official website for more information', 'popupwfb'); ?>
		<a target="_blank" href="<?php echo Popupwfb_FAV; ?>"><?php _e('click here', 'popupwfb'); ?></a>
	</p>
	</div>
</div>