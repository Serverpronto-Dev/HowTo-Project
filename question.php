<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php
//Clear header data
ob_start();
// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');
//added php-mysql security
        $url = mysqli_real_escape_string($db, strip_tags($_GET['url']));
		$referring_page=$url;
		$s_id=session_id(); 
		
        if(isset($_POST['submit'])){
                $type = mysqli_real_escape_string($db, trim( $_POST['usertype']));
                $org = mysqli_real_escape_string($db, trim( $_POST['userorg']));		
				$s_id = mysqli_real_escape_string($db, trim( $_POST['s_id']));	
				$referring_page = mysqli_real_escape_string($db, trim( $_POST['url']));
			mysqli_query($db, "INSERT INTO tbl_association (session_id, user_type, org) VALUES ('$s_id', '$type', '$org') ON DUPLICATE KEY UPDATE session_id='$s_id', user_type='$type', org='$org'");
			    mysqli_close($db);
                header('Location: '.$referring_page);
				exit();
		}
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
</head>
<body>
<div class="container center" style="margin-top:-120px;">
            	<h2><span>User Survey</span></h2>
							<table class="center" style="margin-bottom:40px;">
								<form method="post" action="">
									<tr><td style="font-size:120%;">How would you classify your use of this site? </td>
										<td><select name="usertype" >
<?php
					$gresults = mysqli_query($db, "SELECT * FROM tbl_user_types WHERE status='1'");
                                        $grow = mysqli_fetch_array($gresults);
                                                do{										
                        					$type=$grow['type'];
?>													
														<option value="<?php echo $type ?>"><?php echo $type ?></option>
<?php														
												}while($grow = mysqli_fetch_array($gresults));
                                        														
?>
													<option value="none">None of the listed user types.</option>
													</select></td>
													</tr>
													<tr><td style="font-size:120%;">Do you work with one of these organizations?</td>
													<td><select name="userorg" >
<?php
					$gresults = mysqli_query($db, "SELECT * FROM tbl_user_org WHERE status='1'");
                                        $grow = mysqli_fetch_array($gresults);
                                                do{										
                        					$org=$grow['org'];
?>													
														<option value="<?php echo $org ?>"><?php echo $org ?></option>
<?php														
												}while($grow = mysqli_fetch_array($gresults));
                                        														
?>
														<option value="none">None of the listed organizations.</option>
														</select></td> 
														<td><input type="hidden" name="s_id" value="<?php echo $s_id ?>">
														<input type="hidden" name="url" value="<?php echo $referring_page ?>"></td>
														</tr>
													<tr><td colspan="100%" align="left"><input type="submit" name="submit" value="Submit" class="button"/></td></tr> 
												</form>
								</table>
		</div>
	</body>
<?php
//Import Footer file
require('footer.html');
?>
</html>