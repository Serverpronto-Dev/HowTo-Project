<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php
ob_start();
// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');

//Results of Sign up button
        if(isset($_POST['update'])){
//Create counter
                $c=0;
				
//Prevent sql injections, grab entered variable
                $email = mysqli_real_escape_string($db, trim( $_POST['email']));
				if(!empty($email)){
//Validate email address format  "http://www.linuxjournal.com/article/9585?page=0,0"
				$multiple_emails = explode(",", $email);
				foreach($multiple_emails as $m_email){	
					if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $m_email)) {
						$e_error="1-The email address must be valid.";
						$c++;
					}
					$email_array = explode("@", $m_email);
					$local_array = explode(".", $email_array[0]);
					for ($i = 0; $i < sizeof($local_array); $i++) {
						if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
							$e_error="2-The email address must be valid.";
							$c++;
						}
						if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
							$domain_array = explode(".", $email_array[1]);
							if (sizeof($domain_array) < 2) {
								$e_error="3-The email address must be valid.";
								$c++;
							}
							for ($i = 0; $i < sizeof($domain_array); $i++) {
								if(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|([A-Za-z0-9]+))$",$domain_array[$i])) {
									$e_error="The email address must be valid.";
									$c++;
								}
							}
						}
					}				
				}
			if($c==0){
				mysqli_query($db, "UPDATE tbl_variables SET value='$email' WHERE function='to_email'");
                mysqli_close($db);
                        header('Location: index.php');
			}
			}else{
				$e_error="Email address cannot be empty.";
			}
        }

        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
                }
				
			if(empty($email)){
			$fresults = mysqli_query($db, "SELECT value FROM tbl_variables WHERE function='to_email'");
				$frow = mysqli_fetch_array($fresults);
					$email=$frow['value'];
			}
				
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<body>
<div class="container ">


        <table border="1" class="table1 well-blue">
				<tr>
                    <th><h2>Edit recipient email address for Contact Us form</h2></th>
                </tr>
                <tr>
                <td>
                <table>
								<form method="post" action="<?php echo $PHP_SELF;?>">
                                <tr>
                                <td style="text-align:left;">Email Address:&nbsp;<input name="email" type="text" class="input_field" id="email" maxlength="100" value="<?php echo $email?>" /><span class="red"><?php if(!empty($e_error)){ echo $e_error; } ?></span>
                                </tr>
								<tr>
                                <td style="text-align:left;">**Note: To enter more than one email address, enter them seperated by commas. </td>
                                </tr>
                                <tr>
                                <td colspan="2" style="text-align:left;">
                                <input type="submit" name="update" value="Update" class="button"/>&nbsp;
                                <input type="submit" name="exit" value="Exit" class="button" />&nbsp;
								</form>
								</td>
                                </tr>
                </table>
                </td>
                </tr>
        </table>

        </div>
</body>
<?php
//Import Footer file
require('footer.html');
?>
</html>
