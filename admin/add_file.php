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

//Results of Sign up button
        if(isset($_POST['register'])){
//Create counter
		$c=0;
//Create generic text field data
		$art_text="Enter article content here...";

		$a_activate="0";
		$art_type="txt";
//Prevent sql injections, grab entered variable

                $dept_id = mysqli_real_escape_string($db, strip_tags( $_POST['dept_id']));
                $art_name = mysqli_real_escape_string($db, strip_tags( $_POST['art_name']));
                $a_activate = mysqli_real_escape_string($db, strip_tags( $_POST['a_activate']));
                $an_sort =  mysqli_real_escape_string($db, strip_tags( $_POST['an_sort']));
                $art_text = mysqli_real_escape_string($db, strip_tags( $_POST['art_text']));


//Check that no page esists with this title
$tresults = mysqli_query($db, "SELECT art_name FROM tbl_articles WHERE art_name='$art_name'");
	$trow = mysqli_fetch_array($tresults);
	$name_test=$trow['art_name'];
	if(!empty($name_test)){
                $name_error="An article with this name already exists.";
               	$c++;
	}

//Null variables
		$an_error=" ";
		$at_error=" ";
		$ans_error=" ";

//Check if entered cata is not empty

	if(empty($art_name)){
                $an_error="YOu must specify an article name.";
		$c++;
    	}elseif(empty($art_text)){
                $at_error="There must be text for this article.";
		$c++;
    	}elseif(empty($an_sort) && $an_sort1 !== '0'){
                $ans_error="Sort order cannot be empty.";
		$c++;
//If valid insert data
        }else{ if($c==0){
//Enter valid data into DB

	mysqli_query($db, "INSERT INTO tbl_articles (art_name, art_text, art_type, an_sort, page_id, status) VALUES ('$art_name', '$art_text', '$art_type', '$an_sort', '$id', '$a_activate')");
               	mysqli_close($db);
                        header('Location: select_article.php?id='.$id);
	}
	}
        }
    
 if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
?>
<head>
	<script type="text/javascript" src="../includes/tiny_mce.js"></script>
	<script type="text/javascript">
	tinyMCE.init({
        mode : "textareas",
        theme : "advanced",
        plugins : "lists,table,paste",

        // Theme options
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,tablecontrols,bullist,numlist,|,undo,redo",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",
	});
	</script>


</head>
<body>
<div class="container ">

 <!--form method="post" action="<?php echo $PHP_SELF;?>"-->
 <form action="upload_file.php" method="post" enctype="multipart/form-data">
        <table class="table1 well-blue">
                <tr>
                        <th><h2>Upload File</h2></th>
                </tr>
                <tr>
                <td>
                <table class="center">
                    <tr>
						<td><label for="file">Filename:</label></td>
						<td><input type="file" name="file" id="file"></td></tr>
						<rt><td  class="lastrow"><input type="submit" name="submit" value="Submit">
						<input type="submit" name="exit" value="Exit"></td>
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
