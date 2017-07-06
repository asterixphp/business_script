<?php 
include("config/error.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");

$result = mysql_query("SELECT SUM(pay_amount) from mlm_payoutcalc where pay_user='$_SESSION[userid]' AND pay_calc_status = 1");
$row = mysql_fetch_array($result);
$pay_sum_s = $row[0];

if($pay_sum_s == NULL || $pay_sum_s == ''){$pay_sum_s = 0;}

$result = mysql_query("SELECT SUM(pay_amount) from mlm_payoutcalc where pay_user='$_SESSION[userid]' AND pay_calc_status = 0");
$row = mysql_fetch_array($result);
$pay_sum_f = $row[0];

if($pay_sum_f == NULL || $pay_sum_f == ''){$pay_sum_f = 0;}


$pur_num_s=mysql_num_rows(mysql_query("select * from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 1"));
				
$result=mysql_query("select sum(pay_amount) from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 1");
$row = mysql_fetch_array($result);
$puram_sum_s = $row[0];

$pur_num_p=mysql_num_rows(mysql_query("select * from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 0"));
				
$result=mysql_query("select sum(pay_amount) from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 0");
$row = mysql_fetch_array($result);
$puram_sum_p = $row[0];

$pur_num_f=mysql_num_rows(mysql_query("select * from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 2"));
				
$result=mysql_query("select sum(pay_amount) from mlm_purchase where pay_user='$_SESSION[userid]' AND pay_payment = 2");
$row = mysql_fetch_array($result);
$puram_sum_f = $row[0];

if($pur_num_s == NULL || $pur_num_s == ''){$pur_num_s=0;}
if($pur_num_p == NULL || $pur_num_p == ''){$pur_num_p=0;}
if($pur_num_f == NULL || $pur_num_f == ''){$pur_num_f=0;}

if($puram_sum_s == NULL || $puram_sum_s == ''){$puram_sum_s=0;}
if($puram_sum_p == NULL || $puram_sum_p == ''){$puram_sum_p=0;}
if($puram_sum_f == NULL || $puram_sum_f == ''){$puram_sum_f=0;}


				$d4 = date('Y-m-d', strtotime(date('Y-m-d')." -4 week")); 
				$d3 = date('Y-m-d', strtotime(date('Y-m-d')." -3 week")); 
				$d2 = date('Y-m-d', strtotime(date('Y-m-d')." -2 week")); 
				$d1 = date('Y-m-d', strtotime(date('Y-m-d')." -1 week")); 
				$d0 = date('Y-m-d', strtotime(date('Y-m-d')));
				
				$psum_d4 = array();
				$psum_d3 = array();
				$psum_d2 = array();
				$psum_d1 = array();
				
				for($i=0;$i<3;$i++)
				{
				$row1 = mysql_fetch_array(mysql_query("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d4' and '$d3') AND pay_payment=$i"));
				$psum_d4[$i] = $row1['sum'];
				if($psum_d4[$i] == NULL || $psum_d4[$i] == ""){$psum_d4[$i] = 0;}	
				
				
				$row2 = mysql_fetch_array(mysql_query("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d3' and '$d2') AND pay_payment=$i"));
				$psum_d3[$i] = $row2['sum'];
				if($psum_d3[$i] == NULL || $psum_d3[$i] == ""){$psum_d3[$i] = 0;}
			
				$row3 = mysql_fetch_array(mysql_query("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d2' and '$d1') AND pay_payment=$i"));
				$psum_d2[$i] = $row3['sum'];
				if($psum_d2[$i] == NULL || $psum_d2[$i] == ""){$psum_d2[$i] = 0;}
				
				$row4 = mysql_fetch_array(mysql_query("select sum(pay_amount) as sum from mlm_purchase where pay_user='$_SESSION[userid]' AND (pay_date BETWEEN '$d1' and '$d0') AND pay_payment=$i"));
				$psum_d1[$i] = $row4['sum'];
				if($psum_d1[$i] == NULL || $psum_d1[$i] == ""){$psum_d1[$i] = 0;}
				
				}
				
			$psum_d4[3] = $psum_d4[2] + $psum_d4[1] + $psum_d4[0];
			$psum_d3[3] = $psum_d3[2] + $psum_d3[1] + $psum_d3[0];
			$psum_d2[3] = $psum_d2[2] + $psum_d2[1] + $psum_d2[0];
			$psum_d1[3] = $psum_d1[2] + $psum_d1[1] + $psum_d1[0];




//SELECT * FROM `mlm_register` WHERE user_sponserid = 'SBI2015021' AND user_status = 0

$user_active_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE user_sponserid = '$_SESSION[profileid]' AND user_status = 0"));
$user_inactive_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE user_sponserid = '$_SESSION[profileid]' AND user_status = 1"));
$user_temp_num = mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE user_sponserid = '$_SESSION[profileid]' AND user_status = 5"));

?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />

<!-- style pie chart-->
<style>
#flotcontainer1 {
    width: 300px;
    height: 300px;
    text-align: center;
	background:#ffffff;
	margin:auto;
}
#flotcontainer2 {
    width: 300px;
    height: 300px;
    text-align: center;
	background:#ffffff;
	margin:auto;
}
#flotcontainer3 {
    width: 300px;
    height: 300px;
    text-align: center;
	background:#ffffff;
	margin:auto;
}
</style>
<!-- end-->
</head>
    <body>
		<div class="container main">
			<!-- Start Header-->
			<?php include("includes/header.php"); ?>
			<!-- End Header-->
			
			<!-- Start Navigation -->
			<?php include("includes/menu.php");	?>
			
			<br>
			<br>
		
			<!-- End Navigation -->
			
			<hr />
			
			<!-- Profile info -->
			<?php //include("includes/profileheader.php");	?>
<!--			
			<div id="linechart">
			
			</div>
			
			<br><br><br><br>
			
			<table width='100%' border=1>
			<tr>
			<td width='33%' align='center'>
			<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Overall Payout calculation</h4>
			<div id="flotcontainer1"></div>		
			</td>
			<td width='33%' align='center'>
			<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Overall Users Overview</h4>
			<div id="flotcontainer2"></div>
			</td>
			<td width='33%' align='center'>
			<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Overall Purchase Details</h4>
			<div id="flotcontainer3"></div>
			</td>
			</tr>
			</table>
			
			
		-->
			
			<!-- Profile info end -->
			
			<hr />
			
			<div class="row">
			
				<!-- left div here -->
				
                <?php include("includes/profilemenu.php"); ?>
                
				<div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner">
								<div>
								
								<table	width="100%">
								<tr>
								<td width="48%">
								<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Overall Payout</h4>
									<table cellpadding="7" cellspacing="5" border="0" width="100%">
									<tr>
										<td width="15%">
											<strong>S.No</strong>
										</td>
										
										<td width="65%"> 
											<strong>Description</strong>
										</td>
										
										<td width="20%">
											
										</td>
									</tr>
									<tr>
										<td>1</td>
										<td>Earning Amount</td>
										<td><?php echo $pay_sum_s;?></td>
									</tr>
									<tr>
										<td>2</td>
										<td>Requested Amount</td>
										<td><?php echo $pay_sum_f; ?></td>
									</tr>
									<tr>
										<td>3</td>
										<td>Geneology</td>
										<td><a href="sunflower.php">click</a></td>
									</tr>
								
									</table>
								</td>
								<td>
								</td>
								<td width="48%">
									<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Overall Purchase Details</h4>
									<table cellpadding="7" cellspacing="5" border="0" width="100%">
									<tr>
										<td width="10%">
											<strong>S.No</strong>
										</td>
										
										<td width="50%"> 
											<strong>Description</strong>
										</td>
										
										<td width="20%">
											<strong>Count</strong>
										</td>
										<td width="20%">
											<strong>Cost</strong>
										</td>
									</tr>
									<tr>
										<td>1</td>
										<td>Purchased - success</td>
										<td><?php echo $pur_num_s; ?></td>
										<td><?php echo $puram_sum_s; ?></td>
									</tr>
									<tr>
										<td>2</td>
										<td>Purchased - on process</td>
										<td><?php echo $pur_num_p; ?></td>
										<td><?php echo $puram_sum_p; ?></td>
									</tr>
									<tr>
										<td>3</td>
										<td>Purchased - failed</td>
										<td><?php echo $pur_num_f; ?></td>
										<td><?php echo $puram_sum_f; ?></td>
									</tr>
								
									</table>
								
								</td>
								</tr>
								</table>
								
								</div>
								
				<br><br><br><br>
							
							<div>
							<?php
									
									$week_start = strtotime('monday this week');
									$week_end = strtotime('sunday this week');
									$l1 = date('d-m-Y', $week_start);
									$l2 = date('d-m-Y', $week_end);

							?>
							
							
							
							<h4 class="navbar-inner" style="color:black; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Weekly Purchase <?php echo '( '.$l1.' to '.$l2.' )'; ?></h4>
									<table cellpadding="7" cellspacing="5" border="0" width="100%">
									<tr>
										<td width="10%">
											<strong>S.No</strong>
										</td>
										
										<td width="40%"> 
											<strong>Product Name</strong>
										</td>
										
										<td width="25%">
											<strong>Quantity</strong>
										</td>
										
										<td width="25%">
											<strong>Overall Cost</strong>
										</td>
										
									</tr>
									
									
									<?php
									
									$sql = "SELECT DISTINCT mlm_purchase.pay_product,mlm_purchase.pay_user, mlm_products.pro_name FROM mlm_purchase,mlm_products where (mlm_purchase.pay_user='$_SESSION[userid]') AND (mlm_products.pro_id = mlm_purchase.pay_product)";
									
									$week_start = strtotime('monday this week');
									$week_end = strtotime('sunday this week');
									$week_start = date('Y-m-d', $week_start);
									$week_end = date('Y-m-d', $week_end);
									
									$sql.= "AND (mlm_purchase.pay_date between '$week_start' AND '$week_end')";
									
									$result = mysql_query($sql);
									$i=0;
									
									while($row = mysql_fetch_assoc($result)){
									$pro_id = $row['pay_product'];
									$pro_name = $row['pro_name'];
									$i++;
									$amt=0;
									$qqty=0;

									$result1 = mysql_query("SELECT * FROM mlm_purchase where pay_user='$_SESSION[userid]' AND pay_product='$pro_id'");
									

									while($row1=mysql_fetch_assoc($result1)){
											$amt+=(int)$row1['pay_amount'];
											$qqty++;
											}
											?>
									<tr>
										<td>
											<?php echo $i;?>
										</td>
										
										<td> 
											<?php echo $pro_name;?>
										</td>
										
										<td>
											<?php echo $qqty;?>
										</td>
										
										<td>
											<?php echo $amt;?>
										</td>
										
									</tr>	
										
								<?php } ?>		
										
										
										
									
								
									</table>
									</div>			
								</div>
							<div>
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
		
<link href="c3/c3.css" rel="stylesheet" type="text/css">
<script src="d3/d3.v3.min.js"></script>
<script src="c3/c3.min.js"></script>

<script type="text/javascript">

var pie1 = c3.generate({
    bindto: '#flotcontainer1',
    data: {
      columns: [
        ['Success',<?php echo $pay_sum_s;?>],
		['Pending',<?php echo $pay_sum_f;?>]
        
      ],
	  type:'pie',
	  colors: {
            Success: '#73e600',
            Pending: '#ffcc00'
        }
    }
});

var pie2 = c3.generate({
    bindto: '#flotcontainer2',
    data: {
      columns: [
        ['Active', <?php echo $user_active_num; ?>],
		['Temp', <?php echo $user_temp_num; ?>],
		['Requested', <?php echo $user_inactive_num; ?>]
        
      ],
	  type:'pie',
	  colors: {
            Active: '#73e600',
			Temp: '#ffcc00',
            Requested: '#ff471a'
        }
    }
});

var pie3 = c3.generate({
    bindto: '#flotcontainer3',
    data: {
      columns: [
        ['Success', <?php echo $puram_sum_s; ?>],
		['Pending', <?php echo $puram_sum_p; ?>],
		['Failed', <?php echo $puram_sum_f; ?>]
        
      ],
	  type:'pie',
	  colors: {
            Success: '#73e600',
            Pending: '#ffcc00',
			Failed: '#ff471a'
        }
    }
});

var line1 = c3.generate({
    bindto: '#linechart',
    data: {
      columns: [
        ['Overall purchase value',<?php echo $psum_d4[3];?>,<?php echo $psum_d3[3];?>,<?php echo $psum_d2[3];?>,<?php echo $psum_d1[3];?>]
      ],
	  colors: {
            
        }
    },
	axis: {
        x: {
            type: 'category',
            categories: ['end of 4th week','end of 3rd week','end of 2nd week','end of last week']
        }
    }
});

setTimeout(function () {
    line1.load({
        columns: [
            ['process purchase value',<?php echo $psum_d4[0];?>,<?php echo $psum_d3[0];?>,<?php echo $psum_d2[0];?>,<?php echo $psum_d1[0];?>]
        ]
    });
}, 2000);

setTimeout(function () {
    line1.load({
        columns: [
            ['process purchase value',<?php echo $psum_d4[0];?>,<?php echo $psum_d3[0];?>,<?php echo $psum_d2[0];?>,<?php echo $psum_d1[0];?>]
        ]
    });
}, 2000);

setTimeout(function () {
    line1.load({
        columns: [
			['Success purchase value',<?php echo $psum_d4[1];?>,<?php echo $psum_d3[1];?>,<?php echo $psum_d2[1];?>,<?php echo $psum_d1[1];?>]
        ]
    });
}, 4000);

setTimeout(function () {
    line1.load({
        columns: [
			['Failed purchase value',<?php echo $psum_d4[2];?>,<?php echo $psum_d3[2];?>,<?php echo $psum_d2[2];?>,<?php echo $psum_d1[2];?>]
        ]
    });
}, 6000);



</script>
<!-- end -->
		
		
	</body>
</html>