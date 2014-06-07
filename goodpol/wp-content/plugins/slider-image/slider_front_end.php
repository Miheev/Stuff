<?php








function showPublishedimages_1($id)
{
 global $wpdb;
 

    $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_itslider_images where slider_id = '".$id."' order by id ASC",$id);
			   $images=$wpdb->get_results($query);
			   

    $query=$wpdb->prepare("SELECT * FROM ".$wpdb->prefix."huge_itslider_sliders where id = '".$id."' order by id ASC",$id);
			   $slider=$wpdb->get_results($query);
			   
			   
   		    $query = "SELECT *  from " . $wpdb->prefix . "huge_itslider_params ";

    $rowspar = $wpdb->get_results($query);

    $paramssld = array();
    foreach ($rowspar as $rowpar) {
        $key = $rowpar->name;
        $value = $rowpar->value;
        $paramssld[$key] = $value;
    }


	
  
	return front_end_slider($images, $paramssld, $slider);
			
			
			
   
}




?>






