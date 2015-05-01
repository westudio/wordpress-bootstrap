<?php

class Westudio_Bootstrap_Breadcrumbs
{
    /**
     * Get breadcrumbs items
     *
     * @return array
     */
    public static function items()
    {
        global $post, $wp_query;
        static $items = array();

        if ($items) {
            return $items;
        }

        self::home($items);

        if (is_front_page()) {
            return $items;
        }

        switch (true) {

            // Custom post
            case is_single() && !is_attachment() && get_post_type() != 'post':
                self::post_type($items);
                self::categories($items);
                self::taxonomies($items);
                self::title($items);
                break;

            // Post
            case is_single() && !is_attachment():
                self::categories($items);
                self::title($items);
                break;

            // Page
            case is_page():
                self::ancestors($items);
                self::title($items);
                break;

            // Blog
            case $wp_query->is_posts_page:
                self::blog_title($items);
                break;

            // Category
            case is_category():
                self::category_title($items);
                break;

            // Taxonomy
            case is_tax():
                self::taxonomy_title($items);
                break;

            // Attachment
            case is_attachment():
                self::ancestors($items);
                self::title($items);
                break;

            // Year
            case is_year():
                self::year($items);
                break;

            // Month
            case is_month():
                self::year($items);
                self::month($items);
                break;

            // Day
            case is_day():
                self::year($items);
                self::month($items);
                self::day($items);
                break;

            // Search
            case is_search():
                self::search($items);
                break;

            // Tag
            case is_tag():
                self::tag($items);
                break;

            // Author
            case is_author():
                self::author($items);
                break;

            // 404
            case is_404():
                self::not_found($items);
                break;

            // Archive
            case is_archive():
                self::post_type($items);
                break;
        }

        self::page($items);

        return $items;
    }

    protected static function home(&$items)
    {
        $items[] = sprintf('<a href="%s">%s</a>', home_url(), __('Home', 'wb'));
    }

    protected static function categories(&$items)
    {
        if (!($categories = get_the_category())) {
            return;
        }

        $links = array();
        foreach ($categories as $category) {
            $links[] = sprintf('<a href="%s">%s</a>', get_category_link($category->term_id), $category->name);
        }
        $items[] = implode(', ', $links);
    }

    protected static function taxonomies(&$items)
    {
        global $post;

        if (!($taxonomies = get_object_taxonomies($post))) {
            return;
        }

        if (!($terms = get_the_terms(get_the_ID(), $taxonomies[0]))) {
            return;
        }

        $links = array();
        foreach ($terms as $term) {
            $links[] = sprintf('<a href="%s">%s</a>', get_term_link($term), $term->name);
        }
        $items[] = implode(', ', $links);
    }

    protected static function post_type(&$items)
    {
        $post_type = get_post_type_object(get_post_type());
        $items[]   = sprintf('<a href="%s">%s</a>', home_url().'/'.$post_type->rewrite['slug'], $post_type->labels->name);
    }

    protected static function ancestors(&$items)
    {
        global $post;

        $parents = array();
        $parent_id = $post->post_parent;
        while ($parent_id) {
            $parent = get_page($parent_id);
            array_unshift($parents, sprintf('<a href="%s">%s</a>', get_permalink($parent), $parent->post_title));
            $parent_id = $parent->post_parent;
        }
        if ($parents) {
            $items = array_merge($items, $parents);
        }
    }

    protected static function title(&$items)
    {
        $items[] = get_the_title();
    }

    protected static function category_title(&$items)
    {
        $items[] = single_cat_title('', false);
    }

    protected static function taxonomy_title(&$items)
    {
        $items[] = single_term_title('', false);
    }

    protected static function blog_title(&$items)
    {
        global $wp_query;
        $items[] = $wp_query->queried_object->post_title;
    }

    protected static function year(&$items)
    {
        $items[] = sprintf('<a href="%s">%s</a>', get_year_link(get_the_time('Y')), get_the_time('Y'));
    }

    protected static function month(&$items)
    {
        $items[] = sprintf('<a href="%s">%s</a>', get_month_link(get_the_time('Y'), get_the_time('m')), ucfirst(get_the_time('F')));
    }

    protected static function day(&$items)
    {
        $items[] = sprintf(
            '<a href="%s">%s</a>',
            get_day_link(
                get_the_time('Y'),
                get_the_time('m'),
                get_the_time('d')
            ),
            ucfirst(get_the_time('F'))
        );
    }

    protected static function search(&$items)
    {
        $items[] = sprintf(__('Results for "%s"', 'wb'), get_search_query());
    }

    protected static function tag(&$items)
    {
        $items[] = sprintf(__('Posts tagged "%s"', 'wb'), single_tag_title('', false));
    }

    protected static function author(&$items)
    {
        global $author;
        $userdata = get_userdata($author);
        $items[] = sprintf(__('Articles posted by %s', 'wb'), $userdata->display_name);
    }

    protected static function not_found(&$items)
    {
        $items[] = __('Page not found', 'wb');
    }

    protected static function page(&$items)
    {
        if ($page = get_query_var('paged')) {
            $items[count($items) - 1] .= ' (' . sprintf(__('page %d', 'wb'), $page) . ')';
        }
    }
}
