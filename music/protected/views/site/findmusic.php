<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/vendor/jquery-1.8.1.min.js"><\/script>')</script>

<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Welcome to <i><?php echo CHtml::encode(Yii::app()->name); ?></i></h1>
<?/**
<!--<div class="gfind youtube">-->
<!--    <script>-->
<!--        (function() {-->
<!--            var cx = '000572243992220998960:fn4_jmdgyqw';-->
<!--            var gcse = document.createElement('script');-->
<!--            gcse.type = 'text/javascript';-->
<!--            gcse.async = true;-->
<!--            gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +-->
<!--                '//www.google.com/cse/cse.js?cx=' + cx;-->
<!--            var s = document.getElementsByTagName('script')[0];-->
<!--            s.parentNode.insertBefore(gcse, s);-->
<!--        })();-->
<!--    </script>-->
<!--    <gcse:search></gcse:search>-->
<!--</div>-->
 */ ?>

<div class="gfind myfind">
    <?php

    $instr='muteki no soldier';
    $getout= array();
    $getout['search_query']= $instr;
    $get_data = http_build_query($getout, '', '&');

    $url= 'http://www.youtube.com/results?'.$get_data;
//    $url= 'http://www.youtube.com/embed/CI0FxkDC6QM';
    $ch = curl_init($url);
    $post_data= array();
//    $post_data['search_query']='muteki+no+soldier';
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    $res = curl_exec($ch);
    if ($res === false)
        throw new \Exception('Could not get reply: ' . curl_error($ch));

    $tmp= explode('<head>', $res);
    $tmp2= explode('</head>', $tmp[1]);
//    $out= str_replace('src="/', 'src="http://www.youtube.com/"', $out);
//    echo $tmp2[0];

    $tmp= explode('id="content"', $res);
    $tmp2= explode('id="footer-container"', $tmp[1]);
    $out= '<div id="content" '. $tmp2[0] .'></div>';
    $out= str_replace('src="/"', 'src="http://www.youtube.com/"', $out);
//    echo $out;
    ?>
</div>

<!--<iframe width="420" height="315" src="//www.youtube.com/embed/CI0FxkDC6QM" frameborder="0" allowfullscreen></iframe>-->

<!-- 1. The <iframe> (and video player) will replace this <div> tag. -->
<div id="player"></div>

<script>
    // 2. This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');

    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

    // 3. This function creates an <iframe> (and YouTube player)
    //    after the API code downloads.
    var player;
    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            height: '390',
            width: '640',
            videoId: 'M7lc1UVf-VE',
            events: {
                'onReady': onPlayerReady,
                'onStateChange': onPlayerStateChange
            }
        });
    }

    // 4. The API will call this function when the video player is ready.
    function onPlayerReady(event) {
        event.target.playVideo();
    }

    // 5. The API calls this function when the player's state changes.
    //    The function indicates that when playing a video (state=1),
    //    the player should play for six seconds and then stop.
    var done = false;
    function onPlayerStateChange(event) {
        if (event.data == YT.PlayerState.PLAYING && !done) {
//            setTimeout(stopVideo, 6000);
            done = true;
        }
    }
    function stopVideo() {
        player.stopVideo();
    }
</script>




