<?php

/**
 * Template Name: Contact Page
 */

?>
<?php

wp_enqueue_script('access_map');

if (bootstrap_has_layout()):
    get_header();
endif;

?>

        <div class="container">
            <?php bootstrap_breadcrumbs(); ?>
        </div>

        <div class="map">
            <div id="map" class="map-inner"></div>
        </div>

        <div class="container">
            <div class="row">

                <div id="main" class="col-sm-8">

<?php
while (have_posts()):
    the_post();
?>

                    <div <?php post_class('contact'); ?>>

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
                    <?php get_sidebar('contact'); ?>
                </div><!-- /#sidebar -->

            </div><!-- /.row -->
        </div><!--/.container -->

        <script>
            jQuery(function ($) {
                $('#map').accessmap({
                    center: new google.maps.LatLng(46.521556, 6.624941),
                    content: [
                        '<strong>We studio sàrl</strong>',
                        'Côtes-de-Montbenon 30',
                        'CH-1003 Lausanne'
                    ].join('<br />'),
                    styles: [
                        {
                            "stylers": [
                                { "hue": "#00b2ff" },
                                { "saturation": -50 }
                            ]
                        }
                    ]
                });
            });
        </script>

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>