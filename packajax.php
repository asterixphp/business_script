<?php
include("config/error.php");
$id=addslashes($_REQUEST['q']);

$sele=mysql_query("select * from mlm_membership where id ='$id' and status='0'");
$st=mysql_fetch_array($sele)
?>
		<table cellpadding="7" cellspacing="0" border="0" width="80%">
									<tr>
										<td align="right">
											<strong>Amount</strong>
										</td>
										<td align="center">:</td>
										<td>
											<span id="amount"><?php echo "$".$st['act_amount']; ?> </span>
											<input type="hidden" name="amount" value="<?php echo $st['act_amount']; ?>">
										</td>
									</tr>
									<tr>
										<td align="right">
											<strong>PV</strong>
										</td>
										<td align="center">:</td>
										<td>
											<span id="pv"><?php echo $st['pv']; ?></span>
											<input type="hidden" name="pv" value="<?php echo $st['pv']; ?>">
										</td>
									</tr>
 
		</table>
		