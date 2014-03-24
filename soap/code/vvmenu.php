<?php
//require_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'php'.DIRECTORY_SEPARATOR.'conf.php');

?>

<!--<link rel="stylesheet" type="text/css" href="code/SwatchBook/css/demo.css" />
<link rel="stylesheet" type="text/css" href="code/SwatchBook/css/style3.css" />
<link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:700,300,300italic' rel='stylesheet' type='text/css'>
<script type="text/javascript" src="code/SwatchBook/js/modernizr.custom.79639.js"></script>-->
<!--[if lte IE 8]><style>.main{display:none;} .support-note .note-ie{display:block;}</style><![endif]-->


<div class="s-book container">
    <section class="main">

        <div id="sb-container" class="sb-container">

            <div>
                <h4><span>Hidden</span></h4>
                <span class="sb-icon icon-soap"></span>
            </div>
            <div><a href="/category/мыло-ручной-работы">
                <h4><span>Мыло ручной<br />работы</span></h4>
                <span class="sb-icon icon-soap"></span>
                </a>
            </div>
            <div>
                <h4><span>Hidden</span></h4>
                <span class="sb-icon icon-soap"></span>
            </div>

            <div><a href="/category/средства-для-ванны-0">
                <h4><span>Средства<br />для ванны</span></h4>
                <span class="sb-icon icon-bath"></span>
                </a>
            </div>
            <div>
                <h4><span>Hidden</span></h4>
                <span class="sb-icon icon-soap"></span>
            </div>

            <div><a href="/category/средства-по-уходу-за-телом">
                <h4><span>Уход за телом</span></h4>
                <span class="sb-icon icon-body"></span>
                </a>
            </div>
            <div>
                <h4><span>Hidden</span></h4>
                <span class="sb-icon icon-soap"></span>
            </div>

            <div><a href="/category/пудинг-для-умывания">
                <h4><span>Для лица</span></h4>
                <span class="sb-icon icon-face"></span>
                </a>
            </div>
            <div>
                <h4><span>Hidden</span></h4>
                <span class="sb-icon icon-soap"></span>
            </div>

            <div><a href="/category/средства-по-уходу-за-волосами">
                <h4><span>Для волос</span></h4>
                <span class="sb-icon icon-hair"></span>
                </a>
            </div>
            <div>
                <h4><span>Hidden</span></h4>
                <span class="sb-icon icon-soap"></span>
            </div>

            <div><a href="/category/прочий-товар">
                <h4 class="sb-toggle"><span>Открыть/закрыть</span></h4>
                <h5><span>Каталог</span></h5>
                </a>
            </div>


        </div><!-- sb-container -->

    </section>
</div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript" src="code/SwatchBook/js/jquery.swatchbook.js"></script>
<script type="text/javascript">

    $(document).ready(function() {
        setTimeout(function(){
            jQuery(function() {

                jQuery( '#sb-container' ).swatchbook( {
                    // number of degrees that is between each item
                    angleInc	: 15,
                    neighbor	: 15,
                    // if it should be closed by default
                    initclosed	: true,
                    // index of the element that when clicked, triggers the open/close function
                    // by default there is no such element
                    closeIdx	: 11
                } );
            });

            jQuery('.sb-container div:last-child').trigger('click');

        },1000);
    });

    //jQuery('.s-book.container').css('display', 'none');
</script>