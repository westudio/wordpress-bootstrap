<?php

////////////////////////////////
// Init
////////////////////////////////

// function wb_init_ajax()
// {
//     if (wb_is_ajax()) {
//         wb_set_layout(false);
//     }
// }

// add_action('init', 'wb_init_ajax');

/**
 * Registers custom post types
 */
// function wb_register_post_types()
// {
//     // register_taxonomy('project_category', 'project', array(
//     //     'hierarchical'            => true,
//     //     'label'                   => __('Categories', 'wb'),
//     //     'rewrite'                 => array('slug' => 'projects')
//     // ));

//     register_post_type(
//         'member',
//         array(
//             'labels'              => array(
//                 'name'                => __('Members', 'wb'),
//                 'singular_name'       => __('Member', 'wb')
//             ),
//             'public'              => true,
//             'exclude_from_search' => true,
//             'can_export'          => false,
//             'has_archive'         => true,
//             'show_ui'             => true,
//             'supports'            => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'),
//             'taxonomies'          => array('project_category'),
//             'show_in_nav_menus'   => true,
//             'show_in_menu'        => true,
//             'rewrite'             => array('slug' => 'member')
//         )
//     );
// }

// add_action('init', 'wb_register_post_types');

/**
 * Registers sidebars
 */
// function wb_register_sidebars()
// {
//     register_sidebar(array(
//         'name'          => 'Home sidebar',
//         'id'            => 'home',
//         'description'   => 'Sidebar on home page',
//         'before_widget' => '<section id="%1$s" class="widget %2$s">',
//         'after_widget'  => '</section>',
//         'before_title'  => '<h1>',
//         'after_title'   => '</h1>'
//     ));

//     register_sidebar(array(
//         'name'          => 'Page sidebar',
//         'id'            => 'page',
//         'description'   => 'Sidebar on pages',
//         'before_widget' => '<section id="%1$s" class="widget %2$s">',
//         'after_widget'  => '</section>',
//         'before_title'  => '<h1>',
//         'after_title'   => '</h1>'
//     ));

//     register_sidebar(array(
//         'name'          => 'Single sidebar',
//         'id'            => 'single',
//         'description'   => 'Sidebar on single posts',
//         'before_widget' => '<section id="%1$s" class="widget %2$s">',
//         'after_widget'  => '</section>',
//         'before_title'  => '<h1>',
//         'after_title'   => '</h1>'
//     ));
// }

// add_action('init', 'wb_register_sidebars');


////////////////////////////////
// Setup
////////////////////////////////

function wb_setup_supports()
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

add_action('after_setup_theme', 'wb_setup_supports');

function wb_setup_thumbnails()
{
    set_post_thumbnail_size(585, 390, true);

    add_image_size('wb-2',   195);
    add_image_size('wb-2-2', 195, 195);
    add_image_size('wb-3',   292);
    add_image_size('wb-4',   390);
    add_image_size('wb-6',   585);
    add_image_size('wb-8',   780);
    add_image_size('wb-9',   878);
    add_image_size('wb-12',  1170);
}

add_action('after_setup_theme', 'wb_setup_thumbnails');

function wb_setup_languages()
{
    load_theme_textdomain('wb', get_template_directory() . '/languages');
}

add_action('after_setup_theme', 'wb_setup_languages');

function wb_setup_menus()
{
    register_nav_menus(array(
        'main'   => __('Main', 'wb'),
        'footer' => __('Footer', 'wb')
    ));
}

add_action('after_setup_theme', 'wb_setup_menus');

function wb_setup_styles()
{
    // wp_register_style('fonts', 'http://fast.fonts.net/cssapi/xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx.css', false , WB_VERSION, 'all');
    wp_register_style('wb', get_template_directory_uri().'/assets/styles/dist/main.min.css', false , WB_VERSION, 'all');
}

add_action('wp_enqueue_scripts', 'wb_setup_styles');

function wb_setup_jquery()
{
    if (!is_admin()) {
        wp_deregister_script('jquery');
        wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js', array(), null);
        wp_enqueue_script('jquery');
    }
}

add_action('wp_enqueue_scripts', 'wb_setup_jquery');

function wb_setup_scripts()
{
    wp_register_script('wb', get_template_directory_uri().'/assets/scripts/dist/main.min.js', array('jquery'), WB_VERSION, true);
    wp_register_script('google_map_api', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyCY5DKsx5ZgPdBTF1Kk7Fzk1cKKWhStWrw&sensor=false', array(), true);
    wp_register_script('access_map', get_template_directory_uri().'/assets/vendor/access-map/dist/access-map.min.js', array('jquery', 'google_map_api'), '1.0.0', true);
}

add_action('wp_enqueue_scripts', 'wb_setup_scripts');

/**
 * Enqueues CSS files
 */
function wb_enqueue_styles()
{
    wp_enqueue_style('fonts');
    wp_enqueue_style('wb');
}

add_action('wp_enqueue_scripts', 'wb_enqueue_styles');

/**
 * Enqueues JS files
 */
function wb_enqueue_scripts()
{
    wp_enqueue_script('wb');

}

add_action('wp_enqueue_scripts', 'wb_enqueue_scripts');

function wb_pre_get_posts($query)
{
    // if ($query->is_tax() || $query->get('post_type') == 'project') {
    //     $query->set('posts_per_page', -1);
    // }
}

// add_action('pre_get_posts', 'wb_pre_get_posts');

function wb_clear_months_cache()
{
    if (file_exists($file = wb_get('cache_months'))) {
        unlink($file);
    }
}

add_action('save_post', 'wb_clear_months_cache');
