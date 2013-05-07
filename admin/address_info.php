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

//Create generic text field data
				
                
//Prevent sql injections, grab entered variable
		unset($text);
                $text = mysqli_real_escape_string($db, trim( $_POST['text']));
				
//Null variables
                $t_error=" ";

//Check if entered category is not empty

        if(empty($text)){
                $n_error="You must specify an address.";
                $c++;
//If valid insert data
        }else{
//Enter valid data into DB

        mysqli_query($db, "UPDATE tbl_variables SET value='$text' WHERE function='address_phone'");
                mysqli_close($db);
                        header('Location: index.php'); 
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

 <form method="post" action="<?php echo $PHP_SELF;?>">
        <table border="1" class="table1 well-blue">
                        <th><h2>Update Address and Phone Number</h2></th>
                </tr>
                <tr>
                <td>
                <table class="table50_text">
                                <tr>
								
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT value FROM tbl_variables WHERE function='address_phone'");
				$trow = mysqli_fetch_array($tresults);
						$text=$trow['value'];
			mysqli_close($db);
?>								

                                <td>Content:</td><td><textarea name="text" cols="70" rows="25" Value=""><?php echo $text ?></textarea><span class="red"><?php echo $t_error ?></span></td>
                                </tr>
                                <tr>
                                <td>
                                <input type="submit" name="add" value="Update" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;</td>
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
