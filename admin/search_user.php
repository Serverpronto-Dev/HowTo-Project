<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
//import header file
require('header.php');
//Added sql security to prevent sql injection
$user = mysqli_real_escape_string($db, strip_tags( $_GET['user']));

//Refer to reports page
        if($_POST['exit']){
                        header('Location: reports.php');
                        exit();
                }

?>
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1">
                <tr>
                        <th><h2>Search</h2></th>
                </tr>
                <tr>
                <td>
                <table>
                                <tr>
                                <td>Username</td>
                                <td>Page College detail viewed</td>
				<td>This page related to:</td>
                                <td>Date and time of visit</td>
                                <td>Users IP address</td>
                                </tr>
<?php
//Retrieve data from DB
                $tresults = mysqli_query($db, "SELECT * FROM history WHERE user='$user'");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$array=array();
						$array=explode('=', $trow['activity']);	
						$school=$array[1];
					 $sresults = mysqli_query($db, "SELECT name FROM institutions WHERE id='$school'");
                                         $srow = mysqli_fetch_array($sresults)

?>
                                                <tr>
                                                <td><?php echo $trow['user'] ?></td>
                                                <td><?php echo $trow['activity'] ?></td>
                                                <td><?php echo $srow['name'] ?></td>
                                                <td><?php echo $trow['time_stamp'] ?></td>
                                                <td><?php echo $trow['ip_address'] ?></td>
                                                </tr>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
					}
?>

                                </tr>
                                <td colspan="2">
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
                                <tr>
                                </tr>
                </table>
                </td>
                </tr>
        </table>
        </form>

        </div>
  </div>

</body>
<?php
//Import Footer file
require('../footer.html');
?>
</html>
