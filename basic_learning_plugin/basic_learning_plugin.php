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

// Used to secure view from outside
defined( 'ABSPATH' ) or die;

if (file_exists( dirname(__FILE__) . '/vendor/autoload.php')) {
  require_once dirname(__FILE__) . '/vendor/autoload.php';
}

use Includes\Activate;
use Includes\Deactivate;
use Includes\AdminPages;

if ( !class_exists( 'MyPlugin' )) {
	class MyPlugin
	{
    public $plugin_name;

    function __construct() {
      $this->plugin_name = plugin_basename(__FILE__);
    }

		function register_admin_scripts() {
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ));

      add_action('admin_menu', array($this, 'add_admin_pages'));

      add_filter("plugin_action_links_$this->plugin_name", array($this, 'settings_link'));
		}

    public function settings_link($links) {
      // add custom settings link
      // href for directory path, we created a admin.php and not options-general
      $settings_link = '<a href="admin.php?page=basic_learning_plugin">Michi Settings<a/>';
      array_push($links, $settings_link);

      return $links;
    }

    public function add_admin_pages() {
      // TODO: Check out function
      add_menu_page('Michi Plugin', 'Michi', 'manage_options', 'basic_learning_plugin'
      , array($this, 'admin_index'), 'dashicons-palmtree', 110);
    }

    public function admin_index() {
      // requires template
      require_once plugin_dir_path( __FILE__ ) . 'templates/admin.php';
    }

		protected function create_post_type() {
			add_action( 'init', array( $this, 'custom_post_type' ) );
		}

		function custom_post_type() {
			register_post_type( 'book', ['public' => true, 'label' => 'Books'] );
		}

		function enqueue() {
			// enqueue all our scripts
			wp_enqueue_style( 'mypluginstyle', plugins_url( '/assets/mystyle.css', __FILE__ ));
			wp_enqueue_script( 'mypluginscript', plugins_url( '/assets/myscript.js', __FILE__ ));
		}

		function activate() {
			// require_once plugin_dir_path( __FILE__ ) . 'includes/activate_BLP.php';
			Activate::activate();
		}
	}

	$myPlugin = new MyPlugin();
	$myPlugin->register_admin_scripts();

	// activation
	register_activation_hook( __FILE__, array( $myPlugin, 'activate' ) );

	// deactivation
	// require_once plugin_dir_path( __FILE__ ) . 'includes/deactivate_BLP.php';
	register_deactivation_hook( __FILE__, array( 'Deactivate', 'deactivate' ) );
}
