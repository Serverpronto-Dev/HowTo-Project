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


        if($_POST['submit']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $image = mysqli_real_escape_string($db, strip_tags( $_POST['image']));
				$orig_image = mysqli_real_escape_string($db, strip_tags( $_POST['orig_image']));
				$image_des = mysqli_real_escape_string($db, strip_tags( $_POST['image_des']));
				$image_loc = mysqli_real_escape_string($db, strip_tags( $_POST['image_loc']));				
//Set new text
				mysqli_query($db, "UPDATE tbl_articles SET image='$image', image_des='$image_des', image_loc='$image_loc' WHERE id='$id'");
				mysqli_query($db, "UPDATE tbl_files SET status='0' WHERE name='$image'");
				if($image!=$orig_file){
				mysqli_query($db, "UPDATE tbl_files SET status='1' WHERE name='$orig_image'");
				}
                mysqli_close($db);
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }

//return to home page
        if($_POST['back']){
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }
//return to home page
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }

?>
<html>
<head>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../includes/main.css" type="text/css">


        <title>Daily Living Toolkit</title>
</head>
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
				<th>Page Name</th>
				<th>Image</th>
				<th>Image Description</th>
				<th>Position</th>
				<th>Action</th>
				</tr>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_articles WHERE id='$article_id'");
				$trow = mysqli_fetch_array($tresults);
						$name=$trow['art_name'];
						$id=$trow['id'];
						$orig_image=$trow['image'];
						$image_des=$trow['image_des'];
						$image_loc=$trow['image_loc'];
						$page_id=$trow['page_id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                <tr>
				<td><?php echo $name ?></td>
				<td><select name="image"><option value="<?php echo $orig_image ?>"><?php echo $orig_image ?></option>
<?php
			$iresults = mysqli_query($db, "SELECT name FROM tbl_files WHERE type IN ('image/png', 'image/jpg', 'image/jpeg', 'image/gif', 'image/bmp') AND status=1");
                                        if( $irow = mysqli_fetch_array($iresults)){
												do{
											$image_sel=$irow['name'];
													if($image!=$image_sel){
?>			
														<option value="<?php echo $image_sel ?>"><?php echo $image_sel ?></option>
<?php
													}
                                                }while($irow = mysqli_fetch_array($iresults));
                                        }
?>	
				</td>
				<td><input type="text" name="image_des" value="<?php echo $image_des ?>" size="25"></td>
				<td><select name="image_loc"><option value="<?php echo $image_loc ?>"><?php echo $image_loc ?></option>
				<option value="left">Left</option>
				<option value="center_top">Center Top</option>
				<option value="center_bottom">Center Bottom</option>
				<option value="right">Right</option>
				</select></td>
				<td><input type="submit" name="submit" value="Submit" class="button"/>
				<input type="hidden" name="page_id" value="<?php echo $page_id ?>">
				<input type="hidden" name="orig_image" value="<?php echo $orig_image ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>"></td>
                </tr>
				<tr><td class="lastrow"><input type="submit" name="back" value="Back" class="button"/>
				<input type="submit" name="exit" value="Exit" class="button"/></td></tr>
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

