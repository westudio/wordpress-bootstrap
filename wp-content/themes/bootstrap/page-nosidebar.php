<?php

/**
 * Template Name: Page no sidebar
 */

?>
<?php get_header(); ?>

        <div class="container">
            <?php bootstrap_breadcrumbs(); ?>
        </div><!--/.container -->

        <div class="container">
            <div class="row-fluid">

                <div class="span12 section main page">
                    <div class="page-header">
                        <h1><?php the_title(); ?></h1>
                    </div>
                    <div class="page-content">
                        <div class="page-content-inner">
<?php
while (have_posts()):
    the_post();
?>
                            <div <?php post_class(); ?>>
                                <div class="post-inner">
                                    <?php the_content();?>
                                </div>
                            </div>
<?php
endwhile;
?>
                        </div>
                    </div>
                </div><!-- /.span12 -->

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

<?php get_footer(); ?>