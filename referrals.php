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
			
			<hr />
			
			<div class="row">
                <?php include("includes/profilemenu.php"); ?>
                <div class="span9">
                    <div class="row">
                        <div class="span9">
							<div class="banner" style="padding-right: 0;">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">Referrals</h4>
                                <table cellpadding="7" cellspacing="0" border="0" width="100%">
<tr><th>First Name</th><th>Last Name</th></tr>
<?php

$reffe = $userdetail['user_email'];
$userrefs=mysql_query("select user_fname,user_lname from mlm_register WHERE user_refname='$reffe'");
while($rowref=mysql_fetch_array($userrefs))
{
echo "<tr><td>" . $rowref['user_fname'] . "</td><td>" . $rowref['lname'] . "</td></tr>";
}
?>

									
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