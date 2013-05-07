<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<head>

<script type="text/javascript"></script>
<?php
//Import header file
        require('header.php');
?>
</head>
<body class = "mainbody">
<div class="container ">

<br />
<br />
<br />
<div class="row">
    <div class="span3 offset3 well-blue" style="width:35%">

			<p class="center index">
			<a href="add_page_in_topic.php">Add A Web Page</a><br /> 
			<a href="add_cat_in_topic.php">Add A Category</a><br />  
			<a href="add_topic.php">Add A Topic</a><br />  
			<br />
			<a href="add_home.php">Edit Home Page Content</a><br />  
			<a href="select_topic.php">Edit A Web Page</a><br /> 
									
			<!--a href="user_org.php">Add User Type/Organization</a--><br /> 
			<a href="edit_email.php">Update Contact Form Email Address</a><br /> 
			<!--a href="address_info.php">Update Address and Phone Numbers</a--><br /> 
			<!--a href="list_calendar.php">Update Calendar Events</a><br /--> 
			<a href="add_file.php">Upload A File</a><br /> 
			<!--a href="register.php">Add Account</a--><br /> 
			<!--a href="list_account.php">Edit Accounts</a><br /--> 
			<a href="reports.php">Search Historical Data</a><br />
			<a href="edit_report_email.php">Update Reports Email Address</a><br />
			<!--a href="docs/help.pdf" target="_blank">User Documentation</a--><br />
			<a href="logout.php">Logout</a><br /></p>
</div>
</div>
</div>
</body>
<?php
//Import Footer file
require('footer.html');
?>
</html>
