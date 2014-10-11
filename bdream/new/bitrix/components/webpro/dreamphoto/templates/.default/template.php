<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<style>
    input.dream_photo {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 665px;
        height: 341px;
        opacity: 0;
    }
</style>

    <div class="dream-photo">
        <? echo CFile::InputFile("dream_photo", 20, $str_IMAGE_ID, false, 2*1024*1024, "IMAGE", "class='dream_photo'"); ?>
        <!--            --><?// echo CFile::InputFile("IMAGE_ID", 20, $str_IMAGE_ID); ?>
        <input type="submit" value="Сохранить" style="display: none;">
        <input type="hidden" name="show_crop" value="1" />
    </div>

<? if (isset($_POST['show_crop']) && strlen($fid) > 0) :?>
    <? echo CFile::ShowImage($fid, 665, 341, "border=0", "", false); ?>
<?php elseif (!empty($arParams['imgpath'])) : ?>
    <img src="<?=GetImageResized($arParams['imgpath'], 665, 341);?>" alt="<?=$arParams['strAlt']?>" />
<?php else : ?>
    <img src="<?=GetImageResized(SITE_TEMPLATE_PATH.'/img/file_upload.jpg', 665, 341);?>" alt="<?=$arParams['strAlt']?>" />
<?php endif; ?>



<script>
    $(document).ready(function(){
        $('input[name="dream_photo"]').change(function(){
            $('.dream-form').eq(0).submit();
            $('body').css('cursor', 'wait');
        });
        $('.abutton.dream_photo').click(function(){
            $('input[name="dream_photo"]').eq(0).click();
        });
    });
</script>
