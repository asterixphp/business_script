<?php
include("config/error.php"); 

if(isset($_REQUEST['placement'])) {
	
	$q = $_GET['q'];
	$usr=addslashes($_REQUEST['ussr']);
	
	$checkplace=mysql_query("select user_id from mlm_register where user_profileid='$usr' AND user_status='0'");
	
	if(mysql_num_rows($checkplace)>0) {
		$sql=mysql_query("select user_id from mlm_register where user_placementid='$usr' and user_placement='$q'");
		$num=mysql_num_rows($sql);
		if($num=='0') {
			//echo "<span style='color:#006633;'>proceed !!!</span>";
			echo "0";
		} else {
			//echo "<span style='color:#FF0000;'>Already exists another person !!!</span>";
			echo "2";
		}
	} else {
		echo "5";
	}
	
}

if(isset($_REQUEST['sponsor'])) {
	$q = $_GET['q'];
	
	$sql=mysql_query("select user_fname from mlm_register where user_profileid='$q' and user_status='0'");
	
	if(mysql_num_rows($sql)>0) {
		$row=mysql_fetch_array($sql);
		echo ucfirst($row['user_fname']);
	} else {
		echo "0";
	}
}

?>
