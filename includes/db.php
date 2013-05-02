<?php
//Create DB variable for DB server and user credentials
        $db = mysqli_connect("ext-db1.serverpronto.com", "howto", "q76RR5rclX") or die(mysqli_error());
//Select DB to use
        mysqli_select_db($db, "howto") or die(mysqli_error());
		
//Create DB variable for WHMCS DB server and user credentials		
        $db_whmcs = mysqli_connect("69.60.106.156", "howto", "q76RR5rclX") or die(mysqli_error());

?>

