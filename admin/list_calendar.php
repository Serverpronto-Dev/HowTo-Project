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
                        header('Location: edit_calendar.php?id='.$id);
                        exit();
                }
        if($_POST['deactivate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_calendar SET status='0' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: list_calendar.php');
                        exit();
                }    

        if($_POST['activate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_calendar SET status='1' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: list_calendar.php');
                        exit();
                }
        if($_POST['decrease']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $sort = mysqli_real_escape_string($db, strip_tags( $_POST['sort']));
				$new_sort=$sort-1;
//Set order down 1
                mysqli_query($db, "UPDATE tbl_calendar SET sort='$new_sort' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: list_calendar.php');
                        exit();
                }    
        if($_POST['increase']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $sort = mysqli_real_escape_string($db, strip_tags( $_POST['sort']));
                $new_sort=$sort+1;
//Set order down 1
                mysqli_query($db, "UPDATE tbl_calendar SET sort='$new_sort' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: list_calendar.php');
                        exit();
                }
        if($_POST['delete']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                mysqli_query($db, "UPDATE tbl_calendar SET status='3' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: list_calendar.php');
                        exit();
                }

		if($_POST['add']){
//Add calendar event
                        header('Location: add_calendar.php');
                        exit();
                }
        if($_POST['exit']){
//Refer to home page
                        header('Location: index.php');
                        exit();
                }

?>
<body>
<div class="container">
        <table border="1" class="table1 well-blue">
                <tr>
                        <th><h2>Edit Calendar</h2></th>
                </tr>
                <tr>
                <td>
                <table class="table25">
					<tr>
					<td>Event</td>
					<td>Status</td>
					<td>Sort Order</td>
					<td>Duration</td>
					<td>Action</td>
					</tr>
<?php
//Retrive required data from DB and display
                                $tresults = mysqli_query($db, "SELECT id, event, sort, status, DAY(s_date) AS s_day, DAY(e_date) AS e_day, MONTH(s_date) as s_month, MONTH(e_date) as e_month, YEAR(s_date) as s_year, YEAR(e_date) as e_year FROM tbl_calendar WHERE status IN (0, 1) ORDER BY sort");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
													$s_date=$trow['s_month']."/".$trow['s_day']."/".$trow['s_year'];
													$e_date=$trow['e_month']."/".$trow['e_day']."/".$trow['e_year'];
													$status=$trow['status'];
													$sort=$trow['sort'];
?>

                    <tr>
				<form method="post" action="<?php echo $PHP_SELF;?>">
					<td><?php echo $trow['event'] ?></td>
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
                                echo $status ?></td>		
							<td nowrap ><input type="submit" name="increase" value="Up" class="button"/> 
							<?php echo $sort ?>
							<input type="submit" name="decrease" value="Down" class="button"/>
							<input type="hidden" name="sort" value="<?php echo $sort ?>"></td>
					<td><?php echo $s_date." - ".$e_date ?></td>
					<td nowrap ><input type="hidden" name="id" value="<?php echo $trow['id'] ?>" />
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
					<input type="submit" name="edit" value="Edit" class="button"/>
					<input type="submit" name="delete" value="Delete" class="button"/></td>
				</form>
                                </tr>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>	
                                <tr> <form method="post" action="<?php echo $PHP_SELF;?>">
                                <td colspan="100%" style="text-align:left;">
								<input type="submit" name="add" value="Add" class="button" />
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
