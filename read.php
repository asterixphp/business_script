<?php 
include("config/error.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:login.php");

echo "<script>window.location='login.php'</script>";

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
                <?php include("includes/mailmenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">READ MAIL</h4>
								<table cellpadding="0" cellspacing="0" border="1" bordercolor="#CCCCCC" width="100%" class="profiletable">
									<tr>
										<td width="6%">
											<strong>SNO</strong>										</td>
										<td width="15%" style="text-align:left;">
											<strong>Receiver Name</strong>										</td>
										<td width="14%">
											<strong>Profileid</strong>										</td>
										<td width="40%">
											<strong>Subject</strong>										</td>
										<td width="10%">
											<strong>DATE</strong>										</td>
										<td width="15%">
											<strong>ACTION</strong>
										</td>
									</tr>
									
									<?php
										$page = (int) (!isset($_GET["page"]) ? 1 : $_GET["page"]);
    	$limit = 10;
    	$startpoint = ($page * $limit) - $limit;
		$url='?';
									
								/*$inb=mysql_query("select * from mlm_outbox where (outbox_userid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_readstatus='1') LIMIT {$startpoint} , {$limit}");
									$nom_rows=mysql_num_rows(mysql_query("select * from mlm_outbox where (outbox_userid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_readstatus='1')"));*/
									$inb=mysql_query("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_readstatus='1') LIMIT {$startpoint} , {$limit}");
									$nom_rows=mysql_num_rows(mysql_query("select * from mlm_outbox where (outbox_toupid ='$_SESSION[userid]' and outbox_status='0') and (outbox_usertype!='0' and outbox_readstatus='1')"));
									
									if($nom_rows=='0')
									{ ?>
										<tr>
										<td style="color:#FF0000;" colspan="6" align="center"> No Records Found</td>
										</tr>
									
									<? }
									$i=1;
									$cinb=mysql_num_rows($inb);
									while($rinb=mysql_fetch_array($inb)) 
									{
										
									if($rinb['outbox_usertype']!="1")	
									{	
									
									$useinb=mysql_fetch_array(mysql_query("select * from mlm_register where user_id='$rinb[outbox_toupid]'"));
									$useroutname=$useinb['user_fname'];
									}
									else
									{
										$useroutname="Administrator";
									}
									?>
									
									<tr>
										<td>
											<?php echo $i; ?>
										</td>
										<td style="text-align:left;">
											<?php echo $useroutname;?>
										</td>
										<td>
											<?php echo $rinb['outbox_toprofileid'];?>
										</td>
										<td>
											<?php echo $rinb['outbox_subject'];?>
										</td>
											
										<td>
											<?php echo date("d-m-Y h:i:s",strtotime($rinb['outbox_date']));?>
										</td>
										<td>
											<a href="mailview.php?msgview=<?php echo $rinb['outbox_id']; ?>">VIEW</a>
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