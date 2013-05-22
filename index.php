<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<title>Serverpronto Knowledgebase</title>


<?php
//Include db details and credentials
include('../includes/db.php');
//Import Header file
require('header.php');
?>
</head>

<body>

<div class="container">

<!--  Carousel -->
      <!--  consult Bootstrap docs at 
            http://twitter.github.com/bootstrap/javascript.html#carousel -->
      <div id="this-carousel-id" class="carousel slide">
        <div class="carousel-inner">

          <div class="item active">
<?php
			//Retrieve required information from DB and display on page
			$aresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE status='1' AND dept_id='1' ORDER BY p_sort LIMIT 0, 1");
						$arow = mysqli_fetch_array($aresults);
						$h_id=$arow['id'];
?>	  
            <a href="#">  <img src="images/carousel_security.png" alt="Security" />
            </a>
            <div class="carousel-caption">
			<p>Secuity</p>
              <p><a style="color:#FFFFFF;" href="# ?>">Security Resources&raquo;</a></p>
            </div>
          </div>

          <div class="item">
<?php
			//Retrieve required information from DB and display on page
			$bresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE status='1' AND dept_id='4' ORDER BY p_sort LIMIT 0, 1");
						$brow = mysqli_fetch_array($bresults);
						$f_id=$brow['id'];
?>
            <a href="#">
              <img src="images/carousel_OS.png" alt="Operating Systems" />
            </a>
            <div class="carousel-caption">
              <p>Operating Systems</p>
              <p><a style="color:#FFFFFF;" href="#">Operating System Resources &raquo;</a></p>
            </div>
          </div>

          <div class="item">
<?php
			//Retrieve required information from DB and display on page
			$cresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE status='1' AND dept_id='3' ORDER BY p_sort LIMIT 0, 1");
						$crow = mysqli_fetch_array($cresults);
						$c_id=$crow['id'];
?>
            <a href="page.php?id=<?php echo $c_id ?>">
              <img src="images/carousel_cpanel.png" alt="cPanel" />
            </a>
            <div class="carousel-caption">
              <p>cPanel</p>
              <p><a style="color:#FFFFFF;" href="#">cPanel Resources &raquo;</a></p>
            </div>
          </div>

          <div class="item">
<?php
			//Retrieve required information from DB and display on page
			$dresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE status='1' AND dept_id='5' ORDER BY p_sort LIMIT 0, 1");
						$drow = mysqli_fetch_array($dresults);
						$e_id=$drow['id'];
?>		  
            <a href="#">
              <img src="images/carousel_email.png" alt="E-mail" />
            </a>
            <div class="carousel-caption">
              <p>E-mail</p>
              <p><a style="color:#FFFFFF;" href="#">E-Mail Resources &raquo;</a></p>
            </div>
          </div>

          <div class="item">
<?php
			//Retrieve required information from DB and display on page
			$eresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE status='1' AND dept_id='2' ORDER BY p_sort LIMIT 0, 1");
						$erow = mysqli_fetch_array($eresults);
						$m_id=$erow['id'];
?>		  
            <a href="#">
              <img src="images/carousel_hardware.png" alt="Server Hardware" />
            </a>
            <div class="carousel-caption">
              <p>Money</p>
              <p><a style="color:#FFFFFF;" href="#">Money Management Section &raquo;</a></p>
            </div>
          </div>

 
        </div><!-- .carousel-inner -->
        <!--  next and previous controls here
              href values must reference the id for this carousel -->
          <a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
          <a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
      </div><!-- .carousel -->
      <!-- end carousel -->


  
  <div class="well-blue">
  
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_content WHERE id='1'");
						$trow = mysqli_fetch_array($tresults);
						do{
						$name=$trow['name'];
						$text=$trow['text'];

?>  
    <h1 class="center" style="padding-top:30px;"><?php echo $name?></h1>
		<div style="padding:30px; color:#000000;"><p><?php echo $text ?></p></div>
<?php
						}while($trow = mysqli_fetch_array($tresults));
?>		
    <!--hr width="100%"/-->
  </div>
</div> 

    
    <!-- Bootstrap jQuery plugins compiled and minified -->
    <script src="js/bootstrap-o.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function(){
        $('.carousel').carousel({
          interval: 4000
        });
      });
    </script>


</body>
<?php
//Import Footer file
require('footer.html');
?>
</html>
