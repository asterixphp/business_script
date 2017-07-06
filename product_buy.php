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
                     <div class="inner-page-title fixed">
                        <h3>Product Detail</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit integer id nibh ac est.</p>
                    </div>
                </div>
            </div>
            <hr />
            <div class="row">
				<?php include("includes/leftmenu.php"); ?>
				<?php
					$proid=addslashes($_REQUEST['pid']);
					$products=mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$proid'"));
				?>

                <div class="span9">

                    <div class="row">
                        <div class="span9">
							<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -5px; margin-bottom: 7px;">
								Buy the product
							</h4>
						
                            <h3>
								<?php echo ucfirst($products['pro_name']); ?>
								<span style="float:right; padding:0 10px;">
									Rs. <?php echo $products['pro_cost'];?>/-
								</span>
							</h3>
                        </div>
                    </div>
                    <br />
					<div class="span8" style="width:680px;">
                    <div class="row" style="border:1px #CCC solid;">
							<!---------------------Description------------------------->
							<div class="span6" style="width: 450px; padding: 10px 0;">
								<table cellpadding="7" cellspacing="0" border="0" width="100%">
									<tr>
										<td>
											PV you get
										</td>
										<td>:</td>
										<td>
											<?php echo $products['pro_pv'];?>
										</td>
									</tr>
									<tr>
										<td>
											Stock in hand
										</td>
										<td>:</td>
										<td>
											<?php echo $products['pro_stock'];?> Nums
										</td>
									</tr>
									
									<!--<tr>
										<td>
											Retial Bonus<br>
                                            <span style="font-size:10px;">Minus from MRP</span>
										</td>
										<td>:</td>
										<td>
                                        	<?php if(isset($_SESSION['profileid'])) { 
												$repurchasecheck=mysql_query("SELECT usr_purchased_num FROM mlm_user_status WHERE usr_user='$_SESSION[profileid]'");
												if(mysql_num_rows($repurchasecheck)>0) {
													$repurchaseusrrow=mysql_fetch_array($repurchasecheck);
													if($repurchaseusrrow['usr_purchased_num']>0) {
														$repurchasebonus=mysql_fetch_array(mysql_query("SELECT sun_retail FROM mlm_sunplan WHERE sun_id=1"));
														$tmp=$products['pro_cost']*($repurchasebonus['sun_retail']/100);
														$amt=number_format($tmp,2);
														echo "Rs ".$amt."/-";
													}
												} else {
													echo "This is your 1st purchase";
												}
											} else { ?>
                                            Login to check your retail bonus
                                            <?php } ?>
										</td>
									</tr>-->
								</table>
							</div>
							<!---------------------Image------------------------->
							<div class="span2" style="width: 185px; padding: 10px;">
								<img src="uploads/products/logo/original/<?php echo $products['pro_logo']; ?>" width="150" height="100" />
							   <!-- <img alt="" src="img/service_detail.jpg" />-->
							</div>
                    </div>
					</div>
                    <hr />
                    <div class="row">
					<!---------------------Long Description------------------------->
                        <div class="span9">
                            <p>
                                <?php echo $products['pro_desc']; ?>
                            </p>
                        </div>
                    </div>
					
					<div class="row">
                        <div class="span9" style="border:1px #CCC solid; margin-bottom:-7px;">
							<div style="padding:10px; text-align:center;">
								<?php if($products['pro_stock']>0) { ?>
                            	<a href="product_buynow.php?pid=<?php echo $_REQUEST['pid'];?>" class="greenbtn">BUY NOW</a>
								<?php } ?>
								&nbsp;&nbsp;
								<a href="product_buynow.php?cancel" class="greenbtn">Cancel</a>
							</div>
                        </div>
                    </div>
					<hr />
                    
                </div>

            </div>
           <?php 
			
			include("includes/footer.php");
			
			?>
        </div>
        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
    </body>
</html>