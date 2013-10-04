<?php

////////////////////////////////
// Settings
////////////////////////////////


// Bootstrap
// -----------------------------


// Constants
// ---------

define('BOOTSTRAP_VERSION',            '1.1.0');
define('BOOTSTRAP_IS_RESPONSIVE',      true);
define('BOOTSTRAP_GRID_COLUMN_WIDTH',  BOOTSTRAP_IS_RESPONSIVE ? 70 : 60);
define('BOOTSTRAP_GRID_GUTTER_WIDTH',  BOOTSTRAP_IS_RESPONSIVE ? 30 : 20);

define('BOOTSTRAP_EXCERPT_LENGTH',     55);

define('BOOTSTRAP_ARE_LINKS_ENABLED',  false);


// Variables
// ---------

$_bootstrap_settings = array(

    'has_layout' => true               // Display/Hide header & footer

);


// Accessors
// ---------

/**
 * Get config parameter
 *
 * @param string $key
 * @param mixed $default
 * @return mixed
 */
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

/**
 * Set config parameter
 *
 * @param string $key
 * @param mixed $value
 */
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

/**
 * Is layout enabled
 *
 * @return boolean
 */
function bootstrap_has_layout()
{
    return bootstrap_get('has_layout');
}

/**
 * Enable/Disable layout
 *
 * @param boolean $flag
 */
function bootstrap_set_layout($flag = true)
{
    return bootstrap_set('has_layout', (bool) $flag);
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

function bootstrap_are_links_enabled()
{
    return BOOTSTRAP_ARE_LINKS_ENABLED;
}

function bootstrap_excerpt_length()
{
    return BOOTSTRAP_EXCERPT_LENGTH;
}


// Attachments
// -----------------------------

define('ATTACHMENTS_SETTINGS_SCREEN',  false);
define('ATTACHMENTS_DEFAULT_INSTANCE', false);


// ICL
// -----------------------------

define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
