<?php

/**
 * The template for displaying Archive pages.
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
            <div class="row-fluid">

                <div id="main" class="span8 section main archive">
                    <div class="page-header">
                        <h1><?php

                            if (is_category()):
                                echo single_cat_title('', false);
                                if ($category_description = category_description()):
                                    echo apply_filters('category_archive_meta', '<small class="category-archive-meta">' . $category_description . '</small>');
                                endif;
                            elseif (is_tag()):
                                echo single_tag_title('', false);
                                if ($tag_description = tag_description()):
                                    echo apply_filters('tag_archive_meta', '<small class="tag-archive-meta">' . $tag_description . '</small>');
                                endif;
                            elseif (is_day()):
                                printf(__('Daily Archives: %s', 'bootstrap'), '<time>' . get_the_date() . '</time>');
                            elseif (is_month()):
                                printf(__('Monthly Archives: %s', 'bootstrap'), '<time>' . get_the_date(_x('F Y', 'monthly archives date format', 'bootstrap')) . '</time>');
                            elseif (is_year()):
                                printf(__('Yearly Archives: %s', 'bootstrap'), '<time>' . get_the_date(_x('Y', 'yearly archives date format', 'bootstrap')) . '</time>');
                            elseif (get_post_type() != 'post'):
                                $post_type = get_post_type_object(get_post_type());
                                echo $post_type->labels->name;
                            else:
                                _e('Archives', 'bootstrap');
                            endif;

                        ?></h1>
                    </div>

                    <div class="page-body">
                        <div class="page-body-inner">

<?php
if (have_posts()):
    while (have_posts()):
        the_post();
?>

                            <?php get_template_part('loop', get_post_type()); ?>

<?php
    endwhile;
endif;
?>

                        </div><!-- /.page-content-inner -->
                    </div><!-- /.page-content -->

                    <div class="page-footer">
                        <div class="page-footer-inner">
                            <?php bootstrap_pagination();?>
                        </div>
                    </div><!-- /.page-footer -->

                </div><!-- /#main -->

                <div id="sidebar" class="span4">
                    <?php get_sidebar('archive'); ?>
                </div>

            </div><!-- /.row-fluid -->

<?php
if (bootstrap_has_layout()):
    get_footer();
endif;
?>