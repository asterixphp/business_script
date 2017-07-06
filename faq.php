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
			
            <div class="form3">
            <div class="span5">
                        <div class="span7" style="width:600px;">
						<h2> <?php echo "Frequently Asked Questions";?></h2><br>
					
                       		<?php
									$select=mysql_query("select * from mlm_faq where faq_status=0");
                               	while($test=mysql_fetch_array($select))
								{
								?>
								
								<h4><?php echo $test['faq_qtn'];?></h4>
								<p><?php echo $test['faq_ans']; ?> </p>
								<?php
								}
								?>

                 
					</div>
    			</div></div>
            <div class="row">
                <div class="span3">

                    <!-- start sidebar -->

                   <!-- <div class="span3">
                       
                        
                        <br />
                        <div class="row">
                            <div class="span3 vertical-menu">
                                
                            </div>

                        </div>
                    </div>-->
                    <!-- end sidebar -->

                </div>

                <!--<div class="span9">

                    <div class="row">

                        <div class="span9 entry">
                            
                            <div class="row">
                                <div class="span5">
                                    
                                </div>
                                <div class="span4 related_posts">
                                   
                                </div>
                            </div>


                        </div>	 
                    </div>

                    <hr />
                    <div class="row">
                        <div class="span9">
                            

                        </div>


                    </div><!-- /row -->

              <!--  </div>-->

            </div>
            <?php 
			
			include("includes/footer.php");
			
			?>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>