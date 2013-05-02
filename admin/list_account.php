<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');



        if($_POST['edit']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//refer request to appropriate page
                        header('Location: edit_account.php?id='.$id);
                        exit();
                }

        if($_POST['exit']){
//Refer to home page
                        header('Location: index.php');
                        exit();
                }

        if($_POST['register']){
//Reger to register page
                        header('Location: register.php');
                        exit();
                }

?>
<body>
<div class="container">
        <table border="1" class="table1 well-black">
                <tr>
                        <th><h2>Edit Account</h2></th>
                </tr>
                <tr>
                <td>
                <table class="table25">
<?php
//Retrive required data from DB and display
                                $tresults = mysqli_query($db, "SELECT * FROM tbl_users WHERE status=1 ORDER BY lname");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
?>
                                <tr>
				<form method="post" action="<?php echo $PHP_SELF;?>">
					<td><?php echo $trow['lname'] ?></td>
					<td><?php echo $trow['fname'] ?></td>
					<td><?php echo $trow['email'] ?></td>
					<td><input type="hidden" name="id" value="<?php echo $trow['id'] ?>" />
					<input type="submit" name="edit" value="Edit" class="button"/></td>
				</form>
                                </tr>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>	
                                <tr> <form method="post" action="<?php echo $PHP_SELF;?>">
                                <td colspan="2">
                                <input type="submit" name="register" value="Create Account" class="button"/>&nbsp;
								<input type="submit" name="exit" value="Exit" class="button" />
								</td></form>
				</tr>
        </table>
	</td>
	</tr>
	</table>
</body>
</div>
<?php
//Import Footer file
require('footer.html');
?>
</html>
