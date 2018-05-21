<?php $page_name="manage_data"; include_once "includes/header.php" ?>
<div class="container">
  <form class="login-form center-block">
    <div class="form-group">
      <label for="user-name">User Name</label>
      <input type="text" class="form-control" id="user-name" placeholder="User Name">
    </div>
    <div class="form-group">
      <label for="exampleInputPassword1">Password</label>
      <input type="password" class="form-control" id="password" placeholder="Password">
    </div>
    <div class="checkbox">
      <label>
      <input type="checkbox"> Remember Me
      </label>
    </div>
    <button type="submit" class="btn btn-default login-button" id="login">Login</button>
    <div id="hidden-log-message" hidden="true">
      <div class="alert alert-danger" id="log-result">
        Invalid Credentials
      </div>
    </div>
    </form>
</div>
<?php include_once "includes/footer.php" ?>
