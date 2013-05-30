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
        <div class="map">
            <div id="map" class="map-inner"></div>
        </div>

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
                                    <?php the_content(); ?>
                                </div>
                            </div>
<?php
endwhile;
?>
                        </div>
                    </div>
                </div><!-- /.main -->

                <div class="span4 sidebar">
                    <?php get_sidebar('contact'); ?>
                </div>

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

        <script>
            jQuery(function ($) {
                $('#map').accessmap({
                    center: new google.maps.LatLng(46.521556, 6.624941),
                    content: [
                        '<strong>We studio sàrl</strong>',
                        'Rue des Côtes-de-Montbenon 30',
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