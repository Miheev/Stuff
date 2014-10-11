<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<script src="<?php echo SITE_TEMPLATE_PATH; ?>/add/cropper/dist/cropper.min.js"></script>
<link rel="stylesheet" href="<?php echo SITE_TEMPLATE_PATH; ?>/add/cropper/dist/cropper.css" type="text/css" />

<? if (isset($_POST['show_crop'])) {
    $arr_file = Array(
        "name" => $_FILES['user_img']['name'],
        "size" => $_FILES['user_img']['size'],
        "tmp_name" => $_FILES['user_img']['tmp_name'],
        "type" => "",
        "old_file" => "",
        "del" => "Y",
        "MODULE_ID" => "iblock");
    $fid = CFile::SaveFile($arr_file, "member");
}
?>

<div class="dream-img">
    <div class="left">
        <div class="preview-img"
             style="width:108px; height:108px; text-align: center; overflow: hidden;">
            <?php
            $rsUser = CUser::GetByID($USER->GetID());
            $arUser = $rsUser->Fetch();
            if (isset($arUser["PERSONAL_PHOTO"])) {
                $rsFile = CFile::GetByID($arUser["PERSONAL_PHOTO"]);
                $arFile = $rsFile->Fetch();
                echo CFile::ShowImage($arUser["PERSONAL_PHOTO"], 1024, 768, "border=0", "", false);
            }
            ?>
        </div>
        <p>Аватар</p>
        <a class="abutton user_img" href="javascript:void(0)">Загрузить</a>
        <a class="abutton crop-img" href="javascript:void(0)" style="display: none;">Сохранить</a>
            <? echo CFile::InputFile("user_img", 20, $str_IMAGE_ID, false, 2*1024*1024, "IMAGE", "class='user_img' style='display: none;'"); ?>
<!--            --><?// echo CFile::InputFile("IMAGE_ID", 20, $str_IMAGE_ID); ?>
            <input type="submit" value="Сохранить" style="display: none;">
            <input type="hidden" name="show_crop" value="1" />
    </div>

    <div class="right">
        <div class="source-img" style="width: 335px; height: 335px;">
        <? if (isset($_POST['show_crop']) && strlen($fid) > 0) :?>
                <? echo CFile::ShowImage($fid, 335, 335, "border=0", "", false); ?>
        <?php endif; ?>
        </div>
    </div>
</div>

<? if (isset($_POST['show_crop']) && strlen($fid) > 0) :?>
    <script>
        $(document).ready(function () {
            var $image = $(".source-img img"),
                $dataX = $("#data-x"),
                $dataY = $("#data-y"),
                $dataHeight = $("#data-height"),
                $dataWidth = $("#data-width");

            $image.cropper({
                aspectRatio: 1,
                data:        {
                    x:      50,
                    y:      50,
                    width:  300,
                    height: 300
                },
                preview:     ".preview-img",
                done:        function (data) {
                    $dataX.val(data.x);
                    $dataY.val(data.y);
                    $dataHeight.val(data.height);
                    $dataWidth.val(data.width);
                }
            });

            $('.abutton.user_img').css('display', 'none');
            $('.abutton.crop-img').css('display', 'inline-block');

            $('.crop-img').click(function () {
                out = $image.cropper("getData");
                out.crop = 1;
                out.scale_height= <?php echo $arParams['height']; ?>;
                out.scale_width= <?php echo $arParams['width']; ?>;
                out.fid= <?php echo $fid; ?>;
                out.src = $image.attr('src');
                console.log(out);

                $.post("<?php echo $_GET['icrop_path']; ?>/icrop.php", out, function (data, state) {
                    console.log(state);
                    if (state == 'success') {
                        try {
                            tmp = eval('(' + data + ')');
                            console.log(tmp);
                        }
                        catch (err) {
//                            tmp=data.split('##user_img##');
//                            console.log(tmp[1]);
                            console.log(data);
                        }
                        location.reload();
                    } else
                        console.log(data);
                });
            });
        });
    </script>
<?php endif; ?>

<script>
    $(document).ready(function(){
        $('input[name="user_img"]').change(function(){
            $('.img-crop-form').eq(0).submit();
            $('body').css('cursor', 'wait');
        });
        $('.abutton.user_img').click(function(){
            $('input[name="user_img"]').eq(0).click();
        });
    });
</script>