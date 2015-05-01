<?php

////////////////////////////////
// Filters
////////////////////////////////

add_filter('pre_option_link_manager_enabled', 'wb_are_links_enabled');

add_filter('excerpt_length', 'wb_excerpt_length');

function wb_excerpt_more()
{
    return '&hellip;&nbsp;<a href="' . get_permalink() . '">'.__('Continue reading', 'wb').'</a>';
}

add_filter('excerpt_more', 'wb_excerpt_more');

/**
 * Defines page menu arguments
 *
 * @param  array $args Default arguments
 * @return array
 */
// function wb_page_menu_args($args)
// {
//     $args['show_home'] = true;

//     return $args;
// }

// add_filter('wp_page_menu_args', 'wb_page_menu_args');

/**
 * Defines nav menu arguments
 *
 * @param  array $args Default arguments
 * @return array
 */
function wb_nav_menu_args($args)
{
    $args['fallback_cb'] = false;
    $args['container']   = false;

    if ($args['menu_class'] == 'menu') {
        $args['menu_class'] = 'nav';
    }

    if (empty($args['walker'])) {
        $args['walker'] = 'default';
    }

    if (is_string($args['walker'])) {
        switch ($args['walker']) {
            case 'dropdowns':
                $args['walker'] = new Westudio_Bootstrap_Menu_DropdownsWalker();
                break;

            case 'list-group':
                $args['walker'] = new Westudio_Bootstrap_Menu_ListGroupWalker();
                break;

            case 'one-page':
                $args['walker'] = new Westudio_Bootstrap_Menu_OnePageWalker();
                break;

            default:
                $args['walker'] = new Westudio_Bootstrap_Menu_Walker();
        }
    }

    return $args;
}

add_filter('wp_nav_menu_args', 'wb_nav_menu_args', 10, 1);

function wb_content_thumbnail_sizes($sizes)
{
    return array_merge($sizes, array(
        'wb-6'  => __('Half width', 'wb'),
        'wb-12' => __('Full width', 'wb')
    ));
}

add_filter('image_size_names_choose', 'wb_content_thumbnail_sizes');

/**
 * Defines TinyMCE settings
 *
 * @param  array $settings Default settings
 * @return array
 */
// function wb_tiny_mce_before_init($settings)
// {
//     $formats = array('p', 'h4', 'h5', 'h6', 'pre');
//     $settings['theme_advanced_blockformats'] = implode(',', $formats);

//     return $settings;
// }

// add_filter('tiny_mce_before_init', 'wb_tiny_mce_before_init');

/**
 * Defines columns for <category>
 *
 * @param array $columns
 *
 * @return array
 */
// function wb_manage_edit_category_columns($columns)
// {
//     if (array_key_exists('description', $columns)) {
//         unset($columns['description']);
//     }

//     return array_merge($columns, array(
//         'image' => __('Image', 'wb')
//     ));

//     return $columns;
// }

// add_filter('manage_edit-category_columns', 'wb_manage_edit_category_columns');

/**
 * Prints custom columns for <category>
 *
 * @param  string $content
 */
// function wb_manage_category_custom_column($content, $column, $term_id)
// {
//     switch ($column) {
//         case 'image':
//             if ($attachment_id = get_field('image', 'category_'.$term_id)) {
//                 echo wp_get_attachment_image($attachment_id, 'thumbnail');
//             }
//             break;
//     }
// }

// add_filter('manage_category_custom_column', 'wb_manage_category_custom_column', 10, 3);

/**
 * Defines columns for <project_category>
 *
 * @param array $columns
 *
 * @return array
 */
// function wb_manage_edit_project_category_columns($columns)
// {
//     if (array_key_exists('description', $columns)) {
//         unset($columns['description']);
//     }

//     return array_merge($columns, array(
//         'image' => __('Image', 'wb')
//     ));

//     return $columns;
// }

// add_filter('manage_edit-project_category_columns', 'wb_manage_edit_project_category_columns');

/**
 * Prints custom columns for <project_category>
 *
 * @param  string $content
 */
// function wb_manage_project_category_custom_column($content, $column, $term_id)
// {
//     switch ($column) {
//         case 'image':
//             if ($attachment = get_field('image', 'project_category_'.$term_id)) {
//                 echo wp_get_attachment_image($attachment['id'], 'thumbnail');
//             }
//             break;
//     }
// }

// add_filter('manage_project_category_custom_column', 'wb_manage_project_category_custom_column', 10, 3);
