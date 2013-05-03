<?php

/**
 * Template Name: Search page
 */

?>
<?php get_header(); ?>

        <div class="container">
            <?php bootstrap_breadcrumbs(); ?>
        </div><!--/.container -->

        <div class="container">
            <div class="row-fluid">

                <div class="span8 section main search">
                    <div class="page-header">
                        <h1><?php printf(__('Results for "%s"', 'bootstrap'), get_search_query()); ?></h1>
                    </div>

                    <div class="page-content">
<?php
if (have_posts()):
    while (have_posts()):
        the_post();
?>
                        <?php get_template_part('loop', 'post') ?>
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
                    </div><!-- /.page-content -->
                    
                    <div class="page-footer">
                        <div class="page-footer-inner">
                            <?php bootstrap_pagination();?>
                        </div>
                    </div>   
                    
                </div><!-- /.span8 -->
                
                <?php get_sidebar('search'); ?>

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

<?php get_footer(); ?>