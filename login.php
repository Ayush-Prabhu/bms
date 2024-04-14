<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Local Bus - Login</title>
  <link rel="stylesheet" href="css/login.css">
</head>

<body>
  <div class="container-bms">
    <center>
      <div class="form-deg">
        <form action="login_check.php" method="POST" class="login-deg">
        LOGIN FORM
        <h4>
          <?php
            error_reporting(0);
            session_start();
            session_destroy();
            echo $_SESSION['loginMessage'];
          ?>
        </h4>
          <div>
            <label class="label-deg">Username</label>
            <input type="text" name="username" placeholder="Enter username">
          </div>
          <div>
            <label class="label-deg">Password</label>
            <input type="Password" name="password" placeholder="Enter password">
          </div>
          <div>
            <input type="Submit" name="submit" value="Login" id="submit-deg">
          </div>
        </form>
      </div>
    </center>
  </div>
</body>

</html>