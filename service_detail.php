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
			
            <div class="row">
                <div class="span12 page-title-container">
                    <img src="img/service-header.jpg" />
                     <!--<div class="inner-page-title fixed">
                        <h3>Product Detail</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit integer id nibh ac est.</p>
                    </div>-->
                </div>
            </div>
            <hr />
            <div class="row">
                  <?php include("includes/leftmenu.php"); ?>

                <div class="span9">

                    <div class="row">
                        <div class="span9">
							<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -5px; margin-bottom: 7px;">
								Product full details
							</h4>
						<?php
							$proid=addslashes($_REQUEST['pid']);
							$products=mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$proid'"));

						?>
                            <h3>
								<?php echo ucfirst($products['pro_name']); ?>
								<span style="float:right; padding:0 10px;">
									$<?=$products['pro_cost']?>/-
								</span>
							</h3>
                        </div>
                    </div>
                    <br />
					<div class="span8" style="width:680px;">
                    <div class="row" style="border:1px #CCC solid;">
							<!---------------------Description------------------------->
							<div class="span5">
							<p>
									<?php echo $products['pro_desc']; ?>
								
								   
							 </p>
							 <p>
									Point Value : <?php echo $products['pro_pv']; ?>
								
								   
							 </p>
							   
							</div>
							<!---------------------Image------------------------->
							<div class="span3">
								<img src="uploads/products/logo/original/<?php echo $products['pro_logo']; ?>" width="300" height="200" />
							   <!-- <img alt="" src="img/service_detail.jpg" />-->
							</div>
                    </div>
					</div>
                    <hr />
                    <div class="row">
					<!---------------------Long Description------------------------->
                        <div class="span9">
                            <p>
                                <?php echo $products['pro_longdesc']; ?>
                            </p>
                        </div>
                    </div>
					
					<div class="row">
                        <div class="span9" style="border:1px #CCC solid; margin-bottom:-7px;">
							<div style="padding:10px; text-align:center;">
                            	
								
								    <form action="product_buynow.php" method="post">
					
					
                        <div>
							<div>
						<input type="radio" name="propay" value="1" checked="checked" style="display:none">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/paypal.jpeg" style="width:100px; height:80px;">
							</div>
							<div style="padding:10px; padding-left:200px;display:none">
						<input type="radio" name="propay" value="2" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="images/icici.jpeg"  style="width:100px; height:60px;">
							</div>
							<input type="hidden" name="status" value="0">
                      <input type="hidden" name="type" value="Paypal">
						<input type="hidden" name="pid" value="<?php echo $_REQUEST['pid']; ?>">
						
							<div>
								<?php if($products['pro_stock']>0) { ?>
                            	<input type="submit" name="pay" value="PAY NOW"  style="background-color: #4A7002;
border-radius: 5px;
border: 1px solid #74B807;
display: inline-block;
cursor: pointer;
color: #FFF;
font-size: 14px;
font-weight: bold;
padding: 4px 10px;
text-decoration: none;">
								<?php } ?>
								&nbsp;&nbsp;
								<a href="product_buynow.php?cancel" class="greenbtn">Cancel</a>
							</div>
                        
                    
					
					 </div>
					
                    
					
					
					</form>
								
								
								<!--<form action="paypal_pro.php" method="post">
								  
								  <input type="hidden" name="pid" value="<?php echo $proid; ?>" />
								  <input type="hidden" name="rval" value="<?php echo $rankey; ?>" />
								  
								  
								  
								  
								  <input type="image" name="submit" border="0"
								  src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
								  alt="PayPal - The safer, easier way to pay online" style="width:100px;height:30px;">
								  <img alt="" border="0" width="1" height="1"
								  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
								</form>-->
							</div>
                        </div>
                    </div>
					<hr />
                    <div class="row">
                        <div class="span3">
                            <p>
								<h4>Features of <?php echo ucfirst($products['pro_name']); ?> </h4>
                               	<?php echo $products['pro_features']; ?>
                            </p>

                        </div>
						<!---------------------Tab Menu------------------------->
                        <div class="span6">
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#1" data-toggle="tab">Why us?</a></li>
                                    <li><a href="#2" data-toggle="tab">Related Product</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="1">
                                        <p>
                                            Nam eu tortor eget nunc blandit rutrum. Praesent hendrerit ante sed nulla molestie gravida. Vestibulum ante ipsum primis in faucibus orci luctus.
                                        </p>
                                    </div>

                                    <div class="tab-pane" id="2">
                                        <ul class="thumbnails related_products" style="overflow:-moz-hidden-unscrollable;">
										<?php
											$nam=$products['pro_name']; 
											$related=mysql_query("select * from mlm_products where pro_name like '%$nam%' and pro_id !='$proid' order by rand() limit 2");
											while($search=mysql_fetch_array($related))
											{
										?>	
                                            <li class="span3">
                                                <div class="service-box" style="height:200px; width:180px;">
                                                    <div class="caption">
                                                        <a href="service_detail.html"><h4><?php echo ucfirst($search['pro_name']); ?> </h4></a>
                                                        <p>
															
															<?php 
																echo substr($search['pro_desc'],0,70); 
																if(strlen($search['pro_desc'])>70)
																{
																	echo "......";
																}
															
															?>
                                                            
                                                        </p>
                                                    </div>
                                                    <a href="service_detail.php?pid=<?php echo $search['pro_id']; ?>"><img src="uploads/products/logo/thumb/<?php echo $search['pro_logo']; ?>" style="width:100px; height:80px; padding:2px 40px;"/></a>

                                                </div>
                                            </li>   
											<?php
												}
											?>    
                                            
                                        </ul>
                                    </div>
                                </div>
                            </div>

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