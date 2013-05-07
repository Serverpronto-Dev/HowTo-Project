<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>Daily Living ToolKit</title>
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>



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
            <a href="page.php?id=<?php echo $h_id ?>">  <img src="images/ban-housing.png" alt="Housing" />
            </a>
            <div class="carousel-caption">
			<p>Housing</p>
              <p><a style="color:#FFFFFF;" href="page.php?id=<?php echo $h_id ?>">Housing Section &raquo;</a></p>
            </div>
          </div>

          <div class="item">
<?php
			//Retrieve required information from DB and display on page
			$bresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE status='1' AND dept_id='4' ORDER BY p_sort LIMIT 0, 1");
						$brow = mysqli_fetch_array($bresults);
						$f_id=$brow['id'];
?>
            <a href="page.php?id=<?php echo $f_id ?>">
              <img src="images/ban-food.png" alt="Food" />
            </a>
            <div class="carousel-caption">
              <p>Food</p>
              <p><a style="color:#FFFFFF;" href="page.php?id=<?php echo $f_id ?>">Food Section &raquo;</a></p>
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
              <img src="images/ban-children.png" alt="Children" />
            </a>
            <div class="carousel-caption">
              <p>Children</p>
              <p><a style="color:#FFFFFF;" href="page.php?id=<?php echo $c_id ?>">Children Section &raquo;</a></p>
            </div>
          </div>

          <div class="item">
<?php
			//Retrieve required information from DB and display on page
			$dresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE status='1' AND dept_id='5' ORDER BY p_sort LIMIT 0, 1");
						$drow = mysqli_fetch_array($dresults);
						$e_id=$drow['id'];
?>		  
            <a href="page.php?id=<?php echo $e_id ?>">
              <img src="images/ban-employ.png" alt="Employment" />
            </a>
            <div class="carousel-caption">
              <p>Employment</p>
              <p><a style="color:#FFFFFF;" href="page.php?id=<?php echo $e_id ?>">Employment and Education Section &raquo;</a></p>
            </div>
          </div>

          <div class="item">
<?php
			//Retrieve required information from DB and display on page
			$eresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE status='1' AND dept_id='2' ORDER BY p_sort LIMIT 0, 1");
						$erow = mysqli_fetch_array($eresults);
						$m_id=$erow['id'];
?>		  
            <a href="page.php?id=<?php echo $m_id ?>">
              <img src="images/ban-money.png" alt="Money" />
            </a>
            <div class="carousel-caption">
              <p>Money</p>
              <p><a style="color:#FFFFFF;" href="page.php?id=<?php echo $m_id ?>">Money Management Section &raquo;</a></p>
            </div>
          </div>

          <div class="item">
<?php
			//Retrieve required information from DB and display on page
			$fresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE status='1' AND dept_id='6' ORDER BY p_sort LIMIT 0, 1");
						$frow = mysqli_fetch_array($fresults);
						$hw_id=$frow['id'];
?>		  
            <a href="page.php?id=<?php echo $hw_id ?>">
              <img src="images/ban-health.png" alt="Health" />
            </a>
            <div class="carousel-caption">
              <p>Health and Wellness</p>
              <p><a style="color:#FFFFFF;" href="page.php?id=<?php echo $hw_id ?>">Health and Wellness Section &raquo;</a></p>
            </div>
          </div>

          <div class="item">
<?php
			//Retrieve required information from DB and display on page
			$gresults = mysqli_query($db, "SELECT id FROM tbl_pages WHERE status='1' AND dept_id='7' ORDER BY p_sort LIMIT 0, 1");
						$grow = mysqli_fetch_array($gresults);
						$t_id=$grow['id'];
?>
            <a href="page.php?id=<?php echo $t_id ?>">
              <img src="images/ban-transportation.png" alt="transportation" />
            </a>
            <div class="carousel-caption">
              <p>Transportation</p>
              <p><a style="color:#FFFFFF;" href="page.php?id=<?php echo $t_id ?>">Transportation Section &raquo;</a></p>
            </div>
          </div>



        </div><!-- .carousel-inner -->
        <!--  next and previous controls here
              href values must reference the id for this carousel -->
          <a class="carousel-control left" href="#this-carousel-id" data-slide="prev">&lsaquo;</a>
          <a class="carousel-control right" href="#this-carousel-id" data-slide="next">&rsaquo;</a>
      </div><!-- .carousel -->
      <!-- end carousel -->


  
  <div class="row-fluid">
  
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_content WHERE id='1'");
						$trow = mysqli_fetch_array($tresults);
						do{
						$name=$trow['name'];
						$text=$trow['text'];

?>  
    <h1 class="center"><?php echo $name?></h1>
		<div style="padding-bottom:30px; color:#000000;"><p><?php echo $text ?></p></div>
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
