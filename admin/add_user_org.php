<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

//Results of Sign up button
        if(isset($_POST['add'])){
//Create counter
                $c=0;
//Prevent sql injections, grab entered variable

                $user_type = mysqli_real_escape_string($db, strip_tags( $_POST['user_type']));
                $user_activate = mysqli_real_escape_string($db, strip_tags( $_POST['user_activate']));
				$org_name = mysqli_real_escape_string($db, strip_tags( $_POST['org_name']));
                $org_activate = mysqli_real_escape_string($db, strip_tags( $_POST['org_activate']));


//Check that no user_type esists with this title
$tresults = mysqli_query($db, "SELECT name FROM tbl_user_types WHERE type='$user_type'");
        $trow = mysqli_fetch_array($tresults);
        $type_test=$trow['type'];
        if(!empty($type_test)){
                $user_error="A user type with this name already exists.";
                $c++;
        }
//Check that no org esists with this title
$oresults = mysqli_query($db, "SELECT org FROM tbl_user_org WHERE org='$org_name'");
        $orow = mysqli_fetch_array($oresults);
        $org_test=$orow['org'];
        if(!empty($org_test)){
                $org_error="An organization with this name already exists.";
                $c++;
        }
		
//Check if entered category is not empty

        if(empty($user_type) && empty($org_name)){
                $user_error="You must specify at least one element.";
                $c++;
//If valid insert data
        }else{ if($c==0){
//Enter valid data into DB
			if(!empty($user_type)){
        mysqli_query($db, "INSERT INTO tbl_user_types (type, status) VALUES ('$user_type', '$user_activate')");
			}
			if(!empty($org_name)){
        mysqli_query($db, "INSERT INTO tbl_user_org (org, status) VALUES ('$org_name', '$org_activate')");
			}			
			mysqli_close($db);
			header('Location: user_org.php');
        }
        }
        }
		if($_POST['back']){
                        header('Location: user_org.php');
                        exit();
                }
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1 well-black">
                <tr style="color:white;"a>
                        <th><h2>Add a New User Type or Organization</h2></th>
                </tr>
                <tr>
                <td>
                <table class="table30">
                                <tr>
                                <td>New User Type:</td><td><input type="text" name="user_type" value="<?php echo $user_type ?>" size="85"><span class="red"><?php echo $user_error ?></span></td>
								<td><input type="checkbox" name="user_activate" value="1">Activate?</td>
                                </tr>
                                <tr>
                                <td>New Organization:</td><td><input type="text" name="org_name" value="<?php echo $org_name ?>" size="85"><span class="red"><?php echo $org_error ?></span></td>
								<td><input type="checkbox" name="org_activate" value="1">Activate?</td>
                                </tr>
                                <tr>
                                <td>
                                <input type="submit" name="add" value="Add" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
								<input type="submit" name="back" value="Back" class="button" />&nbsp;
								</td>
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
