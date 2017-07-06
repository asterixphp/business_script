<?php include("config/error.php");
   include("generalfunc.php");
   //include("paycalculation.php");
   include("includes/head.php");
   mysql_query("DELETE FROM mlm_register WHERE `user_date` < (NOW() - INTERVAL 2 MINUTE) and `user_registered`=0");
   //DELETE FROM locks WHERE time_created < (NOW() - INTERVAL 10 MINUTE)
   ?>
<script type="text/javascript">
   function captchaval(str)
   {
   
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
   	//alert(xmlhttp.responseText);
       document.getElementById("capterr").innerHTML=xmlhttp.responseText;
       }
     }
   xmlhttp.open("GET","captchaval.php?q="+str,true);
   xmlhttp.send();
   
   }
   
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
   	document.getElementById('submitbutton').innerHTML="<button class='btn btn-primary' name='registerone' id='registerone' type='submit'>Next</button>";
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
               <!--<div class="vertical-menu">
                  <h3 style="margin-top:10px;">Categories</h3>
                  <hr />
                  <ul class="nav">
                  	<li><a href="blog.html">Category Item</a></li>
                  	<li><a href="blog.html">Category Item</a></li>
                  	<li><a href="blog.html">Category Item</a></li>
                  	<li><a href="blog.html">Category Item</a></li>
                  	<li><a href="blog.html">Category Item</a></li>
                  	<li><a href="blog.html">Category Item</a></li>
                  </ul>
                  <br />
                  <h3>Archive</h3>
                  <hr />
                  <h4>Consultation with Doctor</h4>
                  <div class="sidebar-line"><span></span></div>
                  <p>
                  	First corporate initiative in Ayurvedic stector in Kerala - the Southern State in
                  	the 'Cradle of Ayurveda'.
                  </p>
                  <button class="btn btn-primary" type="submit">Clickhere</button><br><br>
                  </div>-->
               &nbsp;
            </div>
         </div>
<?
$sql=mysql_query("select a.user_profileid,b.epin from mlm_register as a inner join mlm_epin as b on a.user_profileid =b.used_by where a.user_placement!='L' or a.user_placement!='R' order by rand()");
$Random = mysql_fetch_array($sql);
?>
         <div class="span9">
            <div class="row">
               <div class="form2" style="margin-left: -10px;">
                  <div class="span5">
                     <div class="span7" style="width:600px;">
                        <div class="barmenu">
                           <ul>
                              <li class="active"><a href="#">Step1</a></li>
                              <li><a href="#">Step2</a></li>
                              <li><a href="#">Step3</a></li>
                           </ul>
                        </div>
                        <h2 class="widget-title"><span>Step 1*(Basic Information)</span></h2>
                        <div class="sidebar-line"><span></span></div>
                        <form class="register-form" method="post" onSubmit="return formvalidation();" action="registerfunc.php">
                           <label for="sponsorid"><span class="required">*</span> Sponsor id:</label>
                           <input class="input-block-level"  style="width:400px; margin-bottom:0px; " placeholder="Enter the Sponsor id" type="text" name="sponsorid" id="sponsorid" required="true" onBlur="checksponser(this.value);"  /> <span style="color:#999999"> Ex : <?echo $Random['user_profileid'];?> </span>
                           <div id="sponsormsg" style="margin-bottom:16px; width: 400px; color: red; padding: 0 5px;"></div>
                           <label for="sponsorname"><span class="required">*</span>  Sponsor Name: <img src="images/ajax_loading.gif" id="sponsoridloading" style="display: none;" /></label>
                           <input class="input-block-level" style="width:400px; margin-bottom:16px;"type="text" placeholder="Enter the sponsor name" name="sponsorname" id="sponsorname" required="true" readonly="true" />



<label for="refname"><span class="required">*</span>  Referrer Email: </label>
                           <input class="input-block-level" style="width:400px; margin-bottom:16px;"type="email" placeholder="Enter the referrer email" name="refname" id="refname" required="true"/>


                           <label for="password"><span class="required">*</span>  Password:</label>
                           <input class="input-block-level"  style="width:400px; margin-bottom:16px;" placeholder="Enter your password" type="password" name="password" id="password" required="true" />
                           <label for="passwordagain"><span class="required">*</span> Confirm Password:</label>
                           <input class="input-block-level"  style="width:400px; margin-bottom:0px;" placeholder="Enter your password again" type="password" name="passwordagain" id="passwordagain" required="true" />
                           <div id="passerror" style="margin-bottom:16px; width: 400px; color: red; padding: 0 5px;"></div>
                           <label for="placementid"><span class="required">*</span> Placement id:</label>
                           <input class="input-block-level"  style="width:400px; margin-bottom:16px;"type="text" placeholder="Enter the Placement id" name="placementid" id="placementid" required="true" onBlur="showpos(); place();" onKeyDown="document.getElementById("err").innerHTML='';" /> <span style="color:#999999"> Ex : <?echo $Random['user_profileid'];?> </span>
                           <label for="placementposition"><span class="required">*</span> Placement Position:</label>
                           <select name="placementposition" id="placementposition" style="width: 399px; margin-bottom: 0px;" required="true" onChange="showpos();" >
                              <option value="">Select Position</option>
                              <option value="L">Left</option>
                              <option value="R">Right</option>
                           </select>
                           <div id="err" style="margin-bottom:16px; width: 400px; color: red; padding: 0 5px;"></div>
                           <label for="inputEmail">  Bitcoin Wallet Address:</label>
                           <input class="input-block-level" style="width:400px; margin-bottom:16px;" placeholder="Enter your Bitcoin Wallet Address" type="text" name="pancardnum" id="pancardnum" />
                           <label for="inputEmail"><span class="required">*</span> Security Code</label>
                           <img src="CaptchaSecurityImages.php?width=100&height=40&characters=5" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                           <input id="security_code" name="security_code" type="text" placeholder="Security Code" required="required" class="input-block-level" onKeyUp="return captchaval(this.value);" style="width:275px; margin-bottom:16px;" /></span>
                           <br><span id="capterr"></span>
                           <?php if(isset($_REQUEST['capterr'])){
                              echo '<font style="color:#FF0000;">Invalid Captcha, Please try again !!!</font>';
                              }
                              ?>
                           <label for="inputEmail"><span class="required">*</span>   EPIN Verification</label>
                           <!--<input type="text" id="epin" onblur="getproductvalue(this.value);" placeholder="EPIN here" name="epin" />-->
						    <input type="text" id="epin" placeholder="EPIN here" name="epin" />
						   <!--<span style="color:#999999"> Ex : <?echo $Random['epin'];?> </span>-->
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
                           <label for="inputEmail"><span class="required"></span> <input type="submit" name="registerone" value="Register your account today"></label>
                           <span id="submitbutton"></span>
                           <br><br>
                           <label class="checkbox inline">
                           <input type="checkbox" class="box" id="inlineCheckbox1" value="option1" required="required"> <a href="privacy.php"  target="_blank">I read and agree Privacy Policy</a>
                           </label>
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
   <script>
      function showpos()
      {
      	document.getElementById("err").innerHTML='';
      	var str = document.getElementById('placementposition').value;
      	var usr=document.getElementById('placementid').value;
      	//alert(usr);
      	if(usr=="" && str=="") {
      		return false;
      	}
      	if(usr=="" && str!="")
      	{
      		alert("please enter the Placement ID");
      		document.getElementById('placementid').focus();
      		return false;
      	}
      	
      	if(str=="" && usr!="")
      	{
      		//alert("please enter the Placement Position");
      		document.getElementById('placementposition').focus();
      		return false;
      	}
      	
      	document.getElementById("err").innerHTML='<img src="images/ajax_loading.gif" />';
      	
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
      			//alert(xmlhttp.responseText);
      			var res = xmlhttp.responseText; 
      			if(res==5) {
      				document.getElementById("placementid").value='';
      				document.getElementById("placementposition").value='';
      				document.getElementById("placementid").focus();
      				document.getElementById("err").innerHTML="<span style='color:#FF0000;'>Enter valid placement ID</span>";
      			} else if(res==2) {
      				document.getElementById("placementposition").value='';
      				document.getElementById("placementposition").focus();
      				document.getElementById("err").innerHTML="<span style='color:#FF0000;'>Already exists another person !!!</span>";
      			} else if(res==0) {
      				document.getElementById("err").innerHTML="<span style='color:#006633;'>proceed !!!</span>";
      			} else {
      				document.getElementById("err").innerHTML='';
      			}
      		}
      	}
      	xmlhttp.open("GET","getplacement.php?placement&q="+str+"&ussr="+usr,true);
      	xmlhttp.send();
      }
      
	   function place()
      {
      	document.getElementById("err").innerHTML='';
      	var plid = document.getElementById('placementid').value;
      	var spid=document.getElementById('sponsorid').value;
      	if(spid=="" && plid=="") {
      		return false;
      	}
      	if(spid=="" && plid!="")
      	{
      		alert("please enter the Placement ID");
      		document.getElementById('placementid').focus();
      		return false;
      	}
      	
      	if(plid=="" && spid!="")
      	{
      		//alert("please enter the Placement Position");
      		document.getElementById('sponsorid').focus();
      		return false;
      	}
      	
      	document.getElementById("err").innerHTML='<img src="images/ajax_loading.gif" />';
      	
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
      			//alert(xmlhttp.responseText);
      			var res = xmlhttp.responseText; 
      			 if(res==1) {
      				document.getElementById("err").innerHTML="<span style='color:#006633;'>proceed !!!</span>";
      			} else if(res==2) {
      				document.getElementById("sponsorid").value='';
      				document.getElementById("placementid").value='';
      				document.getElementById("sponsorname").value='';
      				document.getElementById("sponsormsg").innerHTML='Invalid Placement';
					document.getElementById("err").innerHTML="<span style='color:#006633;'>Invalid Placement (OR) You Should Place in Your Geneology Only</span>";
      			}
      		}
      	}
      	xmlhttp.open("GET","placecheck.php?&placeid="+plid+"&sponsorid="+spid,true);
      	xmlhttp.send();
      }
	  
	  
      function checksponser(str)
      {
      	if(str=='') {
      		return false;
      	}
      	document.getElementById("sponsoridloading").style.display='inline-block';
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
      			//alert(xmlhttp.responseText);
      			if(xmlhttp.responseText==0) { 
      				document.getElementById("sponsorid").value='';
      				document.getElementById("sponsorname").value='';
      				document.getElementById("sponsormsg").style.color="red";
      				document.getElementById("sponsormsg").innerHTML="Sponsor id entered not valid, Plesae give valid id";
      				document.getElementById("sponsorid").focus();
      			} else {
      				document.getElementById("sponsorname").value=xmlhttp.responseText;
      				document.getElementById("sponsormsg").style.color="green";
      				document.getElementById("sponsormsg").innerHTML="Valid id";
      			}
      			document.getElementById("sponsoridloading").style.display='none';
      		}
      	}
      	xmlhttp.open("GET","getplacement.php?sponsor&q="+str,true);
      	xmlhttp.send();
      }
      
      function formvalidation() {
      	var pass = document.getElementById("password").value;
      	var pass1 = document.getElementById("passwordagain").value;
      	if(pass!='') {
      		if(pass.length<6) {
      			alert("Pleace enter password above 6 letters");
      			document.getElementById("password").focus();
      			return false;
      		}
      	}
      	
      	if(pass1!='') {
      		if(!pass.match(pass1)) {
      			alert("Password and confirm password dosn=\'t match");
      			document.getElementById("password").value='';
      			document.getElementById("passwordagain").value='';
      			document.getElementById("password").focus();
      			return false;
      		}
      	}
      	
      
      		var phonenum = document.getElementById("phonenum").value;
      			reg    = /^[1-9][0-9]{0, 8}$/;
      
      		if (reg.test(phonenum)==false) {
      			
      			alert("Only Numbers up to 10 digits allowed");
      		}
      
      
      }
   </script>
</body>
</html>