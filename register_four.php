<?php include("config/error.php");
if(isset($_REQUEST['id']) && $_REQUEST['id']!='') {
	$profileid=$_REQUEST['id'];
} else {
	header("Location:index.php");exit;
}
include("includes/head.php");
?>


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
			
			<div class="row">
                <div class="span3">
                    <div class="row">
						&nbsp;
					</div>
				</div>
				
                <div class="span9">
                    <div class="row">
<div class="form2" style="margin-left:-10px;">
<div class="span5">
<div class="span7" style="width:600px;">

<div class="barmenu">
<ul>
<li class="active"><a href="#">Step1</a></li>
<li class="active"><a href="#">Step2</a></li>
<li class="active"><a href="#">Step3</a></li>
<li class="active"><a href="#">Step4</a></li>

</ul>
</div>
<h2 class="widget-title"><span>Step 4*(PIN Verification)</span></h2>
<div class="sidebar-line"><span></span></div>
<script language="javascript">
function getproductvalue(pin) {
document.getElementById('regfourloader').style.display='inline';
if(pin=='') {
document.getElementById('minunit').innetHTML='';
document.getElementById('catname').innetHTML='';
document.getElementById('productinfo').style.display='none';
document.getElementById('regfourloader').style.display='none';
return false;
}
var xmlhttp;
if (window.XMLHttpRequest)
{// code for IE7+, Firefox, Chrome, Opera, Safari
xmlhttp=new XMLHttpRequest();
}
else
{// code for IE6, IE5
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
}
xmlhttp.onreadystatechange=function()
{
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
	
	if(xmlhttp.responseText!="nodata0123e"){
	var newval=xmlhttp.responseText.split("-=-");
	
	document.getElementById('minunit').innerHTML=newval[1];
	var total=parseInt(newval[1])*parseInt(newval[0]);
	document.getElementById('prototprice').innerHTML=total;
	document.getElementById('subcatname').innerHTML=newval[2];
	document.getElementById('prodname').innerHTML=newval[3];
	document.getElementById('prodpv').innerHTML=newval[4];
	document.getElementById('product').value=newval[5];
	document.getElementById('submitbutton').innerHTML="<button class='btn btn-primary' name='registrationfour' id='registrationfour' type='submit'>Submit</button>";
	document.getElementById('ptval').value=newval[4];
	document.getElementById('productinfo').style.display='block';
	document.getElementById('regfourloader').style.display='none';
	document.getElementById('productinfo').style.color='black';
	document.getElementById('error').style.display='none';
	}
	else{
	document.getElementById('productinfo').style.display='none';
	document.getElementById('submitbutton').innerHTML="";
	document.getElementById('regfourloader').style.display='none';
	document.getElementById('error').innerHTML="Invaid Pin or Try Again!!";
	document.getElementById('error').style.color='red';
	document.getElementById('epin').value="";
	}
	
}
}
xmlhttp.open("GET","pincheckajax.php?pin="+pin,true);
xmlhttp.send();
}
</script>
<form class="register-form" method="post" action="registerfunc.php">
<label for="inputEmail"><span class="required">*</span>   EPIN Verification</label>
<input type="text" id="epin" onblur="getproductvalue(this.value);" placeholder="EPIN here" name="epin" />
<span id="error"></span>
<img src="images/ajax_loading.gif" id="regfourloader" style="margin-top: -9px; display:none;" />
<div id="productinfo" style="display:none;">
<label><span class="required">*</span>  Product details :</label>
<input type="hidden" id="totalcnt" />
<div style="float:left; width:20%;">
<label><b>Product Name</b></label>
<span id="prodname"></span>
</div>
<div style="float:left; width:20%;">
<label><b>Sub Category Name</b></label>
<span id="subcatname"></span>
</div>
<div style="float:left; width: 15%;">
<label><b>Tot. Units</b></label>
<span id="minunit"></span>
</div>
<div style="float:left; width:15%;">
<label><b>Total Price</b></label>
<span id="prototprice"></span>
</div>

<div style="float:left; width:15%;">
<label><b>Pt. Value</b></label>
<span id="prodpv"></span>
</div>


</div>

<br style="clear:both;"><br>
<input type='hidden' name='ptval' id='ptval' />
<input type="hidden" name="profileid" value="<?php echo $profileid;?>" />

<input type="hidden" id="product" name="product" />
<span id="submitbutton"></span>




</form>
</div>
</div>
</div>
                    </div>
                    <br />
                </div>
				<br class="clear" />
                
            </div>
			
			<?php include("includes/footer.php"); ?>
			</div>
			<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	
	</body>
</html>