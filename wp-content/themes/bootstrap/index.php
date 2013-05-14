<?php

/**
 * The template for displaying everything.
 */

?>
<?php get_header(); ?>

        <div class="container">
            <?php bootstrap_breadcrumbs(); ?>
        </div><!--/.container -->

        <div class="container">
            <div class="row-fluid">

                <div class="span8 section main index">
                    <div class="page-header">
                        <h1><?php _e('Index', 'bootstrap'); ?></h1>
                    </div>

                    <div class="page-content">
                        <div class="page-content-inner">
<?php
while (have_posts()):
    the_post();
                            get_template_part('loop', get_post_type());
endwhile;
?>
                            <?php bootstrap_pagination();?>
                        </div><!-- /.page-content-inner -->
                    </div><!-- /.page-content -->
                </div><!-- /.main -->

                <div class="span4 sidebar">
                    <?php get_sidebar(); ?>
                </div>

            </div><!-- /.row-fluid -->

<?php get_footer(); ?>