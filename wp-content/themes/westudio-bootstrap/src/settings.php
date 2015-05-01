<?php

////////////////////////////////
// Settings
////////////////////////////////


// Westudio Bootstrap
// -----------------------------

$_wb_settings = array(

    'current_url'  => null,  // Used in single page layout
    'has_layout'   => true,  // Display/Hide header & footer
    'is_block'     => false, // Avoid block recursion

    'cache_months' => __DIR__.'/../cache/months.cache',

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
function wb_get($key, $default = null)
{
    global $_wb_settings;

    if (array_key_exists($key, $_wb_settings)) {
        return $_wb_settings[$key];
    } elseif (($const = 'WB_' . strtoupper($key)) && defined($const)) {
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
function wb_set($key, $value)
{
    global $_wb_settings;

    if (array_key_exists($key, $_wb_settings)) {
        return $_wb_settings[$key] = $value;
    } elseif (defined('WB_' . strtoupper($key))) {
        throw new Exception('"'.$key.'" is a constant setting');
    }

    throw new Exception('"'.$key.'" is not an existing setting');
}

/**
 * Is layout enabled
 *
 * @return boolean
 */
function wb_has_layout()
{
    return wb_get('has_layout');
}

/**
 * Enable/Disable layout
 *
 * @param boolean $flag
 */
function wb_set_layout($flag = true)
{
    return wb_set('has_layout', (bool) $flag);
}

function wb_are_links_enabled()
{
    return WB_LINKS_ENABLED;
}

function wb_excerpt_length()
{
    return WB_EXCERPT_LENGTH;
}


// ICL
// -----------------------------

define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
