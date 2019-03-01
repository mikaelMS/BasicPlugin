<?php
/**
* @package LearningPlugin
*/

/*
Plugin Name: Basic Plugin
Plugin URI: https://michael-schmidt.de/plugin
Description: Plugin to learn the basics
Version: 1.0.0
Author: Michael Schmidt
Author URI: https://michael-schmidt.de
License: GPLv2 or later
Text Domain: basic_learning_plugin
*/

defined('ABSPATH') or die();

class MyPlugin
{
  // Public
  // can be accessed from everywhere

  // Protected
  // can be accessed only within the class itself or extensions of that class

  // Private
  // can be accessed only within the class itself

  // Normally contruct is only for initilizing for instance variable and not trigger actions
  function __construct() {
  }

  function register_admin_scripts() {
    add_action('admin_enqueue_scripts', array($this, 'enqueue')); //Loads file WP Dashboard
  }

  // Also has to be called when creating Object
  // function register_wp_scritps() {
  //   add_action('wp_enqueue_scripts', array($this, 'enqueue')); //Loads file WP Dashboard
  // }

  protected function create_post_type() {
    add_action('init', array($this, 'custom_post_type'));
  }

	public static function activate() {
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
    register_post_type('book', ['public' => true, 'label' => 'Michi Plugin']);
  }

  function enqueue() {
    // enqueue all our scripts
    // TODO: Check function (__FILE__ starting point to look for the files)
    wp_enqueue_style('mypluginstyle', plugins_url('/assets/mystyle.css', __FILE__));
    wp_enqueue_style('mypluginscript', plugins_url('/assets/myscripts.js', __FILE__));
  }
}

// Second class example for showcasing how to call protected method
class SecondClass extends MyPlugin
{
  function register_post_type() {
    $this->create_post_type();
  }
}

if (class_exists('MyPlugin')) {
  $myPlugin = new MyPlugin();
  $myPlugin->register_admin_scripts();
}

// Also default constructor is being called !important!
if (class_exists('SecondClass')) {
  $secondClass = new SecondClass();
  $secondClass->register_post_type();
}

// activation
register_activation_hook(__FILE__, array($myPlugin, ‘activate’));   // Need a function, but activate is in MeinPlugin -> array

// deactivation
register_deactivation_hook(__FILE__, array($myPlugin, ‘deactivate’));

// unistall
// Alternativ to making an uninstall.php file, but function need to be static
// register_deactivation_hook(__FILE__, array($myPlugin, 'uninstall'));
