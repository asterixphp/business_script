<?php
//update `mlm_register` set `user_ratio`=0
include("config/error.php"); 
//$curdate = date('Y-m-d');
$curdate = date('Y-m-d',strtotime($_GET['cur_date']));
$prev_date = date('Y-m-d', strtotime("$curdate -1 day"));

$next_date = date('Y-m-d', strtotime("$curdate +1 day"));;


echo "Previous date: ".$prev_date."<br/>";
echo "current date: ".$curdate."<br/>";
echo "Next date: ".$next_date."<br/>";

$res2=mysql_query("UPDATE mlm_register SET `user_sponserid` = UPPER(`user_sponserid`)");
$res3=mysql_query("UPDATE mlm_register SET `user_placementid` = UPPER(`user_placementid`)");

function getbinarydet(){
$binarydet=mysql_fetch_array(mysql_query("select * from mlm_binaryplan where binary_id='1'"));
return $binarydet;
}

function mlm_tempmatch($usr_proid,$curdate){
$tmatch=mysql_fetch_array(mysql_query("select * from mlm_tempmatch where profileid='$usr_proid' and date='$curdate'"));
return $tmatch;
}

function getdetailpur($user_profileid,$curdate){
$total=mysql_num_rows(mysql_query("select * from mlm_pairmatch where profileid='$user_profileid' AND date='$curdate' AND strongside='YC'"));
return $total;
}

function tempcount($user_profileid,$curdate){
$total=mysql_num_rows(mysql_query("select * from mlm_tempmatch where profileid='$user_profileid' AND date='$curdate'"));
return $total;
}



function leftmem($user_profileid){
	$leftmem=mysql_fetch_array(mysql_query("select user_profileid from mlm_register where user_placementid='$user_profileid' AND user_placement='L'"));
	return $leftmem['user_profileid'];
}




function rightmem($user_profileid){
	$rightmem=mysql_fetch_array(mysql_query("select user_profileid from mlm_register where user_placementid='$user_profileid' AND user_placement='R'"));
	return $rightmem['user_profileid'];
}

function downline($user_profileid,$down=array()){
	$result=mysql_query("select * from mlm_register where user_placementid='$user_profileid'");
	while($downline=mysql_fetch_array($result)){
	array_push($down,$downline['user_profileid']);
	}
	foreach($down as $dwn){
	$searchdeep=downline($dwn);
	array_push($down,$searchdeep);
	}
	$down=array_flatten($down);
	return $down;
}

function array_flatten($array) { 
  if (!is_array($array)) { 
    return FALSE; 
  } 
  $result = array(); 
  foreach ($array as $key => $value) { 
    if (is_array($value)) { 
      $result = array_merge($result, array_flatten($value)); 
    } 
    else { 
      $result[$key] = $value; 
    } 
  } 
  return $result; 
}
function currentpvchk($profileid,$curdate){
$result=mysql_query("select * from mlm_pairmatch where profileid='$profileid' and date='$curdate'");
$currentpvchk=mysql_num_rows($result);
return $currentpvchk;
}



function gainedpvchk($usr_proid,$curdate){
$purchase=mysql_fetch_array(mysql_query("select * from mlm_purchase where pay_userid='$usr_proid' and pay_date='$curdate'"));
return $purchase;
}

function gainedpv($usr_proid){
$purchase=mysql_fetch_array(mysql_query("select * from mlm_purchase where pay_userid='$usr_proid'"));
return $purchase;
}
function todayleftpvchk($usr_proid,$curdate){
$todayleftpvchk=mysql_fetch_array(mysql_query("select lcount from mlm_pairmatch where profileid='$usr_proid' AND date='$curdate'"));
if(empty($todayleftpvchk['lcount'])){
return 0;
}
else{
return $todayleftpvchk['lcount'];
}
}

function todayrightpvchk($usr_proid,$curdate){
$todayrightpvchk=mysql_fetch_array(mysql_query("select rcount from mlm_pairmatch where profileid='$usr_proid' AND date='$curdate'"));
return $todayrightpvchk['rcount'];
}

function userratio($usr_proid){
$userratio=mysql_fetch_array(mysql_query("select user_ratio from  mlm_register where user_profileid='$usr_proid'"));
return $userratio['user_ratio'];
}


 
$res=mysql_query("SELECT * FROM `mlm_register`");
echo "<pre>";
		
		while($fetch_det=mysql_fetch_array($res)){
		$user_profileid=$fetch_det['user_profileid'];
		echo "<pre>";
		print_r($user_profileid);
		$leftmem=leftmem($user_profileid);
		$rightmem=rightmem($user_profileid);
			echo "<br/>";
		echo "Left: ";
		print_r($leftmem);
		echo "<br/>";
		echo "Right: ";
		print_r($rightmem);
		$lres = leftmem($leftmem);
		$rres = rightmem($rightmem);
		echo "<br/>Downline<br/>";
		$lres = downline($leftmem);
			$rres = downline($rightmem);
			array_unshift($lres,$leftmem);
			array_unshift($rres,$rightmem);
			$lc=0;
			if($lres !=''){
			
				foreach($lres as $l){
				$row=mysql_fetch_array(mysql_query("select user_sponserid from mlm_register where user_profileid='$l'"));
				$sponsid = $row['user_sponserid'];
					
					if($sponsid==$user_profileid){
					$lc++;
					}
				}
			}
			$rc=0;
			if($lres !=''){
			
				foreach($rres as $r){
				$row=mysql_fetch_array(mysql_query("select user_sponserid from mlm_register where user_profileid='$r'"));
				$sponsid = $row['user_sponserid'];
					
					if($sponsid==$user_profileid){
					$rc++;
					}
				}
			}
			$lrcount = $lc+$rc;
			
			if(($lc >= 1) OR ($rc >= 1)){
			
			echo "<br/><br/><br/><br/><br/><br/><b>Member: $user_profileid</b><br/>";
			
			echo "<br/>Members in Left<br/>";
			print_r($lres);
			echo "<br/><br/>Members in Right<br/>";
			print_r($rres);
			
			
			$lpv=todayleftpvchk($user_profileid,$curdate);
			$rpv=todayrightpvchk($user_profileid,$curdate);
			$gpvchk=gainedpv($user_profileid);
			$catid = $gpvchk['pay_category'];
			$catdet=getcategorydetailbyId($catid);
			$capp = $catdet['capp'];
			if(isset($lres)){
					$i=1;
					foreach($lres as $lt){
					//print_r($lres);
					$gainedpvlft=gainedpvchk($lt,$curdate);
					$lpv=$lpv+$gainedpvlft['pay_pv'];
					}
					
					foreach($rres as $rt){
					//print_r($lres);
					$gainedpvlft=gainedpvchk($rt,$curdate);
					$rpv=$rpv+$gainedpvlft['pay_pv'];
					}
					
					if($lpv>=$rpv){
					$strside="left";
					$pmatch=$rpv;
					}
					else if($rpv>=$lpv){
					$strside="right";
					$pmatch=$lpv;
					}
					$countstr=0;
					echo "<br/>maries cap".$capp;
					if($capp<=$pmatch){
					$pmatch=$capp;
					}
					else if($capp>=$pmatch){
					$pmatch=$pmatch;
					}
					$countstr=$capp-$pmatch;
				
				if($strside=="left" && $capp<=$pmatch){
				$lcfwd=$countstr;
				
				}
				else if($strside=="right" && $capp<=$pmatch){
				$rcfwd=$countstr;
				
				}
				$cpv=currentpvchk($user_profileid,$curdate);
				
				
				
				if($strside=="left" && $capp<=$lpv){
				$countstr=$lpv-$pmatch;
				$rcfwd=0;
				}
				else if($strside=="right" && $capp<=$rpv){
				$countstr=$rpv-$pmatch;
				$lcfwd=0;
				}
				else if($strside=="left" && $capp>=$lpv){
				$countstr=$lpv-$pmatch;
				
				}
				else if($strside=="right" && $capp>=$rpv){
				$countstr=$rpv-$pmatch;
				}
			}
			}
			
			
			echo "<br/>Total Left Pv:".$lpv;
			echo "<br/>Total Right Pv:".$rpv;
			echo "<br/>Strong Side: ".$strside;
			echo "<br/>Capping: ".$capp."<br/>";
			echo "<br/>Pair Match: ".$pmatch."<br/>";
			$getbindet=getbinarydet();
			$bincommperpv = $getbindet['binary_refbonus'];
			
			$commearned = ($pmatch*$bincommperpv);
			$cpv=currentpvchk($user_profileid,$curdate);
			$isratio=userratio($user_profileid);
			$totalfirst=$lpv+$rpv;
			$firstpayflag=0;
			if(($isratio !=1) && ($totalfirst >= 3) && $lrcount >= 2){
			$firstpayflag=1;
			}
		$pchase = getdetailpur($user_profileid,$next_date);	
	if($firstpayflag==1){
	$updateratio = mysql_query("update  mlm_register set user_ratio='1' where user_profileid='$user_profileid'");
		$q1 ="INSERT INTO mlm_pairmatch (profileid, lcount, rcount, pmatched, strongside, countstrong, commearned, is_payed, date) VALUES ('$user_profileid', '$lpv', '$rpv', '$pmatch', '$strside', $countstr, '$commearned', '0', '$curdate')";
		$insert1=mysql_query($q1);
	}
	
	
	
	else if($countstr>=1 && ($strside=="left" || $strside=="right") && $totalfirst < 3 && $totalfirst> 1 && ($lc >= 1 OR $rc >= 1) && $pchase==0){
			
			$q4="INSERT INTO mlm_pairmatch (profileid, lcount, rcount, pmatched, strongside, countstrong, commearned, is_payed ,date) VALUES ('$user_profileid', '$lpv', '$rpv', '0', 'YC', '0', '0', '0', '$next_date')";
			$insertf=mysql_query($q4);
			echo "<br/>Query 4: $q4<br/>";
			}
	
	$gnpv = gainedpvchk($user_profileid,$curdate);
	$gpv = $gnpv['pay_pv'];
	$tcnt = tempcount($user_profileid,$curdate);
	if($firstpayflag==0 && $gpv !=0 && $totalfirst > 0 && $tcnt==0){
	$q4="INSERT INTO mlm_tempmatch (profileid, lcount, rcount, date) VALUES ('$user_profileid', '$lpv', '$rpv', '$next_date')";
	$insert4=mysql_query($q4);
	echo "<br/>Query 4: $q4";
	}
	if($firstpayflag==0 && $tcnt > 0 && $totalfirst > 0){
	
	echo "<br/>Maries L: $lpv";
	echo "<br/>Maries r: $rpv";
	
	$q5="INSERT INTO mlm_tempmatch (profileid, lcount, rcount, date) VALUES ('$user_profileid', '$lpv', '$rpv', '$next_date')";
	$insert5=mysql_query($q5);
	echo "<br/>Query 5: $q5";
	}
		
		echo "<br/>----------------------<br/>";
		}
		
		
?>
