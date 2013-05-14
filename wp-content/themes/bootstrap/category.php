<?php get_header(); ?>

        <div class="container">
            <?php bootstrap_breadcrumbs(); ?>
        </div><!--/.container -->

        <div class="container">
            <div class="row-fluid">

                <div class="span8 section main category archive">
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
                        <?php bootstrap_pagination();?>
                    </div>   
                    
                </div><!-- /.main -->
                
                <div class="span4 sidebar">
                    <?php get_sidebar('category'); ?>
                </div>

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

<?php get_footer(); ?>