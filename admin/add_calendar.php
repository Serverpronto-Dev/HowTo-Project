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
        if(isset($_POST['add'])){
//Create counter
                $c=0;

//Prevent sql injections, grab entered variable
                $event = mysqli_real_escape_string($db, trim( $_POST['event']));
				$sort = mysqli_real_escape_string($db, trim( $_POST['sort']));
				$weekday = mysqli_real_escape_string($db, trim( $_POST['weekday']));
                $month = mysqli_real_escape_string($db, trim( $_POST['month']));
                $day = mysqli_real_escape_string($db, trim( $_POST['day']));
                $year = mysqli_real_escape_string($db, trim( $_POST['year']));
                $end_month = mysqli_real_escape_string($db, trim( $_POST['end_month']));
                $end_day = mysqli_real_escape_string($db, trim( $_POST['end_day']));
                $end_year = mysqli_real_escape_string($db, trim( $_POST['end_year']));
				$s_date=$year."-".$month."-".$day;
				$e_date=$end_year."-".$end_month."-".$end_day;

				mysqli_query($db, "INSERT INTO tbl_calendar (event, s_date, e_date, sort, weekday) VALUE ('$event', '$s_date', '$e_date', '$sort', '$weekday')" );
                mysqli_close($db);
                        header('Location: list_calendar.php');
        }
		if($_POST['back']){
                        header('Location: list_calendar.php');
                        exit();
        }
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
        }
	
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<body>
<div class="container ">


        <table border="1" class="table1 well-blue">
				<tr>
                    <th><h2>Update calendar events.</h2></th>
                </tr>
                <tr>
                <td>
                <table>
								<tr><th>Event</th><th>Start Date</th><th>End Date</th><th>Sort Order</th><tr>
								<form method="post" action="<?php echo $PHP_SELF;?>">
                                <tr>
                                <td><input name="event" type="text" id="event" value="<?php echo $event?>" /></td>
							<td>
                            <select name="month" id="month" >
                                                      <option value="01">Jan</option>
                                                      <option value="02">Feb</option>
                                                      <option value="03">Mar</option>
                                                      <option value="04">Apr</option>
                                                      <option value="05">May</option>
                                                      <option value="06">Jun</option>
                                                      <option value="07">Jul</option>
                                                      <option value="08">Aug</option>
                                                      <option value="09">Sep</option>
                                                      <option value="10">Oct</option>
                                                      <option value="11">Nov</option>
                                                      <option value="12">Dec</option>
						      </select>	
                                                      <select name="day" id="day" >
<?php
//Enumerate days of the month
						for ($i=1; $i<=31; $i++){
							$c=$i;
							if($i<10){$c="0".$i;}
?>
							<option value="<?php echo $c ?>"><?php echo $c ?></option>
<?php
						}
?>	
							</select>
                                                      <select name="year" id="year" value="<?php echo $s_year ?>">
<?php
//Enumerate next 5 years
						$yr=date("Y");
                                                for ($i=1; $i<=5; $i++){
?>
                                                      <option value="<?php echo $yr ?>"><?php echo $yr ?></option>
<?php
     						$yr++;
	                                        }
?>
						</select

				</td>
				<td>
                                                      <select name="end_month" id="end_month">
                                                      <option value="01">Jan</option>
                                                      <option value="02">Feb</option>
                                                      <option value="03">Mar</option>
                                                      <option value="04">Apr</option>
                                                      <option value="05">May</option>
                                                      <option value="06">Jun</option>
                                                      <option value="07">Jul</option>
                                                      <option value="08">Aug</option>
                                                      <option value="09">Sep</option>
                                                      <option value="10">Oct</option>
                                                      <option value="11">Nov</option>
                                                      <option value="12">Dec</option>
						      </select>	
                                                      <select name="end_day" id="end_day">
<?php
//Enumerate days of the month
						for ($i=1; $i<=31; $i++){
							$c=$i;
							if($i<10){$c="0".$i;}
?>
							<option value="<?php echo $c ?>"><?php echo $c ?></option>
<?php
						}
?>	
							</select>
                                                      <select name="end_year" id="end_year">
<?php
//Enumerate next 5 years
						$yr=date("Y");
                                                for ($i=1; $i<=5; $i++){
?>
                                                      <option value="<?php echo $yr ?>"><?php echo $yr ?></option>
<?php
     						$yr++;
	                                        }
?>
						</select

				</td>
				                <td><input name="sort" type="text" id="sort" value="<?php echo $sort?>" /><br />
								<select name="weekday" id="weekday" >
                                                    <option value="Sunday">Sunday</option>
                                                    <option value="Monday">Monday</option>
                                                    <option value="Tuesday">Tuesday</option>
                                                    <option value="Wednesday">Wednesday</option>
                                                    <option value="Thursday">Thursday</option>
                                                    <option value="Friday">Friday</option>
                                                    <option value="Saturday">Saturday</option>
													<option value="">Not Defined</option>
								</select></td>
								</tr>
								<?php if(!empty($e_error)){ ?>
								<tr><td colspan="100%">
								<span class="red"><?php echo $e_error;} ?></span>
								</td></tr>
								<tr>
                                <td colspan="100%" style="text-align:left;">
                                <input type="submit" name="add" value="Add" class="button"/>&nbsp;
								<input type="submit" name="back" value="Back" class="button" />&nbsp;
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
