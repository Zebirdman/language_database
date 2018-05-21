<?php
  /**
  * factory class for creating and returning references to helpers class interfaces, static class only so
  * no need for instatiation. Allows for seperation of object creation method from code throughout site.
  *
  */


  class Factory {

    private static $connectionValues = array(DBCONNSTRING, DBUSER, DBPASS);

    /**
    * creates a database connection adaptor with the avalaible connection values stored as constants in config
    * @return - the database connection object
    */
    public static function createConnection() {

      $adaptor = "DatabaseAdaptor". DATABASE_TYPE;

      if (class_exists($adaptor)) {
        $log = Factory::createLog();
        return new $adaptor(Factory::$connectionValues, $log);
      }
    }

    /**
    * creates a php controller to oversee the main programming logic and class collaboration
    *
    * @return - the php controller object
    */
    public static function createController() {
      $db = Factory::createConnection();
      $log = new Plog();
      $valLog = new Plog();
      $val = new Validator($valLog);
      return new Controller($db, $log, $val);
    }

    /**
    * creates a validation object used for form data validation checks
    * @return - the validator object
    */
    public static function createValidator() {
      $log = new Plog();
      return new Validator($log);
    }

    /**
    * creates and returns a php logger object, used for sending formatted error log, exception and basically
    * anything else you want to a location governed by the constants defined in config
    * @return - the plog class instance.
    */
    public static function createLog() {
      return new Plog();
    }

  }

 ?>
