<?php

include_once('core.php');

if (!isset($_SESSION['login_user'])) header("Location:index.php");

$grListId = (int)validator::testInput($_REQUEST['grListId']);

echo <<<EOT
<!DOCTYPE HTML>
<html>
	<head>
	  <title>Grocery List</title>
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
  <form action="?grListId=$grListId" method="post">
    User to share list with: </br>
    Email address: <input type="text" name="email"></input></br>
    <br></br>
    <input type="submit" value="Share"></input>
  </form>
</body>
</html>
EOT;

if (isset($_REQUEST["email"])) {
	$email = validator::testInput($_REQUEST['email']);


  $grDbAccess = new grDbAccess();
  $userId = $grDbAccess->getUserId($email);
  $result = $grDbAccess->shareGrList($grListId, $userId);
}


var_dump($_REQUEST);

?>