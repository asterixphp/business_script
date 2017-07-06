<?php
include("config/error.php");


function currency($from_Currency, $to_Currency, $amount) {

//echo $amount; exit;
    $amount = urlencode($amount);
    $from_Currency = urlencode($from_Currency);
    $to_Currency = urlencode($to_Currency);

    $url = "http://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency";

    $ch = curl_init();
    $timeout = 0;
    curl_setopt ($ch, CURLOPT_URL, $url);
    curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);

    curl_setopt ($ch, CURLOPT_USERAGENT,
                 "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
    curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $rawdata = curl_exec($ch);
    curl_close($ch);
    $data = explode('bld>', $rawdata);
    $data = explode($to_Currency, $data[1]);
    return round($data[0], 2);
}

$product=addslashes($_REQUEST['pid']);
$profileid=$_SESSION['profileid'];
$rvaaa=$_REQUEST['rval'];

$formaction = "https://www.sandbox.paypal.com/cgi-bin/webscr"; // Test account
//$formaction = "https://www.paypal.com/cgi-bin/webscr"; // Live account

$paypalmail=$paypal_id;

$x_ordid=base64_encode($rvaaa);


$qryy=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$profileid'"));

$mems=mysql_fetch_array(mysql_query("select * from mlm_products where pro_id='$product'"));


$product_price = $mems['pro_cost'];

$product_price=currency('INR','USD',$mems['pro_cost']);

$item_name=$mems['pro_name'];

$trip_type="paypal";
$item_number=$product;

$return_url=$website_url."/success_pro.php?id=$x_ordid";
$cancel=$website_url."/cancel_pro.php?id=$x_ordid";


?>
<script>
function load()
{
document.frm1.submit()
}
</script>

<body onload="load()">
    <form name="frm1" id="frm1" method="get" action="<?php echo $formaction; ?>">
		<input type="hidden" name="cmd" value="_xclick" />
		<input type="hidden" name="business" value="<?php echo $paypalmail; ?>" />
		<input type="hidden" name="item_name" value="<?php echo $item_name; ?>" />
		<input type="hidden" name="amount" value="<?php echo $product_price; ?>" />
		<input type="hidden" name="trip_type" value="<?php echo $trip_type; ?>" />
		<input type="hidden" name="no_note" value="2" />
		<input type="hidden" name="rm" value="2" />
		<input type="hidden" name="currency_code" value="USD" />
		<input type="hidden" name="bn" value="PP-BuyNowBF" />
		<input type="hidden" name="item_number" value="<?php echo $item_number; ?>">
		<input type="hidden" name="notify_url" value="<?php echo $return_url; ?>">
		<input type="hidden" name="return" value="<?php echo $return_url; ?>">
		<input type="hidden" name="cancel_return" value="<?php echo $cancel; ?>" />
	</form>
</body>