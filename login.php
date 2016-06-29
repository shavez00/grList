<?php

include_once("core.php");
include_once("header.php");

$email = NULL;

if (isset($_REQUEST['error'])) $error = validator::testInput($_REQUEST['error']);
if (isset($_REQUEST['email'])) {
	 $email = validator::testInput($_REQUEST['email']);
}

if (isset($error)) {
	//password is incorrect
  if ($error == 2) echo "Password is not correct, please re-enter";

  //New user
  if ($error == 0) echo "User does not exist, please enter in password for new account";

  //password is empty
  if ($error == 4||$error == 6) echo "Please enter a password";

  //new password and password confirm don't match
  if ($error == 3) echo "Passwords entered don't match, please re-enter";

  //no email address or invalid email address entered
  if ($error == 5) echo "Please enter in a valid email address";
}

?>
<div class="container">
    <div class="row">
      <div class="one-half column" style="margin-top: 25%">
        <form action="authenticateUser.php?email=<?php echo $email?>" method="post">
          <h1>Please log in</h1>
          </br>
          <h4>Email: <input type="text" name="email" value="<?echo $email?>"></input></h4>
          </br>
          <h4>Password: <input type="password" name="password"></input></h4>
<?php
  //generate password confirm box if it's a new user, password and password confirm don't match, or password field was empty
  if (isset($error)) if ($error==0 || $error==3 || $error == 6) echo <<<EOT
  </br>
          <h4>Password confirm: <input type="password" name="passwordConfirm"></input></h4>
EOT;
?>
          <input type="submit" value="Submit"></input>
        </form>
      </div>
  </div>
</div>
</body>
</html>