<?php
// avoid direct calls to this file where wp core files not present
if (!function_exists ('add_action')) {
    header('Status: 403 Forbidden');
    header('HTTP/1.1 403 Forbidden');
    exit();
}
// class that reperesent the complete plugin
class TestimonialOptions {
    function TestimonialOptions() {
        add_action('admin_post_save_option', array(&$this, 'on_save_changes'));
        add_filter('screen_layout_columns', array(&$this, 'on_screen_layout_columns'), 10, 2);
        add_action('admin_menu', array(&$this, 'on_admin_menu'));
    }
    // extend the admin menu
    function on_admin_menu() {
        add_object_page('Testimonial Solution', "Testimonials", - 1, "testimonials", array(&$this, 'on_show_page'));
        $this->_manage_page_ref = add_submenu_page('testimonials', 'Manage', 'Manage', 'administrator', 'testimonials_manage', array(&$this, 'on_manage_page'));
        $this->_add_new_page_ref = add_submenu_page('testimonials', 'Add New', 'Add New', 'administrator', 'testimonials_add', array(&$this, 'on_show_page'));
        $this->_settings_page_ref = add_submenu_page('testimonials', 'Settings', 'Settings', 'administrator', 'testimonials_settings', array(&$this, 'on_setting_page'));
        add_action( "admin_print_scripts-{$this->_manage_page_ref}", array( $this, 'add_admin_scripts' ) );
        add_action( "admin_print_scripts-{$this->_add_new_page_ref}", array( $this, 'add_admin_scripts' ) );
        add_action( "admin_print_scripts-{$this->_settings_page_ref}", array( $this, 'add_admin_scripts' ) );
        add_action( "admin_print_scripts-{$this->_add_new_page_ref}", array( $this, 'add_tinymce_scripts' ) );
    }
    function add_admin_scripts() {
        wp_enqueue_script('postbox');
    }
    function add_tinymce_scripts() {
        wp_enqueue_script('editor');
        wp_enqueue_script('quicktags');
        add_action( 'admin_print_footer_scripts', 'wp_tiny_mce', 25 );
    }
    function on_screen_layout_columns($columns, $screen) {
        if ($screen == $this->pagehook) {
            $columns[$this->pagehook] = 2;
        }
        return $columns;
    }
    function on_show_page() {
        // add_meta_box('testimonialOption1', 'Manage Testimonials', array(&$this, 'managetestimonial'), $this->pagehook, 'normal', 'core');
        add_meta_box('testimonialOption2', 'Testimonial Details', array(&$this, 'createtestimonial'), $this->pagehook, 'normal', 'core');
        add_meta_box('testimonialOption3', 'Plugin Info', array(&$this, 'plugininfo'), $this->pagehook, 'side', 'core');
        // add_meta_box('testimonialOption4', 'Testimonial custom css', array(&$this, 'testimonialcss'), $this->pagehook, 'normal', 'core');
        add_meta_box('testimonialOption5', 'How to Use This Plugin', array(&$this, 'recommend'), $this->pagehook, 'normal', 'core');
        // we need the global screen column value to beable to have a sidebar in WordPress 2.8
        // global $screen_layout_columns;
        $screen_layout_columns = 1;
        if ($_GET['action'] == 'edit' && $_GET['msg'] != "Testimonial Edited") {
            $title = 'Edit Testimonial';
        } else {
            $title = 'Add New Testimonial';
        }
        ?>
        <div class="wrap">
            <h2><?php echo __($title); ?></h2>
            <div class="bordertitle"></div>
            <br/>
            <?php
            if (isset($_GET['msg'])) { ?>
                <div class='updated'><p><strong><?php echo $_GET['msg']; ?></strong></p></div>
            <?php
            } ?>
            <form action="admin-post.php" method="post" enctype="multipart/form-data">
                <?php wp_nonce_field('themeOptionPage'); ?>
                <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false); ?>
                <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false); ?>
                <input type="hidden" name="action" value="save_option" />
                <div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
                    <div id="side-info-column" class="inner-sidebar">
                        <?php do_meta_boxes($this->pagehook, 'side', $data); ?>
                    </div>
                    <div id="post-body" class="has-sidebar">
                        <div id="post-body-content" class="has-sidebar-content">
                            <?php do_meta_boxes($this->pagehook, 'normal', $data); ?>
                            <?php do_meta_boxes($this->pagehook, 'additional', $data); ?>
                            <br/>
                        </div>
                    </div>
                    <br class="clear"/>
                </div>
            </form>
        </div>
        <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                // close postboxes that should be closed
                $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                // postboxes setup
                postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');
            });
            //]]>
        </script>
        <?php
    }
    function on_manage_page() {
        add_meta_box('testimonialOption5', 'How to Use This Plugin', array(&$this, 'recommend'), $this->pagehook, 'normal', 'core');
        // we need the global screen column value to beable to have a sidebar in WordPress 2.8
        // global $screen_layout_columns;
        $screen_layout_columns = 1;
        ?>
        <div class="wrap">
            <h2><?php echo __('Manage Your Testimonials'); ?></h2>
            <div class="bordertitle"></div>
            <br/>
            <?php
            if (isset($_GET['msg'])) { ?>
                <div class='updated'><p><strong><?php echo $_GET['msg']; ?></strong></p></div>
            <?php
            } ?>
            <form action="admin-post.php" method="post" enctype="multipart/form-data">
                <?php wp_nonce_field('themeOptionPage'); ?>
                <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false); ?>
                <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false); ?>
                <input type="hidden" name="action" value="save_option" />
                <div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
                    <div id="side-info-column" class="inner-sidebar"></div>
                    <div id="post-body" class="has-sidebar">
                        <div id="post-body-content" class="has-sidebar-content">
                            <?php echo $this->managetestimonial(); ?>
                            <?php do_meta_boxes($this->pagehook, 'normal', $data); ?>
                            <br/>
                        </div>
                    </div>
                    <br class="clear"/>
                </div>
            </form>
        </div>
        <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                // close postboxes that should be closed
                $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                // postboxes setup
                postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');
                $(".checkall").click(function() {

                    var checked_status = this.checked;
                    $(".tobedeleted").each(function() {
                        this.checked = checked_status;
                    });
                });
            });
            //]]>
        </script>
    <?php
    }
    function on_setting_page() {
        add_meta_box('testimonialOption3', 'Plugin Info', array(&$this, 'plugininfo'), $this->pagehook, 'side', 'core');
        add_meta_box('testimonialOption4', 'CSS &amp; Settings', array(&$this, 'testimonialcss'), $this->pagehook, 'normal', 'core');
        add_meta_box('testimonialOption5', 'How to Use This Plugin', array(&$this, 'recommend'), $this->pagehook, 'normal', 'core');
        // we need the global screen column value to beable to have a sidebar in WordPress 2.8
        // global $screen_layout_columns;
        $screen_layout_columns = 1;
        ?>
        <div class="wrap">
            <h2><?php echo __('Testimonial Solution Settings'); ?></h2>
            <div class="bordertitle"></div>
            <br/>
            <?php
            if (isset($_GET['msg'])) { ?>
                <div class='updated'><p><strong><?php echo $_GET['msg']; ?></strong></p></div>
            <?php
            } ?>
            <form action="admin-post.php" method="post" enctype="multipart/form-data">
                <?php wp_nonce_field('themeOptionPage'); ?>
                <?php wp_nonce_field('closedpostboxes', 'closedpostboxesnonce', false); ?>
                <?php wp_nonce_field('meta-box-order', 'meta-box-order-nonce', false); ?>
                <input type="hidden" name="action" value="save_option" />
                <div id="poststuff" class="metabox-holder<?php echo 2 == $screen_layout_columns ? ' has-right-sidebar' : ''; ?>">
                    <div id="side-info-column" class="inner-sidebar">
                        <?php do_meta_boxes($this->pagehook, 'side', $data); ?>
                    </div>
                    <div id="post-body" class="has-sidebar">
                        <div id="post-body-content" class="has-sidebar-content">
                            <?php do_meta_boxes($this->pagehook, 'normal', $data); ?>
                            <?php do_meta_boxes($this->pagehook, 'additional', $data); ?>
                            <br/>
                        </div>
                    </div>
                    <br class="clear"/>
                </div>
            </form>
        </div>
        <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                // close postboxes that should be closed
                $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                // postboxes setup
                postboxes.add_postbox_toggles('<?php echo $this->pagehook; ?>');

            });
            //]]>
        </script>
    <?php
    }
    function on_save_changes() {
        if ($_POST['doaction'] == 'Apply') {
            $data = get_option('testimonials_solution');
            if (!empty($_POST['delete_comments'])) {
                foreach ($_POST['delete_comments'] as $arr) {
                    unset($data['data'][$arr]);
                }
                $data['data'] = array_values($data['data']);
                update_option('testimonials_solution', $data);
            }
        }
        if (isset($_POST['CreateTestimonial'])) {
            $data = get_option('testimonials_solution');
            $inputdata['name']      = stripslashes($_POST['name']);
            $inputdata['company']   = stripslashes($_POST['company']);
            $inputdata['url']       = stripslashes($_POST['url']);
            $inputdata['text']      = stripslashes($_POST['text']);
            $inputdata['avatar']    = stripslashes($_POST['avatar']);
            $inputdata['email']     = stripslashes($_POST['email']);
            if ($_FILES['own_avatar']['name'] != "") {
                $overrides  = array('test_form' => false);
                $file       = wp_handle_upload($_FILES['own_avatar'], $overrides);
                if (isset($file['error']))
                    die($file['error']);
                $url = $file['url'];
                $type = $file['type'];
                $file = $file['file'];
                $filename = basename($file);
                // Construct the object array
                $object = array(
                        'post_title' => $filename,
                        'post_content' => $url,
                        'post_mime_type' => $type,
                        'guid' => $url);
                $inputdata['own_avatar'] = $url.$filename;
                // Save the data
                $id = wp_insert_attachment($object, $file);
                list($width, $height, $type, $attr) = getimagesize($file);
                if ($width == $data['imagex'] && $height == $data['imagey']) {
                    $inputdata['own_avatar'] = $url;
                } elseif ($width > $data['imagex']) {
                    $image = image_resize($file, $data['imagex'], $data['imagey'], true, 't', null, 100);
                    $image = apply_filters('wp_create_file_in_uploads', $image, $id); // For replication
                    $url = str_replace(basename($url), basename($image), $url);
                    $inputdata['own_avatar'] = $url;
                } else {
                    $oitar = 1;
                }
            }
            if ($inputdata['own_avatar'] == "") {
                $inputdata['own_avatar'] = $data['data'][$previous_test_id]['own_avatar'];
            }
            $data['data'][] = $inputdata;
            if ($_POST['avatar']=='own_pic' AND (empty($_FILES['own_avatar']['name']))) {
                $alert  = urlencode('Picture not specified. Press back to try again');
            } elseif ($_POST['avatar']=='gravatar' AND (empty($_POST['email']))) {
                $alert  = urlencode('No personal Gravatar specified. Press back to try again');
            } elseif (empty($inputdata['name'])) {
                $alert  = urlencode('Name not specified. Press back to try again');
            }  elseif (empty($inputdata['text'])) {
                $alert  = urlencode('No testimonial entered. Press back to try again');
            } else {
                update_option('testimonials_solution', $data);
                $alert  = urlencode("New Testimonial Created.");
            }
        }
        if (isset($_POST['EditTestimonial'])) {
            $_POST['_wp_http_referer']  = str_replace('testimonials_add','testimonials_manage',$_POST['_wp_http_referer']);
            $data                       = get_option('testimonials_solution');
            $previous_test_id           = $_POST['previous_test_id'];
            $inputdata['name']          = stripslashes($_POST['name']);
            $inputdata['company']       = stripslashes($_POST['company']);
            $inputdata['url']           = stripslashes($_POST['url']);
            $inputdata['text']          = stripslashes($_POST['text']);
            $inputdata['avatar']        = stripslashes($_POST['avatar']);
            $inputdata['email']         = stripslashes($_POST['email']);
            if ($_FILES['own_avatar']['name'] != "") {
                $overrides  = array('test_form' => false);
                $file       = wp_handle_upload($_FILES['own_avatar'], $overrides);
                if (isset($file['error']))
                    die($file['error']);
                $url        = $file['url'];
                $type       = $file['type'];
                $file       = $file['file'];
                $filename   = basename($file);
                // Construct the object array
                $object = array(
                        'post_title' => $filename,
                        'post_content' => $url,
                        'post_mime_type' => $type,
                        'guid' => $url);
                $inputdata['own_avatar'] = $url.$filename;
                // Save the data
                $id = wp_insert_attachment($object, $file);
                list($width, $height, $type, $attr) = getimagesize($file);
                if ($width == $data['imagex'] && $height == $data['imagey']) {
                    $inputdata['own_avatar'] = $url;
                } elseif ($width > $data['imagex']) {
                    $image  = image_resize($file, $data['imagex'], $data['imagey'], true, 't', null, 100);
                    $image  = apply_filters('wp_create_file_in_uploads', $image, $id); // For replication
                    $url    = str_replace(basename($url), basename($image), $url);
                    $inputdata['own_avatar'] = $url;
                } else {
                    $oitar = 1;
                }
            }
            if ($inputdata['own_avatar'] == "") {
                $inputdata['own_avatar'] = $data['data'][$previous_test_id]['own_avatar'];
            }
            $data['data'][$previous_test_id] = $inputdata;
            if ($_POST['avatar']=='own_pic' AND (empty($_FILES['own_avatar']['name'])) AND ($inputdata['own_avatar']=='')) {
                $alert  = urlencode('Picture not specified. Press back to try again');
            } elseif ($_POST['avatar']=='gravatar' AND (empty($_POST['email']))) {
                $alert  = urlencode('No personal Gravatar specified. Press back to try again');
            } elseif (empty($inputdata['name'])) {
                $alert  = urlencode('Name not specified. Press back to try again');
            } elseif (empty($inputdata['text'])) {
                $alert  = urlencode('No testimonial entered. Press back to try again');
            } else {
                update_option('testimonials_solution', $data);
                $alert  = urlencode("Testimonial Edited");
            }
        }
        if (isset($_POST['btnDeleteTestimonial'])) {
            $id     = array_keys($_POST['btnDeleteTestimonial']);
            $data   = get_option('testimonials_solution');
            unset($data['data'][$id[0]]);
            $data['data'] = array_values($data['data']);
            update_option('testimonials_solution', $data);
            $alert  = urlencode("Testimonial Deleted");
        }
        if (isset($_POST['CreateCustomCSS'])) {
            $data               = get_option('testimonials_solution');
			 $data['css-sidebar']  = stripslashes($_POST['css-sidebar']);
            $data['customcss']  = stripslashes($_POST['css']);
            $data['imagex']     = stripslashes($_POST['imagex']);
            $data['imagey']     = stripslashes($_POST['imagey']);
            $data['dorder']     = stripslashes($_POST['dorder']);
            $data['items']      = stripslashes($_POST['items']);
            update_option('testimonials_solution', $data);
            $alert              = urlencode("Custom CSS Saved");
        }
        if (isset($_POST['recommendButton'])) {
            $data               = get_option('testimonials_solution');
            $data['recommend']  = stripslashes($_POST['recommend']);
            update_option('testimonials_solution', $data);
            $alert              = urlencode("Plugin Updated");
        }
        $params = array('msg' => $alert);
        wp_redirect(add_query_arg($params, $_POST['_wp_http_referer']));
    }
    function managetestimonial() {
        $x = 0;
        $data = get_option('testimonials_solution');
        if (($_GET['action'] == 'delete')) {
            $id             = ($_GET['testimonial_id']);
            $data           = get_option('testimonials_solution');
            unset($data['data'][$id]);
            $data['data']   = array_values($data['data']);

            update_option('testimonials_solution', $data);
            echo "Testimonial Deleted<br/>";
        }
        $testimonialboxcount = count($data['data']);
        $p = new pagination;
        $p->items($testimonialboxcount);
        $p->limit(25);
        if (empty($_GET['pg'])) {
            $page = 1;
        } else {
            $page = $_GET['pg'];
        }
        $p->currentPage($page);
        $p->target('admin.php?page=testimonials_manage');
        ?>
        <div class="tablenav">
            <div class='tablenav-pages'>
                 <?php
                 echo $p->show();
				 ?>
            </div>
            <div class = "alignleft actions" > <select name = "act" > <option value = "-1" selected = "selected" > Bulk Actions</option > <option value = "trash" > Delete</option >
                </select > <input type = "submit" name = "doaction" id = "doaction" value = "Apply" class = "button-secondary apply" / >
            </div><br class = "clear" / >
        </div >
        <?php
        // print_r($data);
        if ($testimonialboxcount > 25) {
            $testimonialboxcount = 25;
            // now to make the array smaller
            $newarray = array_slice($data['data'], ($page - 1) * 25, 25);
            $data['data'] = $newarray;
            $testimonialboxcount = count($newarray);
        }
        ?>
        <table class="widefat" cellspacing="0">
            <thead>
                <tr>
                    <th scope="col" id="cb" class="manage-column column-cb check-column" style=""><input type="checkbox" class="checkall"/></th>
                    <th scope="col" width="250px">Name</th>
                    <th scope="col">Testimonial</th>
                </tr>
            </thead>
            <tfoot>
                <tr>
                    <th scope="col" id="cb" class="manage-column column-cb check-column" style=""><input type="checkbox" class="checkall" /></th>
                    <th scope="col">Name</th>
                    <th scope="col">Testimonial</th>
                </tr>
            </tfoot>
            <tbody>
                <?php
                if ($testimonialboxcount == 0) {
                ?>
                    <tr style="background:#eeeeee;">
                        <td colspan="3" align="center"><strong>No testimonial yet, add one below.</strong></td>
                    </tr>
                <?php
                } else {
                    while ($x <$testimonialboxcount) {
                        $num = $x;
                        $num = $num + 1 + ($page - 1) * 25;
                        $url = $data['data'][$x]['url'];
                        if (substr($url, 0, 7) != 'http://') {
                            $url = 'http://' . $url;
                        }
                        if ($data['data'][$x]['avatar']) {
                            if ($data['data'][$x]['avatar'] == "gravatar") {
                                $av = get_avatar($data['data'][$x]['email'], 48);
                            } else {
                                $av = '<img src="' . $data['data'][$x]['own_avatar'] . '" class="avatar" alt="avatar" width="48" height="48" />';
                            }
                        }
                        ?>
                        <tr>
                            <td align="center" valign="top"><input type='checkbox' name='delete_comments[]' class="tobedeleted" value='<?php echo($num - 1); ?>' /></td>
                            <td class="author column-author">
                                <strong><?php echo $av ?> <?php echo $data['data'][$x]['name'] ?></strong><br>
                                <?php echo $data['data'][$x]['company']; ?><br/>
                                <a href="<?php echo $url; ?>"><?php echo $data['data'][$x]['url']; ?></a>
                            </td>
                            <td align="" valign="top"><?php echo $data['data'][$x]['text']; ?>
                                <div class="row-actions"><span class='edit'><a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=testimonials_add&action=edit&testimonial_id=<?php echo ($num - 1);?>" title="Edit this post">Edit</a> | </span><!-- <span class='inline hide-if-no-js'><a href="#" class="editinline" title="Edit this post inline">Quick&nbsp;Edit</a> | </span> --><span class='trash'><a class='submitdelete' title='Move this post to the Trash' href='<?php echo $_SERVER['PHP_SELF']; ?>?page=testimonials_manage&action=delete&testimonial_id=<?php echo ($num - 1);?>'>Delete</a>  </span></div>
                            </td>
                        </tr>
                        <?php
                        $x++;
                    }
                }?>
            </tbody>
        </table>
        <div class="tablenav">
            <div class='tablenav-pages'>
                <?php echo $p->show(); // Echo out the list of paging. ?>
            </div>
            <div class = "alignleft actions" > 
            <select name = "act" > 
            <option value = "-1" selected = "selected" > Bulk Actions</option > 
            <option value = "trash" > Delete</option >
            </select >
            <input type = "submit" name = "doaction" id = "doaction" value = "Apply" class = "button-secondary apply" / >
            </div><br class = "clear" / >
        </div>
        <br />
        <br />
        <a href="<?php echo $_SERVER['PHP_SELF']; ?>?page=testimonials_add" class="button-primary">Add New Testimonial</a>
        <br />
        <br />
    <?php
    }
    function createTestimonial($title) {
        $data = get_option('testimonials_solution');
    ?>
        <a name="addnewTestimonial"></a>
        <table border="0" width="100%" cellspacing="20">
            <tr>
                <td width="16%" align="right" valign="top" >
                    <label for="avatar"><strong>Image:</strong></label>
                </td>
                <td width="84%">
                    <?php
                    if ($_GET['action'] == 'edit' && $_GET['msg'] != "Testimonial Edited") {
                        $data = get_option('testimonials_solution');
                        $testcount = count($data);
                        $test = $data['data'][$_GET['testimonial_id']];
                    }
                    ?>
                    <input type="radio" name="avatar" onclick="document.getElementById('email').style.display = 'block'; document.getElementById('picture_upload').style.display = 'none';" value="gravatar" <?php if ($test['avatar'] == "gravatar") { echo "checked"; } ?> />Use Gravatar
                    <input type="radio" name="avatar" onclick="document.getElementById('picture_upload').style.display = 'block'; document.getElementById('email').style.display = 'none';" value="own_pic" <?php if ($test['avatar'] == "own_pic") { echo "checked";} ?> /> Upload picture
                    <input type="radio" name="avatar" onclick="document.getElementById('email').style.display = 'none'; document.getElementById('picture_upload').style.display = 'none';" value="" <?php if ($test['avatar'] == "") { echo "checked"; }?> />  No Image
                    <br />
                    <div id="email" style="display:<?php if ($test['avatar'] == "gravatar") { echo "block"; } else { echo "none";} ?>; padding:10px 30px; background:#f4f4f4;">
                        <strong>E-Mail:</strong><br /><br />
                        <input name="email" type="text" style="width:100%" value="<?php if ($_GET['action'] == 'edit' && $test['avatar'] != "own_pic") { echo $test['email'];  }?>" /><br />
                        <small>Please enter the gravatar e-mail</small>
                    </div>
                    <div id="picture_upload" style="display:<?php if ($test['avatar'] == "own_pic") { echo "block"; } else { echo "none"; }?>; padding:10px 30px; background:#f4f4f4;">
                        <strong>Upload picture:</strong><br /><br />
                        <input name="own_avatar" type="file" style="width:100%" /><br />
                        <small>Picture will be resized to  <?php echo $data['imagex'];?>x<?php echo $data['imagey'];?> pixels</small>
                        <?php
                        if ($_GET['action'] == 'edit') {
                            if ($test['own_avatar'] != "") { ?>
                                <br /><br />
                                <?php
                                if ($test['avatar'] != "gravatar") { ?>
                                    <strong>Current Image:</strong><br /><br /><img src="<?php echo $test['own_avatar']; ?>" alt="avatar" width="48" height="48"/>
                                <?php
                                }
                            }
                        }
                        ?>
                    </div>
                </td>
            </tr>
            <tr>
                <td width="16%" align="right" valign="top" >
                    <label for="name"><strong>Name:</strong></label>
                </td>
                <td width="84%">
                    <input type="text" name="name" value="<?php if ($_GET['action'] == 'edit') { echo $test['name']; } ?>" style="width:100%;" />
                </td>
            </tr>
            <tr>
                <td width="16%" align="right" valign="top" >
                    <label for="company"><strong>Website Name:</strong></label>
                </td>
                <td width="84%">
                    <input type="text" name="company" value="<?php if ($_GET['action'] == 'edit') { echo $test['company'];} ?>" style="width:100%;" />
                </td>
            </tr>
            <tr>
                <td width="16%" align="right" valign="top" >
                    <label for="url"><strong>Website URL:</strong></label>
                </td>
                <td width="84%">
                    <input type="text" name="url" value="<?php if ($_GET['action'] == 'edit') { echo $test['url'];}?>" style="width:100%;" />
                </td>
            </tr>
            <tr>
                <td width="16%" align="right" valign="top"><label for="text"><strong>Testimonial:</strong></label><br></td>
                <td width="84%">
                    <?php the_editor($test['text'], 'text', '', false, 4); ?>
                </td>
            </tr>
        </table>
        <p style="text-align:right;">
            <?php
            if ($_GET['action'] == 'edit') { ?>
                <input type="hidden" name="previous_test_id" value="<?php echo $_GET['testimonial_id'] ?>" />
                <input type="submit" value="Update Testimonial" class="button-primary" name="EditTestimonial"/>
            <?php
            } else { ?>
                <input type="submit" value="Create Testimonial" class="button-primary" name="CreateTestimonial"/>
            <?php
            } ?>
            <br/>
        </p>
        <style>#text {width:100%} </style>
    <?php
    }

    function plugininfo() {?>
        <table width="100%" border="0" cellspacing="4">
            <tr>
                <td width="80px" valign="top">Plugin Name:</td>
                <td valign="top">Testimonials Solution</td>
            </tr>
            <tr>
                <td valign="top">Version:</td>
                <td valign="top"> 2.0</td>
            </tr>
            <tr>
                <td valign="top">Author:</td>
                <td valign="top"> HuskerInfotech</td>
            </tr>
            <tr>
                <td valign="top">Description:</td>
                <td valign="top">Manage and display testimonials for your blog, product or service.</td>
            </tr>
            <tr>
                <td align="center" colspan="2">
                    <br/>
                    <input type="submit" value="Update" class="button-primary" name="recommendButton"/>
                    <br/><br/>
                </td>
            </tr>
        </table>
    <?php
    }
    function testimonialcss() {
        $data = get_option('testimonials_solution');
        // print_r($data);
        if (empty($data['imagex'])) {
            $data['imagex'] = 48;
        }
        if (empty($data['imagey'])) {
            $data['imagey'] = 48;
        }
        if (empty($data['dorder'])) {
            $data['dorder'] = 'asc';
        }
        if (empty($data['items'])) {
            $data['items'] = 10;
        }
        ?>
        <table border="0" width="100%" cellspacing="20">
         <tr>
                <td width="16%" align="right" valign="top"><label for="css"><strong>Custom CSS For Sidebar:</strong></label><br></td>
                <td width="84%">
                    <textarea name="css-sidebar" style="width:100%; height:200px;">
                        <?php
                        if (!isset($data['css-sidebar']) || $data['css-sidebar'] == "") {
                       echo <<<EOF
		.testimonials_solution_widget{
             margin: 10px 0;
             padding:10px;
             border: 1px dotted #dddddd;
             background: #f4f4f4;
            }
            .testimonials_solution_widget .avatar{
             background:#FFFFFF none repeat scroll 0 0;
             border:1px solid #DDDDDD;
             float:right;
             margin-right:-5px;
             margin-top:-5px;
			 margin-left: 5px;
             padding:2px;
             position:relative;
            }
EOF;
                        } else {
                            echo $data['css-sidebar'];
                        } ?>
                    </textarea>
                    <small>Enter your custom CSS here.</small>
                </td>
            </tr>
            <tr>
                <td width="16%" align="right" valign="top"><label for="css"><strong>Custom CSS:</strong></label><br></td>
                <td width="84%">
                    <textarea name="css" style="width:100%; height:200px;">
                        <?php
                        if (!isset($data['customcss']) || $data['customcss'] == "") {
                            echo <<<EOF
.testimonial{
    margin: 10px 0;
    padding:10px;
    border: 1px dotted #f4f4f4;
    background: #dddddd;
}
.testimonial .avatar {
    background:#FFFFFF none repeat scroll 0 0;
    border:1px solid #DDDDDD;
    float:right;
    margin-right:-5px;
    margin-top:-5px;
    padding:2px;
    position:relative;
}
div.pagination {
    padding: 3px;
    margin: 3px;
    text-align:center;
}
div.pagination a {
    border: 1px solid #dedfde;
    margin-right:3px;
    padding:2px 6px;
    background-position:bottom;
    text-decoration: none;
    color: #0061de;
}
div.pagination a:hover, div.meneame a:active {
    border: 1px solid #000;
    background-image:none;
    background-color:#0061de;
    color: #fff;
}
div.pagination span.current {
    margin-right:3px;
    padding:2px 6px;

    font-weight: bold;
    color: #ff0084;
}
div.pagination span.disabled {
    margin-right:3px;
    padding:2px 6px;

    color: #adaaad;
}
EOF;
                        } else {
                            echo $data['customcss'];
                        } ?>
                    </textarea>
                    <small>Enter your custom CSS here.</small>
                </td>
            </tr>
            <tr>
                <td width="16%" align="right" valign="top"><label for="imagesize"><strong>Image Size</strong></label><br></td>
                <td width="84%">
                    <input name="imagex"  value="<?php echo $data['imagex'] ?>" size="2"/> x  <input name="imagey"  value="<?php echo $data['imagey'] ?>" size="2"/> pixels
                </td>
            </tr>
            <tr>
                <td width="16%" align="right" valign="top"><label for="dorder"><strong>Display Order</strong></label><br></td>
                <td width="84%">
                    <select name="dorder">
                        <option value="asc">Ascending</option>
                        <option value="desc">Descending</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td width="16%" align="right" valign="top"><label for="items"><strong>Items Per Page</strong></label><br></td>
                <td width="84%">
                    <input name="items"  value="<?php echo $data['items'] ?>" />
                </td>
            </tr>
        </table>
        <p style="text-align:right;">
            <input type="submit" value="Save Settings" class="button-primary" name="CreateCustomCSS"/>
            <br/>
        </p>
        <?php
    }
    function recommend() {
        $data = get_option('testimonials_solution');
        ?>
        <table border="0" width="100%" cellspacing="20">
            <tr>
                <td>
                    <p style="font-size:13px;">Just enter new testimonials on this page. You can either display user images from <a href="http://www.gravatar.com">Gravatar.com</a> or upload your own images.</p>
                    <p style="font-size:13px;">A new testimonials page has been created for you for the first time user, or you can also create your own page and paste the following code to display your testimonials:<br /><br />[show_testimonials]<br /><br /></p>
                    <p style="font-size:13px;">To rotate testimonials in your sidebar, use the testimonials widget.</p>
                    <p style="font-size:13px;">You can customize the appearance of the testimonials on your testimonials page as well as the sidebar using the Custom CSS box.</p>
                </td>
            </tr>
        </table>
        <?php
    }
}
$TestimonialOptions = new TestimonialOptions();
class pagination {
    /*
	   Script Name: Paginator Class
	   Script URI: http://www.huskerinfotech.com
	   Description: Class in PHP that allows to use a pagination .
	   Script Version: 0.4
	   Author: huskerinfotech
	   Author URI: http://www.huskerinfotech.com
    */
    /*Default values*/
    var $total_pages    = - 1; //items
    var $limit          = null;
    var $target         = "";
    var $page           = 1;
    var $adjacents      = 2;
    var $showCounter    = false;
    var $className      = "pagination";
    var $parameterName  = "pg";
    var $urlF           = false; //urlFriendly
    /*Buttons next and previous*/
    var $nextT          = "Next";
    var $nextI          = "&#187;"; //&#9658;
    var $prevT          = "Previous";
    var $prevI          = "&#171;"; //&#9668;

    var $calculate      = false;
    // Total items
    function items($value) {
        $this->total_pages  = (int) $value;
    }
    // how many items to show per page
    function limit($value) {
        $this->limit        = (int) $value;
    }
    // Page to sent the page value
    function target($value) {
        $this->target       = $value;
    }
    // Current page
    function currentPage($value) {
        $this->page         = (int) $value;
    }
    // How many adjacent pages should be shown on each side of the current page?
    function adjacents($value) {
        $this->adjacents    = (int) $value;
    }
    // show counter?
    function showCounter($value = "") {
        $this->showCounter  = ($value === true)?true:false;
    }
    // to change the class name of the pagination div
    function changeClass($value = "") {
        $this->className    = $value;
    }

    function nextLabel($value) {
        $this->nextT        = $value;
    }
    function nextIcon($value) {
        $this->nextI        = $value;
    }
    function prevLabel($value) {
        $this->prevT        = $value;
    }
    function prevIcon($value) {
        $this->prevI        = $value;
    }
    // to change the class name of the pagination div
    function parameterName($value = "") {
        $this->parameterName = $value;
    }
    // to change urlFriendly
    function urlFriendly($value = "%") {
        if (eregi('^ *$', $value)) {
            $this->urlF = false;
            return false;
        }
        $this->urlF = $value;
    }
    var $pagination;
    function pagination() {
    }
    function show() {
        if (!$this->calculate) {
            if ($this->calculate()) {
                echo "<div class=\"$this->className\">$this->pagination</div>\n";
            }
        }
    }
    function getOutput() {
        if (!$this->calculate) {
            if ($this->calculate()) {
                return "<div class=\"$this->className\">$this->pagination</div>\n";
            }
        }
    }
    function get_pagenum_link($id) {
        if (strpos($this->target, '?') === false)
            if ($this->urlF)
                return str_replace($this->urlF, $id, $this->target);
            else
                return "$this->target?$this->parameterName=$id";
        else
            return "$this->target&$this->parameterName=$id";
    }
    function calculate() {
        $this->pagination = "";
        $this->calculate == true;
        $error = false;
        if ($this->urlF and $this->urlF != '%' and strpos($this->target, $this->urlF) === false) {
            // Es necesario especificar el comodin para sustituir
            echo "Especificaste un wildcard para sustituir, pero no existe en el target<br />";
            $error = true;
        } elseif ($this->urlF and $this->urlF == '%' and strpos($this->target, $this->urlF) === false) {
            echo "Es necesario especificar en el target el comodin % para sustituir el n?mero de p?gina<br />";
            $error = true;
        }
        if ($this->total_pages <0) {
            echo "It is necessary to specify the <strong>number of pages</strong> (\$class->items(1000))<br />";
            $error = true;
        }
        if ($this->limit == null) {
            echo "It is necessary to specify the <strong>limit of items</strong> to show per page (\$class->limit(10))<br />";
            $error = true;
        }
        if ($error)return false;
        $n = trim($this->nextT . ' ' . $this->nextI);
        $p = trim($this->prevI . ' ' . $this->prevT);
        /* Setup vars for query. */
        if ($this->page)
            $start = ($this->page - 1) * $this->limit; //first item to display on this page
        else
            $start = 0; //if no page var is given, set start to 0
        /* Setup page vars for display. */
        $prev = $this->page - 1; //previous page is page - 1
        $next = $this->page + 1; //next page is page + 1
        $lastpage = ceil($this->total_pages / $this->limit); //lastpage is = total pages / items per page, rounded up.
        $lpm1 = $lastpage - 1; //last page minus 1
        /*
		   Now we apply our rules and draw the pagination object.
		   We're actually saving the code to a variable in case we want to draw it more than once.
        */
        if ($lastpage > 1) {
            if ($this->page) {
                // anterior button
                if ($this->page > 1)
                    $this->pagination .= "<a href=\"" . $this->get_pagenum_link($prev) . "\" class=\"prev\">$p</a>";
                else
                    $this->pagination .= "<span class=\"disabled\">$p</span>";
            }
            // pages
            if ($lastpage <7 + ($this->adjacents * 2)) { // not enough pages to bother breaking it up
                for ($counter = 1; $counter <= $lastpage; $counter++) {
                    if ($counter == $this->page)
                        $this->pagination .= "<span class=\"current\">$counter</span>";
                    else
                        $this->pagination .= "<a href=\"" . $this->get_pagenum_link($counter) . "\">$counter</a>";
                }
            } elseif ($lastpage > 5 + ($this->adjacents * 2)) { // enough pages to hide some
                // close to beginning; only hide later pages
                if ($this->page <1 + ($this->adjacents * 2)) {
                    for ($counter = 1; $counter <4 + ($this->adjacents * 2); $counter++) {
                        if ($counter == $this->page)
                            $this->pagination .= "<span class=\"current\">$counter</span>";
                        else
                            $this->pagination .= "<a href=\"" . $this->get_pagenum_link($counter) . "\">$counter</a>";
                    }
                    $this->pagination .= "...";
                    $this->pagination .= "<a href=\"" . $this->get_pagenum_link($lpm1) . "\">$lpm1</a>";
                    $this->pagination .= "<a href=\"" . $this->get_pagenum_link($lastpage) . "\">$lastpage</a>";
                }
                // in middle; hide some front and some back
                elseif ($lastpage - ($this->adjacents * 2) > $this->page && $this->page > ($this->adjacents * 2)) {
                    $this->pagination .= "<a href=\"" . $this->get_pagenum_link(1) . "\">1</a>";
                    $this->pagination .= "<a href=\"" . $this->get_pagenum_link(2) . "\">2</a>";
                    $this->pagination .= "...";
                    for ($counter = $this->page - $this->adjacents; $counter <= $this->page + $this->adjacents; $counter++)
                        if ($counter == $this->page)
                            $this->pagination .= "<span class=\"current\">$counter</span>";
                        else
                            $this->pagination .= "<a href=\"" . $this->get_pagenum_link($counter) . "\">$counter</a>";
                    $this->pagination .= "...";
                    $this->pagination .= "<a href=\"" . $this->get_pagenum_link($lpm1) . "\">$lpm1</a>";
                    $this->pagination .= "<a href=\"" . $this->get_pagenum_link($lastpage) . "\">$lastpage</a>";
                }
                // close to end; only hide early pages
                else {
                    $this->pagination .= "<a href=\"" . $this->get_pagenum_link(1) . "\">1</a>";
                    $this->pagination .= "<a href=\"" . $this->get_pagenum_link(2) . "\">2</a>";
                    $this->pagination .= "...";
                    for ($counter = $lastpage - (2 + ($this->adjacents * 2)); $counter <= $lastpage; $counter++)
                        if ($counter == $this->page)
                            $this->pagination .= "<span class=\"current\">$counter</span>";
                        else
                            $this->pagination .= "<a href=\"" . $this->get_pagenum_link($counter) . "\">$counter</a>";
                }
            }
            if ($this->page) {
                // siguiente button
                if ($this->page <$counter - 1)
                    $this->pagination .= "<a href=\"" . $this->get_pagenum_link($next) . "\" class=\"next\">$n</a>";
                else
                    $this->pagination .= "<span class=\"disabled\">$n</span>";
                if ($this->showCounter)$this->pagination .= "<div class=\"pagination_data\">($this->total_pages Pages)</div>";
            }
        }
        return true;
    }
}

?>
