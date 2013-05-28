<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="../includes/main.css" rel="stylesheet" type="text/css" />


<title>Serverpronto HowTo</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<?php
ob_start();
//Create session variables
session_set_cookie_params();
session_start();
//Grab session variables
$_SESSION['URI'] = $_SERVER['REQUEST_URI'];
//Import DB credentials
include('../includes/db.php');
//Require authentication for this page
require('auth.php');
?>
</head>
<body class = "mainbody">
  <div class="container"> 
<table  border="0" cellpadding="10" cellspacing="0" class="headerbanner180">
  <tr>
    <td valign="top"><a href="http://www.serverpronto.com/"><img src="../images/logo-portal.png" width="607" height="50" alt="ServerPronto HowTo"></a></td>
    <td align="right" valign="top"><span class="headerlinks">Sales: 1-877-24-PRONTO&nbsp;&nbsp;&nbsp;<a href"#" style="CURSOR: pointer" onClick="javascript:window.open('http://www.websitealive3.com/3606/rRouter.asp?groupid=3606&amp;websiteid=0&amp;departmentid=1905','guest','width=575,height=490');">Live Chat</a>&nbsp;&nbsp;&nbsp;</span></td>
  </tr>
</table>
        
       <div id="cssmenu">
        <ul id="cssmenu">
          <li class="active"><a href="../index.php">Home</a>          </li>
<?php
    //Retrieve required information from DB and display on page
    			$uresults = mysqli_query($db, "SELECT * FROM tbl_topic WHERE status='1' ORDER BY sort");
                                            if( $urow = mysqli_fetch_array($uresults)){
                                                    do{	
													$topic=$urow['name'];
													$tname_encoded=urlencode($urow['name']);													
													$topic_id=$urow['id'];
?>		  
          <li class="has-sub"><a href="../tpage.php?id=<?php echo $tname_encoded ?>"><?php echo $topic ?></a>
            <ul>
<?php
    			$tresults = mysqli_query($db, "SELECT * FROM tbl_dept WHERE status='1' AND topic='$topic_id' ORDER BY sort_order");
                                            if( $trow = mysqli_fetch_array($tresults)){
                                                    do{
													$name=$trow['name'];
													$cname_encoded=urlencode($trow['name']);
													$dept_id=$trow['id'];
    ?>
        <li class="has-sub"><a href="../cpage.php?id=<?php echo $cname_encoded ?>"><?php  echo $name ?></a>
                <ul>
    <?php
          $sresults = mysqli_query($db, "SELECT p_title, id FROM tbl_pages WHERE status='1' AND dept_id='$dept_id' ORDER BY p_sort");
                                            if( $srow = mysqli_fetch_array($sresults)){
                                                    do{
													$p_name=$srow['p_title'];
													$pname_encoded=urlencode($srow['p_title']);
													$p_id=$srow['id'];
    ?>        
      <li><a href="../page.php?id=<?php echo $pname_encoded ?>"><?php  echo $p_name ?></a></li> 
    <?php
													}while($srow = mysqli_fetch_array($sresults));
                                            }
    ?>          
                </ul>
    <?php
                                                    }while($trow = mysqli_fetch_array($tresults));
                                            }

											
    ?>        
              </li>
            </ul>
          </li> 
<?php
					        }while($urow = mysqli_fetch_array($uresults));
                    }
?>		  
          <li><a href="https://accounts.serverpronto.com"><span>Contact Us</span></a></li>
          <li><a href="http://www.serverpronto.com"><span>About Us</span></a></li>
        </ul>


       </div>
    <!--/div-->
  </div>
</body>
</html>
