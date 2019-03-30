<?php
/**
* @package LearningPlugin
*/

namespace Includes\Pages;

use \Includes\Base\BaseController;
// \ means it goes to the basic directory of the file

/**
 *
 */

class Admin extends BaseController
{
  public function register() {
    add_action('admin_menu', array($this, 'add_admin_pages'));
  }

  public function add_admin_pages() {
    // TODO: Check out function
    add_menu_page('Michi Plugin', 'Michi', 'manage_options', 'basic_learning_plugin'
    , array($this, 'admin_index'), 'dashicons-palmtree', 40);
  }

  public function admin_index() {
    // requires template
    require_once $this->plugin_path . 'templates/admin.php';
  }
}
