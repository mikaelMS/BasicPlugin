<?php
/**
* @package LearningPlugin
*/

/*
Plugin Name: Basic Plugin
Plugin URI: https://michael-schmidt.de/plugin
Description: Plugin to learn the basics
Version: 1.0.0
Author: Michael schmidt
Author URI: https://michael-schmidt.de
License: GPLv2 or later
Text Domain: basic_learning_plugin
*/

class MyPlugin
{
	function activate() {
		echo ‘Plugin was activated’;
		// generated a CPT
		// flush rewrite rules
	}

	function deactivate() {
		echo ‘Plugin was deactivated’;
		//flush rewrite rules
	}

	function uninstall() {
		// delte CPT
		// delte all the plugin data from the DB
	}
}

if (class_exists(‘MeinPlugin’)) {
  $myPlugin = new MyPlugin();
}

// activation
register_activation_hook(__FILE__, array($myPlugin, ‘activate’));   // Need a function, but activate is in MeinPlugin -> array

// deactivation
register_deactivation_hook(__FILE__, array($myPlugin, ‘deactivate’));

// unistall
