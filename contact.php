<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="includes/main.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="css/bootstrap.css">
<!-- <link href="http://fonts.googleapis.com/css?family=Corben:bold" rel="stylesheet" type="text/css">
<link href="http://fonts.googleapis.com/css?family=Nobile" rel="stylesheet" type="text/css">
-->

<title>Daily Living ToolKit</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<?php
ob_start();
//Import Header file
require('header.php');

//Send email
        if(isset($_POST['submit'])){

//Prevent sql injections, grab entered variable

                $author = mysqli_real_escape_string($db, strip_tags( $_POST['author']));
                $email = mysqli_real_escape_string($db, strip_tags( $_POST['email']));
                $phone =  mysqli_real_escape_string($db, strip_tags( $_POST['phone']));
				$text =  mysqli_real_escape_string($db, strip_tags( $_POST['text']));

				$c=0;
//Validate email address format  "http://www.linuxjournal.com/article/9585?page=0,0"
				if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
					$e_error="The email address must be valid.";
					$c++;
				}
				$email_array = explode("@", $email);
				$local_array = explode(".", $email_array[0]);
				for ($i = 0; $i < sizeof($local_array); $i++) {
					if(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$", $local_array[$i])) {
						$e_error="The email address must be valid.";
						$c++;
					}
					if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
						$domain_array = explode(".", $email_array[1]);
						if (sizeof($domain_array) < 2) {
							$e_error="The email address must be valid.";
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
			if($c==0){
//Check fields weren't left empty				
				if(empty($author)){
					$a_error="This field cannot be left empty";
					$c++;
				}
				if(empty($email)){
					$e_error="This field cannot be left empty";
					$c++;
				}
				if(empty($phone)){
					$p_error="This field cannot be left empty";
					$c++;
				}
				if(empty($text)){
					$t_error="This field cannot be left empty";
					$c++;
				}
				if($c==0){
				
//Check that no category esists with this title
		mysqli_query($db, "INSERT INTO tbl_contact ( author, email, phone, text ) VALUES ('$author', '$email', '$phone', '$text')");

		$fresults = mysqli_query($db, "SELECT value FROM tbl_variables WHERE function='to_email'");
            $frow = mysqli_fetch_array($fresults);
			if(!empty($frow['value'])){
				$to_email=$frow['value'];
				$subject="Contact from Daily Living Toolkit Website";
				$message=$author."\n".$phone."\n".$email."\n\n".$text;
				$headers = "From: ".$email."\r\nReply-To: ".$email;
				mail( $to_email, $subject, $message, $headers);
				mysqli_close($db);
				header('Location: index.php');
                exit();
			}else{
					$form_error="No recipient address found";
			}
			

				}
			}
        }
		
				$aresults = mysqli_query($db, "SELECT value FROM tbl_variables WHERE function='address_phone'");
            $arow = mysqli_fetch_array($aresults);
			if(!empty($arow['value'])){
				$address=$arow['value'];
			}else{
					$address="No address found";
			}
?>
</head>

<body>

<div class="container" align="center" style="margin-top:-100px;">
<h1>Children's Services Council</h1>
  <div class="row-fluid span9" align="center" style="font-size:125%;  margin-top:10px;">
        <p><?php echo $address ?></p>
    </div>	<!-- end of banner -->
</div> <!-- end of banner_wrapper -->

<div class="container row-fluid" >

            	<h2 align="left">Contact Information</h2>
            	<h2 align="left"><strong>Office Hours:</strong> 8:00am - 5:30pm M-F</h2>

              <p align="left" style="font-size:125%;">Our office will be closed on the following days:</p>
			  <table class="table table-bordered" align="left">  
        <tbody>
<?php
			$cresults = mysqli_query($db, "SELECT weekday, event, s_date, e_date, DAY(s_date) AS s_day, DAY(e_date) AS e_day, MONTH(s_date) as s_month, MONTH(e_date) as e_month, YEAR(s_date) as s_year, YEAR(e_date) as e_year FROM tbl_calendar WHERE status='1' ORDER By sort");
				if($crow = mysqli_fetch_array($cresults)){
						do{
						$event=$crow['event'];
						$s_date=$crow['s_date'];
						$e_date=$crow['e_date'];
						$weekday=$crow['weekday'];
						$s_day=$crow['s_day'];
						$e_day=$crow['e_day'];
						$s_month=$crow['s_month'];
						$e_month=$crow['e_month'];
						$s_year=$crow['s_year'];
						$e_year=$crow['e_year'];
						
									if($s_month=="1"){$s_month="January";}
									elseif($s_month=="2"){$s_month="February";}
									elseif($s_month=="3"){$s_month="March";}
									elseif($s_month=="4"){$s_month="April";}
									elseif($s_month=="5"){$s_month="May";}
									elseif($s_month=="6"){$s_month="June";}
									elseif($s_month=="7"){$s_month="July";}
									elseif($s_month=="8"){$s_month="August";}
									elseif($s_month=="9"){$s_month="Sepember";}
									elseif($s_month=="10"){$s_month="October";}
									elseif($s_month=="11"){$s_month="November";}
									elseif($s_month=="12"){$s_month="December";}
									else{$s_month="Unknown";}
									
									if($e_month=="1"){$e_month="January";}
									elseif($e_month=="2"){$e_month="February";}
									elseif($e_month=="3"){$e_month="March";}
									elseif($e_month=="4"){$e_month="April";}
									elseif($e_month=="5"){$e_month="May";}
									elseif($e_month=="6"){$e_month="June";}
									elseif($e_month=="7"){$e_month="July";}
									elseif($e_month=="8"){$e_month="August";}
									elseif($e_month=="9"){$e_month="Sepember";}
									elseif($e_month=="10"){$e_month="October";}
									elseif($e_month=="11"){$e_month="November";}
									elseif($e_month=="12"){$e_month="December";}
									else{$e_month="Unknown";}
					
?>		
          <tr>  
            <td><?php echo $event ?></td>  
            <td>
			<?php 
					echo $weekday.", ".$s_month." ".$s_day." ".$s_year; 
					if($s_date!=$e_date){
						echo " - ".$e_month." ".$e_day." ".$e_year;
					}
?>
</td>   
          </tr> 
<?php		  
						}while($crow = mysqli_fetch_array($cresults));
				}
?>				
        </tbody>  
      </table>  


            <div class="fieldset textarea" align="right">
                    <h4>Quick Contact</h4><span class="red"><?php if(!empty($form_error)){?><br /><?php echo $form_error; }?></span>
                    
                    	<form method="post" action="<?php echo $PHP_SELF;?>">

                            <input placeholder="Name" name="author" type="text" class="input_field" id="author" maxlength="40" value="<?php echo $author?>" /><span class="red"><?php if(!empty($a_error)){?><br /><?php echo $a_error; }?></span>
                          	<div class="cleaner_h10"></div>
                            
                            <input placeholder="Email Address" name="email" type="text" class="input_field" id="email" maxlength="40" value="<?php echo $email?>"/><span class="red"><?php if(!empty($e_error)){?><br /><?php echo $e_error; } ?></span>
                          	<div class="cleaner_h10"></div>
                            
                            <input placeholder="Phone Number" name="phone" type="text" class="input_field" id="phone" maxlength="40" value="<?php echo $phone?>"/><span class="red"><?php if(!empty($p_error)){?><br /><?php echo $p_error; } ?></span>
                            <div class="cleaner_h10"></div>

                            <textarea placeholder="Message" id="text" name="text" rows="0" cols="0" class="required" value="<?php echo $text?>"></textarea><span class="red"><?php if(!empty($t_error)){?><br /><?php echo $t_error; } ?></span>
                            <div class="cleaner_h10"></div>

                            <input type="submit" class="submit_btn float_l" name="submit" id="submit" value="Send" />
                    
                        </form>

            </div> 
			<form action="http://maps.google.com/maps" method="get"  target="_blank">
			<p align="right" >Get direction to the Children's Services Council
			<input placeholder="Your location" name="saddr" type="text" class="input_field" id="saddr" maxlength="100" value="" />
			<input type="hidden" name="daddr" value="6600 west Commercial Boulevard, Lauderhill, Florida 33319" /><br />
			<input type="submit" value="Map it!" /></p>
			</form>


			
      </div>
      </div>



</body>
<?php
//Import Footer file
require('footer.html');
?>

</html>
