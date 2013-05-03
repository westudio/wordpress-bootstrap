<?php

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
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title><?php bootstrap_title(); ?></title>

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

        <!-- Icons -->
        <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/ico/favicon.ico" />
        <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/ico/favicon.png" />
        <link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/ico/apple-touch-icon-57x57.png" />
        <link rel="apple-touch-icon" sizes="72x72" href="<?php bloginfo('template_url'); ?>/ico/apple-touch-icon-72x72.png" />
        <link rel="apple-touch-icon" sizes="114x114" href="<?php bloginfo('template_url'); ?>/ico/apple-touch-icon-114x114.png" />
        <link rel="apple-touch-icon" sizes="144x144" href="<?php bloginfo('template_url'); ?>/ico/apple-touch-icon-144x144.png" />

        <!--[if lt IE 9]>
        <script src="<?php bloginfo('template_url'); ?>/js/vendors/html5shim/html5shiv.js"></script>
        <![endif]-->

        <?php wp_head(); ?>

    </head>
    <body <?php body_class(); ?>>
        <div class="container">
            <header>
                <div class="header-inner">

                    <a class="brand" href="<?php echo home_url(); ?>" title="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>" rel="home"><?php bloginfo('name'); ?></a>

<?php
if (bootstrap_is_multilingual()):
?>
                    <div class="languages">
                        <?php bootstrap_languages_list(); ?>
                    </div>
<?php
endif;
?>
                </div><!-- /.header-inner -->
                <div class="navbar">
                    <div class="navbar-inner">
                        <a class="btn btn-navbar btn-icon" data-toggle="collapse" data-target="header .nav-collapse" title="<?php _e('Menu', 'bootstrap'); ?>" rel="tooltip" data-placement="left"><i class="icon-list"></i></a>

                        <?php
                        wp_nav_menu(array(
                            'menu'    => 'main',
                            'menu_id' => 'main-menu'
                        ));
                        ?>

                        <div class="nav-collapse">
                            <?php echo bootstrap_navbar_search_form(); ?>
                        </div>
                    </div><!-- /.navbar-inner -->
                </div>
            </header>
        </div><!-- /.container -->