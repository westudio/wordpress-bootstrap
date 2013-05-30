<?php

/**
 * Template Name: All pages in one
 */

get_header();

bootstrap_set_layout(false);

$items = wp_get_nav_menu_items('main');

foreach ($items as $item):

    $id = bootstrap_url_to_slug($item->url);
    $is_current_page = $item->url == get_permalink() || (get_post_type() == $item->object && get_the_ID() == $item->object_id);

?>

        <section id="<?php echo $id; ?>" class="page-wrapper">

<?php

    ////////////////////////////////
    // Current page
    ////////////////////////////////

    if ($is_current_page):

        include __DIR__.'/page-home.php';

    ////////////////////////////////
    // Page & Post
    ////////////////////////////////

    elseif ($item->object == 'page' || $item->object == 'post'):

        query_posts(array(
            'p'         => $item->object_id,
            'post_type' => $item->object
        ));

        the_post();

        // Page
        if ($item->object == 'page'):

            $template = get_page_template();
            rewind_posts();

            if (__FILE__ == $template):
                include __DIR__.'/page.php';
            else:
                include $template;
            endif;

        // Single
        else:

            $template = get_single_template();
            rewind_posts();

            include $template();

        endif;

        wp_reset_query();

    ////////////////////////////////
    // Category
    ////////////////////////////////

    elseif($item->object == 'category'):

        query_posts(array(
            'cat' => $item->object_id
        ));
        include get_category_template();
        wp_reset_query();

    ////////////////////////////////
    // Archive
    ////////////////////////////////

    elseif($item->object == 'cpt-archive'):

        query_posts(array(
            'post_type' => $item->type
        ));
        include get_archive_template();
        wp_reset_query();

    endif;

?>

        </section><!-- /.page-wrapper -->

<?php
endforeach;

bootstrap_set_layout(true);

get_footer();

?>