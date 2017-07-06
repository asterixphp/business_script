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
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;"><!--Bonus Type-->My Earnings</h4>
								<table cellpadding="0" cellspacing="0" border="0" width="30%" class="profiletable">
									<!--<tr>
										<td width="20%" style="text-align:left;"><b>Direct Bonus</b></td>
										<td width="10%"> :
											<?php
												$bonus=mysql_query("select count(*) as tot from mlm_register where user_sponserid='$userdetail[user_profileid]'");
												 $row=mysql_fetch_array($bonus);
												 $Direct_Bonus_Count=$row['tot'];
												 $Calc=bcmul($Direct_Bonus_Count,$bonusAmt,0);
												 echo $Calc;
											?>
										</td>
									</tr>-->
								</table><br/><br/>
								<table cellpadding="0" cellspacing="0" border="0" width="100%" class="profiletable">
									<tr>
										<td colspan="5" style="text-align:left;"><strong>Fast Start Bonus</strong></td>
									</tr>
									<tr>
										<td width="25%" style="text-align:left;"><strong><!--Earning Amount-->Total Earnings</strong></td>
										<td width="25%" style="text-align:left;"><strong><!--Commission-->Amount Due</strong></td>
										<!--<td width="15%" style="text-align:left;"><strong>Joined Days</strong></td>
										<td width="20%"><strong>Target Days</strong></td>-->
										<td width="25%"><strong>Target Amount</strong></td>
										<td width="25%"><strong>Status</strong></td>
									</tr>
									<tr>
										<td>
										<?php 
										    $pvt=calculatepv($userdetail[user_profileid],1);
											$pvvtot=0; 
											$per=mysql_query("select * from mlm_purchase where pay_userid='$userdetail[user_profileid]' and pay_payment='1'");
											$totv=0;
											while($pp=mysql_fetch_array($per))
											 {
												$chkk=mysql_fetch_array(mysql_query("select * from mlm_target"));
													if($chkk['target_id']==1){
														$totv=$totv+$pp['pay_amount'];
													}
													else if($chkk['target_id']==3){
														$totv=$totv+$pp['pay_pv'];
													}	
											 }
											 $ttt=$pvt + $totv;
											 echo $ttt;
											?>
										</td>
										<td>
										<?php 
											$per=mysql_fetch_array(mysql_query("select * from mlm_percentage where id='1' and status='0'"));
											$perc=$per['percentage'];
											$amt=$ttt*($perc/100);
											echo $amt;
										?>
										</td>
										<!--<td>
										<?php 
										list($year, $month, $day) = explode('-',$userdetail['user_date']); $end = date("Y-m-d");
										echo (int)((time(void) - mktime(0,0,0,$month,$day,$year))/86400);?>
										</td>
										<td><?php $getTarget=mysql_fetch_array(mysql_query("select * from mlm_target"));
												echo $getTarget['no_of_days']; ?></td>-->
										<td><?php echo $getTarget['amount']; ?></td>
										<td><?php  echo fast_start_bonus($ttt,$userdetail['user_date']);?></td>
									</tr>
								</table>
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