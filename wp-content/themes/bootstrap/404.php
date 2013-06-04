<?php

/**
 * The template for 404 error.
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

            <div id="main">

                <div class="page not-found">

                    <div class="page-body">

                        <div class="hero-unit">

                            <h1><?php _e( 'Page not found', 'bootstrap' ); ?></h1>
                            <p><?php _e( 'It seems than what you\'re looking for is no longer here.', 'bootstrap' ); ?></p>
                            <p><?php _e( 'Perhaps searching, or one of the links below, can help.', 'bootstrap' ); ?></p>

                            <?php get_search_form(); ?>

                        </div>

                        <div class="row-fluid">

                            <div class="span6">
                                <?php the_widget('WP_Widget_Recent_Posts'); ?>
                            </div><!--/.span6 -->

                            <div class="span6">
                                <h2><?php _e( 'Most Used Categories', 'bootstrap' ); ?></h2>
                                <ul>
                                    <?php wp_list_categories(array('orderby' => 'count', 'order' => 'DESC', 'show_count' => 1, 'title_li' => '', 'number' => 10)); ?>
                                </ul>
                            </div><!--/.span6 -->

                        </div><!-- /.row-fluid -->

                    </div><!-- /.page-body -->

                </div><!-- /.page -->

            </div><!-- /#main -->

        </div><!--/.container -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>