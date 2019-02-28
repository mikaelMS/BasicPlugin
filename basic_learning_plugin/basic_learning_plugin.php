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

defined('ABSPATH') or die();

class MyPlugin
{
  function __construct() {
      add_action('init', array( $this, 'custom_post_type'));
  }

	function activate() {
		// generated a CPT
    &this->custom_post_type();
		// flush rewrite rules
    flush_rewrite_rules(); //TODO: Check function
	}

	function deactivate() {
		//flush rewrite rules
    flush_rewrite_rules();
	}

	function uninstall() {
		// delte CPT
		// delte all the plugin data from the DB
	}

  // Function to gernate custom post type
  function custom_post_type() {
    register_post_type('book', ['public' => true, 'label' => 'Michi Plugin' ] );
  }
}

if (class_exists(MyPlugin)) {
  $myPlugin = new MyPlugin();
}

// activation
register_activation_hook(__FILE__, array($myPlugin, ‘activate’));   // Need a function, but activate is in MeinPlugin -> array

// deactivation
register_deactivation_hook(__FILE__, array($myPlugin, ‘deactivate’));

// unistall
// register_deactivation_hook(__FILE__, array($myPlugin, 'uninstall'));
