<?php

////////////////////////////////
// Missing functions
////////////////////////////////

if (!function_exists('get_previous_post_link')) {

    function get_previous_post_link($format = '&laquo; %link', $link = '%title', $in_same_cat = false, $excluded_categories = '') {
        // Ho my God ! Kill me !
        ob_start();
        previous_post_link($format, $link, $in_same_cat, $excluded_categories);
        return ob_get_clean();
    }

}

if (!function_exists('get_next_post_link')) {

    function get_next_post_link($format = '%link &raquo;', $link = '%title', $in_same_cat = false, $excluded_categories = '') {
        // Please do it !
        ob_start();
        next_post_link($format, $link, $in_same_cat, $excluded_categories);
        return ob_get_clean();
    }

}


////////////////////////////////
// Helpers
////////////////////////////////

function bootstrap_is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function bootstrap_json($data)
{
    if (headers_sent()) {
        header('Content-Type: application/json');
    }
    echo json_encode($data);
    exit;
}

function bootstrap_url_to_slug($url)
{
    $slug = trim(
        str_replace(
            array(home_url(), '/'),
            array('',         '-'),
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
        $name = 'bootstrap_attachments';
        $instance = new Attachments($name);
        return $instance->get_attachments($name);
}

function bootstrap_get_gallery()
{
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

function bootstrap_navbar_search_form()
{
    include dirname(__FILE__) . '/searchform-navbar.php';
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

    if (empty($paged)) {
        $paged = 1;
    }

    if (!$pages) {
        if (!$pages = $wp_query->max_num_pages) {
            $pages = 1;
        }
    }

    if (1 != $pages) {
        $output .= '<div class="pagination"><ul>';

        if ($paged > 2 && $paged > $range + 1 && $showitems < $pages) {
            $output .= '<li><a href="'.get_pagenum_link(1).'">&laquo;</a></li>';
        }

        if ($paged > 1 && $showitems < $pages) {
            $output .= '<li><a href="'.get_pagenum_link($paged - 1).'">&lsaquo;</a></li>';
        }

        for ($i = 1; $i <= $pages; $i++) {
            if (1 != $pages && ( !($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems )) {
                if ($paged == $i) {
                    $output .= '<li class="active"><span class="current">'.$i.'</span></li>';
                } else {
                    $output .= '<li><a href="'.get_pagenum_link($i).'" class="inactive" >'.$i.'</a></li>';
                }
            }
        }

      if ($paged < $pages && $showitems < $pages) {
          $output .= '<li><a href="'.get_pagenum_link($paged + 1).'">&rsaquo;</a></li>';
      }

      if ($paged < $pages-1 && $paged + $range - 1 < $pages && $showitems < $pages) {
          $output .= '<li><a href="'.get_pagenum_link($pages).'">&raquo;</a></li>';
      }

      $output .= '</ul></div>';
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

    $output = '<ul class="pager">';

    if (is_single()) {

        if ($previous_link = get_previous_post_link('<li class="previous">%link</li>', __('Next post', 'bootstrap'), $in_same_category)) {
            $output .= $previous_link;
            $has_links = true;
        }

        if ($next_link = get_next_post_link('<li class="next">%link</li>', __('Previous post', 'bootstrap'), $in_same_category)) {
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
    include dirname(__FILE__) . '/comment.php';

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

    if (is_front_page()) {
        array_shift($items);
    }

    // Project's name
    array_unshift($items, get_bloginfo('name'));

    if (is_front_page()) {
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
    global $post;
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

                // Attachment
                case is_attachment():
                    // Parent's title
                    $parent = get_post($post->post_parent);
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', get_permalink($parent), $parent->post_title);
                    // Title
                    $breadcrumbs[] = get_the_title();
                    break;

                // Category
                case is_category():
                    // Title
                    $breadcrumbs[] = single_cat_title('', false);
                    break;

                // Year
                case is_year():
                    $breadcrumbs[] = get_the_time('Y');
                    break;

                // Month
                case is_month():
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', get_year_link(get_the_time('Y')), get_the_time('Y'));
                    $breadcrumbs[] = get_the_time('F');
                    break;

                // Day
                case is_day():
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', get_year_link(get_the_time('Y')), get_the_time('Y'));
                    $breadcrumbs[] = sprintf('<a href="%s">%s</a>', get_year_link(get_the_time('Y'), get_the_time('m')), get_the_time('F'));
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

                // Custom post archive
                case !is_single() && !is_page() && get_post_type() != 'post':
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
