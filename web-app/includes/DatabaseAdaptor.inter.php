<?php

  /**
  * database interface allowing access to relevant database class without the fuss
  *
  */
  interface DatabaseAdaptor {

    function runQuery($sql);

    function setterQuery($values, $sql);

    function getterQuery($sql);

    function checkExists($values, $sql);

    function setConnectionInfo($values = array());

    function fetchRow();

  }
 ?>
