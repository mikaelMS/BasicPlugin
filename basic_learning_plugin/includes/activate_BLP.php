<?php
/**
* @package LearningPlugin
*/

class BlpActivate
{
  public static function activate() {
    flush_rewrite_rules();
  }
}
