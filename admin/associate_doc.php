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
                $file = mysqli_real_escape_string($db, strip_tags( $_POST['file']));
				$orig_file = mysqli_real_escape_string($db, strip_tags( $_POST['orig_file']));
				$file_des = mysqli_real_escape_string($db, strip_tags( $_POST['file_des']));
//Set new text
				mysqli_query($db, "UPDATE tbl_pages SET file='$file', file_des='$file_des' WHERE id='$id'");
				mysqli_query($db, "UPDATE tbl_files SET status='0' WHERE name='$file'");
				if($file!=$orig_file){
				mysqli_query($db, "UPDATE tbl_files SET status='1' WHERE name='$orig_file'");
				}
                mysqli_close($db);
                        header('Location: select_article.php?id='.$id);
                        exit();
                }

//return to home page
        if($_POST['back']){
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: select_article.php?id='.$id);
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

        <table border="1" class="table1 well-black">
                <tr>
                        <th><h2>Add a Document Download</h2></th>
                </tr>
                <tr>
                <td>
                <table>
				<tr>
				<th>Page Name</th>
				<th>Document</th>
				<th>Document Description</th>
				</tr>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_pages WHERE id='$page_id'");
				$trow = mysqli_fetch_array($tresults);
						$name=$trow['p_title'];
						$id=$trow['id'];
						$orig_file=$trow['file'];
						$file_des=$trow['file_des'];
						$page_id=$trow['dept_id'];
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                <tr>
				<td><?php echo $name ?></td>
				<td><select name="file"><option value="<?php echo $orig_file ?>"><?php echo $orig_file ?></option>
<?php
			$iresults = mysqli_query($db, "SELECT name FROM tbl_files WHERE type='application/pdf' AND status=1");
                                        if( $irow = mysqli_fetch_array($iresults)){
												do{
											$file_sel=$irow['name'];
													if($file!=$file_sel){
?>			
														<option value="<?php echo $file_sel ?>"><?php echo $file_sel ?></option>
<?php
													}
                                                }while($irow = mysqli_fetch_array($iresults));
                                        }
?>	
				</td>
				<td><input type="text" name="file_des" value="<?php echo $file_des ?>" size="25"></td>
				<td><input type="submit" name="submit" value="Submit" class="button"/>
				<input type="hidden" name="dept_id" value="<?php echo $dept_id ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
				<input type="hidden" name="orig_file" value="<?php echo $orig_file ?>"></td>
                </tr>
				<tr><td><input type="submit" name="back" value="Back" class="button"/>
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
