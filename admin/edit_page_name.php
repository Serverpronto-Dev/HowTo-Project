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


        if($_POST['submit']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $new_p_title = mysqli_real_escape_string($db, trim( $_POST['new_p_title']));
//Set new text
                mysqli_query($db, "UPDATE tbl_pages SET p_title='$new_p_title' WHERE id='$page_id'");
                mysqli_close($db);
                        header('Location: select_article.php?id='.$page_id);
                        exit();
                }
 
//return to home page
        if($_POST['back']){
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: select_article.php?id='.$page_id);
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
                        <th><h2>Edit A Page Title</h2></th>
                </tr>
                <tr>
                <td>
                <table class="center">
				<tr>
				<th>Current Page Name</th>
				<th>New Page Name</th>
				</tr>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT p_title FROM tbl_pages WHERE id='$page_id'");
                        $trow = mysqli_fetch_array($tresults);
						$p_title=$trow['p_title'];
						$id=$trow['id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                <tr>
				
				<td><?php echo $p_title ?></td>
				<td><input type="text" name="new_p_title" value="<?php echo $p_title ?>" size="85">
				<input type="hidden" name="page_id" value="<?php echo $id ?>"></td>
                </tr>
				<tr><td class="lastrow"><input type="submit" name="back" value="Back" class="button"/>
				<input type="submit" name="exit" value="Exit" class="button"/></td>
				<td><input type="submit" name="submit" value="Submit" class="button"/></td>
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
