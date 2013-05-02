<?php
//Create DB variable for DB server and user credentials
        $db = mysqli_connect("ext-db1.serverpronto.com", "howto", "q76RR5rclX") or die(mysqli_error());
//Select DB ti use
        mysqli_select_db($db, "howto") or die(mysqli_error());
?>

