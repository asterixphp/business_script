<?php
include("config/error.php");
$country=addslashes($_REQUEST['q']);
?>
 <select name="addressstate" id="addressstate" onchange="return discity(this.value);" class="input-block-level"  style="margin-bottom:16px;" required="true">
<option value="">--- Choose State ---</option>
		<?php
		   $sele=mysql_query("select * from mlm_state where country_id ='$country' and state_status='0'");
		   while($st=mysql_fetch_array($sele))
		   {
		?>
		
		<option value="<?php echo $st['state_id']; ?>"><?php echo $st['state_name']; ?></option>
		<?php
			}
		?>

</select>