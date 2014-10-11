<?php
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

require_once($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/add/SimpleImage/SimpleImage.php');
$_GET['icrop_path']= $this->GetPath();

$this->StartResultCache(3600);

$this->IncludeComponentTemplate();
?>