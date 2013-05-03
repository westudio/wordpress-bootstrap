<?php 
/*
Plugin Name: WPML Translation Analytics
Plugin URI: http://wpml.org/
Description: Shows the status of translation projects and displays warnings when 
    completion time may not be met. <a href="http://wpml.org">Documentation</a>.
Author: ICanLocalize
Author URI: http://wpml.org
Version: 1.0.1
*/
if(defined('WPML_TRANSLATION_ANALYTICS_VERSION')) return;

define('WPML_TRANSLATION_ANALYTICS_VERSION', '1.0.1');
define('WPML_TRANSLATION_ANALYTICS_PATH', dirname(__FILE__));

require WPML_TRANSLATION_ANALYTICS_PATH . '/inc/constants.inc';
require WPML_TRANSLATION_ANALYTICS_PATH . '/inc/translation-analytics.class.php';

$WPML_Translation_Analytics = new WPML_Translation_Analytics();

register_activation_hook(WP_PLUGIN_DIR . '/' . WPML_TRANSLATION_ANALYTICS_FOLDER 
	. '/plugin.php', array($WPML_Translation_Analytics, 'plugin_activate'));
register_deactivation_hook(WP_PLUGIN_DIR . '/' . WPML_TRANSLATION_ANALYTICS_FOLDER 
	. '/plugin.php', array($WPML_Translation_Analytics, 'plugin_deactivate'));
?>
