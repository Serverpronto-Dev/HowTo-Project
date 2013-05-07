<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

//added php-mysql security
        $page_id = mysqli_real_escape_string($db, strip_tags($_GET['id']));

        if($_POST['edit']){
//Added sql security to prevent sql injection
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
//Refer to correct page for edit
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }    

        if($_POST['activate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
//Set status to 1 if activating
                mysqli_query($db, "UPDATE tbl_articles SET status='1' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: select_article.php?id='.$page_id);
                        exit();
                }    

        if($_POST['deactivate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_articles SET status='0' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: select_article.php?id='.$page_id);
                        exit();
                }    
				
				        if($_POST['edit_name']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: edit_page_name.php?id='.$page_id);
                        exit();
                } 
				
				        if($_POST['document']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: associate_doc.php?id='.$page_id);
                        exit();
                }  


        if($_POST['add']){
//Add An article to current web page
                        header('Location: add_article.php?id='.$page_id);
                        exit();
                }    
    

//go back one page
        if($_POST['back']){
		 $sresults = mysqli_query($db, "SELECT dept_id FROM tbl_pages WHERE id='$page_id'");
			$srow = mysqli_fetch_array($sresults);
			$dept_id=$srow['dept_id'];
                        header('Location: select_page.php?id='.$dept_id);
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
                        <th><h2>Select an Article</h2></th>
                </tr>
                <tr>
<?php
			$presults = mysqli_query($db, "SELECT p_title FROM tbl_pages WHERE id='$page_id'");
                                         $prow = mysqli_fetch_array($presults);
?>				
						<th><h3><?php echo $prow['p_title'] ?></h3></th>
				</tr>
				<tr>
				<td>
                <table class="table25">
				<tr>
				<th>Article Name</th>
				<th>Status</th>
				<th>Sort Order</th>
				<th>Actions</th>
				</tr>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_articles WHERE page_id='$page_id' ORDER BY an_sort");
                                         $trow = mysqli_fetch_array($tresults);
                                                do{
						$name=$trow['art_name'];
						$status=$trow['status'];
						$sort=$trow['an_sort'];
						$id=$trow['id'];

?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr>
				<td nowrap><?php echo $name ?></td>
				<td>
				<?php 
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
				echo $status ?>
				</td>
				<td><?php echo $sort ?></td>
				<td><input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="submit" name="edit" value="Edit" class="button"/>
<?php
	if($status=="Active"){
?>
				<input type="submit" name="deactivate" value="Deactivate" class="button"/></td>
<?php
	}
	if($status=="Inactive"){
?>
				<input type="submit" name="activate" value="Activate" class="button"/></td>
<?php
	}
?>

                                </tr>
				</form>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
				<tr>
<?php
			$presults = mysqli_query($db, "SELECT file, file_des FROM tbl_pages WHERE id='$page_id'");
                                         $prow = mysqli_fetch_array($presults);
										 $file=$prow['file'];
										 $file_des=$prow['file_des']; 
?>				
				<td>Page Document:</td>
				<td><?php echo $file ?></td><td><?php echo $file_des ?></td><td><input type="submit" name="document" value="Associate Document" class="button"/></td>
				<tr>
				<td><input type="submit" name="back" value="Back" class="button"/>
				<input type="submit" name="exit" value="Exit" class="button"/></td>
				<td colspan="2"><input type="submit" name="edit_name" value="Change Page Name" class="button"/>
				<input type="submit" name="add" value="Add Article" class="button"/></td><td></td>
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
