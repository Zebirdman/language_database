<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html"; charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Western Sydney University: Grammatical Changes Database</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
  </head>
  <body>
      <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">
          <img class="logo" alt="logo" src="images/logo.png">Western Sydney University
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li <?php if ($page_name == 'search') echo 'class="active"' ?> ><a href="index.php">Search</a></li>
        <li <?php if ($page_name == 'import_data') echo 'class="active"' ?> ><a href="import-data.php">Import Data</a></li>
        <li <?php if ($page_name == 'manage_data') echo 'class="active"' ?> id="manage-link" ><a href="manage.php">Manage Data</a></li>
        <?php if($_SESSION['logged_in']): ?>
        <li <?php if ($page_name == 'db_progress') echo 'class="active"' ?> ><a href="db-progress.php">Database Progress</a></li>
        <li <?php if ($page_name == 'php_info') echo 'class="active"' ?>><a href="info.php">PHP Info</a></li>
        <li <?php if ($page_name == 'server') echo 'class="active"' ?> ><a href="includes/listener.php?option=logout">Logout</a></li>
        <?php endif; ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
