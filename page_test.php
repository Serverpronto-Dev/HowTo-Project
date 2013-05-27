<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href='http://fonts.googleapis.com/css?family=Nobile' rel='stylesheet' type='text/css'>

<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<?php
// Report all PHP errors
error_reporting(-1);

//Create session variables

 $s_id=session_id(); 
 
//Include db details and credentials
include('../includes/db.php');
		
//Import Header file
require('header_test.php');
//Get session details
        $url=$_SERVER['REQUEST_URI'];
        $ip=$_SERVER['REMOTE_ADDR'];

//added php-mysql security
        $id = mysqli_real_escape_string($db, strip_tags($_GET['id']));
		$page_id=$id;
		$decoded_id=urldecode($page_id);
		if($page_id!=$decoded_id){
			$wresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE p_title='$decoded_id' ");
                if( $wrow = mysqli_fetch_array($wresults)){		
					$id=$wrow['id'];
					$page_id=$wrow['id'];
				}
		}		
					$tresults = mysqli_query($db, "SELECT a.art_name, a.art_text, a.id, p.p_title, p.id as pid, p.file, p.p_sort, p.dept_id, a.image, a.image_loc, a.image_des, a.display_name 
							FROM tbl_articles as a, tbl_pages as p WHERE a.page_id=p.id AND a.status='1' AND a.page_id='$page_id' ORDER BY a.an_sort");
                                        if( $trow = mysqli_fetch_array($tresults)){
						$p_name=$trow['p_title'];
						$p_id=$trow['pid'];
						$file=$trow['file'];
						$dept_id=$trow['dept_id'];
						$p_sort=$trow['p_sort'];
						$c=0;
?>
<title><?php echo $p_name ?></title>
</head>

<body>
<div class="container" >
<table class="well-blue">
<?php
//Retrieve required information from DB and display on page
					
	$prev_page_id='';
	$next_page_id='';
	$prev='';
	$next='';
	$p_count='';
	$cresults = mysqli_query($db, "SELECT count(id) FROM tbl_pages WHERE status='1' AND dept_id='$dept_id'");
		$crow = mysqli_fetch_array($cresults);
		$p_count=$crow['count(id)'];
		if($p_count==1){
			$prev_page_id=$p_id;
			$next_page_id=$p_id;
		}else{
	$presults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE id!='$page_id' AND STATUS = '1' AND p_sort < '$p_sort' AND dept_id = '$dept_id' ORDER BY p_sort DESC LIMIT 0 , 1");
		$prow = mysqli_fetch_array($presults);	
			if (empty($prow['id'])){
				$zresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE STATUS = '1' AND dept_id = '$dept_id' ORDER BY p_sort DESC LIMIT 0 , 1");
				$zrow = mysqli_fetch_array($zresults);
				$prev_page_id=$zrow['id'];
			}else{
				$prev_page_id=$prow['id'];
			}
			
	$nresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE id!='$page_id' AND STATUS = '1' AND p_sort > '$p_sort' AND dept_id = '$dept_id' ORDER BY p_sort LIMIT 0 , 1");
		$nrow = mysqli_fetch_array($nresults);
			if (empty($nrow['id'])){
				$yresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE STATUS = '1' AND dept_id = '$dept_id' ORDER BY p_sort LIMIT 0 , 1");
				$yrow = mysqli_fetch_array($yresults);
				$next_page_id=$yrow['id'];
			}else{
				$next_page_id=$nrow['id'];
			}

		}
?>
<tr style="text-align: center;">
<td><a href="page.php?id=<?php echo $prev_page_id ?>"><h2 style="font-family:'Nobile';"><<span class="font40">PREVIOUS</span></h2></a></td>
<td></td>
<td><a href="page.php?id=<?php echo $next_page_id ?>"><h2 style="font-family:'Nobile';"><span class="font40">NEXT</span>></h2></a></td></tr>
<tr style="text-align: center;">
<td class="fifteen"></td>
<td class="seventy"> 
						
			<h1><?php  echo $p_name ?></h1> 
</td>
<td class="fifteen"> 
<?php
if(!empty($file)){
?>
<a href="<?php echo "upload/".$file ?>" target="_blank"><img src="images/acrobat.gif" alt="Download Page as PDF" ></a>
<p>Download Page in PDF Format</p>

<?php
}
?>
</td></tr>

<?php			
						do{
						$name=$trow['art_name'];
						$text=$trow['art_text'];
						$id=$trow['id'];
						$image=$trow['image'];
						$image_loc=$trow['image_loc'];
						$image_des=$trow['image_des'];
						$display_name=$trow['display_name'];
						$c=$c+1;				
		if($display_name == 1){ 
?>
			<tr>
			<td></td>
			<td><h3 style="text-align: center; font-size:150%;"><?php  echo $name ?></h3></td>
			<td></td>
			</tr>
<?php
		}
		if($image_loc==""){
?>
			<tr>
			<td></td>
			<td><p><?php echo $text ?></p></td>
			<td></td>
			</tr>
<?php
		}
		if($image_loc=="left"){
?>
			<tr>
			<td></td>
			<td style="padding:10px;"><img style="float:left;margin-right:30px;" src="<?php echo 'upload/'.$image ?>" alt="<?php echo $image_des ?>" />
			<p><?php echo $text ?></p></td>
			<td></td>
			</tr>
<?php			
		}
		if($image_loc=="right"){
?>
			<tr>
			<td></td>
			<td style="padding:10px;"><img style="float:right;margin-left:15px;" src="<?php echo 'upload/'.$image ?>" alt="<?php echo $image_des ?>" />
			<p><?php echo $text ?></p></td>
			<td></td>
			</tr>
<?php			
		}
		if($image_loc=="center_top"){
?>
			<tr>
			<td></td>
			<td style="text-align: center; padding:10px;"><img style="text-align: center;" src="<?php echo 'upload/'.$image ?>" alt="<?php echo $image_des ?>" /></td>
			<td></td>
			</tr>
			<tr>
			<td></td>
			<td style="padding:10px;"><p><?php echo $text ?></p></td>
			<td></td>
			</tr>
<?php			
		}
		if($image_loc=="center_bottom"){
?>
			<tr>
			<td></td>
			<td style="padding:10px;"><p><?php echo $text ?></p></td>
			<td></td>
			</tr>	
			<tr>
			<td></td>
			<td style="text-align: center; padding:10px;"><img style="text-align: center;" src="<?php echo 'upload/'.$image ?>" alt="<?php echo $image_des ?>" /></td>
			<td></td>
			</tr>
			
<?php
		}
                                                }while($trow = mysqli_fetch_array($tresults));
                                        }
?>

<tr style="text-align: center;">
<td><a href="page.php?id=<?php echo $prev_page_id ?>"><!--img src="images/previous.png" alt="Previous Page" --><h2 style="font-family:'Nobile';"><<span class="font40">PREVIOUS</span></h2></a></td>
<td></td>
<td><a href="page.php?id=<?php echo $next_page_id ?>"><h2 style="font-family:'Nobile';"><span class="font40">NEXT</span>></h2><!--img src="images/next.png" alt="Next Page" --></a></td></tr>
</table>
</div> 
</body>
<?php
//Import Footer file
require('footer.html');
?>
</html>


