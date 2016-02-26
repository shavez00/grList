<?php

if (isset($_REQUEST['userExists'])) {
	if ($_REQUEST['userExists'] == 1) {
    echo <<<EOT
      User exists!<br>Please <a href="index.php">log in</a>, or select a different email address.<br>
EOT;
  }
}

?>

<!DOCTYPE HTML>
<html>
	<head>
	  <title>Registration</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	  <meta name="description" content="The HTML5 Herald"> 
		<meta name="author" content="SitePoint"> 
		<link rel="stylesheet" href="css/styles.css?v=1.0"> 
		<!--[if lt IE 9]> 
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
		<![endif]--> 
  </head> 
<body> 
  <script src="js/scripts.js"></script> 
  <form action="registerUser.php" method="post">
    Email: <input type="text" name="email"></input>
    <br></br>
    Password: <input type="password" name="password"></input>
    <!--need to add password verification -->
    <br></br>
    <input type="submit" value="Submit"></input>
  </form>
</body>
</html>