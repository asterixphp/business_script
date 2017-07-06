<?php 
include("config/error.php");

if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

if(isset($_REQUEST['psubmit']))
{

$package=addslashes($_REQUEST['package']);

$plan=mysql_fetch_array(mysql_query("select * from mlm_membership where id='$package'"));
$exp=$plan['days'];
$expiredate=date("Y-m-d",strtotime("+$plan[days] days"));

$qry=mysql_query("update mlm_register set mem_package='$package' where user_id='$_SESSION[userid]'");

$chk=mysql_num_rows(mysql_query("select * from mlm_membershipusers where membership='$package' and userid='$_SESSION[userid]'"));

if($chk==0)
{
	$qry1=mysql_query("insert into mlm_membershipusers set membership='$package',userid='$_SESSION[userid]',mem_date=NOW(),exp_date='$expiredate'");
}
else
{
	$qry1=mysql_query("update mlm_membershipusers set membership='$package',userid='$_SESSION[userid]',mem_date=NOW(),status='0',exp_date='$expiredate'");
}


if($qry && $qry1)
{
header("location:memberpackage.php?succ");
echo "<script>window.location='memberpackage.php?succ';</script>";
}
else
{
header("location:memberpackage.php?fail");
echo "<script>window.location='memberpackage.php?fail';</script>";
}

}


include("includes/head.php");

?>

<script>
function detajax(str)
{
//alert(str);

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	//alert(xmlhttp.responseText);
    document.getElementById("resp").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","packajax.php?q="+str,true);
xmlhttp.send();
}
</script>
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
							<div class="banner" style="padding-right: 0;">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Member Package</h4>
								
						<?php	 
						$per=mysql_query("select * from mlm_membershipusers where userid='$_SESSION[userid]'"); 
						
						$perfetch=mysql_fetch_array($per);
						$pernum=mysql_num_rows($per);
					
						if($pernum==0)		
						{											
								?>	
							<form action="" method="post" onClick="return changepass();">
                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
									<?php if(isset($_REQUEST['succ'])) { ?>
									<tr>
									<td colspan="3" align="center" style="color:#006633; font-weight:bold;">
									Package Upgraded Successfully !!!
									</td>
									
									</tr>
									<?php } ?>
									<tr>
										<td width="40%" align="right">
											<strong>Choose package</strong>
										</td>
										<td width="7" align="center">:</td>
										<td width="50%">
										<?php $sql=mysql_query("select * from mlm_membership order by id ASC"); ?>
											<select name="package" onchange="return detajax(this.value);">
											<option value="">select</option>
											<?php 
											while($rowfetch=mysql_fetch_array($sql))
											{
												?>
												<option value="<?php echo $rowfetch['id']; ?>"><?php echo $rowfetch['membership_name']; ?></option>
												<?php
												
											}?>
											</select>
										</td>
									</tr>
									<tr>
									<td colspan="4">
									<div id="resp"></div>
									</td>
									</tr>
									
									
									<tr>
										<td colspan="3" align="center">
											<input type="submit" name="psubmit" class="greenbtn" value="Submit"/>
										</td>
									</tr>
								</table>
								</form>
								<?php
								}	
								else if($pernum1==0)	
								{
									$perm=mysql_fetch_array(mysql_query("select * from mlm_membership where id='$perfetch[membership]'")); 
									
									?>
									<table cellpadding="7" cellspacing="0" border="0" width="100%">
									
									<tr>
									<td colspan="3" align="center" style="font-weight:bold;">
									<h3>Your subscribed Package: <?php echo $perm['membership_name']; ?> </h3>
									<?php
									if($perfetch['status']==0)
									{
										?>
										<br><span style="color:green;"> (Request in Progress) </span>
										<?php
									}
									else 
									{
										?>
										<br><span style="color:green;"> (Approved) </span>
										<?php
									}
									?>
									</td>
									
									</tr>
									</table>
									
									<?php
								}
								?>
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