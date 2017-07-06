<?php
//update `mlm_register` set `user_ratio`=0
include("config/error.php"); 
//$curdate = date('Y-m-d');
/*$curdate = date('Y-m-d',strtotime($_GET['cur_date']));
$prev_date = date('Y-m-d', strtotime("$curdate -1 day"));

$next_date = date('Y-m-d', strtotime("$curdate +1 day"));;


echo "Previous date: ".$prev_date."<br/>";
echo "current date: ".$curdate."<br/>";
echo "Next date: ".$next_date."<br/>";*/

/*SELECT t1.user_profileid AS lvl1,t2.user_profileid AS lvl2,t3.user_profileid AS lvl3,t4.user_profileid AS lvl4, t5.user_profileid AS lvl5 FROM mlm_register t1 LEFT JOIN mlm_register t2 ON t2.user_sponserid = t1.user_profileid  
LEFT JOIN mlm_register t3 ON t3.user_sponserid = t2.user_profileid LEFT JOIN mlm_register t4 ON t4.user_sponserid = t3.user_profileid LEFT JOIN mlm_register t5 ON t5.user_sponserid = t4.user_profileid 
WHERE t1.user_profileid = 'SBI2015021' */
/*
function get_all($referid){
	$query = "select user_profileid,user_placement from mlm_register where user_sponserid='$referid'";
	$rst = mysql_query("$query");
	$result = array();
	$x=0;
	while($row=mysql_fetch_array($rst)){
		$result[$x] = $row;
		$x++;
		}				
		return $result;
}

$parntid="";
$ParentQry=mysql_fetch_array(mysql_query("select user_profileid from mlm_register where user_sponserid='$parntid'"));
$referid = $ParentQry['user_profileid'];

$getall = get_all($referid);
$leftarray=array();
$rightarray=array();
for($i=0;$i<count($getall);$i++){
	$userid = $getall[$i]['user_profileid'];
	$position = $getall[$i]['user_placement'];
	if($position == "L"){
		$leftarray[] = get_all($userid);
	}
	if($position == "R"){
		$rightarray[] = get_all($userid);
	}
}
print_r($leftarray);
exit;
*/

$curdate = date('Y-m-d');
$prev_date = date('Y-m-d', strtotime("$curdate -1 day"));

$next_date = date('Y-m-d', strtotime("$curdate +1 day"));;

$res2=mysql_query("UPDATE mlm_register SET `user_sponserid` = UPPER(`user_sponserid`)");
$res3=mysql_query("UPDATE mlm_register SET `user_placementid` = UPPER(`user_placementid`)");

function getbinarydet(){
$binarydet=mysql_fetch_array(mysql_query("select * from mlm_binaryplan where binary_id='1'"));
return $binarydet;
}

function mlm_tempmatch($usr_proid){
$tmatch=mysql_fetch_array(mysql_query("select SUM(lcount) as lpv, SUM(rcount) as rpv from mlm_tempmatch where profileid='$usr_proid'"));
return $tmatch;
}

function getdetailpur($user_profileid,$curdate){
$total=mysql_num_rows(mysql_query("select * from mlm_pairmatch where profileid='$user_profileid' AND date='$curdate' AND strongside='YC'"));
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
$purchase=mysql_fetch_array(mysql_query("select pay_pv from mlm_purchase where pay_userid='$usr_proid' and pay_date='$curdate'"));
return $purchase['pay_pv'];
}

function gainedpv($usr_proid)
{
$purchase=mysql_fetch_array(mysql_query("select * from mlm_purchase where pay_userid='$usr_proid'"));
return $purchase;
}
function todayleftpvchk($usr_proid,$curdate){
$todayleftpvchk=mysql_fetch_array(mysql_query("select lcount from mlm_pairmatch where profileid='$usr_proid' AND date='$curdate' AND strongside='YC'"));
if(empty($todayleftpvchk['lcount'])){
return 0;
}
else{
return $todayleftpvchk['lcount'];
}
}

function todayrightpvchk($usr_proid,$curdate){
$todayrightpvchk=mysql_fetch_array(mysql_query("select rcount from mlm_pairmatch where profileid='$usr_proid' AND date='$curdate' AND strongside='YC'"));
return $todayrightpvchk['rcount'];
}

function userratio($usr_proid){
$userratio=mysql_fetch_array(mysql_query("select user_ratio from  mlm_register where user_profileid='$usr_proid'"));
return $userratio['user_ratio'];
}


$res=mysql_query("SELECT * FROM `mlm_register`");
echo "<pre>";
		$lpv=0;
		$rpv=0;
		$lc=0;
		$rc=0;
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
		if($leftmem !=''){
		echo "left Member";
		//$lres = leftmem($leftmem);
		$lres = downline($leftmem);
		}
		else if($leftmem ==''){
		unset($lres);
		}
		if($rightmem !=''){
		//$rres = rightmem($rightmem);
		$rres = downline($rightmem);
		}
		else if($rightmem ==''){
		unset($rres);
		}
		echo "<br/>Downline<br/>";
			$lc=0;
			if($leftmem !=''){
			array_unshift($lres,$leftmem);
			foreach($lres as $l){
			$row=mysql_fetch_array(mysql_query("select user_sponserid from mlm_register where user_profileid='$l'"));
			$sponsid = $row['user_sponserid'];
				
				if($sponsid==$user_profileid){
				$lc++;
				}
			}
			}
			$rc=0;
			if($rightmem !=''){
			array_unshift($rres,$rightmem);
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
					$lpv = $lpv + $gainedpvlft;
					}
					foreach($rres as $rt){
					$gainedpvrt=gainedpvchk($rt,$curdate);
					$rpv = $rpv+$gainedpvrt;
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
			
			$isratio=userratio($user_profileid);
			$totalfirst=$lpv+$rpv;
			$firstpayflag=0;
			
			if($isratio==0 && $totalfirst<=2  && $totalfirst !=0 && ($lc >=1 || $rc >=1)){
			
			
			$qtm="INSERT INTO mlm_tempmatch (profileid, lcount, rcount, date) VALUES ('$user_profileid', '$lpv', '$rpv', '$next_date')";
				$insert4=mysql_query($qtm);
				echo "<br/>Query temp: $qtm";
			}
	if(!empty($leftmem) AND !empty($rightmem)){
		
			
			if(($isratio !=1) && ($totalfirst >= 3) && $lrcount >= 2 && $lc>=1 && $rc>=1  && $lpv>=1 && $rpv>=1){
			$updateratio = mysql_query("update  mlm_register set user_ratio='1' where user_profileid='$user_profileid'");
			$firstpayflag=1;
			}
			
			
			
			$totalpvs = $lpv + $rpv;
			$pchase = getdetailpur($user_profileid,$curdate);
			if($firstpayflag == 1){
			$tmatch = mlm_tempmatch($user_profileid);
			$lpv = $lpv + $tmatch['lpv'];
			$rpv = $rpv + $tmatch['rpv'];
			$q1 ="INSERT INTO mlm_pairmatch (profileid, lcount, rcount, pmatched, strongside, countstrong, commearned, is_payed, date) VALUES ('$user_profileid', '$lpv', '$rpv', '$pmatch', '$strside', $countstr, '$commearned', '0', '$curdate')";
			$insert=mysql_query($q1);
			echo "<br/>Query 1 $q1<br/>";
			}
			$pchase = getdetailpur($user_profileid,$next_date);
			
			 if($countstr>=1 && ($strside=="left" || $strside=="right") && $totalfirst >= 2 && $totalfirst !=0 && $pchase==0 && $firstpayflag !=1){
			$q3="INSERT INTO mlm_pairmatch (profileid, lcount, rcount, pmatched, strongside, countstrong, commearned, is_payed ,date) VALUES ('$user_profileid', '$lpv', '$rpv', $pmatch, '$strside', '$countstr', '$commearned', '0', '$next_date')";
			
			$insertf=mysql_query($q3);
			
			echo "<br/> Query 3: $q3<br/>";
			
			}
			else if($countstr>=1 && ($strside=="left" || $strside=="right") && $totalfirst < 3 && $totalfirst> 1 && ($lc >= 1 OR $rc >= 1) && $totalpvs !=0 && $pchase==0){
			
			$q4="INSERT INTO mlm_pairmatch (profileid, lcount, rcount, pmatched, strongside, countstrong, commearned, is_payed ,date) VALUES ('$user_profileid', '$lpv', '$rpv', '0', 'YC', '0', '0', '0', '$next_date')";
			$insertf=mysql_query($q4);
			echo "<br/>Query 4: $q4<br/>";
			}
			
			if($firstpayflag == 0 && ($lc >= 1 OR $rc >= 1) && $totalpvs !=0 && ($isratio==0)){
			
			}
			else if($countstr>0 && ($strside=="left") && (getdetailpur($user_profileid,$next_date)==0)){
			
			$q6="INSERT INTO mlm_pairmatch (profileid, lcount, rcount, pmatched, strongside, countstrong, commearned, is_payed ,date) VALUES ('$user_profileid', '$countstr', '0', '0', 'YC', '0', '0', '0', '$next_date')";
			$insertl=mysql_query($q6);
			echo "<br/>Query 6: $q6";
			}
			else if($countstr>0 && ($strside=="right") && (getdetailpur($user_profileid,$next_date)==0)){
			
			$q7="INSERT INTO mlm_pairmatch (profileid, lcount, rcount, pmatched, strongside, countstrong, commearned, is_payed ,date) VALUES ('$user_profileid', '0', '$countstr', '0', 'YC', '0', '0', '0', '$next_date')";
			$insertr=mysql_query($q7);
			echo "<br/>Query 7: $q7";
			}
			
			}
			
		 
			
			
		echo "<br/>----------------------<br/>";
		}
		 
		//header("location:admin/payout.php");
	 
?>
