<?php
include_once("core.php");
include('header.php');

if (!isset($_SESSION['login_user'])) header("Location:index.php");

if (isset($_REQUEST["grName"])) $grName = validator::testInput($_REQUEST["grName"]);
$userId = (int)validator::testInput($_SESSION["login_user"]["userId"]);

if (!isset($grName)) {
echo <<<EOT
<div class="container">
            <div style="float: left"><h6><a href=session.php>Log out</a></h6></div>
            <div style="float: right"><h6><a href=grocerylist.php>Select different list</a></h6></div>
          </div>

  <form action="createList.php" method="post">
    <h2>Create grocery list: </h2></br>
    <h5>Grocery list name: <input type="text" name="grName"></input><h5></br>
    <br></br>
    <input type="submit" value="Create"></input>
  </form>
</body>
</html>
EOT;
} else {
	
$_SESSION["grName"] = $grName;

$grDbAccess = new grDbAccess();

$grListId = $grDbAccess->setGrListId($userId, $grName);

$_SESSION["grListId"] = $grListId;

header("Location:grocerylist.php?grListId=" . $grListId);
}
?>