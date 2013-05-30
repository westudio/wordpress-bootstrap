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

                <div id="main" class="span8 section main search">
                    <div class="page-header">
                        <h1><?php printf(__('Results for "%s"', 'bootstrap'), get_search_query()); ?></h1>
                    </div>

                    <div class="page-content">
                        <div class="page-content-inner">

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

                            <div class="hentry">
                                <div class="post-inner">
                                    <div class="alert alert-info">
                                        <p><?php _e('No result', 'bootstrap'); ?></p>
                                    </div>
                                </div>
                            </div>

<?php
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
                    <?php get_sidebar('search'); ?>
                </div>

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>