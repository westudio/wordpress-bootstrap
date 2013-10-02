<?php

require_once dirname(__FILE__) . '/classes/Bootstrap_Walker_Nav_Menu.php';
// require_once dirname(__FILE__) . '/classes/Bootstrap_All_In_One_Nav_Walker_Nav_Menu.php';

////////////////////////////////
// Settings
////////////////////////////////

// Bootstrap

define('BOOTSTRAP_IS_RESPONSIVE',      false);
define('BOOTSTRAP_GRID_COLUMN_WIDTH',  BOOTSTRAP_IS_RESPONSIVE ? 70 : 60);
define('BOOTSTRAP_GRID_GUTTER_WIDTH',  BOOTSTRAP_IS_RESPONSIVE ? 30 : 20);

define('BOOTSTRAP_EXCERPT_LENGTH',     55);

define('BOOTSTRAP_ARE_LINKS_ENABLED',  false);

$_bootstrap_settings = array(
    'has_layout' => true
);

// Attachments

define('ATTACHMENTS_SETTINGS_SCREEN',  false);
define('ATTACHMENTS_DEFAULT_INSTANCE', false);

// ICL
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);

////////////////////////////////
// Init
////////////////////////////////

/**
 * Registers custom post types
 */
function bootstrap_register_post_types()
{
    register_post_type(
        'custompost',
        array(
            'labels'              => array(
                'name'                => __('Custom posts', 'bootstrap'),
                'singular_name'       => __('Custom post', 'bootstrap')
            ),
            'public'              => true,
            'exclude_from_search' => false,
            'can_export'          => false,
            'has_archive'         => true,
            'show_ui'             => true,
            'supports'            => array('title', 'editor', 'excerpt', 'thumbnail'),
            'taxonomies'          => array('category', 'post_tag'),
            'show_in_nav_menus'   => true,
            'show_in_menu'        => true,
            'rewrite'             => array('slug' => 'customposts'),
        )
    );
}

// add_action('init', 'bootstrap_register_post_types');

/**
 * Defines columns for <custompost>
 *
 * @param  array $columns
 * @return array
 */
function bootstrap_manage_custompost_posts_columns($columns)
{
    return array_merge($columns, array(
        'customcolumn' => __('Custom column', 'bootstrap')
    ));
}

// add_action('manage_custompost_posts_columns', 'bootstrap_manage_custompost_posts_columns');

/**
 * Prints custom columns for <custompost>
 *
 * @param  string $column
 */
function bootstrap_manage_custompost_posts_custom_column($column)
{
    switch ($column) {
        case 'customcolumn':
            // Print customcolumn content
            // ...
            break;
    }
}

// add_filter('manage_custompost_posts_custom_column', 'bootstrap_manage_custompost_posts_custom_column');

/**
 * Registers sidebars
 */
function bootstrap_register_sidebars()
{
    register_sidebar(array(
        'name'          => 'Home sidebar',
        'id'            => 'home',
        'description'   => 'Sidebar on home page',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h1>',
        'after_title'   => '</h1>'
    ));

    register_sidebar(array(
        'name'          => 'Page sidebar',
        'id'            => 'page',
        'description'   => 'Sidebar on pages',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h1>',
        'after_title'   => '</h1>'
    ));

    register_sidebar(array(
        'name'          => 'Single sidebar',
        'id'            => 'single',
        'description'   => 'Sidebar on single posts',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h1>',
        'after_title'   => '</h1>'
    ));
}

// add_action('init', 'bootstrap_register_sidebars');

/**
 * Registers attachements
 */
function bootstrap_attachments($attachments)
{
    $attachments->register('bootstrap_attachments', array(
        'label'       => __('Attachments', 'bootstrap'),
        'post_type'   => array('page', 'post'),
        'position'    => 'normal',
        'priority'    => 'high',
        'filetype'    => null,
        'note'        => null,
        'append'      => true,
        'button_text' => __('Attach files', 'bootstrap'),
        'modal_text'  => __('Attach', 'bootstrap'),
        'router'      => 'browse',
        'fields'      => array(
            array(
                'name'    => 'title',
                'type'    => 'text',
                'label'   => __('Title', 'bootstrap'),
                'default' => 'title',
            )
        )
    ));

    $attachments->register('bootstrap_gallery', array(
        'label'       => __('Gallery', 'bootstrap'),
        'post_type'   => array('page', 'post'),
        'position'    => 'normal',
        'priority'    => 'high',
        'filetype'    => array('image'),
        'note'        => null,
        'append'      => true,
        'button_text' => __('Attach images', 'bootstrap'),
        'modal_text'  => __('Attach', 'bootstrap'),
        'router'      => 'browse',
        'fields'      => array(
            array(
                'name'    => 'title',
                'type'    => 'text',
                'label'   => __('Title', 'bootstrap'),
                'default' => 'title',
            ),
            array(
                'name'    => 'caption',
                'type'    => 'text',
                'label'   => __('Caption', 'bootstrap'),
                'default' => 'caption',
            )
        )
    ));
}

add_action('attachments_register', 'bootstrap_attachments');

////////////////////////////////
// Setup
////////////////////////////////

function bootstrap_setup_supports()
{
    add_theme_support('automatic-feed-links');
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'gallery',
        'link',
        'quote',
        'status',
        'video',
        'audio',
        'chat'
    ));
    add_theme_support('post-thumbnails');
}

add_action('after_setup_theme', 'bootstrap_setup_supports');

function bootstrap_setup_thumbnails()
{
    set_post_thumbnail_size(col_width(3), col_width(2), true);

    add_image_size('bootstrap-1',          col_width(1));
    add_image_size('bootstrap-1-square',   col_width(1), col_width(1), true);
    add_image_size('bootstrap-2',          col_width(2));
    add_image_size('bootstrap-2-square',   col_width(2), col_width(2), true);
    add_image_size('bootstrap-3',          col_width(3));
    add_image_size('bootstrap-3-cropped',  col_width(3), col_width(2), true);
    add_image_size('bootstrap-3-square',   col_width(3), col_width(3), true);
    add_image_size('bootstrap-4',          col_width(4));
    add_image_size('bootstrap-4-cropped',  col_width(4), col_width(4), true);
    add_image_size('bootstrap-6',          col_width(6));
    add_image_size('bootstrap-6-cropped',  col_width(6), col_width(4), true);
    add_image_size('bootstrap-8',          col_width(8));
    add_image_size('bootstrap-8-cropped',  col_width(8), col_width(6), true);
    add_image_size('bootstrap-9',          col_width(9));
    add_image_size('bootstrap-9-cropped',  col_width(9), col_width(6), true);
    add_image_size('bootstrap-12',         col_width(12));
    add_image_size('bootstrap-12-cropped', col_width(12), col_width(4), true);
}

add_action('after_setup_theme', 'bootstrap_setup_thumbnails');

function bootstrap_content_thumbnail_sizes($sizes)
{
    return array(
        'bootstrap-6-cropped' => __('Medium', 'bootstrap')
    );
}

// add_filter('image_size_names_choose', 'bootstrap_content_thumbnail_sizes');

function bootstrap_setup_i18n()
{
    load_theme_textdomain('bootstrap', get_template_directory() . '/i18n');
}

add_action('after_setup_theme', 'bootstrap_setup_i18n');

function bootstrap_setup_menus()
{
    register_nav_menus(array(
        'main'   => __('Main', 'bootstrap')
    ));
}

add_action('after_setup_theme', 'bootstrap_setup_menus');

function bootstrap_setup_styles()
{
    wp_register_style('bootstrap', get_template_directory_uri().'/css/main.min.css', false ,'1.0.0', 'all');
}

add_action('after_setup_theme', 'bootstrap_setup_styles');

function bootstrap_setup_scripts()
{
    wp_register_script('bootstrap', get_template_directory_uri().'/js/main.min.js', array('jquery'), '1.0.0', true);
    wp_register_script('text_resize', get_template_directory_uri().'/js/text-resize.js', array('jquery'), '1.0.0', true);
    wp_register_script('google_map_api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCY5DKsx5ZgPdBTF1Kk7Fzk1cKKWhStWrw&sensor=false', array(), true);
    wp_register_script('access_map', get_template_directory_uri().'/js/access-map.js', array('jquery', 'google_map_api'), '1.0.0', true);
}

add_action('after_setup_theme', 'bootstrap_setup_scripts');

/**
 * Enqueues CSS files
 */
function bootstrap_enqueue_styles()
{
    wp_enqueue_style('bootstrap');
}

add_action('wp_enqueue_scripts', 'bootstrap_enqueue_styles');

/**
 * Enqueues JS files
 */
function bootstrap_enqueue_scripts()
{
    wp_enqueue_script('bootstrap');
    // wp_enqueue_script('text_resize');

}

add_action('wp_enqueue_scripts', 'bootstrap_enqueue_scripts');

/**
 * Defines TinyMCE settings
 *
 * @param  array $settings Default settings
 * @return array
 */
function bootstrap_tiny_mce_before_init($settings)
{
    $formats = array('p', 'h4', 'h5', 'h6', 'pre');
    $settings['theme_advanced_blockformats'] = implode(',', $formats);

    return $settings;
}

// add_filter('tiny_mce_before_init', 'bootstrap_tiny_mce_before_init');

function bootstrap_pre_get_posts($query)
{
    if ($query->is_category()) {
        $query->set('post_type', array('post', 'custompost'));
    }
}

// add_action('pre_get_posts', 'bootstrap_pre_get_posts');

////////////////////////////////
// Filters
////////////////////////////////

function bootstrap_are_links_enabled()
{
    return BOOTSTRAP_ARE_LINKS_ENABLED;
}

add_filter('pre_option_link_manager_enabled', 'bootstrap_are_links_enabled');

function bootstrap_excerpt_length()
{
    return BOOTSTRAP_EXCERPT_LENGTH;
}

add_filter('excerpt_length', 'bootstrap_excerpt_length');

function bootstrap_excerpt_more()
{
    return '&hellip;&nbsp;<a href="' . get_permalink() . '">'.__('Continue reading', 'bootstrap').'</a>';
}

add_filter('excerpt_more', 'bootstrap_excerpt_more');

/**
 * Defines page menu arguments
 *
 * @param  array $args Default arguments
 * @return array
 */
function bootstrap_page_menu_args($args)
{
    $args['show_home'] = true;

    return $args;
}

// add_filter('wp_page_menu_args', 'bootstrap_page_menu_args');

/**
 * Defines nav menu arguments
 *
 * @param  array $args Default arguments
 * @return array
 */
function bootstrap_nav_menu_args($args)
{
    $args['fallback_cb'] = false;
    $args['container'] = false;

    if ($args['menu_class'] == 'menu') {
        $args['menu_class'] = 'nav';
    }

    if ($args['walker'] == '') {
        $args['walker'] = new Bootstrap_Walker_Nav_Menu();
    }

    return $args;
}

add_filter('wp_nav_menu_args', 'bootstrap_nav_menu_args', 10, 1);

////////////////////////////////
// Helpers
////////////////////////////////

function bootstrap_get($key, $default = null)
{
    global $_bootstrap_settings;

    if (array_key_exists($key, $_bootstrap_settings)) {
        return $_bootstrap_settings[$key];
    } elseif (($const = 'BOOTSTRAP_' . strtoupper($key)) && defined($const)) {
        return constant($const);
    }

    return $default;
}

function bootstrap_set($key, $value)
{
    global $_bootstrap_settings;

    if (array_key_exists($key, $_bootstrap_settings)) {
        return $_bootstrap_settings[$key] = $value;
    } elseif (defined('BOOTSTRAP_' . strtoupper($key))) {
        throw new Exception('"'.$key.'" is a constant setting');
    }

    throw new Exception('"'.$key.'" is not an existing setting');
}

function bootstrap_has_layout()
{
    return bootstrap_get('has_layout');
}

function bootstrap_set_layout($flag = true)
{
    return bootstrap_set('has_layout', (bool) $flag);
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
    static $attachments = null;

    if (null === $attachments) {
        $instance = new Attachments($name);

        $attachments = $instance->get_attachments($name);
    }

    return $attachments;
}

function bootstrap_get_gallery()
{
    $name = 'bootstrap_gallery';
    static $attachments = null;

    if (null === $attachments) {
        $instance = new Attachments($name);

        $attachments = $instance->get_attachments($name);
    }

    return $attachments;
}

function bootstrap_navbar_search_form()
{
    include dirname(__FILE__) . '/searchform-navbar.php';
}

function bootstrap_is_responsive()
{
    return BOOTSTRAP_IS_RESPONSIVE;
}

function bootstrap_get_grid_column_width()
{
    return BOOTSTRAP_GRID_COLUMN_WIDTH;
}

function bootstrap_get_grid_gutter_width()
{
    return BOOTSTRAP_GRID_GUTTER_WIDTH;
}

function bootstrap_get_grid_columns_width($count)
{
    if ($count < 1) {
        $count = 1;
    }

    return BOOTSTRAP_GRID_COLUMN_WIDTH * $count + BOOTSTRAP_GRID_GUTTER_WIDTH * ($count - 1);
}

/**
 * Alias for bootstrap_get_grid_columns_width()
 *
 * @see bootstrap_get_grid_columns_width()
 */
function col_width($count)
{
    return bootstrap_get_grid_columns_width($count);
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
function bootstrap_pager()
{
    global $wp_query;

    echo '<ul class="pager">';

    if (is_single()) {
        // These shits have no `get` versions
        previous_post_link('<li class="previous">%link</li>', '<i class="icon-chevron-left"></i> '.__('Previous post', 'bootstrap'));
        next_post_link('<li class="next">%link</li>', __('Next post', 'bootstrap').' <i class="icon-chevron-right"></i>');
    } elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) {
        if ($previous_link = get_previous_posts_link(__('Newer posts', 'bootstrap').' <i class="icon-chevron-left"></i>')) {
            echo '<li class="previous">'.$previous_link.'</li>';
        }
        if ($next_link = get_next_posts_link('<i class="icon-chevron-right"></i> '.__('Older posts', 'bootstrap'))) {
            echo '<li class="next">'.$next_link.'</li>';
        }
    }

    echo '</ul>';
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
 * Displays title
 *
 * @return string
 */
function bootstrap_title($separator = ' - ')
{
  $output = '';

    if ($breadcrumbs = bootstrap_get_breadcrumbs()) {

        // Replace "Home" by project's name
        $breadcrumbs[0] = get_bloginfo('name');

        if (is_front_page()) {
            $breadcrumbs[] = get_bloginfo('description');
        }

        // Write backwards
        $i = count($breadcrumbs);
        while ($i--) {
            $output .= strip_tags($breadcrumbs[$i]) . ($i ? $separator : '');
        }
    }

    echo $output;
}

/**
 * Displays breadcrumbs
 *
 * @return string
 */
function bootstrap_breadcrumbs()
{
    $output = '';
    $breadcrumbs = bootstrap_get_breadcrumbs();
    $last = count($breadcrumbs) - 1;

    $output .= '<ul class="breadcrumb">';
    foreach ($breadcrumbs as $i => $item) {
        if ($i != $last) {
            $output .= '<li>'.$item.'<span class="divider">/</span></li>';
        } else {
            $output .= '<li class="active">'.$item.'</li>';
        }
    }
    $output .= '</ul>';

    echo $output;
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
