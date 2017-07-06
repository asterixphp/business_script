<?php
$binaryplanqry=mysql_query("SELECT binary_calcday, binary_calcstatus FROM mlm_binaryplan WHERE binary_id='1'")or die(mysql_error());
$binaryplan=mysql_fetch_array($binaryplanqry);

$daytocalculate=date("l");
$monthend=date("t");
$todate=date("d");

if($binaryplan['binary_calcday']==$daytocalculate) {
	
	if($binaryplan['binary_calcstatus']==0) {
		
		assign_purchase_cv(); 
		
		direct_referal(); //exit;
		
		weekly_calculation(); //exit;
		
		$updatebinaryplan=mysql_query("UPDATE mlm_binaryplan SET binary_calcstatus=1, binary_calc=NOW() WHERE binary_id=1");
	}
	
} else {
	if($binaryplan['binary_calcstatus']==1) {
		$updatebinaryplan=mysql_query("UPDATE mlm_binaryplan SET binary_calcstatus=0 WHERE binary_id=1");
		//echo "Updated another day";
	}
}

$sunplanqry=mysql_query("SELECT * FROM mlm_sunplan WHERE sun_id='1'")or die(mysql_error());
$sunplan=mysql_fetch_array($sunplanqry);

if($sunplan['sun_calcdate']=='end') {
	$calcday=$monthend;
} elseif($sunplan['sun_calcdate']=='') {
	$calcday=1;
} else {
	$calcday=$sunplan['sun_calcdate'];
}

$currday=date("d");
$currmnth=date("m");
$dbstatusdate=number_format(date("m",strtotime($sunplan['sun_modify_date'])));

if($calcday==$currday && $currmnth==$dbstatusdate) {
	if($sunplan['sun_calcstatus']==0) {
		
		multilevel();
		
		//echo $calcday." = ".$currday." - ".$currmnth." = ".$dbstatusdate." - ".$sunplan['sun_calcstatus']; exit;
		
		repurchasecalc();
		
		$updatebinaryplan=mysql_query("UPDATE mlm_sunplan SET sun_calcstatus=1, sun_modify_date=NOW() WHERE sun_id=1");
		
	}
} else {
	if($binaryplan['binary_calcstatus']==1) {
		$updatebinaryplan=mysql_query("UPDATE mlm_sunplan SET sun_calcstatus=0 WHERE sun_id=1");
	}
}

?> 