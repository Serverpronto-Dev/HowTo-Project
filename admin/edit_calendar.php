<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml>
<?php
ob_start();
// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
        require('header.php');
		
//Get ID with added php-mysql security
        $id = mysqli_real_escape_string($db, trim($_GET['id']));
		
//Results of Sign up button
        if(isset($_POST['update'])){
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

			if($c==0){
				mysqli_query($db, "UPDATE tbl_calendar SET event='$event', s_date='$s_date', e_date='$e_date', sort='$sort', weekday='$weekday 'WHERE id='$id'");
                mysqli_close($db);
                        header('Location: list_calendar.php');
			}

        }
		if($_POST['back']){
                        header('Location: list_calendar.php');
                        exit();
        }
        if($_POST['exit']){
                        header('Location: index.php');
                        exit();
        }
				
				
		$fresults = mysqli_query($db, "SELECT weekday, event, sort, DAY(s_date) AS s_day, DAY(e_date) AS e_day, MONTH(s_date) as s_month, MONTH(e_date) as e_month, YEAR(s_date) as s_year, YEAR(e_date) as e_year FROM tbl_calendar WHERE id='$id'");
            $frow = mysqli_fetch_array($fresults);			
					$event=$frow['event'];
					$sort=$frow['sort'];
					$weekday=$frow['weekday'];
					$s_day=$frow['s_day'];
					$e_day=$frow['e_day'];
					$s_month=$frow['s_month'];
					$e_month=$frow['e_month'];
					$s_year=$frow['s_year'];
					$e_year=$frow['e_year'];
		
?>
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<body>
<div class="container ">


        <table border="1" class="table1 well-black">
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
<?php								
									if($s_month=="1"){$month="Jan";}
									elseif($s_month=="2"){$month="Feb";}
									elseif($s_month=="3"){$month="Mar";}
									elseif($s_month=="4"){$month="Apr";}
									elseif($s_month=="5"){$month="May";}
									elseif($s_month=="6"){$month="Jun";}
									elseif($s_month=="7"){$month="Jul";}
									elseif($s_month=="8"){$month="Aug";}
									elseif($s_month=="9"){$month="Sep";}
									elseif($s_month=="10"){$month="Oct";}
									elseif($s_month=="11"){$month="Nov";}
									elseif($s_month=="12"){$month="Dec";}
									else{$s_month="Unknown";}
?>							
							<td>
                                                      <select name="month" id="month" >
                                                      <option value="<?php echo $s_month ?>"><?php echo $month ?></option>
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
													  <option value="<?php echo $s_day ?>"><?php echo $s_day ?></option>
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
													  <option value="<?php echo $s_year ?>"><?php echo $s_year ?></option>
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
<?php								
									if($e_month=="1"){$month="Jan";}
									elseif($e_month=="2"){$month="Feb";}
									elseif($e_month=="3"){$month="Mar";}
									elseif($e_month=="4"){$month="Apr";}
									elseif($e_month=="5"){$month="May";}
									elseif($e_month=="6"){$month="Jun";}
									elseif($e_month=="7"){$month="Jul";}
									elseif($e_month=="8"){$month="Aug";}
									elseif($e_month=="9"){$month="Sep";}
									elseif($e_month=="10"){$month="Oct";}
									elseif($e_month=="11"){$month="Nov";}
									elseif($e_month=="12"){$month="Dec";}
									else{$e_month="Unknown";}
?>
				<td>
                                                      <select name="end_month" id="end_month">
													  <option value="<?php echo $e_month ?>"><?php echo $month ?></option>
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
													  <option value="<?php echo $e_day ?>"><?php echo $e_day ?></option>
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
													  <option value="<?php echo $e_year ?>"><?php echo $e_year ?></option>
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
				
				
				
				                <td><input name="sort" type="text" id="sort" value="<?php echo $sort?>" />
																<select name="weekday" id="weekday" >
													<option value="<?php echo $weekday ?>"><?php echo $weekday ?></option>
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
                                <input type="submit" name="update" value="Update" class="button"/>&nbsp;
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
