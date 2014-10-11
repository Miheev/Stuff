<?php

require_once 'config.php';
require_once 'incl/main.inc';

dbconnect(); $settings=get_settings(1); print $settings['faq_page'];

?>