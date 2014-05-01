<?php
/**
 * Our custom dashboard page
 */

/** WordPress Administration Bootstrap */
require_once( ABSPATH . 'wp-load.php' );
require_once( ABSPATH . 'wp-admin/admin.php' );
require_once( ABSPATH . 'wp-admin/admin-header.php' );
?>
<div class="wrap about-wrap">

	<h1><?php _e( 'Welcome to My Custom Dashboard Page' ); ?></h1>

    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="active"><a href="#home" data-toggle="tab">Home</a></li>
        <li><a href="#profile" data-toggle="tab">Profile</a></li>
        <li><a href="#messages" data-toggle="tab">Messages</a></li>
        <li><a href="#settings" data-toggle="tab">Settings</a></li>
    </ul>

    <div class="tab-content">
        <div class="tab-pane fade in active" id="home">
            <div class="changelog">
                <h3><?php _e( 'Morbi leo risus, porta ac consectetur' ); ?></h3>

                <div class="feature-section images-stagger-right">
                    <img src="<?php echo esc_url( admin_url( 'images/screenshot-1.jpg' ) ); ?>" class="image-50" />
                    <h4><?php _e( 'Risus Consectetur Elit Sollicitudin' ); ?></h4>
                    <p><?php _e( 'Cras mattis consectetur purus sit amet fermentum. Vivamus sagittis lacus vel augue laoreet rutrum faucibus dolor auctor. Vestibulum id ligula porta felis euismod semper. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Nulla vitae elit libero, a pharetra augue. Donec sed odio dui.' ); ?></p>

                    <h4><?php _e( 'Mattis Justo Purus' ); ?></h4>
                    <p><?php _e( 'Aenean lacinia bibendum nulla sed consectetur. Donec id elit non mi porta gravida at eget metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id ligula porta felis euismod semper. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.

Cras mattis consectetur purus sit amet fermentum. Maecenas faucibus mollis interdum. Etiam porta sem malesuada magna mollis euismod. Maecenas faucibus mollis interdum. Curabitur blandit tempus porttitor. Cras justo odio, dapibus ac facilisis in, egestas eget quam.' ); ?></p>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="profile">
            <h3><?php _e( 'Bootstrap Integrated' ); ?></h3>
            <!--  FOREXPF.RU - Курсы ЦБ РФ start -->
            <div id="eurusd" style="background:; width:186px; height:47px; border: 1x solid #808080; color:#84057A; text-decoration:none; text-align:left; top; overflow: hidden; font-style:normal; font-variant:normal; font-weight:normal; font-size:9px; font-family:Verdana, sans-serif;"><a href="http://www.forexpf.ru/" title="Курсы валют" target="_blank" style="line-height:14px;color:#000000;text-decoration:none;padding-left: 4px;">Курсы валют</a><br><a href="http://www.forexpf.ru/currency_usd.asp" title="Курс доллара" target="_blank" style="line-height:14px;color:#000000;text-decoration:none;padding-left: 4px;">Курс доллара</a><br><a href="http://www.forexpf.ru/currency_eur.asp" title="Курс евро" target="_blank" style="line-height:14px;color:#000000;text-decoration:none;padding-left: 4px;">Курс евро</a></div><script src="http://www.forexpf.ru/_informer_/eurusd_.php"></script>
            <!--  FOREXPF.RU - Курсы ЦБ РФ end -->
            <!--  FOREXPF.RU - Графики ЦБ РФ start -->
            <a href="http://www.forexpf.ru" style="text-decoration:none">Курсы валют</a><br>
            <script type="text/javascript" src="http://www.forexpf.ru/_informer_/chart.php?type=1&wid=240&hig=160"></script><!--  FOREXPF.RU - Графики ЦБ РФ end -->
        </div>
        <div class="tab-pane fade" id="messages">...</div>
        <div class="tab-pane fade" id="settings">...</div>
    </div>
</div>
<?php include( ABSPATH . 'wp-admin/admin-footer.php' );