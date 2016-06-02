<?php

include_once('core.php');

include_once("header.php");

if (!isset($_SESSION['login_user'])) header("Location:index.php");

$grListId = (int)validator::testInput($_REQUEST['grListId']);

echo '<div class="container">
            <div style="float: left"><h6><a href=session.php>Log out</a></h6></div>
            <div style="float: right"><h6><a href=grocerylist.php>Go back</a></h6></div>
          </div>';

$form = '<form action="?grListId=' . $grListId . '" method="post">
    <div class="container">
      <div class="row">
        <div class="one-half column" style="margin-top: 0%">
           <h4>User to share list with: </h4></br>
           <h4>Email address: </h4><input type="text" name="email"></input></br>
           <br></br>
           <input type="submit" value="Share"></input>
         </div>
       </div>
     </div>
  </form>
</body>
</html>';

if (!isset($_REQUEST['email']))echo $form;

if (isset($_REQUEST["email"])) {
	$email = validator::testInput($_REQUEST['email']);
	$userId = validator::testInput($_SESSION['login_user']['userId']);

  $grDbAccess = new grDbAccess();
  $sharedWithId = $grDbAccess->getUserId($email);
  if (empty($sharedWithId)) {
	  echo '<div class="container">
                <div class="row">
                  <div class="one-half column" style="margin-top: 0%">
                    <h4>That email address could not be found</h4>
                  </div>
                </div>
              </div>';
     echo $form;
	} else {
		$result = $grDbAccess->shareGrList($grListId, $userId, $sharedWithId);
		header("Location:grocerylist.php");
	}
}

?>