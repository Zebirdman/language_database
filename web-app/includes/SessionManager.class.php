<?php
  /**
  * session manager class, provides all methods for creating, checking user sessions
  * and for handling logging in and out for users, uses cookies as well hold data
  * but does not rely on them.
  * @author - Ben Futterleib
  */

  class SessionManager {

    private $log;

    /**
    * session manager constructor, uses dependancy injection for adding a log class
    * to session manager for error reporting
    */
    public function __construct($log) {
      if(!session_start()) {
        session_start();
      }
      $this->log = $log;
    }
    /**
    * checks whether or not a user is logged in, returns true or false if a log in exists
    */
    public function validLogIn() {
      if(isset($_SESSION["logged_in"])) {
        $currentTime = time();
        $sessionTime = $_SESSION["start"];
        $timeLeft = $currentTime - $sessionTime;
        return true;
      } else {
        return false;
      }
    }

    /**
    * sends a request to the database based on a entered username, hashes and compares password
    */
    public function processLogInRequest($credentials) {
      $this->log->output("Log in details recieved are: ".$credentials);
      $this->log->output($credentials);
      if($credentials['password'] == PASSWORD && $credentials['username'] == USERNAME) {
        $this->log->output("Credentials match");
        $_SESSION["logged_in"] = true;
        $_SESSION['start'] = time();
        $_SESSION["logged_in"] = true;
        $_SESSION['last-sql'] = '';
        $_SESSION['last-table'] = '';
        $_SESSION['last-start'] = 0;
        $_SESSION['last-finish'] = 0;
        // if remember me is selected create a cookie to hold username and hashed password
        if(isset($credentials['remember-me'])) {
          $_SESSION['remember-me'] = 1;
          setcookie("auto-log",$cookieData,time()+(86400*30),"/");
        } else {
          $_SESSION['remember-me'] = 0;
          unset($_COOKIE["auto-log"]);
          setcookie("auto-log","",time() - 3600, "/");
        }
        $this->log->output("Log in succesful");
        $this->log->output($_SESSION);
        http_response_code(200);
        echo "manage.php";
      } else {
        http_response_code(400);
        echo "Password or usename does not match";
      }

    }

    /**
    * logs a user out, unsets all of their session variables and destroys current session.
    * returns correct response code in order to help ajax trigger correct response.
    */
    public function logUserOut() {
      $this->log->output("LOGGING OUT");
      unset($_SESSION["logged_in"]);
      unset($_SESSION['start']);
      unset($_SESSION['remember-me']);
      session_destroy();
      http_response_code(200);
    }
  }














 ?>
