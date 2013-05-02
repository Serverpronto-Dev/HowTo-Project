<?php
//Create session variables
session_start();

//check variables
if(isset($_SESSION['app_username']))
  unset($_SESSION['app_username']);

//Destroy session variables
if(isset($_SESSION['app_password']))
  unset($_SESSION['app_password']);
        {
          header ("Location: index.php");
          exit();
        }
?>
