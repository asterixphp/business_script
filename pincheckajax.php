<?php
include("config/error.php"); 
if(isset($_REQUEST['pin'])) {
	$epin=addslashes($_REQUEST['pin']);
	$epindata=mysql_fetch_array(mysql_query("SELECT * FROM mlm_epin WHERE epin='$epin' and (status='2' OR status='0')"));
	
	$subcatdet=getsubcategorydetailbyId($epindata['prodsubcategory']);
	$catid=$subcatdet['category_id'];
	$catdet=getcategorydetailbyId($catid);
	$productid=$subcatdet['product_id'];
	$proddet=getproductdetailbyId($productid);
	$catename=$subcatdet['subcategory_name'];
	if($epindata!=""){
	echo $epindata['productcost']."/-"."-=-".$subcatdet['minunit']."-=-".$catename."-=-".$proddet['pro_name']."-=-".$catdet['pv']."-=-".$productid;
	$_SESSION['eepinn']=$epin;
	$_SESSION['cateid']=$catid;
	}
	else{
	echo "nodata0123e";
	}
}
?>