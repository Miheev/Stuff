<?php
if (version_compare($wp_version, '2.8', '>=')) {
    class testimonials_solution_widget extends WP_Widget {
        // The widget construct. Mumbo-jumbo that loads our code.
        function testimonials_solution_widget()
		{
            $widget_ops = array('classname' => 'ww1231', 'description' => __("Display and rotate your testimonials"));
            $this->WP_Widget('ww123', __('Testimonials'), $widget_ops);
        }
        function widget($args, $instance)
		{
            extract($args, EXTR_SKIP);
			$data = get_option('testimonials_solution');
			if(trim($data['css-sidebar']) == "")
			{
?>
    	<link rel="stylesheet" type="text/css" href="<?php echo get_site_url(); ?>/wp-content/plugins/testimonials-solution/css/testimonialSidebar.css" media="screen" />
<?php
			}
			else
			{
?>
		    <style type="text/css">
<?php
			echo $data['css-sidebar'];
			}
?>
			</style>
<?php
            $data = $instance;
            widgetcss($data, $widget_id);
            $instanc = get_option('testimonials_solution');
            echo $before_widget;
            if ($data['display'] && $data['display'] < count($instanc['data'])) 
			{
                $testimonialboxValue = $data['display'];
            } 
			else
			{
                $testimonialboxValue = count($instanc['data']);
            }
            if ($data['title'] != "") 
			{
                echo $args['before_title'] . $data['title'] . $args['after_title'];
            }
            $result_array = array();
            if(empty($instanc['data'])) 
			{
                echo '<div class="testimonials_solution_widget" style="text-align:center;">';
                echo '<strong>There are no testimonial yet</strong>';
                echo '</div>';
            }
			else {
                shuffle($instanc['data']);
                $result_array = array_slice($instanc['data'], 0, $testimonialboxValue);
                if ($testimonialboxValue == 0)
				{
                    echo '<div class="testimonials_solution_widget" style="text-align:center;">';
                    echo '<strong>There are no testimonial yet</strong>';
                    echo '</div>';
                }
				else
				{
                    foreach ($result_array as $x) 
					{
                        if ($x != - 1) 
						{
                            $url = $x['url'];
                            if (substr($url, 0, 7) != 'http://') 
							{
                                $url = 'http://' . $url;
                            }
                            $text = stripslashes($x['text']);
                            echo '<div class="testimonials_solution_widget">';
                            if ($x['avatar']) 
							{
                                if ($x['avatar'] == "gravatar") 
								{
                                    echo get_avatar($x['email'], $size = '48');
                                } 
								else
								{
                                    echo '<img src="' . $x['own_avatar'] . '" class="avatar" alt="avatar" width="48" height="48" />';
                                }
                            }
                            echo nl2br($text);
                            echo '<br /><br /><strong>' . stripslashes($x['name']) . '</strong><br />';
                            if ($x['url']) 
							{
                                echo '<a href="' . stripslashes($url) . '">';
                            }
                            if ($x['company']) 
							{
                                echo stripslashes($x['company']);
                            }
                            if ($x['url']) 
							{
                                echo '</a>';
                            }
                            echo '</div>';
                        }
                    }
                    if ($data['page_link'] != "no_page") 
					{
                        echo '<div style="width:100%;text-align:right; display:block;"><a href="';
                        if ($data['page_link'] == "") 
						{
                            get_permalink($instance['page_id']);
                        }
						else 
						{
                            echo $data['page_link'];
                        }
                        echo '"> Read more&rsaquo;&rsaquo; </a></div>';
                    }
                }
            }
            echo $after_widget;
        } // End function widget.
        // Updates the settings.
        function update($new_instance, $old_instance) 
		{
            return $new_instance;
        } // End function update
        // The admin form.
        function form($instance) 
		{
            if (empty($instance['display'])) 
			{
                $instance['display'] = "3";
            }
            if (empty($instance['title'])) 
			{
                $instance['title'] = "Testimonials";
            }
            ?>
            <p>
            <label>Widget Title:<br />
            <input name="<?php echo $this->get_field_name("title") ?>" type="text" value="<?php echo htmlspecialchars($instance['title'], ENT_QUOTES); ?>" style="width:100%;" />
            </label>
            </p>
            <p>
            <label>No. of items to rotate:<br />
            <input type="text" name="<?php echo $this->get_field_name("display") ?>" value="<?php echo htmlspecialchars($instance['display'], ENT_QUOTES); ?>" style="width:100%;" />
            </label>
            </p>
            <p>
            <label>Full testimonials page:<br />
	        <select name="<?php echo $this->get_field_name("page_link") ?>" style="width:100%">
            <?php
            add_filter('posts_where', 'filter_testimonial');
            query_posts($query_string);
            if (have_posts()) : while (have_posts()) : the_post();
            ?>
            <option value="<?php the_permalink(); ?>" 
			<?php if ($data['page_link'] == "") 
			{
                if (get_permalink($instance['page_id']) == get_permalink()) 
				{
                       echo "selected";
                }
            } 
			else 
			{
                if ($data['page_link'] == get_permalink()) 
				{
                       echo "selected";
                }
            }

             ?>>
			 <?php the_title(); ?>
             </option>
             <?php
              endwhile;
              else:
             ?>
             <option value="no_page">No page with testimonial short code</option>
             <?php
             endif;
             wp_reset_query();
             ?>
	        </select>
            </label>
            </p>
            <?php
            } // end function form
            } // end class WP_Widget_BareBones
                // Register the widget.
 		   add_action('widgets_init', create_function('', 'return register_widget("testimonials_solution_widget");'));
			}
			else 
			{
					add_action("widgets_init", array('testimonials_solution_widget', 'register'));
					register_activation_hook(__FILE__, array('testimonials_solution_widget', 'activate'));
					register_deactivation_hook(__FILE__, array('testimonials_solution_widget', 'deactivate'));
					class testimonials_solution_widget {
					function activate() {
											$data = array('title' => 'Testimonials' , 'display' => '3' ,);
											update_option('testimonials_solution_widget' , $data);
										}
					function deactivate() {
												delete_option('testimonials_solution_widget');
										   }
		
					function control() {
											$data = get_option('testimonials_solution_widget');
											if (!isset($data['display']) || $data['display'] == "") {
											$data['display'] = "3";
										}
										if (!isset($data['title']) || $data['title'] == "") {
											$data['title'] = "Testimonials";
										}
						
					?>
		<p>
        <label>Widget Title:<br />
        <input name="title" type="text" value="<?php echo htmlspecialchars($data['title'], ENT_QUOTES); ?>" style="width:100%;" />
        </label>
        </p>
		<p>
        <label>No. of items to rotate:<br />
        <input type="text" name="display" value="<?php echo htmlspecialchars($data['display'], ENT_QUOTES); ?>" style="width:100%;" />
        </label>
        </p>
		<p>
        <label>Custom CSS:<br />
        <textarea name="customcss" style="width:100%; height:200px;"><?php echo htmlspecialchars($data['customcss'], ENT_QUOTES); ?></textarea>
        </label>
        </p>
		<p><label>Full testimonials page:<br />
		<select name="page_link" style="width:100%">
					<?php
					add_filter('posts_where', 'filter_testimonial');
					query_posts($query_string);
					if (have_posts()) : while (have_posts()) : the_post();
					?>
					<option value="<?php the_permalink(); ?>" <?php if ($data['page_link'] == "") {
											if (get_permalink($instance['page_id']) == get_permalink()) {
												echo "selected";
											}
										} else {
											if ($data['page_link'] == get_permalink()) {
												echo "selected";
												}
										}
										?>><?php the_title(); ?></option>
									<?php
									endwhile;
								else:
									?>
					<option value="no_page">No page with testimonial short code</option>
								<?php
										endif;
										// Reset Query
										wp_reset_query();
		
										?>
				</select></label></p>
								<?php
								if (isset($_POST['title'])) {
									$data['title'] = attribute_escape($_POST['title']);
									$data['display'] = attribute_escape($_POST['display']);
									$data['customcss'] = attribute_escape($_POST['customcss']);
									$data['page_link'] = $_POST['page_link'];
						update_option('testimonials_solution_widget', $data);
            }
        }

        function widget($args) {
            extract($args, EXTR_SKIP);
            $data = get_option('testimonials_solution_widget');
            $instance = get_option('testimonials_solution');
            echo $args['before_widget'];
            if ($data['display'] && $data['display'] < count($instance['data'])) {
                $testimonialboxValue = $data['display'];
            } else {
                $testimonialboxValue = count($instance['data']);
            }
            if ($data['title'] != "") {
                echo $args['before_title'] . $data['title'] . $args['after_title'];
            }
            $result_array = array();
            while (count($result_array) < $testimonialboxValue) {
                $num = array_rand($instance['data']);
                if (!in_array($num, $result_array)) {
                    $result_array[] = $num;
                }
            }
            if ($testimonialboxValue == 0) {
                echo '<div class="testimonials_solution_widget" style="text-align:center;">';
                echo '<strong>There are no testimonial yet</strong>';
                echo '</div>';
            } else {
                foreach ($result_array as $x) {
                    if ($x != - 1) {
                        $url = $instance['data'][$x]['url'];
                        if (substr($url, 0, 7) != 'http://') {
                            $url = 'http://' . $url;
                        }
                        $text = stripslashes($instance['data'][$x]['text']);
                        echo '<div class="testimonials_solution_widget">';
                        if ($instance['data'][$x]['avatar']) {
                            if ($instance['data'][$x]['avatar'] == "gravatar") {
                                echo get_avatar($instance['data'][$x]['email'], $size = '48');
                            } else {
                                echo '<img src="' . $instance['data'][$x]['own_avatar'] . '" class="avatar" alt="avatar" width="48" height="48" />';
                            }
                        }
                        echo $text;
                        echo '<br /><br /><strong>' . stripslashes($instance['data'][$x]['name']) . '</strong><br />';
                        if ($instance['data'][$x]['url']) {
                            echo '<a href="' . stripslashes($url) . '">';
                        }
                        if ($instance['data'][$x]['company']) {
                            echo stripslashes($instance['data'][$x]['company']);
                        }
                        if ($instance['data'][$x]['url']) {
                            echo '</a>';
                        }
                        echo '</div>';
                    }
                }
                if ($data['page_link'] != "no_page") {
                    echo '<div style="width:100%;text-align:right; display:block;"><a href="';
                    if ($data['page_link'] == "") {
                        get_permalink($instance['page_id']);
                    } else {
                        echo $data['page_link'];
                    }
                    echo '"> Read more&rsaquo;&rsaquo; </a></div>';
                }
            }
            echo $args['after_widget'];
        }
        function register() {
            register_sidebar_widget('Testimonials Solution', array('testimonials_solution_widget', 'widget'));
            register_widget_control('Testimonials Solution', array('testimonials_solution_widget', 'control'));
        }
    }
}

?>