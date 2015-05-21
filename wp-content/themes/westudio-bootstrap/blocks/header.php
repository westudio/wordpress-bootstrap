<?php
if (!wb_has_layout()):
  return;
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

  <title><?php wb_page_title(); ?></title>

  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.ico" type="image/x-icon" />

  <!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
  <![endif]-->

  <?php wp_head(); ?>

  <!--[if lt IE 9]>
  <script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
  <![endif]-->

</head>
<body <?php body_class(); ?>>

  <header class="header navbar navbar-default navbar-fixed-top">
    <div class="container">

      <div class="navbar-header">
        <a
          class="navbar-brand"
          href="<?php echo home_url(); ?>"
          title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>"
          rel="home"><?php bloginfo('name'); ?></a>

        <button
          type="button"
          class="offcanvas-toggle"
          data-toggle="offcanvas"
          data-target="#offcanvas"
          title="<?php _e('Menu', 'bootstrap'); ?>">
          <i class="glyphicon glyphicon-menu-hamburger"></i>
        </button>

      </div><!-- /.navbar-header -->

      <nav id="main-menu" class="collapse navbar-collapse">
        <?php
        wp_nav_menu(array(
          'theme_location' => 'main',
          'menu_class'     => 'nav navbar-nav',
          'depth'          => 2,
          'walker'         => 'dropdowns',
        ));
        ?>
      </nav>

    </div><!-- ./container -->
  </header><!-- /.navbar-default -->

  <?php get_template_part('blocks/offcanvas') ?>
