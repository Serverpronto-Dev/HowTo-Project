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
				$id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
				$description =  mysqli_real_escape_string($db, trim( $_POST['description']));

//Check that no category exists with this title
$tresults = mysqli_query($db, "SELECT name FROM tbl_topic WHERE name='$topic_name' AND id!='$topic_id'");
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
		}elseif(empty($description)){
                $desc_error="Description cannot be empty.";
                $c++;				
//If valid insert data
        }else{ if($c==0){
//Enter valid data into DB

        mysqli_query($db, "UPDATE tbl_topic SET name='$topic_name', description='$description' WHERE id='$topic_id'");
                mysqli_close($db);
                        header('Location: select_topic.php');
        }
        }
        }
        if($_POST['back']){
                        header('Location: select_topic.php');
                        exit();
                }
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<script type="text/javascript" src="../includes/tinymce/tiny_mce.js"></script>
<script type="text/javascript">
tinyMCE.init({
        // General options
        mode : "textareas",
        theme : "advanced",
        element_format : "html",
        plugins : "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

        // Theme options
        theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
        theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
        theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
        theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage",
        theme_advanced_toolbar_location : "top",
        theme_advanced_toolbar_align : "left",
        theme_advanced_statusbar_location : "bottom",
        theme_advanced_resizing : true,

        // Skin options
        skin : "o2k7",
        skin_variant : "silver",

        // Drop lists for link/image/media/template dialogs
        template_external_list_url : "js/template_list.js",
        external_link_list_url : "js/link_list.js",
        external_image_list_url : "js/image_list.js",
        media_external_list_url : "js/media_list.js",

});
</script>
</head>
<body>
<div class="container ">

        <table class="table1 well-blue">
                <tr style="color:white;"a>
                        <th><h2>Edit Topic Name</h2></th>
                </tr>
                <tr>
                <td>
                <table class="center">
				<form method="post" action="<?php echo $PHP_SELF;?>">
					<tr>
<?php
$nresults = mysqli_query($db, "SELECT name, description, id FROM tbl_topic WHERE id='$topic_id'");
        $nrow = mysqli_fetch_array($nresults);
        $topic_name=$nrow['name'];								
		$id=$nrow['id'];								
		$description=$nrow['description'];				
?>
                                <td>New Topic Name:</td><td><input type="text" name="topic_name" value="<?php echo $topic_name ?>" size="85"></td><td><span class="red"><?php echo $topic_error ?></span></td>
                                </tr>
								<tr>
                                <td>Description:</td><td><textarea name="description" cols="70" rows="25" Value="<?php /*echo $description */?>"><?php echo $description ?></textarea></td><td><span class="red"><?php echo $desc_error ?></span></td>
                                </tr>								 
                                <tr>
                                <td class="lastrow">
								<input type="hidden" name="id" value="<?php echo $topic_id ?>">
                                <input type="submit" name="add" value="Update" class="button"/>&nbsp;
                                <input type="submit" name="back" value="Back" class="button" />&nbsp;
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
