<?php

/**
 * Search page
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

                <div id="main" class="span8">

                    <div class="page search">

                        <div class="page-header">
                            <h1><?php printf(__('Results for "%s"', 'bootstrap'), get_search_query()); ?></h1>
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
else:
?>

                            <div class="alert alert-info">
                                <p><?php _e('No result', 'bootstrap'); ?></p>
                            </div>

<?php
endif;
?>

                        </div><!-- /.page-content -->

                        <div class="page-footer">
                            <?php bootstrap_pagination();?>
                        </div><!-- /.page-footer -->

                    </div><!-- /.page -->

                </div><!-- /#main -->
                
                <div id="sidebar" class="span4">
                    <?php get_sidebar('search'); ?>
                </div><!-- /#sidebar -->

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>