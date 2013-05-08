<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link rel="stylesheet" href="../includes/main.css" type="text/css">
<link rel="stylesheet" href="../css/bootstrap.css">




<title>Serverpronto HowTo</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>

<?php
//Create session variables
session_destroy();
session_set_cookie_params();
session_start();
//Set session URI
$_SESSION['URI'] = $_SERVER['REQUEST_URI'];
//Import DB credentials
include('../includes/db.php');
?>
</head>
<body class = "mainbody">
  <div class="container"> 
    <!--div class="span3">
        <a href="admin/index.php"><img src="../images/admin-button.png" width="92" height="40" alt="admin" /></a>
     </div--> 
      <!--div class="navbar-static-top"-->
       
        <!--img src="../images/header.png" width="100%" height="100%" alt="headerpic" />
       
       <a href="http://www.211-broward.org/" target="blank">
          <img class="img-rounded" src="../images/211banner.png" width="100%" height="100%" />
       </a-->
<table  border="0" cellpadding="10" cellspacing="0" class="headerbanner180">
  <tr>
    <td valign="top"><a href="http://www.serverpronto.com/"><img src="../images/logo-portal.png" width="379" height="42" alt="ServerPronto HowTo"></a></td>
    <td align="right" valign="top"><span class="headerlinks">Sales: 1-877-24-PRONTO&nbsp;&nbsp;&nbsp;<a href"#" style="CURSOR: pointer" onClick="javascript:window.open('http://www.websitealive3.com/3606/rRouter.asp?groupid=3606&amp;websiteid=0&amp;departmentid=1905','guest','width=575,height=490');">Live Chat</a>&nbsp;&nbsp;&nbsp;</span></td>
  </tr>
</table>


      <div id='cssmenu'>
        <ul>
         <li class='active'><a href='../index.php'><span>Home</span></a></li>
<?php
    //Retrieve required information from DB and display on page
    			$uresults = mysqli_query($db, "SELECT * FROM tbl_topic WHERE status='1' ORDER BY sort");
                                            if( $urow = mysqli_fetch_array($uresults)){
                                                    do{	
													$topic=$urow['name'];
													$topic_id=$urow['id'];
?>		  
          <li class="has-sub"><a href="#"><?php echo $topic ?></a>
            <ul>
<?php
    			$tresults = mysqli_query($db, "SELECT * FROM tbl_dept WHERE status='1' AND topic='$topic_id' ORDER BY sort_order");
                                            if( $trow = mysqli_fetch_array($tresults)){
                                                    do{
    						$name=$trow['name'];
    						$id=$trow['id'];
    ?>
        <li class="has-sub"><a><?php  echo $name ?></a>
                <ul>
    <?php
          $sresults = mysqli_query($db, "SELECT p_title, id FROM tbl_pages WHERE status='1' AND dept_id='$id' ORDER BY p_sort");
                                            if( $srow = mysqli_fetch_array($sresults)){
                                                    do{
                $p_name=$srow['p_title'];
                $p_id=$srow['id'];
    ?>        
      <li><a href="../page.php?id=<?php echo $p_id ?>"><?php  echo $p_name ?></a></li> 
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
</ul>
</div>
    <!--/div-->
  </div>
</div>
</body>
</html>
