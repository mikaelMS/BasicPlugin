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
defined('ABSPATH') or die;

// Require once the Composer Autoload
if (file_exists( dirname(__FILE__) . '/vendor/autoload.php')) {
  require_once dirname(__FILE__) . '/vendor/autoload.php';
}

// Hooks need to be initilized outside the class
function activate_my_plugin() {
  Includes\Base\Activate::activate();
}
function deactivate_my_plugin() {
  Includes\Base\Deactivate::deactivate();
}

// Activation and deactivation hook to trigger procedural methods that call them
register_activation_hook(__FILE__, 'activate_my_plugin');
register_deactivation_hook(__FILE__, 'deactivate_my_plugin');

// Calling through auto includes
if (class_exists('Includes\\Init')) {
  // Registers all the services like activate, deactive
  includes\Init::register_services();
}
