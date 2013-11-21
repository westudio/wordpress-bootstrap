<?php

/**
 * Default Page
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

<?php
while (have_posts()):
    the_post();
?>

                    <div <?php post_class(); ?>>

                        <div class="page-header">
                            <h1><?php the_title(); ?></h1>
                        </div>

                        <div class="page-body">
                            <div class="content">
                                <?php the_content(); ?>
                            </div>
                        </div>

                    </div><!-- /.page -->

<?php
endwhile;
?>

                </div><!-- /#main -->

                <div id="sidebar" class="col-sm-4">
                    <?php get_sidebar('page'); ?>
                </div><!-- /#sidebar -->

            </div><!-- /.row -->
        </div><!--/.container -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>