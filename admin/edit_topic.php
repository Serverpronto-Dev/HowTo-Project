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
		$topic_id=$id;
//Results of Sign up button
        if(isset($_POST['add'])){
//Create counter
                $c=0;
//Prevent sql injections, grab entered variable

                $topic_name = mysqli_real_escape_string($db, strip_tags( $_POST['topic_name']));
				$id= mysqli_real_escape_string($db, strip_tags( $_POST['id']));

//Check that no category esists with this title
$tresults = mysqli_query($db, "SELECT name FROM tbl_topic WHERE name='$topic_name'");
        $trow = mysqli_fetch_array($tresults);
        $name_test=$trow['name'];
        if(!empty($name_test)){
                $topic_error="This name already exists.";
                $c++;
        }



//Check if entered category is not empty

        if(empty($topic_name)){
                $topic_error="You must specify a name.";
                $c++;
//If valid insert data
        }else{ if($c==0){
//Enter valid data into DB

        mysqli_query($db, "UPDATE tbl_topic SET name='$topic_name' WHERE id='$topic_id'");
                mysqli_close($db);
                        header('Location: select_topic.php');
        }
        }
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
        <table border="1" class="table1 well-black">
                <tr style="color:white;"a>
                        <th><h2>Edit Topic Name</h2></th>
                </tr>
                <tr>
                <td>
                <table class="table50">
                                <tr>
<?php
$nresults = mysqli_query($db, "SELECT name FROM tbl_topic WHERE id='$id'");
        $nrow = mysqli_fetch_array($nresults);
        $topic_name=$nrow['name'];								
		$id=$nrow['id'];								
?>
                                <td>New Topic Name:</td><td><input type="text" name="topic_name" value="<?php echo $topic_name ?>" size="85"><span class="red"><?php echo $topic_error ?></span></td>
                                </tr>
                                <tr>
                                <td>
								<input type="hidden" name="id" value="<?php echo $id ?>">
                                <input type="submit" name="add" value="Update" class="button"/>&nbsp;
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
