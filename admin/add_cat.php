<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');
		
	
//Results of Sign up button
        if(isset($_POST['add'])){
//Create counter
                $c=0;
//Prevent sql injections, grab entered variable

                $cat_name = mysqli_real_escape_string($db, strip_tags( $_POST['cat_name']));
                $cat_activate = mysqli_real_escape_string($db, strip_tags( $_POST['cat_activate']));
                $cat_sort =  mysqli_real_escape_string($db, strip_tags( $_POST['cat_sort']));
				$topic_id =  mysqli_real_escape_string($db, strip_tags( $_POST['topic_id']));
				
//Check that no category esists with this title
$tresults = mysqli_query($db, "SELECT name FROM tbl_dept WHERE name='$cat_name' and topic='$topic_id'");
        $trow = mysqli_fetch_array($tresults);
        $name_test=$trow['name'];
        if(!empty($name_test)){
                $cat_error="An article with this name already exists.";
                $c++;
        }

//Null variables
                $cs_error=" ";

//Check if entered category is not empty

        if(empty($cat_name)){
                $cat_error="You must specify an category name.";
                $c++;
        }elseif(empty($cat_sort) && $cat_sort !== '0'){
                $cs_error="Sort order cannot be empty.";
                $c++;
//If valid insert data
        }else{ if($c==0){
//Enter valid data into DB

        mysqli_query($db, "INSERT INTO tbl_dept (name, sort_order, status, topic) VALUES ('$cat_name', '$cat_sort', '$cat_activate', '$topic_id')");
                mysqli_close($db);
                        header('Location: select_category.php?id='.$topic_id);
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
        <table border="0" class="table1 well-blue">
                        <th><h2>Add a New Category</h2></th>
                </tr>
                <tr>
                <td>
                <table>
					<form method="post" action="<?php echo $PHP_SELF;?>">
                                <tr>
                                <td>New Category Name:<input type="text" name="cat_name" value="<?php echo $cat_name ?>" size="85"><span class="red"><?php echo $cat_error ?></span></td>
                                <td>Sort Order:<input class="textarea_short" type="text" name="cat_sort" value="<?php echo $cat_sort ?>" size="2"><span class="red"><?php echo $cs_error ?></span></td>
								<td><select name="topic_id" id="topic_id">
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
								</select></td>
								<td><input type="checkbox" name="cat_activate" value="1">Activate?</td>
                                </tr>
                                <tr>
                                <td colspan="100%" style="text-align:left;padding-bottom;40px;">
                                <input type="submit" name="add" value="Add" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
								</td>
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
