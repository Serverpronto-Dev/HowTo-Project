	<?php
        include('../includes/db.php');
//c97198e9423a407d9c3dd6dda5d78f99
        # create a session cookie
        session_start();

        # see if user has logged in or is already logged in and
        # grab username and password if available

	$app_username = isset($_POST['username']) ? $_POST['username'] : $_SESSION['app_username'];
        $app_password = isset($_POST['password']) ? $_POST['password'] : $_SESSION['app_password'];
/*
echo $app_username."\n";
echo $app_password."\n";
*/
        # redirect to login page if not logged in
        if(!isset($app_username) || !isset($app_password))
        {
          header ("Location: login.php");
          exit();
        }

        # update session variables if this is a fresh login
        $_SESSION['app_username'] = $app_username;
        $_SESSION['app_password'] = $app_password;
	$password=md5($app_password);
        # query to search for this particular user in the users db
        $sql = "SELECT * FROM tbladmins WHERE username = '$app_username' AND password = '$password' AND disabled='0'";
		mysqli_select_db($db_whmcs, "new-whmcs") or die(mysqli_error());
        $result = mysqli_query($db_whmcs, $sql);

        # make sure the database is working correctly
        if (!$result) {
          echo('A database error occurred while checking your '.
                          'login details.\\nIf this error persists, please ');
        }else{
                $row = mysqli_fetch_array($result);
                $_SESSION['app_level'] = $row['level'];
                $_SESSION['app_id'] = $row['email'];
//                $app_id = $_SESSION['app_id'];
//                $app_level = $_SESSION['app_level'];
        }

        if (mysqli_num_rows($result) == 0) {
                  unset($_SESSION['app_username']);
                  unset($_SESSION['app_password']);
//                  unset($_SESSION['app_level']);
                  $_SESSION = array();
                  session_destroy();
                  header ("Location: login.php");
                  exit();
        }
?>
