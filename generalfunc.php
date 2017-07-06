<?php
function product_purchase($proid,$user,$eepinn,$ptvalue) {
	//echo $proid." -- ".$user;
	$product=$proid;
	$profileid=$user;
	$user_profileid=$profileid;
	$currip=$_SERVER['REMOTE_ADDR'];
	$amount=gettotalamtbyepin($eepinn);
	
	$usertable=mysql_fetch_array(mysql_query("SELECT * FROM mlm_register WHERE user_profileid='$profileid'"));
	$productdata=mysql_fetch_array(mysql_query("SELECT * FROM mlm_products WHERE pro_id='$product'"));
	$catid=$_SESSION['cateid'];
	
	
	//echo "INSERT INTO mlm_purchase (pay_user, pay_userid, randomkey, pay_category, pay_email, pay_phone, pay_product, pay_amount, pay_pv, pay_type, pay_date, pay_ip, pay_payment) VALUES ('$usertable[user_id]', '$profileid', '$eepinn', $catid, '$usertable[user_email]', '$usertable[user_phone]', '$productdata[pro_id]', '$amount', '$ptvalue', 'Free', NOW(), '$currip', '1')"; exit;
	
	
	
	$insert=mysql_query("INSERT INTO mlm_purchase (pay_user, pay_userid, randomkey, pay_category, pay_email, pay_phone, pay_product, pay_amount, pay_pv, pay_type, pay_date, pay_ip, pay_payment) VALUES ('$usertable[user_id]', '$profileid', '$eepinn','$catid', '$usertable[user_email]', '$usertable[user_phone]', '$productdata[pro_id]', '$productdata[pro_cost]', '$productdata[pro_pv]', 'Paypal', NOW(), '$currip', '1')");
	
	$stockupdate=mysql_query("UPDATE mlm_products SET pro_stock=pro_stock-1 WHERE pro_id='$productdata[pro_id]'");
	
	
	
	if($insert){
	return 1;
	}
	else{
	return 0;
	}
}



?>