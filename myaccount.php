<?php 
include("config/error.php");
include("includes/function.php");
if(!(isset($_SESSION['profileid'])) && !(isset($_SESSION['userid'])))
{
header("location:index.php");

echo "<script>window.location='index.php'</script>";

}

include("includes/head.php");
$count1 = 0;
$total_c=0;

function counttree($id,$count)
{
$seelct123 = mysql_query("select * from mlm_register where user_sponserid = '".$id."'");
$count = mysql_num_rows($seelct123);
global $total_c;
if($count == 2)
{
	
 $total_c=$total_c+1;

while($rowfetch = mysql_fetch_array($seelct123))
{
$count = counttree($rowfetch['user_profileid'],$count) + $count;

}
}
return $total_c;
}
$count1 = 0;
$curdate = date('Y-m-d');
$query="select * from mlm_pairmatch where profileid='$_SESSION[profileid]' order by id desc";
if(isset($_POST['overall']))
{
 $query="select * from mlm_pairmatch where profileid='$_SESSION[profileid]' order by id desc";
}
else if(isset($_POST['today'])){
$query="select * from mlm_pairmatch where profileid='$_SESSION[profileid]' AND date between '$curdate' AND '$curdate'";
}
else if(isset($_POST['lastten'])){
$start_date1 =date('Y-m-d', strtotime(' -10 day'));
$end_date10=date('Y-m-d', strtotime(' -1 day'));
$query="select * from mlm_pairmatch where profileid='$_SESSION[profileid]' AND date between '$start_date1' AND '$end_date10'";
}
else if(isset($_POST['monthly'])){
$month_start = strtotime('first day of this month', time());
$month_end = strtotime('last day of this month', time());

$month_start = date('Y-m-d', $month_start);
$month_end = date('Y-m-d', $month_end);

$query="select * from mlm_pairmatch where profileid='$_SESSION[profileid]' AND date between '$month_start' AND '$month_end'";
} 
?>
<link href="css/pagination.css" rel="stylesheet" type="text/css" />
<link href="css/B_red.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="admin/assets/css/font-awesome.min.css" />
<style>
th{
cursor: pointer;
}
.dataTables_length select{
width: auto !important;
}
</style>
<script type="text/javascript">
 
function printDiv() {
var DocumentContainer = document.getElementById('sample-table-2');
var WindowObject = window.open('', 'PrintWindow', 'width=750,height=650,top=50,left=50,toolbars=no,scrollbars=yes,status=no,resizable=yes');
var strHtml = "<html>\n<head>\n <style>.dataTable th[class*=\"sort\"]:after{ content:none !important;}</style><link rel=\"stylesheet\" type=\"text/css\" href=\"admin/assets/css/ace.min.css\"><link rel=\"stylesheet\" type=\"text/css\" href=\"css/bootstrap.css\">\n</head><body><table class=\"table table-striped table-bordered table-hover dataTable\">\n"
+ DocumentContainer.innerHTML + "\n</table>\n</body>\n</html>";
WindowObject.document.writeln(strHtml);
WindowObject.document.close();
WindowObject.focus();
WindowObject.print();
WindowObject.close();
 
}</script>
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
							<div class="banner">
								<h4 class="navbar-inner" style="color:#091647; line-height:40px; margin-top: -50px; margin-bottom: 7px;">My Account</h4>
								<div id="printme">
								<table class="table table-striped table-bordered table-hover" id="sample-table-2">
                        <thead>
                           <tr>
                              
                              <th width="10">SNO</th>
                              <th width="10">DATE</th>
                              <th width="15">UID</th>
                              <th width="15">LPC</th>
                              <th width="15">RPC</th>
                              <th width="15" >PM</th>
                              <th width="15" >SS</th>
							   <th width="15" >CSS</th>
							   <th width="15" >BC</th>
							   <!--<th width="15" >PS</th>-->
							 
                             
                           </tr>
                        </thead>
                        <tbody>
					   <?php 
					$total_count =0;
					function LDownlineCount($prflid,$pos){
					if($pos !="")
					   $posfltr="and user_placement='$pos'";
					else
					   $posfltr="";
						
						$sql="SELECT user_profileid FROM mlm_register where user_sponserid='$prflid' $posfltr";
						$res=mysql_query($sql);
						$row=mysql_fetch_array($res);
						global $total_count;
					
						$total_count=$total_count+mysql_num_rows($res);
						if($row['user_profileid']!=''){
						   LDownlineCount($row['user_profileid'],"");
						}
						return $total_count;
					}
					$parntid = $userdetail['user_profileid'];	
					$ParentQry=(mysql_query("select user_id,user_profileid,user_date from mlm_register where user_sponserid='$parntid'")); 
					$i=1; $Tot_Earning_Amt = array(); $Tot_PM = array(); 
					while($row_pair=mysql_fetch_array($ParentQry)){
						$user_id = $row_pair['user_profileid'];
						$userid = $row_pair['user_id'];
						$LeftCount = count_value($userid,"L");
						$RightCount = count_value($userid,"R");
                                                $count1 = 0;
                                                $leftc = counttree($user_id,$count1);
                                                $total_c=0;
						$calcc=mysql_fetch_array(mysql_query("select * from mlm_binaryplan where binary_id='1'"));
						$per_amt = $calcc['binary_refbonus']; 
						if($LeftCount !=0 && $RightCount !=0){
							$PS_Match_Lft = get_all_pm($userid,"L");
							$PS_Match_Rght = get_all_pm($userid,"R");
							if(($PS_Match_Lft == $PS_Match_Rght) && ($PS_Match_Lft !=0)){
								$Tot_PM = array();
								array_push($Tot_PM, $PS_Match_Lft);
								$TotPM = array_sum($Tot_PM);
							}
							else if($PS_Match_Lft < $PS_Match_Rght){
								$Tot_PM = array();
								array_push($Tot_PM, $PS_Match_Lft);
								$TotPM = array_sum($Tot_PM);
							}
							else if($PS_Match_Rght < $PS_Match_Lft){
								$Tot_PM = array();
								array_push($Tot_PM, $PS_Match_Rght);
								$TotPM = array_sum($Tot_PM);
							}
						}else{ $TotPM=0; }						
						if($LeftCount < $RightCount){$count_stronger_side = "R";}
						elseif($RightCount < $LeftCount){$count_stronger_side = "L";}
						else{$count_stronger_side = "0";}
						/* $PSRec=mysql_fetch_array(mysql_query("select is_payed from mlm_pairmatch where profileid='$user_id'"));
						if($PSRec['is_payed']==0){
							$ps_status = "Pending";
							$BC_Amt = 0;
							$Tot_Earning_Amt[] = 0;
						}
						else{
							$ps_status = "Paid";
							$BC_Amt = bcmul($TotPM,$per_amt,0);
							$Tot_Earning_Amt[] = $BC_Amt;
						} */
						$BC_Amt = bcmul($TotPM,$per_amt,0);
						$Tot_Earning_Amt[] = $BC_Amt;
						//echo $PS_Match_Lft ."--".$PS_Match_Rght."-->".$TotPM."<br/>";
						?>
						  <tr>
                              <td>
                                 <?php echo $i; ?>
                              </td>
							  <td><?php echo substr($row_pair['user_date'],0,10); ?></td>
                              <td><?php echo $user_id; ?></td>
                              <td><?php echo $lef=LDownlineCount($user_id,"L"); $total_count =0; ?></td>
                              <td><?php echo $righ=LDownlineCount($user_id,"R"); $total_count =0; ?></td>
                              <td><?php echo $leftc; ?></td>
                              <td><?php if($lef>$righ) 
								          echo "L"; 
							            else if($lef<$righ) 
										  echo "R";
									    else if($lef==$righ)
										  echo "(L&R)"; ?></td>
                              <td><?php if($lef>$righ)
 								          echo $lef; 
									    else if($lef<$righ)
										  echo $righ; 
									    else if($lef==$righ) 
										  echo $lef."(L&R)";
								  ?></td>
                              <td><?php echo $BC_Amt;?></td>
							  <!--<td><?php //echo $ps_status;?></td>-->
                           </tr>
                           <?php $i++; }?>
						   <? $_SESSION['TotEarning_Amt'] = array_sum($Tot_Earning_Amt);?>
                        </tbody>
                     </table>
					 </div>
					<div class="modal-footer">
					<form action="" method="post">
                     <input type="submit" name="overall" id="overall" value="OVER ALL" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-danger pull-left" title="Overall" />
                     <input type="submit" name="today" id="today" value="TODAY" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left" title="Today Report"/>
					  <input type="submit" name="lastten" id="lastten" value="LAST TEN DAYS" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left" title="Last Ten Days Report"/>
					  <input type="submit" name="monthly" id="monthly" value="THIS MONTH" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left" title="This Month"/>
					  <input type="submit" style="color:#FFFFFF; margin-top:5px;" class="btn btn-small btn-success pull-left" value="PRINT" onclick="printDiv();" />
				   </form>
                  </div>
				  <div class="modal-footer1">
				  <span><b>UID</b> = User ID; </span>
				  <span><b>LPC</b> = Left Point Count; </span>
				  <span><b>RPC</b> = Right Point Count; </span>
				  <span><b>PM</b> = Points Matched; </span>
				  <span><b>SS</b> = Stronger Side; </span>
				  <span><b>CSS</b> = Count Stronger Side; </span>
				  <span><b>BC</b> = Binary Commission; </span>
				  <!--<span><b>PS</b> = Paid Status</span>-->
				  </div>
								    
							</div>
							 <div>
            <?php echo pagination($nom_rows,$limit,$page,$url); ?>
                      
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
		<script src="admin/assets/js/jquery.dataTables.min.js"></script>
<script src="admin/assets/js/jquery.dataTables.bootstrap.js"></script>
<!--ace scripts-->
<script src="admin/assets/js/ace-elements.min.js"></script>
<script src="admin/assets/js/ace.min.js"></script>
<!--inline scripts related to this page-->
<script type="text/javascript">
   $(function() {
   	var oTable1 = $('#sample-table-2').dataTable( {
   	"aoColumns": [
         { "bSortable": true },
         { "bSortable": true }, { "bSortable": true },{ "bSortable": true }, { "bSortable": true }, { "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true },{ "bSortable": true }
   	] } );
   	
   	
   	$('table th input:checkbox').on('click' , function(){
   		var that = this;
   		$(this).closest('table').find('tr > td:first-child input:checkbox')
   		.each(function(){
   			this.checked = that.checked;
   			$(this).closest('tr').toggleClass('selected');
   		});
   			
   	});
   
   
   	$('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});
   	function tooltip_placement(context, source) {
   		var $source = $(source);
   		var $parent = $source.closest('table')
   		var off1 = $parent.offset();
   		var w1 = $parent.width();
   
   		var off2 = $source.offset();
   		var w2 = $source.width();
   
   		if( parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2) ) return 'right';
   		return 'left';
   	}
   })
</script>
	</body>
</html>