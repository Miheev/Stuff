<div class='wrap'>
<div id="icon-options-general" class="icon32"></div>
<h2><?php echo sprintf(__('Shareaholic: App Manager', 'shareaholic')); ?></h2>

<div class='reveal-modal' id='editing_modal'>
  <div id='iframe_container' class='bg-loading-img' allowtransparency='true'></div>
  <a class="close-reveal-modal">&#215;</a>
</div>

<script>
window.first_part_of_url = '<?php echo Shareaholic::URL . '/publisher_tools/' . $settings['api_key']?>/';
window.verification_key = '<?php echo $settings['verification_key'] ?>'
</script>

<div class='unit size3of5'>
  <form name="settings" method="post" action="<?php echo $action; ?>">
  <?php wp_nonce_field($action, 'nonce_field') ?>
  <input type="hidden" name="already_submitted" value="Y">

  <div id='app_settings'>

  <fieldset class="app" style="line-height:18px;"><?php echo sprintf(__('First time here? Read %sUnderstanding the new Shareaholic for WordPress interface and configuration settings.%s', 'shareaholic'), '<a href="https://blog.shareaholic.com/understanding-the-new-shareaholic-for-wordpress-interface-and-configuration-settings/" target="_blank">','</a>'); ?> <?php echo sprintf(__('If you are upgrading from an earlier version of Shareaholic for WordPress and need help, have a question or have a bug to report, please %slet us know%s.', 'shareaholic'), '<a href="#" onclick="SnapEngage.startLink();">','</a>'); ?>
  </fieldset>

  <fieldset class="app"><legend><h2><img src="<?php echo SHAREAHOLIC_ASSET_DIR; ?>img/sharebuttons@2x.png" height=32 width=32 /> <?php echo sprintf(__('Share Buttons', 'shareaholic')); ?></h2></legend>
  <span class="helper"><i class="icon-star"></i> <?php echo sprintf(__('Pick where you want your buttons to be displayed. Click "Customize" to customize look & feel, themes, share counters, alignment, etc.', 'shareaholic')); ?></span>

    <?php foreach(array('post', 'page', 'index', 'category') as $page_type) { ?>
    <fieldset id='sharebuttons'>
      <legend><?php echo ucfirst($page_type) ?></legend>
      <?php foreach(array('above', 'below') as $position) { ?>
        <?php if (isset($settings['location_name_ids']['share_buttons']["{$page_type}_{$position}_content"])) { ?>
          <?php $location_id = $settings['location_name_ids']['share_buttons']["{$page_type}_{$position}_content"] ?>
        <?php } else { $location_id = ''; } ?>
          <div>
            <input type="checkbox" id="share_buttons_<?php echo "{$page_type}_{$position}_content" ?>" name="share_buttons[<?php echo "{$page_type}_{$position}_content" ?>]" class="check"
            <?php if (isset($share_buttons["{$page_type}_{$position}_content"])) { ?>
              <?php echo ($share_buttons["{$page_type}_{$position}_content"] == 'on' ? 'checked' : '') ?>
            <?php } ?>>
            <label for="share_buttons_<?php echo "{$page_type}_{$position}_content" ?>"><?php echo ucfirst($position) ?> Content</label>
            <button data-app='share_buttons'
                    data-location_id='<?php echo $location_id ?>'
                    data-href='share_buttons/locations/{{id}}/edit'
                    class="btn btn-success">
            <?php _e('Customize', 'shareaholic'); ?></button>
          </div>
      <?php } ?>
    </fieldset>
    <?php } ?>
  </fieldset>

  <div class='clear'></div>

  <fieldset class="app"><legend><h2><img src="<?php echo SHAREAHOLIC_ASSET_DIR; ?>img/related_content@2x.png" height=32 width=32 /> <?php echo sprintf(__('Related Content / Recommendations', 'shareaholic')); ?></h2></legend>
  <span class="helper"><i class="icon-star"></i> <?php echo sprintf(__('Pick where you want Related Content to be displayed. Click "Customize" to customize look & feel, themes, block lists, etc.', 'shareaholic')); ?></span>
    <?php foreach(array('post', 'page', 'index', 'category') as $page_type) { ?>
      <?php foreach(array('below') as $position) { ?>
        <?php if (isset($settings['location_name_ids']['recommendations']["{$page_type}_{$position}_content"])) { ?>
          <?php $location_id = $settings['location_name_ids']['recommendations']["{$page_type}_{$position}_content"] ?>
        <?php } else { $location_id = ''; } ?>
        <fieldset id='recommendations'>
          <legend><?php echo ucfirst($page_type) ?></legend>
            <div>
              <input type="checkbox" id="recommendations_<?php echo "{$page_type}_below_content" ?>" name="recommendations[<?php echo "{$page_type}_below_content" ?>]" class="check"
              <?php if (isset($recommendations["{$page_type}_below_content"])) { ?>
                <?php echo ($recommendations["{$page_type}_below_content"] == 'on' ? 'checked' : '') ?>
              <?php } ?>>
              <label for="recommendations_<?php echo "{$page_type}_below_content" ?>"><?php echo ucfirst($position) ?> Content</label>
              <button data-app='recommendations'
                      data-location_id='<?php echo $location_id ?>'
                      data-href="recommendations/locations/{{id}}/edit"
                      class="btn btn-success">
              <?php _e('Customize', 'shareaholic'); ?></button>
            </div>
          <?php } ?>
      </fieldset>
    <?php } ?>

    <div class='clear'></div>

    <strong><?php echo sprintf(__('Related Content:', 'shareaholic')); ?></strong>
    <?php
	    $status = ShareaholicUtilities::recommendations_status_check();
	    if ($status == "processing" || $status == 'unknown'){
	      echo '<img class="shrsb_health_icon" align="top" src="'.SHAREAHOLIC_ASSET_DIR.'img/circle_yellow.png" />'. sprintf(__('Processing', 'shareaholic'));
	    } else {
	      echo '<img class="shrsb_health_icon" align="top" src="'.SHAREAHOLIC_ASSET_DIR.'img/circle_green.png" />'. sprintf(__('Ready', 'shareaholic'));
	    }
	  ?>

  </fieldset>
  </div>

  <div class='clear'></div>
  <div class="row" style="padding-top:20px; padding-bottom:35px;">
    <div class="span2"><input type='submit' onclick="this.value='<?php echo sprintf(__('Saving Changes...', 'shareaholic')); ?>';" value='<?php echo sprintf(__('Save Changes', 'shareaholic')); ?>'></div>
  </div>
  </form>
</div>
<?php ShareaholicUtilities::load_template('why_to_sign_up', array('url' => Shareaholic::URL)) ?>
</div>


<?php ShareaholicAdmin::show_footer(); ?>
<?php ShareaholicAdmin::include_snapengage(); ?>
