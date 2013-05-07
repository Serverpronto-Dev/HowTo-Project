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
require('header-main.php');
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
  <!--img class="img_bottom_padding" src="images/LivingToolkit.png" alt="Category Collage"--> 
<?php
//Retrieve required information from DB and display on page
			$tresults = mysqli_query($db, "SELECT * FROM tbl_content WHERE id='1'");
						$trow = mysqli_fetch_array($tresults);
						do{
						$name=$trow['name'];
						$text=$trow['text'];

?>  
    <h1 class="center"><?php echo $name?></h1>
		<div style="padding-bottom:30px;"><?php echo $text ?></div>
<?php
						}while($trow = mysqli_fetch_array($tresults));
?>		
    <!--hr width="100%"/-->
  </div>
</div> 


  <!--div class="container">            
    <div class="row">
      <div class="span4" style="padding-left:100px; font-size:125%;">
        <h6><a href="#"><img width="240" height="110" src="images/templatemo_image_02.jpg" alt="image 2" /></a></h6>
        <p><em>Cindy Arenberg Seltzer<br />
        President/CEO <br />
        </em></p>
        <p align="justify">At the Children's services Council of Broward County, we recognize that families across our community are beaing challenged to do more with less. That's why we're providing this free resource, &quot;<strong>The Daily Living Tool Kit</strong>.&quot; Inside, you'll find helpful tips and insightful techniques on how to manage your finances and strech your hard earned dollars. You'll also learn about others in the community who are working to expand prosperity to all Broward residents.</p>
        <p align="justify">Remeber, Your future starts today! Dedicate yourself to a new financial start. We hope you enjoy this tool kit and benefit from the many resources it provides.</p>
        <h6>&nbsp;</h6>
        <h6>&nbsp;</h6>
      </div> 

    
            
      <div class="span4" style="padding-left:100px; font-size:150%;">
        	<h2>Daily Living Toolkit</h2>
	       		<h5>&nbsp;</h5>
   		    <ul>
            <li>
              <h4><a href="page.php?id=<?php echo $h_id ?>">Housing</a></h4>
            </li>
            <li>
              <h4><a href="page.php?id=<?php echo $f_id ?>">Food</a></h4>
            </li>
            <li>
              <h4><a href="page.php?id=<?php echo $hw_id ?>">Health And Wellness</a></h4>
            </li>
            <li>
              <h4><a href="page.php?id=<?php echo $c_id ?>">Children</a></h4>
            </li>
    		    <li>
    		      <h4><a href="page.php?id=<?php echo $e_id ?>">Employment and Education</a></h4>
    		    </li>
            <li>
              <h4><a href="page.php?id=<?php echo $t_id ?>">Transportation</a></h4>
            </li>
            <li>
              <h4><a href="page.php?id=<?php echo $m_id ?>">Money Management</a></h4>
            </li>                        
          </ul>
    	   </div>
    
            
            <div class="span4" style="padding-left:100px; font-size:150%;">
               <h2>Partnership</h2>
				<h4><a href="http://www.211-broward.org/" target="_blank">Broward 2-1-1</a></h4>
                <h4><a href="http://www.broward.edu/" target="_blank">Broward College</a></h4>
                <h4><a href="http://www.myflfamilies.com/" target="_blank">Florida Department of Children and Families</a></h4>
                <h4><a href="http://bchafl.org/" target="_blank">Broward County Housing Authority</a></h4>
				<h4><a href="http://www.broward.org/BCT" target="_blank">Broward County Transit</a></h4>
            </div>
</div>  
</div-->

<!-- Le javascript
    ================================================== -->
    <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary 
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>  -->
    
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
