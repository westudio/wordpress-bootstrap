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

                <div id="main" class="span8 section main category archive">
                    <div class="page-header">
                        <h1><?php echo single_cat_title('', false);?></h1>
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
                    <?php get_sidebar('category'); ?>
                </div>

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>