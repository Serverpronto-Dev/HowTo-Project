<?php

// Report all PHP errors
error_reporting(-1);

//Include db details and credentials
include('../includes/db.php');
//Added sql security to prevent sql injection
$range = mysqli_real_escape_string($db, strip_tags( $_GET['range']));
//Manipulate data for start and end date
$array1=explode("_", $range);
$start=$array1[0]." 00:00:00";
$end=$array1[1]." 23:59:59";

//Set date variables
        date_default_timezone_set("America/New_York");
        $dsql=date('Y-m-d');
        $tsql=date('h:i:s',time());
        $dtsql=$dsql." ".$tsql;

		
		//Set file to write
                $outfile="log/usage_report_".$dsql."-".$tsql.".csv";
                $fho = fopen($outfile,'w') or die("can't open file");
                fwrite($fho, "User type,Organization,Page Visited,Date and Time,User IP address\n");

//Retrieve data from DB
				$emailsql="SELECT value FROM tbl_variables WHERE function='report_email'";
			    $eresults = mysqli_query($db, "$emailsql");
					$erow = mysqli_fetch_array($eresults);
						


				$sql="SELECT * FROM tbl_tracking WHERE timestamp >= '$start' AND timestamp <= '$end' ORDER BY id";
			    $tresults = mysqli_query($db, "$sql");
                            if( $trow = mysqli_fetch_array($tresults)){
											do{
												$s_id=$trow['session_id'];
												$url=$trow['url'];
												if (strpos($url,'=') !== false) {
													$explode_url=explode('=',$url);
													$url_id=end($explode_url);
				$presults = mysqli_query($db, "SELECT p.p_title, c.name FROM tbl_pages as p, tbl_dept as c WHERE p.id='$url_id' AND p.dept_id=c.id");
							$prow = mysqli_fetch_array($presults);																
								$url=$prow['name']." - ".$prow['p_title'];
												}
												
												
			    $dresults = mysqli_query($db, "SELECT * FROM tbl_association WHERE session_id='$s_id'");
							$drow = mysqli_fetch_array($dresults);
							if(empty($drow['user_type'])){
								$user_type="Empty";
								}else{
								$user_type=$drow['user_type'];
								}
							if(empty($drow['org'])){
								$org="Empty";
								}else{
								$org=$drow['org'];
								}								
//                        echo $user_type.",".$org.",".$url.",".$trow['timestamp'].",".$trow['ip']."\n";
                        fwrite($fho, $user_type.",".$org.",".$url.",".$trow['timestamp'].",".$trow['ip']."\n");
                                                }while($trow = mysqli_fetch_array($tresults));
					}
		mysqli_close($db);
                fclose($fho);					
					
//Create mail parameters
$mail_to = $erow['value'];
//define the subject of the email
$subject = 'Site Usage Report '.$range.'.';
//create a boundary string. It must be unique
//so we use the MD5 algorithm to generate a random hash
$random_hash = md5(date('r', time()));
//define the headers we want passed. Note that they are separated with \r\n
$headers = "From: reports@dailylivingtoolkit.com\r\nReply-To: reports@dailylivingtoolkit.com";
//add boundary string and mime type specification
$headers .= "\r\nContent-Type: multipart/mixed; boundary=\"PHP-mixed-".$random_hash."\"";
//read the atachment file contents into a string,
//encode it with MIME base64,
//and split it into smaller chunks
$attachment = chunk_split(base64_encode(file_get_contents($outfile)));
//define the body of the message.
ob_start();					
?>
--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: multipart/alternative; boundary="PHP-alt-<?php echo $random_hash; ?>" 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/plain; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

Website Usage Report 

--PHP-alt-<?php echo $random_hash; ?>  
Content-Type: text/html; charset="iso-8859-1" 
Content-Transfer-Encoding: 7bit

<h2>Website Usage Report</h2> 

--PHP-alt-<?php echo $random_hash; ?>-- 

--PHP-mixed-<?php echo $random_hash; ?>  
Content-Type: application/zip; name="usage_report_<?php echo $dsql."-".$tsql ?>.csv"  
Content-Transfer-Encoding: base64  
Content-Disposition: attachment  

<?php echo $attachment; ?> 
--PHP-mixed-<?php echo $random_hash; ?>-- 

<?php
//copy current buffer contents into $message variable and delete current output buffer
$message = ob_get_clean();
//send the email
$mail_sent = @mail( $mail_to, $subject, $message, $headers );
//if the message is sent successfully print "Mail sent". Otherwise print "Mail failed"
echo $mail_sent ? "Mail sent" : "Mail failed";

header('Location: email_confirm.php');
?>