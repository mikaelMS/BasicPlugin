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

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.
This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.
You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
Copyright 2005-2015 Automattic, Inc.
*/

defined('ABSPATH') or die();

if (!class_exists('MyPlugin')) {
  class MyPlugin
  {
    // Public
    // can be accessed from everywhere

    // Protected
    // can be accessed only within the class itself or extensions of that class

    // Private
    // can be accessed only within the class itself

    // Static

    // Normally contruct is only for initilizing for instance variable and not trigger actions
    function __construct() {
    }

    public static function register_admin_scripts() {
      add_action('admin_enqueue_scripts', array('MyPlugin', 'enqueue')); //Loads file WP Dashboard

      add_action('admin_menu', array('MyPlugin', 'add_admin_pages'));
    }

    public function add_admin_pages() {
      // TODO: Check out function
      add_menu_page('Michi Plugin', 'Michi', 'manage_options', 'basic_learning_plugin'
      , array('MyPlugin', 'admin_index'), 'dashicons-palmtree', 110);
    }

    public function admin_index() {
      // requires template
      echo(plugin_dir_path(__FILE__));
      // require_once plugin_dir_path(__FILE__) . '/templates/admin.php';
    }

    // Also has to be called when creating Object
    // function register_wp_scritps() {
    //   add_action('wp_enqueue_scripts', array($this, 'enqueue')); //Loads file WP Dashboard
    // }

    protected function create_post_type() {
      add_action('init', array($this, 'custom_post_type'));
    }

  	// public static function activate() {
  	// 	// generated a CPT
    //   $this->custom_post_type();
  	// 	// flush rewrite rules
    //   flush_rewrite_rules(); //TODO: Check function
  	// }

  	// function deactivate() {
  	// 	//flush rewrite rules
    //   flush_rewrite_rules();
  	// }

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

    function activate() {
      require_once plugin_dir_path(__FILE__) . 'includes/activate_BLP.php';
      BlpActivate::activate();
    }
  }

  $myPlugin = new MyPlugin();
  $myPlugin->register_admin_scripts();

  // activation (Changed first array var from $myPlugin to BasicLearningPluginActivate)
  register_activation_hook(__FILE__, array($myPlugin, 'activate'));   // Need a function, but activate is in MeinPlugin -> array

  // deactivation
  require_once plugin_dir_path(__FILE__) . 'includes/deactivate_BLP.php';
  register_deactivation_hook(__FILE__, array('BlpDeactivate', 'deactivate'));

  // unistall
  // Alternativ to making an uninstall.php file, but function need to be static
  // register_deactivation_hook(__FILE__, array($myPlugin, 'uninstall'));
}
