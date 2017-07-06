<?php 
include("config/error.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");

?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />

	
</head>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			
			<!-- Start Navigation -->
			<?php include("includes/menu.php");	?>
			<!-- End Navigation -->
			
			<hr />
			
			<!-- Profile info -->
			<div class="row">
                <div class="span profile-info">
					<div class="row">
						<div class="span2">
							<img src="<?=$profileimages?>" width="128" height="128" />
						</div>
						<div class="span9" style="width: 757px;">
							<blockquote style="height: 155px; margin: 0;">
								<h4 style="border:1px #CCC solid; padding:7px; margin-bottom:3px; height:20px;">
									<span style="float:left; display:block;">
										<?php echo $userdetail['user_fname']; ?>
									</span>
									<span style="float:right; display:block;">
										<?php echo $userdetail['user_date']; ?>
									</span>
								</h4>
                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
									<tr>
										<td width="20%">
											<strong>Name</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php echo $userdetail['user_fname']; ?>
										</td>
										<td width="20%">
											<strong>Email id</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php echo $userdetail['user_email']; ?>
										</td>
									</tr>
									<tr>
										<td width="20%">
											<strong>Profile Id</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
											<?php echo $userdetail['user_profileid']; ?>
										</td>
										<td width="20%">
											<strong>Sponsor Name</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="28%">
										<?php echo $userdetail['user_sponsername']; ?>
										</td>
									</tr>
								</table>
								<hr style="border: 1px solid #f5f5f5;" />
								<div style="text-align:center;">
									<ul style="list-style:none; margin: 0; width:100%;">
										<li style="margin:0 10px; display:block;">
											<label  class="cb-enable selected">
												<span>Total CV </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:50px;"><?php echo $userdetail['total_bv']; ?></span>
											</label>
										</li>
										<li>
											<span style="float:left; margin:0 10px;">&nbsp;</span>
										</li>
										<li style="margin:0 10px;">
											<label class="cb-enable selected">
												<span>Current CV </span>
											</label>
											<label class="cb-disable">
												<span style="min-width:50px;"><?php echo $userdetail['accumulated_bv']; ?></span>
											</label>
										</li>
									</ul>
								</div>
                            </blockquote>
						</div>
					</div>
                </div>
            </div>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner">
								<h4 class="navbar-inner" style="color:#fff; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Purchase list</h4>
								<table cellpadding="0" cellspacing="0" border="0" width="100%" class="profiletable">
									<tr>
										<td width="10%">
											<strong>SNO</strong>
										</td>
										<td width="30%" style="text-align:left;">
											<strong>PRODUCT</strong>
										</td>
										<td width="15%">
											<strong>AMOUNT</strong>
										</td>
										<td width="10%">
											<strong>CV</strong>
										</td>
										<td width="20%">
											<strong>DATE</strong>
										</td>
										<td width="15%">
											<strong>ACTION</strong>
										</td>
									</tr>
									
									<?php
										$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 10;
    	$startpoint = ($page * $limit) - $limit;
		$url='?';
									
									$pur=mysql_query("select * from mlm_purchase where pay_user='$_SESSION[userid]' and pay_payment='1' LIMIT {$startpoint} , {$limit}");
									$nom_rows=mysql_num_rows(mysql_query("select * from mlm_purchase where pay_user='$_SESSION[userid]' and pay_payment='1'"));
									$i=1;
									$cpur=mysql_num_rows($pur);
									while($rpur=mysql_fetch_array($pur)) 
									{
									$proname=mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$rpur[pay_product]'"));
									?>
									
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										<td style="text-align:left;">
											<?php echo $proname['pro_name'];?>
										</td>
										<td>
											Rs.<?php echo $proname['pro_cost'];?>
										</td>
										<td>
											<?php echo $proname['pro_bv'];?>
										</td>
										<td>
											<?php echo date("d-m-Y",strtotime($rpur['pay_date']));?>
										</td>
										<td>
											<a href="#">VIEW</a>
										</td>
									</tr>
									<?php $i++;} ?>		
										<tr>
									<td colspan="5" align="center">
									</td></tr>
									
									</table>
								    
							</div>
							 <div>
            <?php echo pagination($nom_rows,$limit,$page,$url); ?>
                      
                    </div>
                        </div>
                    </div>
                    <br />
                </div>
				
            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>