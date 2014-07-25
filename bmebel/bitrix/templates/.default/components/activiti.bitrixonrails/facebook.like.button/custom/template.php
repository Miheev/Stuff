<div style="margin:0 0 10px 20px;">
<!-- BitrixOnRails.ru: ��������� facebook.like.button -->
<script src="http://connect.facebook.net/<?=$arParams['LANG']?>/all.js#xfbml=1"></script>
<fb:like <?=$arParams['URL_TO_LIKE'] != '' ? 'href="'.$arParams['URL_TO_LIKE'].'"' : ''?> layout="<?=$arParams['LAYOUT_STYLE']?>" show_faces="<?=$arParams['SHOW_FACES']?>" width="<?=$arParams['WIDTH']?>" action="<?=$arParams['VERB_TO_DISPLAY']?>" font="<?=$arParams['FONT']?>" colorscheme="<?=$arParams['COLOR']?>">
</fb:like>
</div>