<?php

////////////////////////////////
// Init
////////////////////////////////

function bootstrap_init_ajax()
{
    if (bootstrap_is_ajax()) {
        bootstrap_set_layout(false);
    }
}

// add_action('init', 'bootstrap_init_ajax');

/**
 * Registers custom post types
 */
function bootstrap_register_post_types()
{
    register_taxonomy('project_category', 'project', array(
        'hierarchical'            => true,
        'label'                   => __('Categories', 'bootstrap'),
        'rewrite'                 => array('slug' => 'projects')
    ));

    register_post_type(
        'project',
        array(
            'labels'              => array(
                'name'                => __('Projects', 'bootstrap'),
                'singular_name'       => __('Project', 'bootstrap')
            ),
            'public'              => true,
            'exclude_from_search' => false,
            'can_export'          => false,
            'has_archive'         => true,
            'show_ui'             => true,
            'supports'            => array('title', 'editor', 'excerpt', 'thumbnail'),
            'taxonomies'          => array('project_category'),
            'show_in_nav_menus'   => true,
            'show_in_menu'        => true,
            'rewrite'             => array('slug' => 'project')
        )
    );
}

// add_action('init', 'bootstrap_register_post_types');

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
        'post_type'   => array('page', 'post', 'project'),
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
                'default' => '',
            ),
            array(
                'name'    => 'caption',
                'type'    => 'text',
                'label'   => __('Caption', 'bootstrap'),
                'default' => '',
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
    // add_theme_support('post-formats', array(
    //     'aside',
    //     'image',
    //     'gallery',
    //     'link',
    //     'quote',
    //     'status',
    //     'video',
    //     'audio',
    //     'chat'
    // ));
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
    // wp_register_style('fonts', 'http://fast.fonts.net/cssapi/XXX.css', false , BOOTSTRAP_VERSION, 'all');
    wp_register_style('bootstrap', get_template_directory_uri().'/css/wordpress-bootstrap.min.css', false , BOOTSTRAP_VERSION, 'all');
}

add_action('after_setup_theme', 'bootstrap_setup_styles');

function bootstrap_setup_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array(), null);
        wp_enqueue_script('jquery');
    }
}

add_action('init', 'bootstrap_setup_jquery');

function bootstrap_setup_scripts()
{
    wp_register_script('bootstrap', get_template_directory_uri().'/js/wordpress-bootstrap.min.js', array('jquery'), BOOTSTRAP_VERSION, true);
    wp_register_script('google_map_api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCY5DKsx5ZgPdBTF1Kk7Fzk1cKKWhStWrw&sensor=false', array(), true);
    wp_register_script('access_map', get_template_directory_uri().'/js/access-map.js', array('jquery', 'google_map_api'), '1.0.0', true);
}

add_action('after_setup_theme', 'bootstrap_setup_scripts');

/**
 * Enqueues CSS files
 */
function bootstrap_enqueue_styles()
{
    // wp_enqueue_style('fonts');
    wp_enqueue_style('bootstrap');
}

add_action('wp_enqueue_scripts', 'bootstrap_enqueue_styles');

/**
 * Enqueues JS files
 */
function bootstrap_enqueue_scripts()
{
    wp_enqueue_script('bootstrap');
    // wp_enqueue_script('google_map_api');
    // wp_enqueue_script('text_resize');

}

add_action('wp_enqueue_scripts', 'bootstrap_enqueue_scripts');

function bootstrap_pre_get_posts($query)
{
    if ($query->is_tax() || $query->get('post_type') == 'project') {
        $query->set('posts_per_page', -1);
    }
}

add_action('pre_get_posts', 'bootstrap_pre_get_posts');
