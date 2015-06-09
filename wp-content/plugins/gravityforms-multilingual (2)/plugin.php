<?php 
/*
Plugin Name: Gravity Forms Multilingual
Plugin URI: http://wpml.org/documentation/related-projects/gravity-forms-multilingual/
Description: Add multilingual support for Gravity Forms
Author: OnTheGoSystems
Author URI: http://www.onthegosystems.com/
Version: 1.2.2
*/


if(defined('GRAVITYFORMS_MULTILINGUAL_VERSION')) return;

define('GRAVITYFORMS_MULTILINGUAL_VERSION', '1.2.2');
define('GRAVITYFORMS_MULTILINGUAL_PATH', dirname(__FILE__));

require GRAVITYFORMS_MULTILINGUAL_PATH . '/inc/gravity_forms_multilingual.class.php';

$gravity_forms_multilingual = new Gravity_Forms_Multilingual();