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
                    <img src="img/testimonial.jpg" />
                    <!-- <div class="inner-page-title fixed" style="padding: 45px 25px 20px;">
                        <h2>
                         <?php echo $testi['testi_header'];?></h2>
                        <p><?php echo $testi['testi_content'];?></p>
                    </div>-->
                </div>
            </div>
			<!-- banar end -->
			<hr />
			<br />
			<div class="row">
			 <?php include("includes/leftmenu.php"); ?>

                <div class="span9">
				<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -5px; margin-bottom: 7px;">Testimonials List</h4>
				<?php
				$select=mysql_query("select * from mlm_testimonial where test_status=0");
				while($test=mysql_fetch_array($select))
				{
				?>
                    <div class="row">
                        <div class="span3" style="width:140px;">
							<?php
							$user=mysql_fetch_array(mysql_query("select user_id,user_fname,user_image from mlm_register where user_id='$test[test_user]'"));
							if($user['user_image'])
							{ ?>
								 <img src="uploads\profile_image\thumb\<?php echo $user['user_image']; ?>"/>
						   <?php }
						   else
						   {
							$testmonial_img = $test['testmonial_img'];
							?>
								<?if($testmonial_img !=""){?>
									<img src="uploads/testmonial_img/<?echo $testmonial_img;?>" style="width:140px; height:150px;">
								<? } else{?>
									<img src="images/empty_images.jpg" style="width:140px; height:150px;">
                      		<?php } }?>
                        </div>
                        <div class="span7">
                            <blockquote style="height: 153px;">
								<h4><?php echo $test['test_title']; ?></h4>
                                <p> <?php $test_comment = $test['test_comment']; echo @substr($test_comment,0,200); ?> </p>
                                <small> <?php echo $user['user_fname']; ?>&nbsp;&nbsp;&nbsp;<?php echo $test['test_date']; ?></small>
                            </blockquote>
							<a href="testimonials_read.php?tid=<?echo $test['test_id'];?>" style="float:right;">Read More</a>
                        </div>
                    </div>
				<?php }	?>
		      </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>