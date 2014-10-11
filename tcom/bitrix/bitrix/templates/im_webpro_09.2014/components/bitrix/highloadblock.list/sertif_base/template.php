<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$this->setFrameMode(true);

if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}

//echo '<pre>';
//print_r($arResult);
//echo '</pre>';

?>
<div class="sertif clearfix">
<? foreach ($arResult['rows'] as $rid => $row):
    if (!($rid % 3)) echo '<div class="row clearfix">';
    ?>
    <div class="item">
        <h3><?=$row['UF_NAME']?></h3>
        <?
            preg_match('/\/[^\"]*\"/', $row['UF_IMG'], $imgarr);
            $img_path= rtrim($imgarr[0], '"');
            echo CFile::ShowImage($img_path, 250, 999, 'alt=""');
        ?>
    </div>
<?
    if (($rid != 0 && $rid % 4 == 0) || $rid == count($row)-1) echo '</div>';
endforeach; ?>
</div>