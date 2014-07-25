<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
?>
<div id="da-slider" class="da-slider">
 <? foreach ( $arResult['ITEMS'] as $element ) { ?>
 				<div class="da-slide">
					<h2><?=$element['NAME']?></h2>
					<p><?=$element['PREVIEW_TEXT']?></p>
					<div class="da-img"><img src="<?=$element['PREVIEW_PICTURE']['SRC']?>" alt="<?=$element['NAME']?>" /></div>
				</div>
<? } ?>								
				<nav class="da-arrows">
					<span class="da-arrows-prev"></span>
					<span class="da-arrows-next"></span>
				</nav>				
 </div>
 		<script type="text/javascript">
			$(function() {
			
				$('#da-slider').cslider({
				<? if ( $arParams['AUTOSCROL_GALLERY'] == "Y" ) { ?>
					autoplay	: true,
				<? } ?>
				});
			
			});
		</script>	