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
			<?php include("includes/profileheader.php");	?>
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Purchase list</h4>
								<table cellpadding="0" cellspacing="0" border="0" width="100%" class="profiletable">
									<tr>
										<td width="10%">
											<strong>SNO</strong>
										</td>
										<td width="10%">
											<strong>Category</strong>
										</td>
										<td width="20%" style="text-align:left;">
											<strong>PRODUCT</strong>
										</td>
										<td width="20%">
											<strong>TOTAL AMOUNT</strong>
										</td>
										<td width="10%">
											<strong>PV</strong>
										</td>
										<td width="20%">
											<strong>DATE</strong>
										</td>
										
									</tr>
									
									<?php
										$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 10;
    	$startpoint = ($page * $limit) - $limit;
		$url='?';
									$pur=mysql_query("select * from mlm_purchase where pay_user='$_SESSION[userid]' and pay_payment='1' LIMIT {$startpoint} , {$limit}");
									
									
									$nom_rows=mysql_num_rows(mysql_query("select * from mlm_purchase where pay_user='$_SESSION[userid]' and pay_payment='1'"));
									if($nom_rows=='0')
									{ ?>
										<tr>
										<td style="color:#FF0000;" colspan="6" align="center"> No Records Found</td>
										</tr>
									
									<?php }
									$i=1;
								
								while($rpur=mysql_fetch_array($pur)) 
									{
									$proname=mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$rpur[pay_product]'"));
									?>
									
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										<td>
											<?php
											$catdet = getcategorydetailbyId($rpur['pay_category']);
											echo $catdet['category_name'];
											?>
										</td>
										<td style="text-align:left;">
											<?php echo $proname['pro_name'];?>
										</td>
										<td>
											Rs.<?php echo $rpur['pay_amount'];?>
										</td>
										<td>
											<?php
											echo $rpur['pay_pv'];
											?>
										</td>
										<td>
											<?php echo date("d-m-Y",strtotime($rpur['pay_date']));?>
										</td>
										
									</tr>
									<?php $i++; } ?>		
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