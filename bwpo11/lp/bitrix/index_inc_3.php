<div id="usl-block-3-2">
    <div class="width-list">
        <div class="content clearfix">
            <div class="left">
                <img src="<?= SITE_TEMPLATE_PATH ?>/images/cert/partner-002.jpg" />
            </div>
            <div class="right">
                <div class="block-name">У нас сертифицированные разработчики!</div>
                <div class="row clearfix">
                    <div class="item">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/cert/doc1-page-001.jpg" />

                        <p class="label">
                            &laquo;Технология композитный сайт&raquo;
                        </p>
                    </div>
                    <div class="item">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/cert/doc2-page-001.jpg" />

                        <p class="label">
                            &laquo;Администратор. Бизнес&raquo;
                        </p>
                    </div>
                    <div class="item">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/cert/doc3-page-001.jpg" />

                        <p class="label">
                            &laquo;Контент-менеджер&raquo;
                        </p>
                    </div>
                </div>
                <div class="row clearfix">
                    <div class="item">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/cert/doc4-page-001.jpg" />

                        <p class="label">
                            &laquo;Администратор. Модули&raquo;
                        </p>
                    </div>
                    <div class="item">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/cert/doc5-page-001.jpg" />

                        <p class="label">
                            &laquo;Разработчки Bitrix Framework&raquo;
                        </p>
                    </div>
                    <div class="item">
                        <img src="<?= SITE_TEMPLATE_PATH ?>/images/cert/doc6-page-001.jpg" />

                        <p class="label">
                            &laquo;Администратор. Базовый&raquo;
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){

        $('#usl-block-3-2 .item img').click(function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).css({
                '-webkit-transition' : 'width 1s, height 1s,-webkit-transform 1s',
                'transition' : 'width 1s, height 1s, transform 1s'
            });
            if (!$(this).hasClass('hover'))
                $(this).addClass('hover');
        });
        $('body').click(function(){
            $('#usl-block-3-2 .item img').each(function(){
                if ($(this).hasClass('hover')) {
                    $(this).removeClass('hover');
                    $(this).removeAttr('style');
                }
            });
        });
    });
</script>