<?php
/**
* @package LearningPlugin
*/

namespace Includes\Base;

/**
 *
 */

class SettingsLinks
{
  public function register() {
    add_filter("plugin_action_links_" . PLUGIN_NAME, array($this, 'settings_link'));
  }

  public function settings_link($links) {
     // add custom settings link
     // href for directory path, we created a admin.php and not options-general
     $settings_link = '<a href="admin.php?page=basic_learning_plugin">Michi Settings<a/>';
     array_push($links, $settings_link);

     return $links;
   }
}
