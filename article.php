	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="includes/main.css" rel="stylesheet" type="text/css">

<title>Daily Living ToolKit</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<?php
// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
		
//Import Header file
require('header.php');

//added php-mysql security
        $id = mysqli_real_escape_string($db, strip_tags($_GET['id']));
?>
</head>

<body>
<div class="container">
<div id="wrapper" align="center">
<br />
<br />
<table border="0" id="content_table" >

<?php

//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT a.art_name, a.art_text, a.id, a.an_sort, p.id as pid, a.image, a.image_loc, a.image_des FROM tbl_articles as a, tbl_pages as p WHERE a.page_id=p.id AND a.id='$id'");
                                        $trow = mysqli_fetch_array($tresults);
										
						$name=$trow['art_name'];
						$text=$trow['art_text'];
						$p_id=$trow['pid'];
						$an_sort=$trow['an_sort'];
						$image=$trow['image'];
						$image_loc=$trow['image_loc'];
						$image_des=$trow['image_des'];
?>
<tr style="text-align: center;">
<td></td>
<td colspan="6"><h3><?php  echo $name ?></h3></td>
<td></td>
</tr>
<tr>
<td>

</td>
<td colspan="6">
<?php
		if($image_loc=="left"){
?>
			<img style="float:left;margin-right:30px;" src="<?php echo 'upload/'.$image ?>" alt="<?php echo $image_des ?>" />
<?php			
		}
		if($image_loc=="right"){
?>	
			<img style="float:right;margin-left:15px;" src="<?php echo 'upload/'.$image ?>" alt="<?php echo $image_des ?>" />
<?php			
		}
?>
<p><?php  echo $text ?></p>
<?php
		if($image_loc=="center"){
?>	
			<img src="<?php echo 'upload/'.$image ?>" alt="<?php echo $image_des ?>" />
<?php			
		}
?>
<td>
</td>
</tr>
<tr style="text-align: center;">
<?php
			$prev_art_id='';
			$prev_sort='';
			$next_art_id='';
			$next_sort='';
			$art_count=='';
			$cresults = mysqli_query($db, "SELECT count(id) FROM tbl_articles WHERE page_id='$p_id' AND status=1");
                        $crow = mysqli_fetch_array($cresults);
						$art_count=$crow['count(id)'];
			if($an_sort==0){
				$prev_sort=$art_count-1;
			}else{
				$prev_sort=$an_sort-1;
			}
			if($an_sort==($art_count-1)){
				$next_sort=0;
			}else{
				$next_sort=$an_sort+1;
			}
			$presults = mysqli_query($db, "SELECT id FROM tbl_articles WHERE page_id='$p_id' AND an_sort='$prev_sort' AND status=1");
                        $prow = mysqli_fetch_array($presults);
						$prev_art_id=$prow['id'];
			$nresults = mysqli_query($db, "SELECT id FROM tbl_articles WHERE page_id='$p_id' AND an_sort='$next_sort' AND status=1");
                        $nrow = mysqli_fetch_array($nresults);
						$next_art_id=$nrow['id'];	
?>
<td><a href="article.php?id=<?php echo $prev_art_id ?>">Previous Article</a></td>
<td colspan="6"><a href="art_index.php?id=<?php echo $p_id ?>">Article List</a></td>
<td><a href="article.php?id=<?php echo $next_art_id ?>">Next Article</a></td>
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

