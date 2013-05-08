<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>

<?php
ob_start();
// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');


        if($_POST['edit']){
//Added sql security to prevent sql injection
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Refer to correct page for edit
                        header('Location: select_category.php?id='.$id);
                        exit();
                }    
        if($_POST['deactivate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_topic SET status='0' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: select_topic.php?id='.$id);
                        exit();
                }    

        if($_POST['activate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_topic SET status='1' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: select_topic.php?id='.$id);
                        exit();
                }
        if($_POST['decrease']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $sort = mysqli_real_escape_string($db, strip_tags( $_POST['sort']));
				$new_sort=$sort-1;
//Set order down 1
                mysqli_query($db, "UPDATE tbl_topic SET sort_order='$new_sort' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: select_topic.php');
                        exit();
                }    
        if($_POST['increase']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $sort = mysqli_real_escape_string($db, strip_tags( $_POST['sort']));
                $new_sort=$sort+1;
//Set order down 1
                mysqli_query($db, "UPDATE tbl_topic SET sort_order='$new_sort' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: select_topic.php');
                        exit();
                }
//Edit category name
        if($_POST['edit_name']){
				$id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: edit_topic.php?id='.$id);
                        exit();
                }				
//return to home page
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
?>

<body>
<div class="container  ">
        <table class="table1 well-blue">
                <tr>
                        <th colspan="100%"><h2>Select a Topic</h2></th>
                </tr>
				<tr>
				<td>
                <table class="center">
				<th>Topic</th>
				<th>Status</th>
				<th>Sort Order</th>
				<th>Action</th> 
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_topic ORDER BY sort");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$name=$trow['name'];
						$status=$trow['status'];
						$sort_order=$trow['sort'];
						$id=$trow['id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr>
				<td nowrap><?php echo $name ?></td>
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
				<td nowrap ><input type="submit" name="increase" value="Up" class="button"/> 
				<?php echo $sort_order ?>
				<input type="submit" name="decrease" value="Down" class="button"/>
				<input type="hidden" name="sort" value="<?php echo $sort_order ?>"></td>
				<td nowrap >
				<input type="submit" name="edit" value="Categories" class="button"/>
<?php
	if($status=="Active"){
?>
				<input type="submit" name="deactivate" value="Deactivate" class="button"/>
<?php
	}
	if($status=="Inactive"){
?>	
				<input type="submit" name="activate" value="Activate" class="button"/>
<?php
}
?>
                <input type="submit" name="edit_name" value="Edit" class="button"/></td>
				</tr>
				</form>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
				<tr>
				<td class="lastrow"><input type="submit" name="exit" value="Exit" class="button"/></td>
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
