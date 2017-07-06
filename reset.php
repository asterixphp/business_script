<?php
//update `mlm_register` set `user_ratio`=0
include("config/error.php"); 


$res2=mysql_query("UPDATE mlm_register SET `user_ratio`=0");
$res3=mysql_query("TRUNCATE TABLE `mlm_pairmatch`");
$res4=mysql_query("TRUNCATE TABLE `mlm_tempmatch`");

if($res2 && $res3 && $res4){
echo "Reset Success..";
}
		
?>
