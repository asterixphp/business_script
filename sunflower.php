<?php 
include("config/error.php");

include("includes/head.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}




?>
<style type="text/css">
	.numwraper {
		position: relative;
		width: 65px;
		height: 65px;
	}
	
	.numwraper img {
		width: 100%;
		height: 100%;
	}
	
	.numwraper span {
		position: absolute;
		right: 34%;
		top: 31%;
		font-family:Verdana, Arial, Helvetica, sans-serif;
		font-weight:bold;
		font-size: 12px;
		background-color: #FFF;
		padding: 0px 2px 0px 2px;
		display: block;
	}
</style>
<style type="text/css">
 a.tooltipp 
 {
 outline:none;
 opacity: 1;
  } 
 a.tooltipp strong 
 {
 line-height:30px;
 } 
 a.tooltipp:hover 
 {
 text-decoration:none;
 } 
 a.tooltipp span 
 {
  z-index:10;display:none; 
  padding:14px 20px;
   margin-top:-30px; 
   margin-left:10px; 
   width:300px;
    line-height:16px;
	 } 
	 a.tooltipp:hover span
	 { 
	 display:inline;
	  position:absolute; 
	 color:#111;
	  border:1px solid #DCA;
	   background:#fffAF0;} 
	   .callout {
	   z-index:20;
	   position:absolute;
	   top:30px;
	   border:0;
	   left:-12px;
	   } 
	   /*CSS3 extras*/
	    a.tooltipp span { 
		border-radius:4px;
		 -moz-border-radius: 4px;
		  -webkit-border-radius: 4px; 
		  -moz-box-shadow: 5px 5px 8px #CCC;
		   -webkit-box-shadow: 5px 5px 8px #CCC;
		    box-shadow: 5px 5px 8px #CCC;
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
							<div class="banner" style="padding-right: 0;">
							<?php  $ussserid=(isset($_REQUEST['ussserid']))? $_REQUEST['ussserid'] :$_SESSION['profileid']; ?>
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">SUNFLOWER STRUCTURE</h4>
								<table width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse; border:1px #FF6600 solid; ">
			
			<tr>
			<td align="center" valign="bottom" style=" border:1px #FF6600 solid;"><img src="images/no-blue.jpg" width="64" height="77" /><br />			 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="forgotlink tooltipp">
			<?php
			
	       $select=mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$ussserid'");
		$u_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$ussserid' "));
		if($u_num > 0)
		{
		while($fetch=mysql_fetch_array($select))
		{
					  
					  echo $fetch['user_fname'];
					  
					  ?>
					  <span style="font-size:12px;"><img class="callout" src="images/callout.gif" /> <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo $fetch['user_fname']; ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo $fetch['user_fname']; ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo $fetch['user_profileid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  	  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $fetch['user_sponsername']; ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Downline Count : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  </div>
					  </span>
					  
					  
					  </a>
					  <?php } }?>
					  	<span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 0</span></td>
                    </tr>
                    
                   
                    <tr>
                      <td align="center" style=" border:1px #FF6600 solid;">
					 
					 <table width="100%" border="0" cellspacing="1" cellpadding="0" style="border-collapse:collapse; ">
                     <tr>  
					 <?php 
	 function SunGetUserNamePosFromId($ussserid)
	{
		//echo "SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid'"; 
		$select_ussserid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid'");
		$ussserid_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid' "));
		if($ussserid_num > 0)
		{
		while($fetch_ussserid=mysql_fetch_array($select_ussserid))
		{ ?>
					    
                          <td width="30%" align="center" valign="top"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>L1</span></div><br />
               
						  <a href="sunflower.php?ussserid=<?php echo $fetch_ussserid['user_profileid'];?>" class="forgotlink tooltipp">
						  <?php
						 
                         echo $fetch_ussserid['user_fname'];
						   ?>
						    <span style="font-size:12px; margin-left:-330px; margin-top:20px;">
							 <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo $fetch_ussserid['user_fname']; ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo $fetch_ussserid['user_fname']; ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo $fetch_ussserid['user_profileid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  	  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $fetch_ussserid['user_sponsername']; ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Downline Count : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  </div>
					  </span>
						   
						  </a>	
						 
						 
						  </td>
                          
                       <?php }} }  sunGetUserNamePosFromId($ussserid); ?> 
					   
					   </tr>
                      </table> 
					  
				
					  <span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 1</span>
					  
					  </td>
                    </tr>
                    
                    <tr>
                      <td align="center" style=" border:1px #FF6600 solid;">
					  
					  <table width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tr>
						 <?php 
	
		$select_user1id=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid' ");
		$user1id_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid'"));
		if($user1id_num > 0)
		{
		while($fetch_user1id=mysql_fetch_array($select_user1id))
		{
		$select_ussseridd=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$fetch_user1id[user_profileid]'");
$ussserid_numm=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$fetch_user1id[user_profileid]'"));
		if($ussserid_numm > 0)
		{
		while($fetch_ussseridd=mysql_fetch_array($select_ussseridd))
		{ ?>
                          <td width="25%" align="center" valign="top"><div class="numwraper"><img src="images/full_blue.jpg" width="64" height="77" /><span>L2</span></div><br />
              
							   
							  <a href="sunflower.php?ussserid=<?php echo $fetch_ussseridd['user_profileid'];?>" class="forgotlink tooltipp">
							  <?php
							   echo $fetch_ussseridd['user_fname'];
							  
							  ?>
							   <span style="font-size:12px; margin-left:-330px; margin-top:20px;">
							 <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo $fetch_ussseridd['user_fname']; ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo $fetch_ussseridd['user_fname']; ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo $fetch_ussseridd['user_profileid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  	  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $fetch_ussseridd['user_sponsername']; ?>  </b></div>
					  <div style="float:left; width:150px;" align="left"> Downline Count : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>
					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  </div>
					  </span>	
							   </a>	
					
							  </td>
                             <?php } } } }?>
                            </tr>
                       
                      </table><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 2</span></td>
					    
                    </tr> 
                   
                    <tr>
                      <td align="center" style=" border:1px #FF6600 solid;">
					  
					  <table width="100%" border="0" cellspacing="1" cellpadding="0">
                        <tr>
						  <?php 
	
		$select_user1=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid' ");
		$ussserid_num1=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$ussserid'"));
		if($ussserid_num1 > 0)
		{
		while($fetch_user1=mysql_fetch_array($select_user1))
		{
		$select_user2=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$fetch_user1[user_profileid]'");
        $ussserid_num2=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$fetch_user1[user_profileid]'"));
		if($ussserid_num2 > 0)
		{
		
		while($fetch_user2=mysql_fetch_array($select_user2))
		{ 
		$select_user3=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$fetch_user2[user_profileid]'");
        $ussserid_num3=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$fetch_user2[user_profileid]'"));
		
		if($ussserid_num3 > 0)
		{
		while($fetch_user3=mysql_fetch_array($select_user3))
		{ 
		?>
                          <td width="25%" align="center" valign="top"><div class="numwraper"><img src="images/full_orange.jpg" width="64" height="77" /><span>L3</span></div>
                          <br />
              
							   
							  <a href="sunflower.php?ussserid=<?php echo $fetch_user3['user_profileid'];?>" class="forgotlink tooltipp">
							  <?php
							   echo $fetch_user3['user_fname'];
							  
							  ?>
							   <span style="font-size:12px; margin-left:-330px; margin-top:20px;">
							 <div style="width:300px;">
					  <div style="font-weight:bold; border-bottom:1px #CCCCCC solid;" align="left"><?php echo $fetch_user3['user_fname']; ?> Details</div>
					  <div style="padding-top:5px;">
					  <div style="float:left; width:150px;" align="left"> Name : <b><?php echo $fetch_user3['user_fname']; ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Profile Id : <b><?php echo $fetch_user3['user_profileid']; ?></b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  	  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsor Name : <b><?php echo $fetch_user3['user_sponsername']; ?> </b></div>
					  <div style="float:left; width:150px;" align="left"> Downline Count : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					   <div>

					  <div style="float:left; width:150px;" align="left"> Left Points : <b>0 </b></div>
					  <div style="float:left; width:150px;" align="left"> Right Points : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  <div>
					  <div style="float:left; width:150px;" align="left"> Sponsored Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Sponsered Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					    <div>
					  <div style="float:left; width:150px;" align="left"> Qualified Team1 : <b>0</b> </div>
					  <div style="float:left; width:150px;" align="left">  Qualified Team2 : <b>0</b></div>
					  <div style="clear:both;">&nbsp;</div>
					  </div>
					  
					  
					  </div>
					  </span>	
						    </a>	
					
						  </td>
                             <?php } } } }} }?>
                            </tr>
                       
                      </table><span style="color:#CC33FF; float:right; padding-right:10px; font-weight:bold;">level 3</span></td>
					    
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