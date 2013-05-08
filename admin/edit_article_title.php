<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

//added php-mysql security
        $id = mysqli_real_escape_string($db, strip_tags($_GET['id']));


        if($_POST['submit']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $new_art_name = mysqli_real_escape_string($db, trim( $_POST['new_art_name']));
//Set new text
                mysqli_query($db, "UPDATE tbl_articles SET art_name='$new_art_name' WHERE id='$id'");
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
<body>
<div class="container ">

        <table class="table1 well-blue">
                <tr>
                        <th><h2>Edit an Article Title</h2></th>
                </tr>
                <tr>
                <td>
                <table class="center">
				<tr>
				<th>Current Article Title</th>
				<th>New Article Title</th>
				</tr>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT art_name FROM tbl_articles WHERE id='$id'");
                        $trow = mysqli_fetch_array($tresults);
						$art_name=$trow['art_name'];
//						$id=$trow['id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                <tr>
				
				<td><?php echo $art_name ?></td>
				<td><input type="text" name="new_art_name" value="<?php echo $art_name ?>" size="85">
				<input type="hidden" name="id" value="<?php echo $id ?>"></td>
                </tr>
				<tr><td class="lastrow"><input type="submit" name="back" value="Back" class="button"/>
				<input type="submit" name="exit" value="Exit" class="button"/>
				<input type="submit" name="submit" value="Submit" class="button"/></td>
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
