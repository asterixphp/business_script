<?php include("config/error.php");
include("includes/head.php");
?>
</head>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			
			<!-- Start Navigation -->
			<?php include("includes/menu.php");	?>
			<!-- End Navigation -->
			<?php
					   $testi=mysql_fetch_array(mysql_query("select * from mlm_cms"));
					   ?>
			<!-- banar -->
			<div class="row">
                <div class="span12 page-title-container">
                    <img src="img/contact.jpg" />
                     <div class="inner-page-title fixed" style="padding: 45px 25px 20px;">
                        <h2>
                         <?php echo $testi['testi_header'];?></h2>
                        <p><?php echo $testi['testi_content'];?></p>
                    </div>
                </div>
            </div>
			<!-- banar end -->
			<hr />
			<br />
			<div class="row">
			 <?php include("includes/leftmenu.php"); ?>
			<?php
				$tid = $_GET['tid'];
				if($tid == ""||$tid==0){
					echo "<script>location.href='testimonials.php';</script>";
				}
				$select=mysql_query("select * from mlm_testimonial where test_id='$tid'");
				$test=mysql_fetch_array($select)
			?>
                <div class="span9">
				<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -5px; margin-bottom: 7px;"><?php echo ucwords($test['test_title']); ?></h4>
                    <div class="row">
                        <div class="span3" style="width:140px;">
						   <?php 
							$testmonial_img = $test['testmonial_img'];
							?>
								<?if($testmonial_img !=""){?>
									<img src="uploads/testmonial_img/<?echo $testmonial_img;?>" style="width:140px; height:150px;">
								<? } else{?>
									<img src="images/empty_images.jpg" style="width:140px; height:150px;">
                      		<?php } ?>
                        </div>
                        <div class="span7">
                            <blockquote style="height: 153px;">
                                <p> <?php echo $test['test_comment']; ?> </p>
                                <small>&nbsp;&nbsp;&nbsp;<?php echo $test['test_date']; ?></small>
                            </blockquote>
                        </div>
                    </div>
		      </div>
            </div>			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>