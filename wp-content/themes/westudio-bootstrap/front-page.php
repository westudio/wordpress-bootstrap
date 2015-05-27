<?php

/**
 * Front Page
 */

if ('posts' === get_option('show_on_front')):
  include dirname(__FILE__).'/index.php';
else:
  include dirname(__FILE__).'/page-home.php';
endif;
