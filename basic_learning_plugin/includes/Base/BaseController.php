<?php
/**
* @package LearningPlugin
*/

namespace Includes\Base;

// Doesn't need to be included in the Init
class Basecontroller
{
  public $plugin_path;
  public $plugin_url;
  public $plugin_name;

  public function __construct() {
    // Have to navigate form the basic directory into the includes/Base
    $this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
    $this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
    $this->plugin_name = plugin_basename(realpath( __DIR__."/../.." ) )."/basic_learning_plugin.php";
  }
}
