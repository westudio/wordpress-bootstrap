<?php

////////////////////////////////
// Missing functions
////////////////////////////////

if (!function_exists('get_previous_post_link')) {

    function get_previous_post_link($format = '&laquo; %link', $link = '%title', $in_same_cat = false, $excluded_categories = '')
    {
        ob_start();
        previous_post_link($format, $link, $in_same_cat, $excluded_categories);
        return ob_get_clean();
    }

}

if (!function_exists('get_next_post_link')) {

    function get_next_post_link($format = '%link &raquo;', $link = '%title', $in_same_cat = false, $excluded_categories = '')
    {
        ob_start();
        next_post_link($format, $link, $in_same_cat, $excluded_categories);
        return ob_get_clean();
    }

}


if (!function_exists('get_nav_menu_id_by_location')) {

    function get_nav_menu_id_by_location($location)
    {
        $locations = get_nav_menu_locations();

        if (array_key_exists($location, $locations)) {
            return $locations[$location];
        }

        return null;
    }

}

if (!function_exists('get_months')) {

    /**
     * Get months
     *
     * @see bootstrap_clear_months_cache()
     * @return object[]
     */
    function get_months()
    {
        $file = bootstrap_get('cache_months');
        if (file_exists($file)) {
            return unserialize(file_get_contents($file));
        }

        global $wpdb;
        $months = $wpdb->get_results(
              "SELECT DISTINCT "
            .   "MONTH(post_date) as month, "
            .   "YEAR(post_date) as year "
            . "FROM {$wpdb->posts} "
            . "WHERE "
            .   "post_type = 'post' "
            .   "AND post_status = 'publish' "
            .   "AND post_date <= NOW() "
            . "ORDER BY post_date DESC"
        );

        array_walk($months, function ($month) {
            $month->month = (int) $month->month;
            $month->year  = (int) $month->year;
        });

        if (!file_exists($dir = dirname($file))) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($file, serialize($months));

        return $months;
    }

}

////////////////////////////////
// Helpers
////////////////////////////////

function bootstrap_render_item($item)
{
    // Page
    if ($item->object == 'page') {
        bootstrap_render_page($item->object_id);
    }
    // Post
    elseif ($item->object == 'post') {
        bootstrap_render_post($item->object_id);
    }
    // Category
    elseif($item->object == 'category') {
        bootstrap_render_category($item->object_id);
    }

}

function bootstrap_render_page($page_id)
{
    // Blog page is still a page
    if ($page_id == get_option('page_for_posts')) {
        return bootstrap_render_blog($page_id);
    }

    bootstrap_set('current_url', get_permalink($page_id));

    query_posts(array(
        'page_id'   => $page_id
    ));

    the_post();

    $template = get_page_template();

    // Avoid infinite loop
    if (realpath(__DIR__.'/../page-all.php') == $template) {
        $template = __DIR__.'/../page-home.php';
    }

    rewind_posts();

    bootstrap_link_hack(true);
    include $template;
    bootstrap_link_hack(false);

    wp_reset_query();
}

function bootstrap_render_post($post_id)
{
    bootstrap_set('current_url', get_permalink($post_id));

    query_posts(array(
        'p'         => $post_id,
        'post_type' => 'post'
    ));

    the_post();

    $template = get_single_template();

    rewind_posts();

    bootstrap_link_hack(true);
    include $template;
    bootstrap_link_hack(false);

    wp_reset_query();
}

function bootstrap_render_blog($page_id = null)
{
    if (!$page_id) {
        return bootstrap_render_archive('post');
    }

    bootstrap_set('current_url', get_permalink($page_id));

    query_posts(array(
        'page_id' => $page_id
    ));

    the_post();

    $template = get_archive_template();

    rewind_posts();

    bootstrap_link_hack(true);
    include $template;
    bootstrap_link_hack(false);

    wp_reset_query();
}

function bootstrap_render_archive($post_type)
{
    bootstrap_set('current_url', get_post_type_archive_link($post_type));

    query_posts(array(
        'post_type' => $post_type
    ));

    if (!($template = get_archive_template())) {
        $template = __DIR__.'/../archive.php';
    }

    bootstrap_link_hack(true);
    include $template;
    bootstrap_link_hack(false);

    wp_reset_query();
}

function bootstrap_render_category($category_id)
{
    query_posts(array(
        'cat' => $category_id
    ));

    if (!($template = get_category_template())) {
        $template = __DIR__.'/../archive.php';
    }

    include $template;

    wp_reset_query();
}

function bootstrap_is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function bootstrap_json($data)
{
    if (!headers_sent()) {
        header('Content-Type: application/json');
    }
    echo json_encode($data);
    exit;
}

function bootstrap_url_to_slug($url)
{
    $slug = trim(
        str_replace(
            array(home_url(), '/', '#'),
            array('',         '-', ''),
            esc_attr($url)
        ),
        '/-'
    );

    if ('' == $slug) {
        $slug = __('home', 'bootstrap');
    }

    return $slug;
}

function bootstrap_get_attachments()
{
    if (!class_exists('Attachments')) {
        return array();
    }

    $name = 'bootstrap_attachments';
    $instance = new Attachments($name);
    return $instance->get_attachments($name);
}

function bootstrap_get_gallery()
{
    if (!class_exists('Attachments')) {
        return array();
    }

    // $attachments = array();

    // if (is_category() || is_tax('project_category')) {

    //     $queried_object = get_queried_object();
    //     $term_id = $queried_object->term_id;

    //     if (is_category()) {
    //         if ($image = get_field('image', 'category_'.$term_id)) {
    //             $attachments[] = (object) $image;
    //         }
    //     } elseif (is_tax('project_category')) {
    //         if ($image = get_field('image', 'project_category_'.$term_id)) {
    //             $attachments[] = (object) $image;
    //         }
    //         if ($image2 = get_field('image_2', 'project_category_'.$term_id)) {
    //             $attachments[] = (object) $image2;
    //         }
    //     }
    // } else {
        $name = 'bootstrap_gallery';
        $instance = new Attachments($name);
        $attachments = $instance->get_attachments($name);
    // }

    return $attachments;
}

function bootstrap_get_background()
{
    return get_post_thumbnail_id();
}

function bootstrap_navbar_search_form()
{
    include dirname(__FILE__) . '/../searchform-navbar.php';
}

/**
 * Ugly hack
 *
 * @param boolean $enable
 */
function bootstrap_link_hack($enable = true)
{
    static $original = null;

    if (!$url = bootstrap_get('current_url')) {
        return;
    }

    if ($enable) {
        $path = parse_url($url, PHP_URL_PATH);
        $original = $_SERVER['REQUEST_URI'];
        $_SERVER['REQUEST_URI'] = $path;
    } else {
        $_SERVER['REQUEST_URI'] = $original;
    }
}

/**
 * Displays pagination
 *
 * @param integer $pages
 * @param integer $range
 */
function bootstrap_pagination($pages = null, $range = 2)
{
    global $paged, $wp_query;

    $output = '';
    $showitems = $range * 2 + 1;

    if (!$paged) {
        $paged = 1;
    }

    if (!$pages) {
        if (!$pages = $wp_query->max_num_pages) {
            $pages = 1;
        }
    }

    if ($pages > 1) {
        bootstrap_link_hack(true);

        $output .= '<ul class="pagination">';

        // First page
        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
            $output .= '<li><a href="'.get_pagenum_link(1).'">&laquo;</a></li>';
        }

        // Previous page
        if ($paged > 1 && $showitems < $pages) {
            $output .= '<li><a href="'.get_pagenum_link($paged - 1).'">&lsaquo;</a></li>';
        }

        // Page numbers
        for ($i = 1; $i <= $pages; $i++) {
            if (
                1 != $pages
                && (
                    !($i >= $paged + $range + 1
                    || $i <= $paged - $range - 1)
                    || $pages <= $showitems
                )
            ) {
                if ($paged == $i) {
                    $output .= '<li class="active"><span class="current">'.$i.'</span></li>';
                } else {
                    $output .= '<li><a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a></li>';
                }
            }
        }

        // Next page
        if ($paged < $pages && $showitems < $pages) {
            $output .= '<li><a href="'.get_pagenum_link($paged + 1).'">&rsaquo;</a></li>';
        }

        // Last page
        if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages) {
            $output .= '<li><a href="'.get_pagenum_link($pages).'">&raquo;</a></li>';
        }

        $output .= '</ul>';

        bootstrap_link_hack(false);
    }

    echo $output;
}

/**
 * Displays pager
 */
function bootstrap_pager($in_same_category = false)
{
    global $wp_query;

    $has_links = false;
    $output    = '<ul class="pager">';

    bootstrap_link_hack(true);

    if (is_single()) {

        if ($previous_link = get_previous_post_link(
            '<li class="previous">%link</li>',
            __('Next post', 'bootstrap'),
            $in_same_category
        )) {
            $output .= $previous_link;
            $has_links = true;
        }

        if ($next_link = get_next_post_link(
            '<li class="next">%link</li>',
            __('Previous post', 'bootstrap'),
            $in_same_category
        )) {
            $output .= $next_link;
            $has_links = true;
        }

    } elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) {

        $previous_label = get_query_var('posts_per_page') == 1
            ? __('Next post', 'bootstrap')
            : __('Newer posts', 'bootstrap');

        $next_label = get_query_var('posts_per_page') == 1
            ? __('Previous post', 'bootstrap')
            : __('Older posts', 'bootstrap');

        if ($previous_link = get_previous_posts_link($previous_label)) {
            $output .= '<li class="previous">'.$previous_link.'</li>';
            $has_links = true;
        }

        if ($next_link = get_next_posts_link($next_label)) {
            $output .= '<li class="next">'.$next_link.'</li>';
            $has_links = true;
        }

    }

    $output .= '</ul>';

    if ($has_links) {
        echo $output;
    }

    bootstrap_link_hack(false);
}

/**
 * Displays single comment
 *
 * @param  object  $comment
 * @param  array   $args
 * @param  integer $depth
 * @return string
 * @see    wp_list_comments()
 */
function bootstrap_comment($comment, $args, $depth)
{
    ob_start();
    include dirname(__FILE__) . '/../comment.php';

    return ob_get_clean();
}

/**
 * Displays publication date
 */
function bootstrap_posted_on()
{
    printf(
        '<time class="entry-date" datetime="%s" pubdate>%s</time>',
        esc_attr(get_the_date('c')),
        esc_html(get_the_date('j F Y'))
    );
}

/**
 * Returns title
 *
 * @param  string  $separator
 * @param  boolean $reverse
 * @param  boolean $strip_tags
 * @return string
 */
function bootstrap_page_title($separator = ' - ', $reverse = true)
{
    $items = bootstrap_get_breadcrumbs();

    array_shift($items);

    // Project's name
    array_unshift($items, get_bloginfo('name'));

    if (is_front_page() && ($description = trim(get_bloginfo('description')))) {
        $items[] = get_bloginfo('description');
    }

    $items = array_map('strip_tags', $items);

    if ($reverse) {
        $items = array_reverse($items);
    }

    echo implode($separator, $items);
}

/**
 * Prints title
 *
 * @param  string  $separator
 * @param  boolean $reverse
 * @param  boolean $strip_tags
 * @return string
 */
function bootstrap_title($separator = ' - ', $reverse = false, $strip_tags = false)
{
    $items = bootstrap_get_breadcrumbs();

    array_shift($items);

    if ($strip_tags) {
        $items = array_map('strip_tags', $items);
    }

    if ($reverse) {
        $items = array_reverse($items);
    }

    echo implode($separator, $items);
}

/**
 * Returns breadcrumbs
 *
 * @return array
 */
function bootstrap_get_breadcrumbs()
{
    global $post, $wp_query;
    static $breadcrumbs = array();

    if (!$breadcrumbs) {

        // Home
        $breadcrumbs[] = sprintf('<a href="%s">%s</a>', home_url(), __('Home', 'bootstrap'));

        if (!is_front_page()) {

            switch (true) {

                // Single custom post
                case is_single() && !is_attachment() && get_post_type() != 'post':
                    // Type
                    $post_type = get_post_type_object(get_post_type());
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', home_url().'/'.$post_type->rewrite['slug'], $post_type->labels->name);
                    // Categories
                    if ($categories = get_the_category()) {
                        $links = array();
                        foreach ($categories as $category) {
                            $links[] = sprintf('<a href="%s">%s</a>', get_category_link($category->term_id), $category->name);
                        }
                        $breadcrumbs[] = implode(', ', $links);
                    }
                    // Taxonomies
                    elseif ($taxonomies = get_object_taxonomies($post)) {
                        // Terms
                        if ($terms = get_the_terms(get_the_ID(), $taxonomies[0])) {
                            $links = array();
                            foreach ($terms as $term) {
                                $links[] = sprintf('<a href="%s">%s</a>', get_term_link($term), $term->name);
                            }
                            $breadcrumbs[] = implode(', ', $links);
                        }
                    }
                    // Title
                    $breadcrumbs[] = get_the_title();
                    break;

                // Post
                case is_single() && !is_attachment():
                    // Categories
                    if ($categories = get_the_category()) {
                        $links = array();
                        foreach ($categories as $category) {
                            $links[] = sprintf('<a href="%s">%s</a>', get_category_link($category->term_id), $category->name);
                        }
                        $breadcrumbs[] = implode(', ', $links);
                    }
                    // Title
                    $breadcrumbs[] = get_the_title();
                    break;

                // Page
                case is_page():
                    // Parents' titles
                    $parents = array();
                    $parent_id = $post->post_parent;
                    while ($parent_id) {
                        $parent = get_page($parent_id);
                        array_unshift($parents, sprintf('<a href="%s">%s</a>', get_permalink($parent), $parent->post_title));
                        $parent_id = $parent->post_parent;
                    }
                    $breadcrumbs = array_merge($breadcrumbs, $parents);
                    // Title
                    $breadcrumbs[] = get_the_title();
                    break;

                // Blog
                case $wp_query->is_posts_page:
                    $breadcrumbs[] = $wp_query->queried_object->post_title;
                    break;

                // Category
                case is_category():
                    // Type
                    $post_type = get_post_type_object(get_post_type());
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', get_post_type_archive_link(get_post_type()), $post_type->labels->name);
                    // Category
                    $breadcrumbs[] = single_cat_title('', false);
                    break;

                // Taxonomy
                case is_tax():
                    // Type
                    $term = get_queried_object();
                    $taxonomy = get_taxonomy($term->taxonomy);
                    $post_type = $taxonomy->object_type[0];
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', get_post_type_archive_link($post_type), $taxonomy->labels->name);
                    // Taxonomy
                    $breadcrumbs[] = single_term_title('', false);
                    break;

                // Attachment
                case is_attachment():
                    // Parent's title
                    $parent = get_post($post->post_parent);
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', get_permalink($parent), $parent->post_title);
                    // Title
                    $breadcrumbs[] = get_the_title();
                    break;

                // Year
                case is_year():
                    $breadcrumbs[] = get_the_time('Y');
                    break;

                // Month
                case is_month():
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', get_year_link(get_the_time('Y')), get_the_time('Y'));
                    $breadcrumbs[] = ucfirst(get_the_time('F'));
                    break;

                // Day
                case is_day():
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', get_year_link(get_the_time('Y')), get_the_time('Y'));
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', get_month_link(get_the_time('Y'), get_the_time('m')), ucfirst(get_the_time('F')));
                    $breadcrumbs[] = get_the_time('d');
                    break;

                // Search
                case is_search():
                    $breadcrumbs[] = sprintf(__('Results for "%s"', 'bootstrap'), get_search_query());
                    break;

                // Tag
                case is_tag():
                    $breadcrumbs[] = sprintf(__('Posts tagged "%s"', 'bootstrap'), single_tag_title('', false));
                    break;

                // Author
                case is_author():
                    global $author;
                    $userdata = get_userdata($author);
                    $breadcrumbs[] = sprintf(__('Articles posted by %s', 'bootstrap'), $userdata->display_name);
                    break;

                // 404
                case is_404():
                    $breadcrumbs[] = __('Page not found', 'bootstrap');
                    break;

                // Archive
                case is_archive():
                    // Type
                    $post_type = get_post_type_object(get_post_type());
                    $breadcrumbs[] = $post_type->labels->name;
                    break;

            }
        }

        // Page
        if ($page = get_query_var('paged')) {
            $breadcrumbs[count($breadcrumbs) - 1] .= ' (' . sprintf(__('page %d', 'bootstrap'), $page) . ')';
        }

    }

    return $breadcrumbs;
}

/**
 * Displays breadcrumbs
 *
 * @return string
 */
function bootstrap_breadcrumbs()
{
    get_template_part('block', 'breadcrumbs');
}
