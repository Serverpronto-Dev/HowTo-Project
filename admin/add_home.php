<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');
		$name="";
//Results of Sign up button
        if(isset($_POST['add'])){
//Create counter
                $c=0;
//Create generic text field data
				
                
//Prevent sql injections, grab entered variable
		unset($text);
                $name = mysqli_real_escape_string($db, strip_tags( $_POST['name']));
//              $activate = mysqli_real_escape_string($db, strip_tags( $_POST['activate']));
//                $sort =  mysqli_real_escape_string($db, strip_tags( $_POST['sort']));
                $text = mysqli_real_escape_string($db, trim( $_POST['text']));
				
//Null variables
                $n_error=" ";
                $t_error=" ";
                //$s_error=" ";

//Check if entered category is not empty

        if(empty($name)){
                $n_error="You must specify a name.";
                $c++;
        }elseif(empty($text)){
                $t_error="You must enter text.";
                $c++;
			
//If valid insert data
        }else{ if($c==0){
//Enter valid data into DB

        mysqli_query($db, "UPDATE tbl_content SET name='$name', text='$text' WHERE id='1'");
                mysqli_close($db);
                        header('Location: index.php'); 
        }
        }
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
                        <th><h2>Update Home Page Content</h2></th>
                </tr>
                <tr>
                <td>
                <table class="center">
					<form method="post" action="<?php echo $PHP_SELF;?>">
						<tr>
								
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_content WHERE id='1'");
				$trow = mysqli_fetch_array($tresults);
						$name=$trow['name'];
						$text=$trow['text'];
?>								
                                <td>Title:</td><td><input type="text" name="name" value="<?php echo $name ?>" size="85"><span class="red"><?php echo $n_error ?></span></td>
                                </tr>
                                <tr>
                                <td>Content:</td><td><textarea name="text" cols="70" rows="25" Value=""><?php echo $text ?></textarea><span class="red"><?php echo $t_error ?></span></td>
                                </tr>
                                <tr>
                                <td  class="lastrow">
                                <input type="submit" name="add" value="Update" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;</td>
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
