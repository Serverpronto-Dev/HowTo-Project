<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
//Import header file
require('header.php');
//Added sql security to prevent sql injection
$range = mysqli_real_escape_string($db, strip_tags( $_GET['range']));
//Manipulate data for start and end date
$array1=explode("_", $range);
$start=$array1[0]." 00:00:00";
$end=$array1[1]." 23:59:59";

//Refer to reports page
        if($_POST['exit']){
                        header('Location: reports.php');
                        exit();
                }

?>
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table class="table1 well-blue">
                <tr>
                        <th><h2>Search</h2></th>
                </tr>
                <tr>
                <td>
                <table class="center">
                                <tr>
                                <th>User type</th>
								<th>Organization</th>
								<th>This page related to:</th>
                                <th>Date and time of visit</th>
                                <th>Users IP address</th>
                                </tr>
<?php
//Retrieve data from DB
				$sql="SELECT * FROM tbl_tracking WHERE timestamp >= '$start' AND timestamp <= '$end' ORDER BY id";
			    $tresults = mysqli_query($db, "$sql");
                            if( $trow = mysqli_fetch_array($tresults)){
											do{
												$s_id=$trow['session_id'];
												$url=$trow['url'];
												if (strpos($url,'=') !== false) {
													$explode_url=explode('=',$url);
													$url_id=end($explode_url);
				$presults = mysqli_query($db, "SELECT p.p_title, c.name FROM tbl_pages as p, tbl_dept as c WHERE p.id='$url_id' AND p.dept_id=c.id");
							$prow = mysqli_fetch_array($presults);																
								$url=$prow['name']." - ".$prow['p_title'];
												}
												
												
			    $dresults = mysqli_query($db, "SELECT * FROM tbl_association WHERE session_id='$s_id'");
							$drow = mysqli_fetch_array($dresults);
							if(empty($drow['user_type'])){
								$user_type="Empty";
								}else{
								$user_type=$drow['user_type'];
								}
							if(empty($drow['org'])){
								$org="Empty";
								}else{
								$org=$drow['org'];
								}								
							
?>
                                                <tr>
                                                <td><?php echo $user_type ?></td>
												<td><?php echo $org ?></td> 
                                                <td><?php echo $url ?></td>
                                                <td><?php echo $trow['timestamp'] ?></td>
                                                <td><?php echo $trow['ip'] ?></td>
												</tr>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
					}
?>
                                </tr>
                                <td class="lastrow">
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
require('footer.html');
?>
</html>
