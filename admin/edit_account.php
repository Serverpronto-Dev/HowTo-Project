<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
require('header.php');

//Get ID with added php-mysql security
        $id = mysqli_real_escape_string($db, strip_tags($_GET['id']));

//Results of Sign up button
        if(isset($_POST['register'])){
//Create counter
		$c=0;
//Prevent sql injections, grab entered variable
                $fname = mysqli_real_escape_string($db, strip_tags( $_POST['fname']));
                $lname = mysqli_real_escape_string($db, strip_tags( $_POST['lname']));
                $email = mysqli_real_escape_string($db, strip_tags( $_POST['email']));
                $pass =  mysqli_real_escape_string($db, strip_tags( $_POST['pass']));
                $pass1 = mysqli_real_escape_string($db, strip_tags( $_POST['pass1']));
                $level = mysqli_real_escape_string($db, strip_tags( $_POST['level']));
//Null variables
		$fn_error=" ";
		$ln_error=" ";
		$e_error=" ";
		$pw_error=" ";

//Check if entered cata is not empty
	if (empty($fname)){
        $fn_error="First name cannot be empty.";
		$c++;
	}elseif(empty($lname)){
		$ln_error="Last name cannot be empty.";
		$c++;
	}elseif(empty($email)){
        $e_error="Email address cannot be empty.";
		$c++;
	}elseif($pass!=$pass1){
		$pw_error="Passwords must match.";
		$c++;
//Check if passwords match
    }elseif ($pass==$pass1 && $c==0){
//Enter valid data into DB
		mysqli_query($db, "UPDATE tbl_users SET fname='$fname', lname='$lname', email='$email', level='$level' WHERE id='$id'");
             
//If passwords don't match, reject
	}else{
			$pw_error="Passwords must match";
//    			header('Location: register.php');
//			exit();
	}

		if (!empty($pass) && $pass==$pass1){
			$password=md5($pass);
			mysqli_query($db, "UPDATE tbl_users SET password='$password' WHERE id='$id' ");
		   	mysqli_close($db);
		}
		    header('Location: list_account.php');
            break;
    }
    
        if($_POST['exit']){
                        header('Location: list_account.php');
                        exit();
                }
        if($_POST['deactivate']){
	mysqli_query($db, "UPDATE tbl_users SET status=0  WHERE id='$id' ");
                        header('Location: list_account.php');
                        exit();
                }

?>
<body>
<div class="container">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1 well-black">
                <tr>
<?php 
$tresults = mysqli_query($db, "SELECT * FROM tbl_users WHERE id='$id'");
$trow = mysqli_fetch_array($tresults);
?>
                        <th><h2>Edit account for <?php echo $trow['fname']." ".$trow['lname']; ?></h2></th>
                </tr>
                <tr>
                <td>
                <table class="table50">
                                <tr>
                                <td>First Name</td><td><input type="text" name="fname" value="<?php echo $trow['fname'] ?>" size="30"><span class="red"><?php echo $fn_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Last Name</td><td><input type="text" name="lname" value="<?php echo $trow['lname'] ?>" size="30"><span class="red"><?php echo $ln_error ?></span></td>
                                </tr>
                                <tr>
                                <td>E-mail</td><td><input type="text" name="email" value="<?php echo $trow['email'] ?>" size="30"><span class="red"><?php echo $e_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Password</td><td><input type="password" name="pass" size="30"><span class="red"><?php echo $pw_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Confirm Password</td><td><input type="password" name="pass1" size="30"><span class="red"><?php echo $pw_error ?></span></td>
                                </tr>
                                <td>User Access</td>
                                <td>
                                                        <select name="level" id="level">
                                                        <option value="<?php echo $trow['level'] ?>"><?php echo $trow['level'] ?></option>
                                                        <option value="Administrator">Administor</option>
														<option value="User">User</option>
                                </td>
                                </tr>
                                <td>
                                <input type="submit" name="register" value="Update" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
                                <input type="submit" name="deactivate" value="Deactivate" class="button" />&nbsp;
                                <tr>
                                </tr>
                </td>
                </tr>
        </table>
        </form>
		</td>
		</tr>
		</table>
        </div>
  </div>
</body>
<?php
//Import Footer file
require('footer.html');
?>
</html>
