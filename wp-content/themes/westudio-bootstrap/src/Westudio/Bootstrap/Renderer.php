<?php

class Westudio_Bootstrap_Renderer
{
    private static $home_template = 'page-home.php';

    public static function get_home_template()
    {
        return WB_PATH . DIRECTORY_SEPARATOR . self::$home_template;
    }

    public static function set_home_template($template)
    {
        self::$home_template = $template;
    }

    public static function item($item)
    {
        // Page
        if ($item->object == 'page') {
            self::page($item->object_id);
        }
        // Post
        elseif ($item->object == 'post') {
            self::post($item->object_id);
        }
        // Category
        elseif($item->object == 'category') {
            self::category($item->object_id);
        }
    }

    public static function page($page_id)
    {
        static $current = null;

        // Blog page is still a page
        if ($page_id == get_option('page_for_posts')) {
            return self::blog($page_id);
        }

        wb_set('current_url', get_permalink($page_id));

        query_posts(array(
            'page_id'   => $page_id
        ));

        the_post();

        // Avoid infinite loop
        $template = get_page_template();
        if ($template === $current) {
            $template = self::get_home_template();
        }

        rewind_posts();

        wb_link_hack(true);
        $current = $template;
        include $template;
        $current = null;
        wb_link_hack(false);

        wp_reset_query();
    }

    public static function post($post_id)
    {
        wb_set('current_url', get_permalink($post_id));

        query_posts(array(
            'p'         => $post_id,
            'post_type' => 'post'
        ));

        the_post();

        $template = get_single_template();

        rewind_posts();

        wb_link_hack(true);
        include $template;
        wb_link_hack(false);

        wp_reset_query();
    }

    public static function blog($page_id = null)
    {
        if (!$page_id) {
            return self::archive('post');
        }

        wb_set('current_url', get_permalink($page_id));

        query_posts(array(
            'page_id' => $page_id
        ));

        the_post();

        $template = get_archive_template();

        rewind_posts();

        wb_link_hack(true);
        include $template;
        wb_link_hack(false);

        wp_reset_query();
    }

    public static function archive($post_type)
    {
        wb_set('current_url', get_post_type_archive_link($post_type));

        query_posts(array(
            'post_type' => $post_type
        ));

        if (!($template = get_archive_template())) {
            $template = WB_PATH.'/archive.php';
        }

        wb_link_hack(true);
        include $template;
        wb_link_hack(false);

        wp_reset_query();
    }

    public static function category($category_id)
    {
        query_posts(array(
            'cat' => $category_id
        ));

        if (!($template = get_category_template())) {
            $template = WB_PATH.'/archive.php';
        }

        include $template;

        wp_reset_query();
    }

}
