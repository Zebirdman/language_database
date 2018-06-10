<?php

      // ------------------------------------ database connection information -----------------------------
      define('DBCONNSTRING', 'mysql:host='.getenv('DB_CONN_IP').
        ';port='.getenv('DB_CONN_PORT').';dbname=database;charset=utf8');
      define('DBUSER', 'language_user');
      define('DBPASS', '.Hudeg9m5');
      define('TYPE', 'PDO');
      // -------------------------------------- Define max file size --------------------------------------
      define('MAX_FILE_SIZE', '10000000');
      // ------------------------------------------  constants --------------------------------------------
      define('LOGGING_DIR', '/plog/errors.log');
      define('LISTENER', '/includes/listener.php');
      define('DATABASE_TYPE', 'PDO');
      define('USERNAME','admin');
      define('PASSWORD', 'ldbwsu123');
      // ---------------------------------------- cache control -------------------------------------------
      header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
      header("Cache-Control: no-cache");
      header("Pragma: no-cache");
      //header("Content-Type: text/html;charset=ISO-8859-1");

      //ini_set('default_charset', 'UTF-8');
      require_once $prefix."SessionManager.class.php";
      require_once $prefix."Plog.class.php";
      require_once $prefix."Validator.class.php";
      require_once $prefix."DatabaseAdaptor.inter.php";
      require_once $prefix."DatabaseAdaptorPDO.class.php";
      require_once $prefix."Controller.class.php";
      require_once $prefix."Factory.class.php";
      require_once $prefix."FilterControl.class.php";
      require_once $prefix."htmlManager.class.php";


 ?>
