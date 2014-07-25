<?


foreach($arResult["DISPLAY_PROPERTIES"]['maki_houses']['VALUE'] as $k => $v) {
                
    $bigFile = CFile::GetFileArray($v['BIG']);
    $smallFile = CFile::GetFileArray($v['SMALL']); 
    /*
        */    
    $arFilterSmall = array();      
    $arFilterSmall[] = array(
        "name" => "watermark", 
        "position" => 'mc', 
        "size"=>"real", 
        "file"=> $_SERVER['DOCUMENT_ROOT'].'/images/watermark/maki.png'
    );
    $arFileTmp = CFile::ResizeImageGet(
        $bigFile,
        array('width' => 600, 'height' => 700),
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true, $arFilterSmall
    );                                       
         
    $arFileTmpSmall = CFile::ResizeImageGet(
        $smallFile,
        array('width' => 60, 'height' => 60), 
        BX_RESIZE_IMAGE_EXACT,
        true, array()
    );             
                    
    $arResult["DISPLAY_PROPERTIES"]['maki_houses']['VALUE'][$k]['BIG_IMG'] = $arFileTmp;    
    $arResult["DISPLAY_PROPERTIES"]['maki_houses']['VALUE'][$k]['SMALL_IMG'] = $arFileTmpSmall;   
} 

/*  */

//printr($arResult["DISPLAY_PROPERTIES"]['maki_plans']);
if(empty($arResult["DISPLAY_PROPERTIES"]['maki_plans']['FILE_VALUE'][0])) {
    $val = $arResult["DISPLAY_PROPERTIES"]['maki_plans']['FILE_VALUE'];
    unset($arResult["DISPLAY_PROPERTIES"]['maki_plans']['FILE_VALUE']);
    $arResult["DISPLAY_PROPERTIES"]['maki_plans']['FILE_VALUE'][] = $val ;     
}


foreach($arResult["DISPLAY_PROPERTIES"]['maki_plans']['FILE_VALUE'] as $k => $v) {
                
    //$bigFile = CFile::GetFileArray($v['BIG']);
    $arFilterSmall = array();
    /* 
    
    $arFilterSmall[] = array(
        "name" => "watermark", 
        "position" => 'mc', 
        "size"=>"real", 
        "file"=> $_SERVER['DOCUMENT_ROOT'].'/images/watermark/maki.png'
    );   
    */   
    $arFileTmp = CFile::ResizeImageGet(
        $v,
        array('width' => 600, 'height' => 700), 
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true, $arFilterSmall
    );                                       
     
    $arFileTmpSmall = CFile::ResizeImageGet(
        $v,
        array('width' => 150, 'height' => 150), 
        BX_RESIZE_IMAGE_EXACT,
        true, array()
    );       
                
    $arResult["DISPLAY_PROPERTIES"]['maki_plans']['VALUE_BIG_IMG'][$k]= $arFileTmp;   
    $arResult["DISPLAY_PROPERTIES"]['maki_plans']['VALUE_SMALL_IMG'][$k]= $arFileTmpSmall ;   
     
}                                                                                         


if(empty($arResult["DISPLAY_PROPERTIES"]['maki_photo']['FILE_VALUE'][0])) {
    $val = $arResult["DISPLAY_PROPERTIES"]['maki_photo']['FILE_VALUE'];
    unset($arResult["DISPLAY_PROPERTIES"]['maki_photo']['FILE_VALUE']);
    $arResult["DISPLAY_PROPERTIES"]['maki_photo']['FILE_VALUE'][] = $val ;     
}

foreach($arResult["DISPLAY_PROPERTIES"]['maki_photo']['FILE_VALUE'] as $k => $v) {
                
    //$bigFile = CFile::GetFileArray($v['BIG']);
    $arFilterSmall = array();      
    $arFilterSmall[] = array(
        "name" => "watermark", 
        "position" => 'mc', 
        "size"=>"real", 
        "file"=> $_SERVER['DOCUMENT_ROOT'].'/images/watermark/maki.png'
    );  
   
    $arFileTmp = CFile::ResizeImageGet(
        $v,
        array('width' => 600, 'height' => 1500), 
        BX_RESIZE_IMAGE_PROPORTIONAL,
        true, $arFilterSmall
    );  
    
    $arFileTmpSmall = CFile::ResizeImageGet(
        $v,
        array('width' => 60, 'height' => 60), 
        BX_RESIZE_IMAGE_EXACT,
        true, array()
    );    
                                             
                    
    $arResult["DISPLAY_PROPERTIES"]['maki_photo']['VALUE_BIG_IMG'][$k]= $arFileTmp;  
    $arResult["DISPLAY_PROPERTIES"]['maki_photo']['VALUE_SMALL_IMG'][$k]= $arFileTmpSmall ;       
} 

?>