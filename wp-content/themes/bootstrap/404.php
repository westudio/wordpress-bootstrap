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

            <div id="main" class="section main not-found">

                <div class="page-content">
                    
                    <div class="hero-unit">
                        <h1><?php _e( 'Page not found', 'bootstrap' ); ?></h1>
                        <p><?php _e( 'It seems we can\'t find what you\'re looking for. Perhaps searching, or one of the links below, can help.', 'bootstrap' ); ?></p>
                        <?php get_search_form(); ?>
                    </div>

                    <div class="page-content-inner">
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
                    </div>
                </div>

            </div><!-- /#main -->

        </div>

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>