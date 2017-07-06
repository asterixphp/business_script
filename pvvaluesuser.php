<?php 
include("config/error.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");

$total_countv =0;
function DownlineCountp($prflid,$iv){
    $sql="SELECT * FROM mlm_register where user_status='0' and user_sponserid='$prflid'";
    $res=mysql_query($sql);
    $row=mysql_fetch_array($res);
	global $total_countv;
	if($iv==3){
		$total_countv=0;
	}
    $total_countv=$total_countv+mysql_num_rows($res)."tot";
    if($row['user_profileid']!=''){
       DownlineCountp($row['user_profileid'],1);
    }
    return $total_countv;
}

function calculatepv1($prflid,$i){
	$sql="SELECT * FROM mlm_register where user_status='0' and user_sponserid='$prflid'";
	$res=mysql_query($sql);
	$row=mysql_fetch_array($res);
	global $pvvtot;
	
	$pvv=mysql_query("select * from mlm_purchase where pay_userid='$row[user_profileid]' and pay_payment=1");
	while($pp1=mysql_fetch_array($pvv)){
		$pvvtot=$pvvtot+$pp1['pay_pv'];
	}
	if($row['user_profileid']!=''){
		calculatepv1($row['user_profileid'],2);
  	}
	return $pvvtot;
}


$pvvtot1=0;
function Downlw($prflid,$i){
	if($i==L){
		 $sqlr="SELECT * FROM mlm_register where user_status='0' and user_sponserid='$prflid' and user_placement='L'";
	}
	else if($i==R){
		 $sqlr="SELECT * FROM mlm_register where user_status='0' and user_sponserid='$prflid' and user_placement='R'";
	}
 $resr=mysql_query($sqlr);
 $resrnum=mysql_num_rows($resr);
 $rowr=mysql_fetch_array($resr);
 global $pvvtot1;
  $month_start = strtotime('first day of this month', time());
  $month_end = strtotime('last day of this month', time());
  $month_start = date('Y-m-d', $month_start);
  $month_end = date('Y-m-d', $month_end);
  if($resrnum !='0' || $resrnum !=''){
        $pvv=mysql_query("select * from mlm_purchase where pay_userid='$rowr[user_profileid]' and pay_payment=1 and pay_date>=$month_start");
           while($pp1=mysql_fetch_array($pvv))
		   {
			 $pvvtot1=$pvvtot1+$pp1['pay_pv'];
		   }
  }
   if($rowr['user_profileid']!=''){	
      Downlw($rowr['user_profileid'],2);
   }
return $pvvtot1;
} 
?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />

<style>
#note{
width:100%;
margin:auto;	
}

</style>

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
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Point Values</h4>
								<table cellpadding="0" cellspacing="0" border="0" width="100%" class="profiletable">
									<tr>
										<td width="10%"><strong>PPV</strong></td>
										<td width="20%"><strong>TPPV</strong></td>
										<!--<td width="20%"><strong>TSPV</strong></td>-->
										<td width="10%"><strong>TBPV</strong></td>
										<td width="20%"><strong>PWPV</strong></td>
										<td width="20%"><strong>TPWPV</strong></td>
										<td width="20%"><strong>TPSPV</strong></td>
									</tr>
									<tr>
										<td width="10%">
										<?
											$rpv=mysql_query("select * from mlm_purchase where pay_userid='$_SESSION[profileid]' and pay_payment='1'");
											$nom_rows=mysql_num_rows($rpv); 
											$totpv=0;
											while($pvv=mysql_fetch_array($rpv)){
												$totpv=$totpv+$pvv['pay_pv'];
											}
											$pvt=calculatepv1($_SESSION[profileid],1);
											$pvvtot=0; 
											echo $totpv;
										?>
										</td>
										<td width="20%"><?php echo $totpv+$pvt; ?></td>
										<!--<td width="20%">
										<?php 
											/*  $DwnlineCount = DownlineCountp($_SESSION[profileid],3);
											$total_countv=0; 
											$calcc=mysql_fetch_array(mysql_query("select * from mlm_binaryplan where binary_id='1'"));
											echo $DwnlineCount*$calcc['binary_refbonus']; */
										?>
										</td>
										<td width="10%">
										<?php 
											///echo $DwnlineCount*$calcc['binary_refbonus'];
										?>
										</td>-->
										<td width="20%">
										<?php  
										    $left= Downlw($_SESSION[profileid],L);
											$pvvtot1=0;
										    $right= Downlw($_SESSION[profileid],R);
											$pvvtot1=0;
											if($left<$right){
												echo $left."(Left)";
											 }
											 else if($right<$left){
												echo $right."(Right)"; 
											 }
											 else if($right==$left){
												  echo $right."(Left and Right)";
											 } 
											 ?>
										</td>
										<td width="20%">
										<?php 
											 $cnt=DownlineCountbin($_SESSION[profileid],L); 
											 $total_count1=0; 
											 $cnt1=DownlineCountbin($_SESSION[profileid],R); 
											 $total_count1=0; 
											 if($cnt<$cnt1){
												 if($cnt!=0)
												    echo $cnt*$calcc['binary_refbonus']."(Left)"; 
											     else
													echo $cnt*$calcc['binary_refbonus'];
											 }else{
												 if($cnt1!=0)
												  echo $cnt1*$calcc['binary_refbonus']."(Right)"; 
											     else
												  echo $cnt1*$calcc['binary_refbonus'];
											 }
											 ?> 
										</td>
										<td width="20%">
										<?php 
										    if($cnt>$cnt1){
												 if($cnt!=0)
												    echo $cnt*$calcc['binary_refbonus']."(Left)"; 
											     else
													echo $cnt*$calcc['binary_refbonus'];
												
									        }else{
												 if($cnt1!=0)
												  echo $cnt1*$calcc['binary_refbonus']."(Right)"; 
											     else
												  echo $cnt1*$calcc['binary_refbonus'];
										    }
										?></td>
									</tr>
								</table>
									
								</div>
                        </div>
                    </div>
                    <br />
					<div id="note">
			<ul>
			<li><p><strong>PV &nbsp;&nbsp;:</strong>Personal Point Value</p></li>
			<li><p><strong>TPPV &nbsp;:</strong> Total Personal Point Value</p></li>
			<!--<li><p><strong>TSPV &nbsp;:</strong> Team Sunflower Point Value</p></li>
			<li><p><strong>TBPV &nbsp;:</strong> Total Binary Point Value </p></li>-->
			<li><p><strong>PWPV &nbsp;:</strong> Payout weaker point value</p></li>
			<li><p><strong>TPWPV :</strong> Total purchase weaker point value</p></li>
			<li><p><strong>TPSPV :</strong>  Total purchase stronger point value</p></li>
			</ul>
			</div>
                </div>
            </div>
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>