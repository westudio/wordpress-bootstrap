<?php

/**
 * Template Name: Default Page
 */

?>
<?php get_header(); ?>

        <div class="container">
            <?php bootstrap_breadcrumbs(); ?>
        </div><!--/.container -->

        <div class="container">
            <div class="row-fluid">

                <div class="span8 section main page">
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
                </div><!-- /.span8 -->

                <div class="span4 sidebar">
                    <?php get_sidebar('page'); ?>
                </div>

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

<?php get_footer(); ?>