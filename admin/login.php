<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">



<title>Log In</title>

<?php
//Create session variables 
	session_start();
//Import header file
        require('header1.php');
?>

</head>
<body class = "mainbody">
        <div class="container">


<div class="row">
    <div class="span4 offset4">
      <div class="well">
        <legend>Sign in to WebApp</legend>
        <form method="POST" action="index.php" accept-charset="UTF-8">
   
            <input class="span3" placeholder="Email" type="text" name="username">
            <input class="span3" placeholder="Password" type="password" name="password"> 
            <button class="btn-info btn" type="submit" name="submit" value="Log In" class="button">Login</button>      
        </form>    
      </div>
    </div>
</div>
</div>
</body>
<?php
//Import Footer file
require('footer.html');
?>
</html> 
