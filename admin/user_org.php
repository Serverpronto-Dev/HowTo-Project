<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>

<?php
ob_start();
// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

        if($_POST['deactivate_user_type']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_user_types SET status='0' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: user_org.php');
                        exit();
                }    

        if($_POST['activate_user_type']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_user_types SET status='1' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: user_org.php');
                        exit();
                }
        if($_POST['deactivate_org']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_user_org SET status='0' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: user_org.php');
                        exit();
                }    

        if($_POST['activate_org']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_user_org SET status='1' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: user_org.php');
                        exit();
                }	
        if($_POST['delete_user_type']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_user_types SET status='3' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: user_org.php');
                        exit();
                }				
				if($_POST['delete_org']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_user_org SET status='3' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: user_org.php');
                        exit();
                }
				
				
//return to home page
        if($_POST['add']){
                        header('Location: add_user_org.php');
                        exit();
                }
				
//return to home page
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
?>

<body>
<div class="container ">
        <table border="1" class="table1 well-blue">
                <tr>
                        <th colspan="100%"><h2>User Type/Organizations</h2></th>
                </tr>
				<tr>
				<td>
                <table class="table30">
				<th>User Type</th>
				<th>Status</th>
				<th>Action</th> 
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_user_types WHERE status IN (0, 1)");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$name=$trow['type'];
						$status=$trow['status'];
						$id=$trow['id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr>
				<td class="td_left" nowrap ><?php echo $name ?></td>
                                <td><?php
                                        switch($status){
                                        case "0":
                                                $status="Inactive";
                                                break;
                                        case "1":
                                                $status="Active";
                                                break;
                                        default:
                                                $status="Unknown";
                                }
                                echo $status ?><input type="hidden" name="id" value="<?php echo $id ?>"></td>
				<td>
<?php
	if($status=="Active"){
?>
				<input type="submit" name="deactivate_user_type" value="Deactivate" class="button"/>
<?php
	}
	if($status=="Inactive"){
?>	
				<input type="submit" name="activate_user_type" value="Activate" class="button"/>
<?php
}
?>
				<input type="submit" name="delete_user_type" value="Delete" class="button"/>
                </td>
				</tr>
				</form>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td><td>&nbsp;</td></tr>

				<th>Orginazation</th>
				<th>Status</th>
				<th>Action</th> 
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_user_org WHERE status IN(0, 1) ");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$name=$trow['org'];
						$status=$trow['status'];
						$id=$trow['id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr>
				<td class="td_left" nowrap ><?php echo $name ?></td>
                                <td><?php
                                        switch($status){
                                        case "0":
                                                $status="Inactive";
                                                break;
                                        case "1":
                                                $status="Active";
                                                break;
                                        default:
                                                $status="Unknown";
                                }
                                echo $status ?><input type="hidden" name="id" value="<?php echo $id ?>"></td>
				<td>
<?php
	if($status=="Active"){
?>
				<input type="submit" name="deactivate_org" value="Deactivate" class="button"/>
<?php
	}
	if($status=="Inactive"){
?>	
				<input type="submit" name="activate_org" value="Activate" class="button"/>
<?php
}
?>
				<input type="submit" name="delete_org" value="Delete" class="button"/>
                </td>
				</tr>
				</form>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
				<tr>
				<td><input type="submit" name="exit" value="Exit" class="button"/>
				<input type="submit" name="add" value="Add" class="button"/></td>
				<td></td>
				<td></td>
				</tr>
				</form>


                </table>				
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
