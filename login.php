<?php
include("config/error.php");

if((isset($_SESSION['profileid'])) && (isset($_SESSION['userid'])))
{
	header("location:dashboard.php");
	echo "<script>window.location='dashboard.php'</script>";
}

if(isset($_REQUEST['activate']))
{
$act=addslashes($_REQUEST['activate']);

$upd=mysql_query("update mlm_register set user_status='0' where user_profileid='$act'");

if($upd)
{
header("location:login.php?verify");
echo "<script>window.location='login.php?verify';</script>";

}

}


if((isset($_REQUEST['login'])) || (isset($_REQUEST['dlogin'])))
{

    if(isset($_REQUEST['dlogin']))
	{
   $profileid=addslashes($_REQUEST['username']);
   $password=addslashes($_REQUEST['password']);
    }
	else
	{
	$profileid=addslashes($_REQUEST['profileid']);
	$password=addslashes($_REQUEST['password']);
	}
	
	
	$lsql="select * from mlm_register where (user_profileid='$profileid' or user_email='$profileid') and (user_password='$password' and user_status='0')";
	
	$vea=mysql_num_rows(mysql_query("select * from mlm_register where (user_profileid='$profileid' or user_email='$profileid') and (user_password='$password' and user_status='1')"));
	
	//echo $vea; exit;
	
	if($vea=='1')
	{
	header("location:login.php?errver");
	echo "<script>window.location='login.php?errver'</script>";exit;
	}

	$lcount=mysql_num_rows(mysql_query($lsql));
	if($lcount=='1')
	{
		$lfetch=mysql_fetch_array(mysql_query($lsql));
		$_SESSION['profileid']=$lfetch['user_profileid'];
		$_SESSION['userid']=$lfetch['user_id'];
		$_SESSION['user_fname']=$lfetch['user_fname'];
		
		if(isset($_SESSION['choosedproid']) && $_SESSION['choosedproid']!='') {
			header("location:product_buy.php?pid=$_SESSION[choosedproid]&loginsucc");
			echo "<script>window.location='product_buy.php?pid=$_SESSION[choosedproid]&loginsucc'</script>";exit;
		} else {
			header("location:dashboard.php?succ");
			echo "<script>window.location='dashboard.php?succ'</script>";exit;
		}
	}
	else
	{
		header("location:login.php?err");
		echo "<script>window.location='login.php?err'</script>";exit;
	}
}

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
					<?php 
			if(isset($_REQUEST['succ']))
			{ ?>
				<div style="color:#00B04E; text-align:center; padding:10px;">Congratulations !! for becoming member with <strong>fixpluz.org</strong>.<br/> Please Login with your Email ID/User ID and Password.</div>
			<?php }
			
			?>
			<span style="padding-left:300px;">
			<?php 
			if(isset($_REQUEST['err']))
			{ ?>
				<span style="color:#FF0000;">Account Doesn't Exists, Please enter valid username and password.</span>
			<?php }
			
			?>
				<?php 
			if(isset($_REQUEST['verify']))
			{ ?>
				<span style="color:#006600;">Your Account is activated successfully, please login now.</span>
			<?php }
			
			?>
				<?php 
			if(isset($_REQUEST['errver']))
			{ ?>
				<span style="color:#FF0000;">Please activate your account, and then login.</span>
			<?php }
			
			?>
			
			
			</span>
			<br>
			<div class="logform">
				<div class="span5" style="width:280px;">
					<h2 class="widget-title"><span>Login Your Account</span></h2>
					<div class="sidebar-line"><span></span></div>
					<p>If you need any help please contact us via <a href="contact.php">ticket system</a> in your dashboard.</p>
					
					<form class="signin-form" action="" method="post">
						<input class="input-block-level" type="text" placeholder="Enter your E-mail / Profile id" name="profileid" id="inputEmail" required/>
						<input class="input-block-level" placeholder="Enter your password" type="password" name="password" id="inputPassword" required/>
						<input type="submit" class="btn btn-primary" name="login" id="login" value="Sign in your account" />
					</form>
					<label for="inputPassword">
						<a href="forgot.php">Forgot Password ?</a>
					</label>
					<a href="register.php" rel="register" class="linkform">You don't have an account? Register here</a>
					
					
				</div>
			</div>
			<div class="row">&nbsp;</div>
			<br />
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>