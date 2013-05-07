<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<head>

<script type="text/javascript"></script>
<?php
//Include db details and credentials
include('../includes/db.php');
//Import header file
        require('header.php');
		
			$fresults = mysqli_query($db, "SELECT value FROM tbl_variables WHERE function='report_email'");
				$frow = mysqli_fetch_array($fresults);
					$email=$frow['value'];		
?>
</head>
<body class = "mainbody">
<div class="container ">

<br />
<br />
<br />
<div class="row">
    <div class="span3 offset3 well-blue" style="width:35%">

			<p class="center index"><h6>The requested report has been sent to <?php echo $email ?>.</h6></p>
			<form><input type="button" value="BACK " onclick="history.go(-1);return false;" /></form>
</div>
</div>
</div>
</body>
<?php
//Import Footer file
require('footer.html');
?>
</html>
