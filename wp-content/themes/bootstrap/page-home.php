<?php

/**
 * Home page
 */

?>
<?php

the_post();

if (bootstrap_has_layout()):
    get_header();
endif;
?>
<code>page-home</code>

        <div class="container">
            <div class="row-fluid">

                <div class="span8 section main page home">
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
                </div><!-- /.main -->

                <div class="span4 sidebar">
                    <?php get_sidebar('page'); ?>
                </div>

            </div><!-- /.row-fluid -->
        </div><!--/.container -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>