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

                <div id="main" class="span8 section main single">
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
                </div><!-- /#main -->

                <div id="sidebar" class="span4">
                    <?php get_sidebar('single'); ?>
                </div>

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>
