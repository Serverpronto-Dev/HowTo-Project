<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

		//return to home page
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
				
$allowedExts = array("gif", "jpeg", "jpg", "png", "bmp", "pdf");
$extension = end(explode(".", $_FILES["file"]["name"]));
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/bmp")
|| ($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 20000000)
&& in_array($extension, $allowedExts))
  {
?>
<body>
        <div class="container ">
        <table border="1" class="table1 well-blue">
                <tr>

<?php
  if ($_FILES["file"]["error"] > 0)
    {
?>
    <td><?php echo "Return Code: " . $_FILES["file"]["error"] . "<br>";?></td>
<?php
    }
  else
    {
?>
    <td><?php echo "Upload: " . $_FILES["file"]["name"] . "<br>";?></td>
	<td><?php echo "Type: " . $_FILES["file"]["type"] . "<br>";?></td>
	<td><?php echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";?></td>
    <?php 
		$file_name=$_FILES["file"]["name"];
		$file_type=$_FILES["file"]["type"];
		$file_size=($_FILES["file"]["size"] / 1024) . " kB";
/*	
	
	echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
*/	
?>
<?php
    if (file_exists("upload/" . $_FILES["file"]["name"]))
      {
?>
      <td><?php echo $_FILES["file"]["name"] . " already exists. ";?></td>
<?php
      }
    else
      {
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "../upload/" . $_FILES["file"]["name"]);
?>
      <td><?php echo "Stored in: " . "../upload/" . $_FILES["file"]["name"];?></td>
	  
<?php
		$file_loc="../upload/" . $_FILES["file"]["name"];
		mysqli_query($db, "INSERT INTO tbl_files (name, type, size, location, date) 
			      VALUES ('$file_name', '$file_type', '$file_size', '$file_loc', NOW())");
        mysqli_close($db);
      }
    }
  }
else
  {
?>
                <td><?php echo "Invalid file";?></td>
<?php
  }
?>
                        </tr>
			<form method="post" action="<?php echo $PHP_SELF;?>"><tr><td><input type="submit" name="exit" value="Exit" class="button"/></td></tr></form>
        </table>
        </div>
</body>
<?php
//Import Footer file
require('footer.html');
?>
</html>
