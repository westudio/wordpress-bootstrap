<?php

/**
 * The template for displaying everything.
 */

?>
<?php
if (bootstrap_has_layout()):
    get_header();
endif;
?>

        <div class="container">
            <?php bootstrap_breadcrumbs(); ?>
        </div><!--/.container -->

        <div class="container">
            <div class="row-fluid">

                <div id="main" class="span8 section main index">
                    <div class="page-header">
                        <h1><?php echo get_bloginfo('name'); ?></h1>
                    </div>

                    <div class="page-body">
                        <div class="page-body-inner">

<?php
if (have_posts()):
    while (have_posts()):
        the_post();
?>

                            <?php get_template_part('loop', get_post_type()); ?>

<?php
    endwhile;
endif;
?>

                        </div><!-- /.page-content-inner -->
                    </div><!-- /.page-content -->

                    <div class="page-footer">
                        <div class="page-footer-inner">
                            <?php bootstrap_pagination();?>
                        </div>
                    </div><!-- /.page-footer -->

                </div><!-- /#main -->

                <div id="sidebar" class="span4">
                    <?php get_sidebar(); ?>
                </div>

            </div><!-- /.row-fluid -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>