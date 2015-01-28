<?php
/*
    THIS IS A LEGACY VERSION OF ATTACHMENTS AND IS CONSIDERED DEPRECATED
*/

/*  Copyright 2009-2012 Jonathan Christopher  (email : jonathan@irontoiron.com)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
 */

 // Exit if accessed directly
 if( !defined( 'ABSPATH' ) ) exit;


// constant definition
if( !defined( 'IS_ADMIN' ) )
    define( 'IS_ADMIN',  is_admin() );

define( 'ATTACHMENTS_PREFIX',   'attachments_' );
define( 'ATTACHMENTS_VERSION',  '1.6.2.1' );
define( 'ATTACHMENTS_URL',      plugin_dir_url( __FILE__ ) );
define( 'ATTACHMENTS_DIR',      plugin_dir_path( __FILE__ ) );


// ===========
// = GLOBALS =
// ===========

global $wpdb;

// environment check
$wp_version = get_bloginfo( 'version' );
if( !version_compare( PHP_VERSION, '5.2', '>=' ) || !version_compare( $wp_version, '3.0', '>=' ) )
{
    if( IS_ADMIN && ( !defined( 'DOING_AJAX' ) || !DOING_AJAX ) )
    {
        require_once ABSPATH.'/wp-admin/includes/plugin.php';
        deactivate_plugins( __FILE__ );
        wp_die( __('Attachments requires PHP 5.2 or higher, as does WordPress 3.2+. Attachments has been automatically deactivated.') );
    }
    else
    {
        return;
    }
}


// we moved all attachments_get_attachments() functions to an external file in version 3.0
include_once 'get-attachments.php';


// =========
// = HOOKS =
// =========

if( IS_ADMIN )
{

    // pre-flight check
    add_action( 'init',                     'attachments_pre_init' );

    // get our assets in line
    add_action( 'admin_enqueue_scripts',    'attachments_enqueues' );
    add_action( 'admin_head',               'attachments_init_js' );

    // get our menu in line
    add_action( 'admin_menu',               'attachments_menu' );

    // need our textdomain
    add_action( 'plugins_loaded',           'attachments_localization' );

    // make sure we've got our settings in place
    add_action( 'admin_init',               'attachments_register_settings' );

    // make sure we handle the save
    add_action( 'save_post',                'attachments_save' );

    // invoke our meta box
    add_action( 'add_meta_boxes',           'attachments_meta_box' );

}


function attachments_localization()
{
    load_plugin_textdomain( 'attachments', false, ATTACHMENTS_DIR . '/languages/' );
}



function attachments_enqueues( $hook )
{

    wp_enqueue_style( 'attachments', trailingslashit( ATTACHMENTS_URL ) . 'css/attachments.css' );

    if( 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook )
        return;

    wp_enqueue_script( 'handlebars', trailingslashit( ATTACHMENTS_URL ) . 'js/handlebars.js', null, '1.0.beta.6', false );
    wp_enqueue_script( 'attachments', trailingslashit( ATTACHMENTS_URL ) . 'js/attachments.js', array( 'handlebars', 'jquery', 'thickbox' ), ATTACHMENTS_VERSION, true );

    wp_enqueue_style( 'thickbox' );
}




// =============
// = FUNCTIONS =
// =============

function attachments_pre_init()
{
    // as of version 1.6 we'll be storing a proper settings array
    if( !get_option( ATTACHMENTS_PREFIX . 'settings' ) )
    {
        $settings = array();

        // we've got a version < 1.6 and therefore no real settings
        $settings['version'] = ATTACHMENTS_VERSION;

        $post_parent = get_option( 'attachments_store_native' );

        if( $post_parent === false )
        {
            // it wasn't set
            $settings['post_parent'] = false;
        }
        else
        {
            $settings['post_parent'] = true;
        }

        // grab our custom post types
        $args           = array(
            'public'    => true,
            'show_ui'   => true,
            '_builtin'  => false
            );
        $output         = 'objects';
        $operator       = 'and';
        $post_types     = get_post_types( $args, $output, $operator );

        // we also want to optionally enable Pages and Posts
        $post_types['post']->labels->name   = 'Posts';
        $post_types['post']->name           = 'post';
        $post_types['page']->labels->name   = 'Pages';
        $post_types['page']->name           = 'page';

        if( count( $post_types ) )
        {
            foreach( $post_types as $post_type )
            {
                $post_parent = get_option( 'attachments_cpt_' . $post_type->name );

                if( $post_parent === false )
                {
                    // it wasn't set
                    $settings['post_types'][$post_type->name] = false;
                }
                else
                {
                    $settings['post_types'][$post_type->name] = true;
                }
            }
        }

        // save our settings
        update_option( ATTACHMENTS_PREFIX . 'settings', $settings );
    }
}


function attachments_register_settings()
{
    // flag our settings
    register_setting(
        ATTACHMENTS_PREFIX . 'settings',
        ATTACHMENTS_PREFIX . 'settings',
        'attachments_validate_settings'
    );

    add_settings_section(
        ATTACHMENTS_PREFIX . 'options',
        'Post Type Settings',
        'attachments_edit_options',
        'attachments_options'
    );

    // post types
    add_settings_field(
        ATTACHMENTS_PREFIX . 'post_types',
        'Post Types',
        'attachments_edit_post_types',
        'attachments_options',
        ATTACHMENTS_PREFIX . 'options'
    );

    // post_parent
    add_settings_field(
        ATTACHMENTS_PREFIX . 'post_parent',
        'Set Post Parent',
        'attachments_edit_post_parent',
        'attachments_options',
        ATTACHMENTS_PREFIX . 'options'
    );
}

function attachments_edit_options()
{  }

function attachments_validate_settings($input)
{
    $input['version'] = ATTACHMENTS_VERSION;
    return $input;
}

function attachments_edit_post_parent()
{
    $settings = get_option( ATTACHMENTS_PREFIX . 'settings' );
    ?>
    <div>
        <label for="<?php echo ATTACHMENTS_PREFIX; ?>settings[post_parent]">
            <input name="<?php echo ATTACHMENTS_PREFIX; ?>settings[post_parent]" type="checkbox" id="<?php echo ATTACHMENTS_PREFIX; ?>settings[post_parent]" value="1"<?php if( isset( $settings['post_parent'] ) && $settings['post_parent'] ) : ?> checked="checked"<?php endif; ?> /> Set the <code>post_parent</code> when Attachments are saved
        </label>
    </div>
<?php }

function attachments_edit_post_types()
{
    $settings = get_option( ATTACHMENTS_PREFIX . 'settings' );
    $args           = array(
                        'public'    => true,
                        'show_ui'   => true,
                        '_builtin'  => false
                        );
    $output         = 'objects';
    $operator       = 'and';
    $post_types     = get_post_types( $args, $output, $operator );

    // we also want to optionally enable Pages and Posts
    $post_types['post']->labels->name   = 'Posts';
    $post_types['post']->name           = 'post';
    $post_types['page']->labels->name   = 'Pages';
    $post_types['page']->name           = 'page';

    if( count( $post_types ) ) : foreach($post_types as $post_type) : ?>
        <div>
            <label for="<?php echo ATTACHMENTS_PREFIX; ?>settings[post_types][<?php echo $post_type->name; ?>]">
                <input name="<?php echo ATTACHMENTS_PREFIX; ?>settings[post_types][<?php echo $post_type->name; ?>]" type="checkbox" id="<?php echo ATTACHMENTS_PREFIX; ?>settings[post_types][<?php echo $post_type->name; ?>]" value="1"<?php if( isset( $settings['post_types'][$post_type->name] ) && $settings['post_types'][$post_type->name] ) : ?> checked="checked"<?php endif; ?> /> <?php echo $post_type->labels->name; ?>
            </label>
        </div>
    <?php endforeach; endif; ?>
<?php }


/**
 * Creates the markup for the WordPress admin options page
 *
 * @return void
 * @author Jonathan Christopher
 */
function attachments_options()
{
    include 'attachments.options.php';
}


/**
 * Creates the entry for Attachments Options under Settings in the WordPress Admin
 *
 * @return void
 * @author Jonathan Christopher
 */
function attachments_menu()
{
    add_options_page('Settings', 'Attachments', 'manage_options', __FILE__, 'attachments_options');
}


/**
 * Inserts HTML for meta box, including all existing attachments
 *
 * @return void
 * @author Jonathan Christopher
 */
function attachments_add()
{ ?>

    <div id="attachments-inner">

        <?php
            $media_upload_iframe_src = "media-upload.php?type=image&TB_iframe=1";
            $image_upload_iframe_src = apply_filters( 'image_upload_iframe_src', "$media_upload_iframe_src" );
            ?>

                <ul id="attachments-actions">
                    <li>
                        <a id="attachments-thickbox" href="media-upload.php?type=image&amp;TB_iframe=1&amp;width=640&amp;height=1500&amp;attachments_thickbox=1" title="Attachments" class="button button-highlighted">
                            <?php _e( 'Attach', 'attachments' ) ?>
                        </a>
                    </li>
                </ul>

                <div id="attachments-list">
                    <input type="hidden" name="attachments_nonce" id="attachments_nonce" value="<?php echo wp_create_nonce( plugin_basename(__FILE__) ); ?>" />
                    <ul>
                        <?php
                    if( !empty($_GET['post']) )
                    {
                        // get all attachments
                        $existing_attachments = attachments_get_attachments( intval( $_GET['post'] ) );

                        if( is_array($existing_attachments) && !empty($existing_attachments) )
                        {
                            foreach ($existing_attachments as $attachment)
                            {
                                // TODO: Better handle this when examining Handlebars template
                                if( empty( $attachment['title'] ) )
                                {
                                    $attachment['title'] = ' ';
                                }
                                if( empty( $attachment['caption'] ) )
                                {
                                    $attachment['caption'] = ' ';
                                }
                                attachments_attachment_markup( $attachment['name'], $attachment['title'], $attachment['caption'], $attachment['id'], $attachment['order'] );
                            }
                    }
                }
                ?>
            </ul>
        </div>
    </div>
    <script id="attachment-template" type="text/x-handlebars-template">
        <?php attachments_attachment_markup(); ?>
    </script>
<?php }


function attachments_attachment_markup( $name = null, $title = null, $caption = null, $id = null, $order = null )
{ ?>
    <li class="attachments-file">
        <h2>
            <a href="#" class="attachment-handle">
                <span class="attachment-handle-icon"><img src="<?php echo WP_PLUGIN_URL; ?>/attachments/deprecated/images/handle.gif" alt="Drag" /></span>
            </a>
            <span class="attachment-name"><?php echo empty( $name ) ? '{{name}}' : $name; ?></span>
            <span class="attachment-delete"><a href="#"><?php _e("Delete", "attachments")?></a></span>
        </h2>
        <div class="attachments-fields">
            <div class="textfield" id="field_attachment_title_<?php echo empty( $id ) ? '{{id}}' : $id; ?>">
                <label for="attachment_title_<?php echo empty( $id ) ? '{{id}}' : $id; ?>"><?php _e("Title", "attachments")?></label>
                <input type="text" id="attachment_title_<?php echo empty( $id ) ? '{{id}}' : $id; ?>" name="attachment_title_<?php echo empty( $id ) ? '{{id}}' : $id; ?>" value="<?php echo empty( $title ) ? '{{title}}' : $title; ?>" size="20" />
            </div>
            <div class="textfield" id="field_attachment_caption_<?php echo empty( $id ) ? '{{id}}' : $id; ?>">
                <label for="attachment_caption_<?php echo empty( $id ) ? '{{id}}' : $id; ?>"><?php _e("Caption", "attachments")?></label>
                <input type="text" id="attachment_caption_<?php echo empty( $id ) ? '{{id}}' : $id; ?>" name="attachment_caption_<?php echo empty( $id ) ? '{{id}}' : $id; ?>" value="<?php echo empty( $caption ) ? '{{caption}}' : $caption; ?>" size="20" />
            </div>
        </div>
        <div class="attachments-data">
            <input type="hidden" name="attachment_id_<?php echo empty( $id ) ? '{{id}}' : $id; ?>" id="attachment_id_<?php echo empty( $id ) ? '{{id}}' : $id; ?>" value="<?php echo empty( $id ) ? '{{id}}' : $id; ?>" />
            <input type="hidden" class="attachment_order" name="attachment_order_<?php echo empty( $id ) ? '{{id}}' : $id; ?>" id="attachment_order_<?php echo empty( $id ) ? '{{id}}' : $id; ?>" value="<?php echo empty( $order ) ? '{{order}}' : $order; ?>" />
        </div>
        <div class="attachment-thumbnail">
            <span class="attachments-thumbnail">
                <?php $thumb = wp_get_attachment_image( $id, array(80, 60), 1 ); ?>
                <?php if( !empty( $thumb ) ) : ?>
                    <?php echo $thumb; ?>
                <?php else: ?>
                    <img src="{{thumb}}" alt="Thumbnail" />
                <?php endif; ?>
            </span>
        </div>
    </li>
<?php }



/**
 * Creates meta box on all Posts and Pages
 *
 * @return void
 * @author Jonathan Christopher
 */
function attachments_meta_box()
{
    // for custom post types
    if( function_exists( 'get_post_types' ) )
    {
        $settings = get_option( ATTACHMENTS_PREFIX . 'settings' );

        $args = array(
            'public'    => true,
            'show_ui'   => true
            );
        $output         = 'objects';
        $operator       = 'and';
        $post_types     = get_post_types( $args, $output, $operator );

        foreach($post_types as $post_type)
        {
            if( isset( $settings['post_types'][$post_type->name] ) && $settings['post_types'][$post_type->name] )
            {
                add_meta_box( 'attachments_list', __( 'Attachments', 'attachments' ), 'attachments_add', $post_type->name, 'normal' );
            }
        }
    }
}


/**
 * Echos JavaScript that sets some required global variables
 *
 * @return void
 * @author Jonathan Christopher
 */
function attachments_init_js()
{
    echo '<script type="text/javascript" charset="utf-8">';
    echo '  var attachments_base = "' . WP_PLUGIN_URL . '/attachments"; ';
    echo '  var attachments_media = ""; ';
    echo '</script>';
}


/**
 * Fired when Post or Page is saved. Serializes all attachment data and saves to post_meta
 *
 * @param int $post_id The ID of the current post
 * @return void
 * @author Jonathan Christopher
 * @author JR Tashjian
 */
function attachments_save($post_id)
{
    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if( !isset( $_POST['attachments_nonce'] ) )
    {
        return $post_id;
    }

    if( !wp_verify_nonce( $_POST['attachments_nonce'], plugin_basename(__FILE__) ) )
    {
        return $post_id;
    }

    // verify if this is an auto save routine. If it is our form has not been submitted, so we dont want
    // to do anything
    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE )
    {
        return $post_id;
    }

    // Check permissions
    if( 'page' == $_POST['post_type'] )
    {
        if( !current_user_can( 'edit_page', $post_id ) )
        {
            return $post_id;
        }
    }
    else
    {
        if( !current_user_can( 'edit_post', $post_id ) )
        {
            return $post_id;
        }
    }

    // OK, we're authenticated: we need to find and save the data

    // delete all current attachments meta
    // moved outside conditional, else we can never delete all attachments
    delete_post_meta( $post_id, '_attachments' );

    // Since we're allowing Attachments to be sortable, we can't simply increment a counter
    // we need to keep track of the IDs we're given
    $attachment_ids = array();

    // We'll build our array of attachments
    foreach( $_POST as $key => $data )
    {
        // Arbitrarily using the id
        if( substr($key, 0, 14) == 'attachment_id_' )
        {
            array_push( $attachment_ids, substr( $key, 14, strlen( $key ) ) );
        }

    }

    // If we have attachments, there's work to do
    if( !empty( $attachment_ids ) )
    {

        foreach ( $attachment_ids as $i )
        {
            if( !empty( $_POST['attachment_id_' . $i] ) )
            {
                $attachment_id      = intval( $_POST['attachment_id_' . $i] );

                $attachment_details = array(
                    'id'        => $attachment_id,
                    'title'     => str_replace( '"', '&quot;', $_POST['attachment_title_' . $i] ),
                    'caption'   => str_replace( '"', '&quot;', $_POST['attachment_caption_' . $i] ),
                    'order'     => intval( $_POST['attachment_order_' . $i] )
                    );

                // serialize data and encode
                $attachment_serialized = base64_encode( serialize( $attachment_details ) );

                // add individual attachment
                add_post_meta( $post_id, '_attachments', $attachment_serialized );

                // save native Attach
                $settings = get_option( ATTACHMENTS_PREFIX . 'settings' );
                if( isset( $settings['post_parent'] ) && $settings['post_parent'] )
                {
                    // need to first check to make sure we're not overwriting a native Attach
                    $attach_post_ref = get_post( $attachment_id );

                    if( $attach_post_ref->post_parent == 0 )
                    {
                        // no current Attach, we can add ours
                        $attach_post                    = array();
                        $attach_post['ID']              = $attachment_id;
                        $attach_post['post_parent']     = $post_id;

                        wp_update_post( $attach_post );
                    }
                }

            }
        }

    }

}