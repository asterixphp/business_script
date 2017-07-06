<?php
include("config/error.php");

include("generalfunc.php");

/* =============== Registration step - 1 =================== */

if(isset($_REQUEST['registerone'])) {
	//echo "test";exit;
	$sponsorname=addslashes($_REQUEST['sponsorname']);
	$password=addslashes($_REQUEST['password']);
	$passwordagain=addslashes($_REQUEST['passwordagain']);
	$placementid=addslashes($_REQUEST['placementid']);
	$sponsorid=addslashes($_REQUEST['sponsorid']);
	$placementposition=addslashes($_REQUEST['placementposition']);
	$pancardnum=addslashes($_REQUEST['pancardnum']);
	$product=addslashes($_REQUEST['product']);
	$ptvalue=addslashes($_REQUEST['ptval']);
	$profileid=generateid();
	
	if($_SESSION['security_code']!=$_REQUEST['security_code'] && !empty($_SESSION['security_code'] ) ) {
	header("Location:register.php?capterr");
	exit;
	}
	
	
	$ip=$_SERVER['REMOTE_ADDR'];
	
	$insert=mysql_query("INSERT INTO mlm_register (user_profileid, user_password, user_sponsername,user_sponserid, user_placementid, user_placement, user_pancard, user_date, user_ip, user_status) VALUES ('$profileid', '$password', '$sponsorname', '$sponsorid', '$placementid', '$placementposition', '$pancardnum', NOW(), '$ip', '0')");
	
	$id=mysql_insert_id();
	
	if(isset($_SESSION['eepinn'])){
	$eepinn=addslashes($_SESSION['eepinn']);
	
	$updpin=mysql_query("UPDATE mlm_epin SET status='1', date=CURDATE(), used_by='$profileid' WHERE epin='$eepinn' AND status !='1'");
	$purchasestatus = product_purchase($product, $profileid, $eepinn,$ptvalue);
	unset($_SESSION['eepinn']);
	$_SESSION['purchasestat'] = $purchasestatus;
	}
	
	
	
	if(($placementid!="") && ($placementid!=0))
	{
	regcount($id,$profileid,$sponsorid,$placementid,$placementposition);
	}
	
	if($insert) {
		header("Location:register_two.php?id=$profileid");
		echo '<script language="javascript"> window.location="register_two.php?id='.$profileid.'"; </script>';exit;
	} else {
		die("Registration error please contact admin : <br>".mysql_error());exit;
	}
	
	
	
}

/* =============== Registration step - 2 =================== */

if(isset($_REQUEST['registertwo'])) {
	//echo "test";
	$firstname=addslashes($_REQUEST['firstname']);
	$secondname=addslashes($_REQUEST['secondname']);
	$lastname=addslashes($_REQUEST['lastname']);
	$dobdate=addslashes($_REQUEST['dobdate']);
	$dobmonth=addslashes($_REQUEST['dobmonth']);
	$dobyear=addslashes($_REQUEST['dobyear']);
	
	$addressline1=addslashes($_REQUEST['addressline1']);
	$addressline2=addslashes($_REQUEST['addressarea']);
	$addresscity=addslashes($_REQUEST['addresscity']);
	$addressstate=addslashes($_REQUEST['addressstate']);
	$addresspostal=addslashes($_REQUEST['addresspostal']);
	$addresscountry=addslashes($_REQUEST['addresscountry']);
	
	
	$padddress1=addslashes($_REQUEST['padddress1']);
	$padddress2=addslashes($_REQUEST['padddress2']);
	$cpcity=addslashes($_REQUEST['cpcity']);
	$cpstate=addslashes($_REQUEST['cpstate']);
	$pzipcode=addslashes($_REQUEST['pzipcode']);
	$cpcountry=addslashes($_REQUEST['cpcountry']);
	
	
	$phonenum=addslashes($_REQUEST['phonenum']);
	$emailaddress=addslashes($_REQUEST['emailaddress']);
	
	
	$bankaccname=addslashes($_REQUEST['bankaccname']);
	$accnum=addslashes($_REQUEST['accnum']);
	$bankname=addslashes($_REQUEST['bankname']);
	$branchname=addslashes($_REQUEST['branchname']);
	$ifsc=addslashes($_REQUEST['ifsc']);
	$dob=$dobyear."-".$dobmonth."-".$dobdate;
	$profileid=addslashes($_REQUEST['profileid']);
	
	$userid_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$profileid' AND user_email='$emailaddress'"));
	if($userid_num > 0)
	{
		echo '<script language="javascript"> window.location="register_two.php?id='.$profileid.'&exists"; </script>';exit;
	}
	/* parent segment ids*/
	$GetSponser=mysql_fetch_array(mysql_query("select user_sponserid from mlm_register where user_profileid='$profileid'"));
	$user_sponserid = $GetSponser['user_sponserid'];
	$GetSeg=mysql_fetch_array(mysql_query("select user_id,parent_segment from mlm_register where user_profileid='$user_sponserid'"));
	$segment = $GetSeg['parent_segment'];
	$refrid = $GetSeg['user_id'];
	if($segment !=""){$segment = $segment.",".$refrid;}else{$segment = $refrid;}
	/* end of segment */						
	
	//echo $firstname." - ".$secondname." - ".$lastname." - ".$dobdate." - ".$dobmonth." - ".$dobyear." - ".$addressline1." - ".$addressarea." - ".$addresscity." - ".$addressstate." - ".$addresspostal." - ".$addresscountry." - ".$phonenum." - ".$emailaddress." - ".$bankaccname." - ".$accnum." - ".$bankname." - ".$branchname." - ".$ifsc." - ".$profileid;exit;
	
	$update=mysql_query("UPDATE mlm_register SET user_fname='$firstname', user_lname='$lastname', user_secondname='$secondname', user_dob='$dob', user_commaddr1='$addressline1', user_commaddr2='$addressline2', user_city='$addresscity', user_state='$addressstate', user_country='$addresscountry', user_postalcode='$addresspostal', user_phone='$phonenum', user_email='$emailaddress', user_accholdername='$bankaccname', user_accno='$accnum', user_bankname='$bankname', user_branch='$branchname', user_ifsccode='$ifsc',user_paddr1='$padddress1',user_paddr2='$padddress2',user_pcity='$cpcity',user_pstate='$cpstate',user_pcountry='$cpcountry',user_ppostalcode='$pzipcode',parent_segment='$segment' WHERE user_profileid='$profileid'");
	
	if($update) {
		header("Location:register_three.php?id=$profileid");
		echo '<script language="javascript"> window.location="register_three.php?id='.$profileid.'"; </script>';exit;
	} else {
		die("Registration error your id is $profileid tell administrator about this : <br>".mysql_error());
	}
	
}

/* =============== Registration step - 3 =================== */

if(isset($_REQUEST['registrationthree'])) {
	//echo "test three";exit;
	$nomname=addslashes($_REQUEST['nomname']);
	$idcardtype=addslashes($_REQUEST['idcardtype']);
	$idcardtypename=(isset($_REQUEST['idcardtypename']))? $_REQUEST['idcardtypename'] : '';
	$idcardnum=addslashes($_REQUEST['idcardnum']);
	$nomaddress=addslashes($_REQUEST['nomaddress']);
	$nomarea=addslashes($_REQUEST['nomarea']);
	$nomcity=addslashes($_REQUEST['nomcity']);
	$nomstate=addslashes($_REQUEST['nomstate']);
	$nompostal=addslashes($_REQUEST['nompostal']);
	$nomcountry=addslashes($_REQUEST['nomcountry']);
	$nomphone=addslashes($_REQUEST['nomphone']);
	$nomemail=addslashes($_REQUEST['nomemail']);
	$profileid=addslashes($_REQUEST['profileid']);
	
	if($idcardtype!='others') {
		$idcardtypename=$idcardtype;
	}
	
	//echo $nomname." - ".$idcardtype." - ".$idcardtypename." - ".$idcardnum." - ".$nomaddress." - ".$nomarea." - ".$nomcity." - ".$nomstate." - ".$nompostal." - ".$nomcountry." - ".$nomphone." - ".$nomemail." - ".$profileid;exit;
	
	$update=mysql_query("UPDATE mlm_register SET user_nomineename='$nomname', user_identifycardtype='$idcardtypename', user_idnumber='$idcardnum', user_naddr1='$nomaddress', user_naddr2='$nomarea', user_ncity='$nomcity', user_nstate='$nomstate', user_ncountry='$nomcountry', user_npostalcode='$nompostal', user_nphone='$nomphone', user_nemail='$nomemail',user_status='0', user_registered='1'  WHERE user_profileid='$profileid'");
	
	$sel=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$profileid'"));
	
	$prooofid=$sel['user_profileid'];
	$userremail=$sel['user_email'];
	$pasdsdf=$sel['user_password'];
	
		$subject="Login details from ".$website_name;
	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Login details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Username : $prooofid (or) $userremail </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Password : $pasdsdf</td>
						</tr>
					
					
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From:'.$website_name.'<'.$website_admin.'>' . "\r\n";

$to=$userremail;


//echo $to."<br>".$msg."<br>".$subject."<br>".$headers; exit;

mail($to,$subject,$msg,$headers);
	
	//if($_SESSION['purchasestat'] !='1') {
	//	echo $_SESSION['purchasestat'];
		
	//} else {
		header("Location:login.php?succ");
		echo '<script language="javascript"> window.location="login.php?succ"; </script>';exit;
//	}
	
}

/* =============== Registration step - 4 =================== */

/*if(isset($_REQUEST['registrationfour'])) {
	//echo "test four"; exit;
	
	
	$update=mysql_query("UPDATE mlm_register SET user_status='0' WHERE user_profileid='$profileid'");
	
	//$statususr=mysql_query("INSERT INTO mlm_user_status (usr_user) VALUES ('$profileid')");
	
	
}*/



?>