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

                    <div class="page-header">
                        <h1><?php _e( 'Page not found', 'bootstrap' ); ?></h1>
                    </div>

                    <div class="page-body">
                        <p><?php _e( 'It seems than what you\'re looking for is no longer here.', 'bootstrap' ); ?></p>
                    </div>

                </div><!-- /.page -->

            </div><!-- /#main -->

        </div><!--/.container -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>