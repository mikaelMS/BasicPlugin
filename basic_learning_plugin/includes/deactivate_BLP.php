<?php
/**
* @package LearningPlugin
*/

class BlpDeactivate
{
  public static function deactivate() {
    flush_rewrite_rules();
  }
}
