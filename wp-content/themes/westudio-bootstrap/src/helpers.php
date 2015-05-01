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
     * @see wb_clear_months_cache()
     * @return object[]
     */
    function get_months()
    {
        $file = wb_get('cache_months');
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

/**
 * Returns breadcrumbs
 *
 * @return array
 */
function wb_get_breadcrumbs()
{
    return Westudio_Bootstrap_Breadcrumbs::items();
}

function wb_is_ajax()
{
    return isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}

function wb_json($data)
{
    if (!headers_sent()) {
        header('Content-Type: application/json');
    }
    echo json_encode($data);
    exit;
}

/**
 * Ugly hack to force URL
 *
 * @param boolean $enable
 */
function wb_link_hack($enable = true)
{
    static $original = null;

    if (!$url = wb_get('current_url')) {
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
 * Returns title
 *
 * @param  string  $separator
 * @param  boolean $reverse
 * @param  boolean $strip_tags
 * @return string
 */
function wb_page_title($separator = ' - ', $reverse = true)
{
    $items = wb_get_breadcrumbs();

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
 * Displays pager
 */
function wb_pager($in_same_category = false)
{
    global $wp_query;

    $has_links = false;
    $output    = '<ul class="pager">';

    wb_link_hack(true);

    if (is_single()) {

        if ($previous_link = get_previous_post_link(
            '<li class="previous">%link</li>',
            __('Next post', 'wb'),
            $in_same_category
        )) {
            $output .= $previous_link;
            $has_links = true;
        }

        if ($next_link = get_next_post_link(
            '<li class="next">%link</li>',
            __('Previous post', 'wb'),
            $in_same_category
        )) {
            $output .= $next_link;
            $has_links = true;
        }

    } elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) {

        $previous_label = get_query_var('posts_per_page') == 1
            ? __('Next post', 'wb')
            : __('Newer posts', 'wb');

        $next_label = get_query_var('posts_per_page') == 1
            ? __('Previous post', 'wb')
            : __('Older posts', 'wb');

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

    wb_link_hack(false);
}

/**
 * Displays pagination
 *
 * @param integer $pages
 * @param integer $range
 */
function wb_pagination($pages = null, $range = 2)
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
        wb_link_hack(true);

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

        wb_link_hack(false);
    }

    echo $output;
}

/**
 * Displays publication date
 */
function wb_posted_on()
{
    printf(
        '<time class="entry-date" datetime="%s" pubdate>%s</time>',
        esc_attr(get_the_date('c')),
        esc_html(get_the_date('j F Y'))
    );
}

function wb_render_item($item)
{
    return Westudio_Bootstrap_Renderer::item($item);
}

/**
 * Prints title
 *
 * @param  string  $separator
 * @param  boolean $reverse
 * @param  boolean $strip_tags
 * @return string
 */
function wb_title($separator = ' - ', $reverse = false, $strip_tags = true)
{
    $items = wb_get_breadcrumbs();

    if (count($items) > 1) {
        array_shift($items);
    }

    if ($strip_tags) {
        $items = array_map('strip_tags', $items);
    }

    if ($reverse) {
        $items = array_reverse($items);
    }

    echo implode($separator, $items);
}

function wb_url_to_slug($url)
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
        $slug = __('home', 'wb');
    }

    return $slug;
}
