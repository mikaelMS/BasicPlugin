<?php
/**
* @package LearningPlugin
*/

namespace Includes\Pages;

/**
 *
 */

class Admin
{
  public function register() {
    add_action('admin_menu', array($this, 'add_admin_pages'));
  }

  public function add_admin_pages() {
    // TODO: Check out function
    add_menu_page('Michi Plugin', 'Michi', 'manage_options', 'basic_learning_plugin'
    , array($this, 'admin_index'), 'dashicons-palmtree', 110);
  }

  public function admin_index() {
    // requires template
    require_once PLUGIN_PATH . 'templates/admin.php';
  }
}
