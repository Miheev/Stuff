<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>
<style>
    input.dream_photo {
        position: absolute;
        top: 0;
        left: 0;
        display: block;
        width: 154px;
        height: 166px;
        opacity: 0;
        cursor: pointer;
    }
</style>

    <div class="dream-photo">
        <img src="<?=GetImageResized(SITE_TEMPLATE_PATH.'/img/img_add.jpg', 168, 167);?>"  />
<!--        <a class="abutton dream_photo" href="javascript:void(0)">Загрузить</a>-->
<!--        <a class="abutton crop-dream" href="javascript:void(0)" style="display: none;">Сохранить</a>-->
        <? echo CFile::InputFile("dream_photo[]", 20, $str_IMAGE_ID, false, 2*1024*1024, "IMAGE", "class='dream_photo' multiple='multiple'"); ?>
        <!--            --><?// echo CFile::InputFile("IMAGE_ID", 20, $str_IMAGE_ID); ?>
        <input type="submit" value="Сохранить" style="display: none;">
        <input type="hidden" name="show_crop" value="1" />
    </div>





<script>
    $(document).ready(function(){
        $('input[name="dream_photo[]"]').change(function(){
            $('.dream-form').eq(0).submit();
            $('body').css('cursor', 'wait');
        });
        $('.abutton.dream_photo').click(function(){
            $('input[name="dream_photo[]"]').eq(0).click();
        });
    });
</script>
