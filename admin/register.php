<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

//Include db details and credentials
include('../../includes/db.php');
//Import header file
        require('header.php');


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
                $phone = mysqli_real_escape_string($db, strip_tags( $_POST['phone']));
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
        }elseif(empty($pass)){
                $pw_error="A password is required.";
		$c++;
//Check if passwords match
        }elseif ($pass==$pass1 && $c==0){
//Enter valid data into DB
		$password=md5($pass);
		mysqli_query($db, "INSERT INTO tbl_users (fname, lname, email, password, phone, level, date) 
					      VALUES ('$fname', '$lname', '$email', '$password', '$phone', '$level', NOW())");
               	mysqli_close($db);
                        header('Location: index.php');
                        break;
//If passwords don't match, reject
	}else{
			$pw_error="Passwords must match";
//    			header('Location: register.php');
//			exit();
	}

                }
    
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
?>
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1 well-black">
                <tr>
                        <th><h2>Create Account</h2></th>
                </tr>
                <tr>
                <td>
                <table class="table50">
                                <tr>
                                <td>First Name</td><td><input type="text" name="fname" value="<?php echo $fname ?>" size="30"><span class="red"><?php echo $fn_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Last Name</td><td><input type="text" name="lname" value="<?php echo $lname ?>" size="30"><span class="red"><?php echo $ln_error ?></span></td>
                                </tr>
                                <tr>
                                <td>E-mail</td><td><input type="text" name="email" value="<?php echo $email ?>" size="30"><span class="red"><?php echo $e_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Password</td><td><input type="password" name="pass" size="30"><span class="red"><?php echo $pw_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Confirm Password</td><td><input type="password" name="pass1" size="30"><span class="red"><?php echo $pw_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Phone Number</td><td><input type="text" name="phone" value="<?php echo $phone ?>" size="30"></td>
                                </tr>
				<tr>
					<td>User Access Level: </td>
					<td>
                                    <select name="level" id="level">
										<option value="Administrator">Administrator</option>
                                        <option value="User">User</option>
									</select>
					</td>
				</tr>
                                <td>
                                <input type="submit" name="register" value="Create" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
                                <input type="reset" value="Clear" /></td>
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

</body>
<?php
//Import Footer file
require('footer.html');
?>
</html>
