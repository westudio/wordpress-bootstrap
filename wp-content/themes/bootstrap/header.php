<?php

if (!bootstrap_has_layout()):
  return;
endif;

if (is_singular() && get_option('thread_comments')):
  wp_enqueue_script('comment-reply');
endif;

?>
<!DOCTYPE html>
<!--[if lt IE 7]>     <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]>        <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]>        <html class="no-js lt-ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 8]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head>
  <meta charset="<?php bloginfo('charset'); ?>" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="We studio" />

  <title><?php bootstrap_page_title(); ?></title>

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

  <!-- Icons -->
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/ico/favicon.ico" type="image/x-icon" />

  <!-- Icons -->
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/ico/favicon.png" type="image/png" />
  <!--[if IE]>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/ico/favicon.ico" type="image/x-icon" />
  <![endif]-->

  <!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/vendor/html5shiv/dist/html5shiv.js"></script>
  <![endif]-->

  <?php wp_head(); ?>

  <!--[if lt IE 9]>
  <script src="<?php echo get_template_directory_uri(); ?>/vendor/respond/dest/respond.min.js"></script>
  <![endif]-->

</head>
<body <?php body_class(); ?>>

  <header class="layout-header navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href="<?php echo home_url(); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><?php _e('Menu', 'bootstrap'); ?></button>
      </div><!-- /.navbar-inner -->

      <nav id="main-menu" class="collapse navbar-collapse">
        <?php
        wp_nav_menu(array(
          'menu'       => 'main',
          'menu_class' => 'nav navbar-nav',
          'depth'      => 1,
        ));
        ?>
      </nav>

    </div><!-- /container -->
  </header>
