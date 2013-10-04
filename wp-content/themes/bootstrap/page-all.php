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
        <section id="<?php echo $id ?>" class="page-wrapper">
<?php

    ////////////////////////////////
    // Current page
    ////////////////////////////////

    if ($is_current_page):

        include __DIR__.'/page-home.php';

    ////////////////////////////////
    // Page
    ////////////////////////////////

    elseif ($item->object == 'page'):

        query_posts(array(
            'p'         => $item->object_id,
            'post_type' => $item->object
        ));

        the_post();

        $template = get_page_template();

        if (__FILE__ == $template):
            $template = __DIR__.'/page.php';
        endif;

        rewind_posts();

        include $template;

        wp_reset_query();

    ////////////////////////////////
    // Post
    ////////////////////////////////

    elseif ($item->object == 'post'):

        query_posts(array(
            'p'         => $item->object_id,
            'post_type' => $item->object
        ));

        the_post();

        $template = get_single_template();

        rewind_posts();

        include $template;

        wp_reset_query();

    ////////////////////////////////
    // Category
    ////////////////////////////////

    elseif($item->object == 'category'):

        query_posts(array(
            'cat' => $item->object_id
        ));

        if (!($template = get_category_template())):
            $template = __DIR__.'/archive.php';
        endif;

        include $template;

        wp_reset_query();

    endif;

?>
        </section>
<?php

endforeach;

bootstrap_set_layout(true);

get_footer();

?>