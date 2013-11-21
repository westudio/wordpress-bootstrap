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
            <div class="row">

                <div id="main" class="col-sm-8">

                    <div class="page index">

                        <div class="page-header">
                            <h1><?php echo get_bloginfo('name'); ?></h1>
                        </div>

                        <div class="page-body">

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

                        </div><!-- /.page-body -->

                        <div class="page-footer">
                            <?php bootstrap_pagination();?>
                        </div><!-- /.page-footer -->

                    </div><!-- /.page -->

                </div><!-- /#main -->

                <div id="sidebar" class="col-sm-4">
                    <?php get_sidebar(); ?>
                </div><!-- /#sidebar -->

            </div><!-- /.row -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>