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
  // Normally contruct is only for initilizing for instance variable and not trigger actions
  function __construct() {
      add_action('init', array( $this, 'custom_post_type'));
  }

  function register() {
    add_action('admin_enqueue_scripts', array($this, 'enqueue'));
  }

	function activate() {
		// generated a CPT
    $this->custom_post_type();
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

  function enqueue() {
    // enqueue all our scripts
    // TODO: Check function
    wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
  }
}

if (class_exists(MyPlugin)) {
  $myPlugin = new MyPlugin();
  $myPlugin->register();
}

// activation
register_activation_hook(__FILE__, array($myPlugin, ‘activate’));   // Need a function, but activate is in MeinPlugin -> array

// deactivation
register_deactivation_hook(__FILE__, array($myPlugin, ‘deactivate’));

// unistall
// Alternativ to making an uninstall.php file, but function need to be static
// register_deactivation_hook(__FILE__, array($myPlugin, 'uninstall'));
