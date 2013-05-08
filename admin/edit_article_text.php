<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

//added php-mysql security
        $article_id = mysqli_real_escape_string($db, strip_tags($_GET['id']));


        if($_POST['submit']){
//Added sql security to prevent sql injection
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                $text = mysqli_real_escape_string($db, trim( $_POST['text']));
				$display_name = mysqli_real_escape_string($db, trim( $_POST['display_name']));
//Set new text
                mysqli_query($db, "UPDATE tbl_articles SET art_text='$text', display_name='$display_name' WHERE id='$id'");
                mysqli_close($db);
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }

//return to home page
        if($_POST['back']){
                $id = mysqli_real_escape_string($db, strip_tags( $_POST['id']));
                        header('Location: edit_article.php?id='.$id);
                        exit();
                }
//return to home page
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }

?>
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
                <tr>
                        <th><h2>Edit an Article</h2></th>
                </tr>
                <tr>
                <td>
                <table class="center">
				<tr>
				<th>Page Name</th>
				<th>Content</th>
				</tr>
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_articles WHERE id='$article_id'");
                                        if( $trow = mysqli_fetch_array($tresults)){
                                                do{
						$name=$trow['art_name'];
						$id=$trow['id'];
						$art_text=$trow['art_text'];
						$page_id=$trow['page_id'];
						$display_name=$trow['display_name'];
					
					if($display_name==1){
						$show_title="Yes";
					}else{
						$show_title="No";
					}
?>
				<form name="edit" method="post" action="<?php basename($PHP_SELF)?>">
                                <tr>
									<td><?php echo $name ?></td>
				<td><textarea name="text" cols=70 rows=25><?php echo $art_text ?></textarea></td>
				<td><input type="hidden" name="page_id" value="<?php echo $page_id ?>">
				<input type="hidden" name="id" value="<?php echo $id ?>">
					Display Article Title on Page: <select class="textarea_short" name="display_name"><option value="<?php echo $display_name ?>"><?php echo $show_title ?></option>
<?php
						if($show_title!="No"){
?>
							<option value="0">No</option>
<?php							
						}
						if($show_title!="Yes"){
?>						
						<option value="1">Yes</option>
<?php						
						}
?>						
					</select>
				</td>
                </tr>
				<tr><td class="center"><input type="submit" name="back" value="Back" class="button"/>
				<input type="submit" name="exit" value="Exit" class="button"/>
				<input type="submit" name="submit" value="Submit" class="button"/></td>

				</tr>
				</form>
<?php
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>
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
