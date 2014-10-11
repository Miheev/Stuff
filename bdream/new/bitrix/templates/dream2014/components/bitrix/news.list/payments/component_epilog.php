<div class="doPay">
<?
if($USER->IsAuthorized()):?>
<?$APPLICATION->IncludeComponent("bitrix:sale.personal.account", ".default", array(
	"SET_TITLE" => "N",
	"DREAM_ID" => $arParams["DREAM_ID"],
	"TYPE_PAY" => $arParams["TYPE_PAY"]	
	),
	false,
	Array('HIDE_ICONS' => 'Y')
);?>
<?else:?>
	<p><?=GetMessage("FOR_ACTION");?><a href="/auth/"><?=GetMessage("AUTHORIZE");?></a></p>
<?endif;?>
</div>
