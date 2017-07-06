<?php
session_start();
error_reporting(0);
date_default_timezone_set("Asia/Kolkata");
	$db_host="localhost";
	$db_username="phpscrip_seabay";
	$db_pwd="inet123!@#";
	$db_name="phpscrip_seabayion";
	
	

	$conn=mysql_connect($db_host,$db_username,$db_pwd);
	
	$db =mysql_select_db($db_name,$conn);
		
	
	
	//include "db_configue.php";
	
$gsetting=mysql_query("select * from mlm_generalsetting where gen_id='1'");

$generalfetch=mysql_fetch_array($gsetting);
$website_title =$generalfetch['gen_title'];
$website_name =$generalfetch['gen_sitename'];
$website_keywords =$generalfetch['gen_keywords'];
$website_desc=$generalfetch['gen_desc'];
$website_team=$generalfetch['gen_team'];
$website_admin =$generalfetch['gen_mail'];
$website_url =$generalfetch['gen_url'];
$paypal_id=$generalfetch['gen_paypal'];
$sitelogo=$generalfetch['gen_logo'];
$logourl = $website_url."/uploads/logo/".$sitelogo;


$gen_cvvalue=$generalfetch['gen_cvvalue'];
$gen_minwithdraw=$generalfetch['gen_minwithdraw'];
$gen_fundtransfer=$generalfetch['gen_fundtransfer'];
$gen_tax=$generalfetch['gen_tax'];
$gen_ceilcount=$generalfetch['gen_ceilcount'];

$gen_startvalue=$generalfetch['gen_startvalue'];
$gen_need_reach=$generalfetch['gen_need_reach'];
$gen_maintain=$generalfetch['gen_maintain'];


function getPageName() {
	return basename($_SERVER['PHP_SELF']);
}

function generateid() 
{
	$selectregcount=mysql_fetch_array(mysql_query("SELECT * FROM mlm_reg_count WHERE reg_id=1"));
	$renewdate=explode("-",$selectregcount['reg_date']);
	$currmonth=date("m");
	$currentyear=date("Y");
	if(($renewdate[0]<$currentyear) || ($renewdate[1]<$currmonth)) {
		$updateregcount=mysql_query("UPDATE mlm_reg_count SET reg_count=1, reg_date=NOW() WHERE reg_id=1");
		return $currentyear.$currmonth."1";
	} else {
		$currentcount=$selectregcount['reg_count']+1;
		$updateregcount=mysql_query("UPDATE mlm_reg_count SET reg_count=$currentcount WHERE reg_id=1");
		return "SBI".$renewdate[0].$renewdate[1].$selectregcount['reg_count'];
	}
}

function GetUserNameFromId($userid)
	{
		$select_userid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid'");
	$userid_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid'"));
	if($userid_num > 0)
	{
		$fetch_userid=mysql_fetch_array($select_userid);
		return $fetch_userid['user_fname'];
	}
	
	else
	{
		return "Empty";
	}
	}
	
	function GetUserNamePosFromId($userid,$pos)
	{
		
		$select_userid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_placementid`='$userid' and `user_placement`='$pos'");
		$userid_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_placementid`='$userid' and `user_placement`='$pos'"));
		if($userid_num > 0)
		{
		$fetch_userid=mysql_fetch_array($select_userid);
		return $fetch_userid['user_fname'];
		}
		else
		{
		return "Empty";
		}
	}
	
	function GetUserIDPosFromId($userid,$pos)
	{
		
		$select_userid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_placementid`='$userid' and `user_placement`='$pos'");
		$userid_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_placementid`='$userid' and `user_placement`='$pos'"));
		if($userid_num > 0)
		{
		$fetch_userid=mysql_fetch_array($select_userid);
		return $fetch_userid['user_profileid'];
		}
		else
		{
		return 0;
		}
		
	}





function SunGetUserNameFromId($userid)
	{
		$select_userid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid'");
	$userid_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid'"));
	if($userid_num > 0)
	{
		$fetch_userid=mysql_fetch_array($select_userid);
		return $fetch_userid['user_fname'];
	}
	
	else
	{
		return "Empty";
	}
	}
	
	function SunfGetUserNamePosFromId($userid)
	{
		//echo "SELECT * FROM `mlm_register` WHERE `user_sponserid`='$userid'"; 
		$select_userid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$userid'");
		$userid_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_sponserid`='$userid' "));
		if($userid_num > 0)
		{
		while($fetch_userid=mysql_fetch_array($select_userid))
		{
		echo $fetch_userid['user_fname'];
		}
		}
		else
		{
		return "Empty";
		}
	}
	
	function SunfGetUserIDPosFromId($userid)
	{
		//echo "SELECT * FROM `mlm_register` WHERE `user_sponserid`='$userid' ";
		$select_userid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid' ");
		$userid_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$userid'"));
		if($userid_num > 0)
		{
		while($fetch_userid=mysql_fetch_array($select_userid))
		{
		return $fetch_userid['user_sponserid'];
		}
		}
		else
		{
		return 0;
		}
		
	}
	
		function getcity($city)
	{
		$select_city=mysql_query("SELECT * FROM `mlm_city` WHERE `city_id`='$city' ");
		$city_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_city` WHERE `city_id`='$city'"));
		if($city_num > 0)
		{
		$fetch_city=mysql_fetch_array($select_city);
		{
		return $fetch_city['city_name'];
		}
		}
		else
		{
		return "Not Mentioned";
		}
	
	}

	function getstate($state)
	{
		$select_state=mysql_query("SELECT * FROM `mlm_state` WHERE `state_id`='$state' ");
		$state_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_state` WHERE `state_id`='$state'"));
		if($state_num > 0)
		{
		$fetch_state=mysql_fetch_array($select_state);
		{
		return $fetch_state['state_name'];
		}
		}
		else
		{
		return "Not Mentioned";
		}
	
	}

	
	function getcountry($country)
	{
		$select_country=mysql_query("SELECT * FROM `mlm_country` WHERE `country_id`='$country' ");
		$country_num=mysql_num_rows(mysql_query("SELECT * FROM `mlm_country` WHERE `country_id`='$country'"));
		if($country_num > 0)
		{
		$fetch_country=mysql_fetch_array($select_country);
		{
		return $fetch_country['country_name'];
		}
		}
		else
		{
		return "Not Mentioned";
		}
	
	}
	
	
	function regcount($uuserid,$profileid,$sponsorid,$placementid,$pos)
	{
	
	//echo $userid,$profileid,$sponsorid,$placementid,$pos;
	
	$sel_userid=mysql_query("SELECT * FROM `mlm_register` WHERE `user_profileid`='$placementid'");
	$fet_user=mysql_fetch_array($sel_userid);
	$coureg=mysql_query("select * from mlm_regcount where count_profileid='$placementid'");
	$coun=mysql_num_rows($coureg);
	
	if($coun == '0')
	{
	if($pos=="L")
	{
	//echo "insert into mlm_regcount set count_userid='$fet_user[user_id]',count_profileid='$placementid',count_userleft='1',count_leftuserids='$userid'"; exit;
	$ins=mysql_query("insert into mlm_regcount set count_userid='$fet_user[user_id]',count_profileid='$placementid',count_userleft='1',count_leftuserids='$userid'");
	}
elseif($pos=="R")
	{
	//echo "insert into mlm_regcount set count_userid='$fet_user[user_id]',count_profileid='$placementid',count_userright='1',count_rightuserids='$userid'"; exit;
	
	$ins=mysql_query("insert into mlm_regcount set count_userid='$fet_user[user_id]',count_profileid='$placementid',count_userright='1',count_rightuserids='$userid'");
	}
	else { }
	}
	else
	{
	
	$fcnt=mysql_fetch_array(mysql_query("select * from mlm_regcount where count_userid='$fet_user[user_id]'"));
	$cvalleft=$fcnt['count_userleft']+1;
	$cvalright=$fcnt['count_userright']+1;
	
    
	
if($pos=="L")
	{	
	if($fcnt['count_leftuserids']=="")
	{
	$implcv=$fet_user['user_id'];
	}
	else
	{
$implcv=$fcnt['count_leftuserids']."-".$fet_user['user_id'];
}
	$ins=mysql_query("update mlm_regcount set count_userid='$fet_user[user_id]',count_profileid='$placementid',count_userleft='$cvalleft',count_leftuserids='$implcv' where count_userid='$fet_user[user_id]' ");
	}
elseif($pos=="R")
	{
	if($fcnt['count_rightuserids']=="")
	{
	$imprcv=$fet_user['user_id'];
	}
	else
	{
	$imprcv=$fcnt['count_rightuserids']."-".$fet_user['user_id'];
	}
	$ins=mysql_query("update mlm_regcount set count_userid='$fet_user[user_id]',count_profileid='$placementid',count_userright='$cvalright',count_rightuserids='$imprcv' where count_userid='$fet_user[user_id]'");
	}
	else { }
	
	}
	
	if($placementid !=0)
	{
	regcount($fet_user['user_id'],$fet_user['user_profileid'],$fet_user['user_sponserid'],$fet_user['user_placementid'],$fet_user['user_placement']);
	}
	
	}
	
	function getsubcategorydetailbyId($catid){
	$subcat=mysql_fetch_array(mysql_query("select * from mlm_product_subcategory where subcategory_id='$catid'"));
	return $subcat;
	}
	
	function getcategorydetailbyId($catid){
	$cat=mysql_fetch_array(mysql_query("select * from mlm_product_category where category_id='$catid'"));
	return $cat;
	}
	
	
	function getproductdetailbyId($productid){
	$prods=mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$productid'"));
	return $prods;
	}
	
	function gettotalamtbyepin($eepinn){
	$epindet=mysql_fetch_array(mysql_query("select * from mlm_epin where epin='$eepinn'"));
	$subcatdet = getsubcategorydetailbyId($epindet['prodsubcategory']);
	$productid = $subcatdet['product_id'];
	$minunit = $subcatdet['minunit'];
	$proddet = getproductdetailbyId($productid);
	$prodcost = $proddet['pro_cost'];
	$totalcost = ($prodcost*$minunit);
	return $totalcost;
	}
	
	function gettotalearnings($user_profileid){
	$result=mysql_query("select commearned from  mlm_pairmatch where profileid='$user_profileid'");
	$sum=0;
	while($row=mysql_fetch_array($result)){
	$sum = $sum + $row['commearned'];
	
	}
	return $sum;
	}
	
	function gettotaldue($user_profileid){
	$result=mysql_query("select commearned from mlm_pairmatch where is_payed='0' AND profileid='$user_profileid'");
	$upsum=0;
	while($row=mysql_fetch_array($result)){
	$upsum = $upsum + $row['commearned'];
	}
	return $upsum;
	}
?>
