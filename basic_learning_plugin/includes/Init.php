<?php

/**
* @package LearningPlugin
*/

namespace Includes;

final class Init
{

  // Static so class doesn't need to be initilize to call the function

  /**
   * Store all classes inside an array
   * @return array  full list of classes
   */
  public static function get_services() {
    return [
        Pages\Admin::class,
        Base\Enqueue::class,
        Base\SettingsLinks::class
    ];
  }

  /**
   * Loop through classes, initilize them
   * and call the register() method if it exits
   * @return
   */
  public static function register_services() {
    // TODO: check out loop
    foreach (self::get_services() as $class) {
        $service = self::instantiate($class);

        /* TODO: implement Interface and check if class has implemented interface
        -> better than checking method (Performance wise)
        */
        if(method_exists($service, 'register')) {
            $service->register();
          }
    }
  }

  /**
   * initilize the class
    * @param class $class  class from the service array
    * @return class instance  new instance of class
    */
  private static function instantiate($class) {
    $service = new $class(); // same as $service = new Pages\Admin::class;
                             // But this way we can automate adding new classes simply in the get_services
    return $service;
  }
}
