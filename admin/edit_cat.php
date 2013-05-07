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
		$dept_id=$id;
//Results of Sign up button
        if(isset($_POST['add'])){
//Create counter
                $c=0;
//Prevent sql injections, grab entered variable

                $cat_name = mysqli_real_escape_string($db, strip_tags( $_POST['cat_name']));
				$id= mysqli_real_escape_string($db, strip_tags( $_POST['id']));

//Check that no category esists with this title
$tresults = mysqli_query($db, "SELECT name FROM tbl_dept WHERE name='$cat_name'");
        $trow = mysqli_fetch_array($tresults);
        $name_test=$trow['name'];
        if(!empty($name_test)){
                $cat_error="An article with this name already exists.";
                $c++;
        }



//Check if entered category is not empty

        if(empty($cat_name)){
                $cat_error="You must specify an category name.";
                $c++;
//If valid insert data
        }else{ if($c==0){
//Enter valid data into DB

        mysqli_query($db, "UPDATE tbl_dept SET name='$cat_name' WHERE id='$dept_id'");
                mysqli_close($db);
                        header('Location: select_category.php');
        }
        }
        }
        if($_POST['back']){
				$topic_id= mysqli_real_escape_string($db, strip_tags( $_POST['topic_id']));
                        header('Location: select_category.php?id='.$topic_id);
                        exit();
                }
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<body>
<div class="container ">

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1 well-blue">
                <tr style="color:white;"a>
                        <th><h2>Edit Category Name</h2></th>
                </tr>
                <tr>
                <td>
                <table class="table50">
                                <tr>
<?php
$nresults = mysqli_query($db, "SELECT name, topic FROM tbl_dept WHERE id='$id'");
        $nrow = mysqli_fetch_array($nresults);
        $cat_name=$nrow['name'];								
		$id=$nrow['id'];								
		$topic_id=$nrow['topic'];								
?>
                                <td>New Category Name:</td><td><input type="text" name="cat_name" value="<?php echo $cat_name ?>" size="85"><span class="red"><?php echo $cat_error ?></span></td>
                                </tr>
                                <tr>
                                <td>
								<input type="hidden" name="id" value="<?php echo $id ?>">
								<input type="hidden" name="topic_id" value="<?php echo $topic_id ?>">
                                <input type="submit" name="add" value="Update" class="button"/>&nbsp;
                                <input type="submit" name="back" value="Back" class="button" />&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
								</td>
                                </tr>
                </table>
                </td>
                </tr>
        </table>
        </form>

        </div>
  </div>
</body>
<?php
//Import Footer file
require('footer.html');
?>
</html>
