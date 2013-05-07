<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>

<?php
ob_start();
// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');


  
//Edit category name
        if($_POST['select']){
				$id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: add_page.php?id='.$id);
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
                        <th><h2>Select the topic in which you want to add a page.</h2></th>
                </tr>
                <tr>
                <td>
                <table class="table30_text">
				<form method="post" action="<?php echo $PHP_SELF;?>">
							<tr>
                                <td>Topic:</td><td>
									<select name="id" id="id">
												<option value="">Select Topic</option>
<?php

                                $qresults = mysqli_query($db, "SELECT id, name FROM tbl_topic WHERE status='1'");
									if($qrow = mysqli_fetch_array($qresults)){

?>

<?php
//Retrieve data from the DB and display
                                                do{
												    $id=$qrow['id'];
													$name=$qrow['name'];
?>
                                                <option value="<?php echo $id ?>"><?php echo $name ?></option>
<?php
                                                }while($qrow = mysqli_fetch_array($qresults));
                                        }
                                ?>
								</select>
								</td>
                                </tr>

				<tr><td>
				<input type="submit" name="select" value="Select" class="button"/>
				<input type="submit" name="exit" value="Exit" class="button"/>
				</td></tr>
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
