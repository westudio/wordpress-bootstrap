<?php get_header(); ?>

        <div class="container">
            <?php bootstrap_breadcrumbs(); ?>
        </div><!--/.container -->

        <div class="container">
            
            <div class="row-fluid">

                <div class="span8 section main single">
<?php
while (have_posts()):
    the_post();
?>
                    <div class="page-header">
                        <h1><?php the_title(); ?></h1>
                    </div>

                    <div class="page-content">
                        <div class="page-content-inner">
                            <div <?php post_class(); ?>>
                                <div class="post-inner">
                                    <?php the_content();?>
                                </div>
                            </div>       
                        </div>
                    </div>

                    <div class="page-footer">
                        <div class="page-footer-inner">
                            <?php bootstrap_pager(); ?>
                        </div>
                    </div>
<?php
endwhile;
?>
                </div><!-- /.span8 -->

                <div class="span4 sidebar">
                    <?php get_sidebar('single'); ?>
                </div>

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

<?php get_footer(); ?>
