<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

//added php-mysql security
        $article_id = mysqli_real_escape_string($db, strip_tags($_GET['id']));
/*
        if($_POST['delete']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $page_id = mysqli_real_escape_string($db, strip_tags( $_POST['page_id']));
$dresults = mysqli_query($db, "DELETE FROM tbl_articles WHERE id='$id'");
//Refer to correct page for edit
                        header('Location: select_article.php?id='.$page_id);
                        exit();
                }    
*/
        if($_POST['activate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
//Set status to 1 if activating
                mysqli_query($db, "UPDATE tbl_articles SET status='1' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }    

        if($_POST['deactivate']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
//Set status to 0 if deactivating
                mysqli_query($db, "UPDATE tbl_articles SET status='0' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }    

        if($_POST['decrease']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $sort = mysqli_real_escape_string($db, strip_tags( $_POST['sort']));
		$new_sort=$sort-1;
//Set order down 1
                mysqli_query($db, "UPDATE tbl_articles SET an_sort='$new_sort' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }    

        if($_POST['increase']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $sort = mysqli_real_escape_string($db, strip_tags( $_POST['sort']));
                $new_sort=$sort+1;
//Set order down 1
                mysqli_query($db, "UPDATE tbl_articles SET an_sort='$new_sort' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }

        if($_POST['edit']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: edit_article_text.php?id='.$id);
                        exit();
                }
				if($_POST['edit_title']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: edit_article_title.php?id='.$id);
                        exit();
                }

//back to previous page
        if($_POST['back']){
                 $sresults = mysqli_query($db, "SELECT page_id FROM tbl_articles WHERE id='$article_id'");
                        $srow = mysqli_fetch_array($sresults);
                        $page_id=$srow['page_id'];
                        header('Location: select_article.php?id='.$page_id);
                        exit();
                }
//return to home page
        if($_POST['image']){
//		                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: associate_image.php?id='.$article_id);
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

        <table class="table1 well-blue">
                <tr>
                        <th><h2>Edit an Article</h2></th>
                </tr>
                <tr>
                <td>
                <table class="center">
				<tr>
				<th>Article Name</th>
				<th colspan="2">Content</th>
				<th>Image</th>
				<th>Status</th>
				<th>Sort Order</th>
				<th>Actions</th>
				</tr>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_articles WHERE id='$article_id'");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$name=$trow['art_name'];
						$id=$trow['id'];
						$sort=$trow['an_sort'];
						$status=$trow['status'];
						$art_text=$trow['art_text'];
						$page_id=$trow['page_id'];
						$image=$trow['image'];
						$image=$trow['image'];
						$display_name=$trow['display_name'];
					
					if($display_name==1){
						$show_title="Yes";
					}else{
						$show_title="No";
					}
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr><td rowspan="3">
									<table>
										<tr>
						<td><?php echo $name ?></td>
						<td><input type="submit" name="edit_title" value="Edit Title" class="button"/></td>
										</tr>
										<tr>
										</tr>
										<tr>
						<br /><td>Display Article Title: <?php echo $show_title ?></td>
										</tr>
									</table></td>
						<td><?php echo $art_text ?>
						</td><td><input type="submit" name="edit" value="Edit Text" class="button"/></td>
                                <td><?php echo $image ?></td>
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
				<!--td><input type="submit" name="increase" value="Up" class="button"/><br />
				<?php echo $sort ?><br />
				<input type="submit" name="decrease" value="Down" class="button"/></td-->
				<td><input type="hidden" name="page_id" value="<?php echo $page_id ?>"></td>
				<td><input type="hidden" name="sort" value="<?php echo $sort ?>"></td>
				<td><input type="hidden" name="id" value="<?php echo $id ?>"></td>
<?php				
		if($status=="Active"){
?>
				<!--td><input type="submit" name="deactivate" value="Deactivate" class="button"/></td-->
<?php
		}
		if($status=="Inactive"){
?>
				<!--td><input type="submit" name="activate" value="Activate" class="button"/></td-->
<?php
		}
?>
				<!--td><input type="submit" name="delete" value="delete" class="button"/></td-->
                                </tr>
				</form>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
				<tr>
				<td><input type="submit" name="back" value="Back" class="button"/>
				<input type="submit" name="exit" value="Exit" class="button"/></td>
				<td class="lastrow"></td>
				<td><input type="submit" name="image" value="Associate Image" class="button"/></td>
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
