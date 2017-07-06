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
					   $about=mysql_fetch_array(mysql_query("select * from mlm_cms"));
					   ?>

			
			<!-- banar -->
			<div class="row">
                <div class="span12 page-title-container">
                    <img src="img/page-title.jpg" />
                    <!--<div class="inner-page-title fixed">
                       <h2>
                         <?php echo $about['about_header'];?>
                        <p><?php echo $about['about_content'];?></p>
                    </div>-->
                </div>
            </div>
            <hr />
			<!-- banar end -->
			
			<div class="row">
                 <?php include("includes/leftmenu.php"); ?>
                    <div class="span8 single" style="text_aling:justify;">
                       <?php
					   $about=mysql_fetch_array(mysql_query("select cms_aboutus from mlm_cms"));
					   echo $about['cms_aboutus'];
					   ?>
                    </div>
                
            </div>
			
			<?php include("includes/footer.php"); ?>
			</div>
			<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
        
	</body>
</html>