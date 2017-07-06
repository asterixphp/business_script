<?php include("config/error.php");
include("includes/head.php");
if(isset($_REQUEST['contact']))
{

$name=addslashes($_REQUEST['name']);
$email=addslashes($_REQUEST['email']);
$mobile=addslashes($_REQUEST['mobile']);
$message=addslashes($_REQUEST['message']);
$sub=addslashes($_REQUEST['subject']);
$ip=$_SERVER['REMOTE_ADDR'];
 if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
$inse=mysql_query("insert into mlm_feedback set fb_fromemail='$email',fb_toemail='$website_admin',fb_subject='$sub',fb_message='$message',fb_date=NOW(),fb_name='$name',fb_mobile='$mobile',fb_ip='$ip' ");


$subject="Enquiry Details from ".$website_name;

	$msg="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b>Enquiry Details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Dear $name, </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Your enquiry has been sent successfully, concern person is contact you soon.</td>
						</tr>
					
				
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";

$headers  = 'MIME-Version: 1.0' . "\r\n";

$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers .= 'From:'.$website_name.'<'.$website_admin.'>' . "\r\n";

$to=$email;


//echo $to."<br>".$msg."<br>".$subject."<br>".$headers; exit;

mail($to,$subject,$msg,$headers);

$subject1=$sub;
$msg1="<table cellpadding='0' cellspacing='0' border='0' bgcolor='#006699' style='border:solid 10px #006699; width:550px;'>
		<tr bgcolor='#006699' height='25'>
			<td><img src=".$logourl." border='0' width='200' height='60' /></td>
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr bgcolor='#FFFFFF' height='30'>
						<td valign='top' style='font-family:Arial; font-size:12px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'><b> Enquiry Details from ".$website_name." </b></td>
						</tr>

							
							<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Name : $name </td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Email : $email</td>
						</tr>
						
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Subject : $sub</td>
						</tr>
						<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'>Message : $message</td>
						</tr>
					
					<tr bgcolor='#FFFFFF' height='35'>
						<td style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000;'><a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>Click Here</a></td>
						</tr>
				
							<tr bgcolor='#FFFFFF'>
		 	<td align='left' style='padding-left:20px; font-family:Arial; font-size:11px; line-height:18px; text-decoration:none; color:#000000; padding-left:20px;'> Regards,<br>
				".$website_name."<br>
			</td>
		
		</tr>
						<tr bgcolor='#FFFFFF'><td>&nbsp;</td></tr>
						<tr height='40'>
		
<td align='right' style='font-family: Arial, Helvetica, sans-serif;font-size: 10px;background-color:#006699;
color: #000000;'>&copy; Copyright " .date("Y")."&nbsp;"."<a href='$website_url/login.php' style='font-family:Arial; font-size:11px; font-weight:bold; text-decoration:none; color:#FFFFFF;'>".$website_name."</a>."."
</td>
</tr>
</table>";

$headers1  = 'MIME-Version: 1.0' . "\r\n";

$headers1 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

$headers1 .= 'From:'.$website_name.'<'.$email.'>' . "\r\n";

$to1=$website_admin;


//echo $to1."<br>".$msg1."<br>".$subject1."<br>".$headers; exit;

if(mail($to1,$subject1,$msg1,$headers1))
{
header("location:contact.php?succ");
echo "<script>window.location='contact.php?succ';</script>";
}
else
{
header("location:contact.php?err");
echo "<script>window.location='contact.php?err';</script>";
}
unset($_SESSION['security_code']);
unset($_SESSION['capname']);
unset($_SESSION['capemail']);
unset($_SESSION['capmobile']);
unset($_SESSION['capmessage']);
unset($_SESSION['capsubject']);
}
else
{

$_SESSION['capname']=$_REQUEST['name'];
$_SESSION['capemail']=$_REQUEST['email'];
$_SESSION['capmobile']=$_REQUEST['mobile'];
$_SESSION['capmessage']=$_REQUEST['message'];
$_SESSION['capsubject']=$_REQUEST['subject'];
header("location:contact.php?caperr");
echo "<script>window.location='contact.php?caperr';</script>";

}

}


?>
<script>
function phnumbersonly(myfield, e, dec)
{

var key;
var keychar;

	if (window.event)
	key = window.event.keyCode;
	else if (e)
	key = e.which;
	else
	return true;
keychar = String.fromCharCode(key);

// control keys
	if ((key==null) || (key==0) || (key==8) || (key==9) || (key==13) || (key==27) )
	return true;

// numbers
	else if ((("+0123456789").indexOf(keychar) > -1))
	return true;

// decimal point jump
	else if (dec && (keychar == ".")) {
	myfield.form.elements[dec].focus();
	return false;
	} 
else
return false;
}
function validateEmail() {
    var x = document.forms["contactform"]["email"].value;
    var atpos = x.indexOf("@");
    var dotpos = x.lastIndexOf(".");
    if (atpos< 1 || dotpos<atpos+2 || dotpos+2>=x.length) {
        alert("Not a valid e-mail address");
		document.forms["contactform"]["email"].focus();
		document.forms["contactform"]["email"].value="";
		
        return false;
    }
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
            
             <?php
					   $about=mysql_fetch_array(mysql_query("select * from mlm_cms"));
					   ?>
			
			<!-- banar -->
			<div class="row">
                <div class="span12 page-title-container">
                    <img src="img/contact.jpg" />
                    <!-- <div class="inner-page-title fixed" style="padding: 45px 25px 20px;">
                        <h2>
                         <?php echo $about['contact_header'];?></h2>
                        <p><?php echo $about['contact_content'];?></p>
                    </div>-->
                </div>
            </div>
			<!-- banar end -->
			<hr />
			<br />
			<div class="row">
<?php 
						$addss=mysql_fetch_array(mysql_query("select * from mlm_address where addr_id='1'"));
						
						?>	 
                <div class="span3" style="width:300px;">
                    <h2>Our location Address</h2>
                    <p><b><?php echo $addss['addr_companyname']; ?></b><br /><?php echo $addss['addr_area']; ?>,<br /><?php echo $addss['addr_city']; ?>,<?php echo $addss['addr_state']; ?>,<br /><?php echo $addss['addr_country']; ?>,<?php echo $addss['addr_zipcode']; ?><br> Tell : +1-<?php echo $addss['addr_mobile']; ?></p>	
                    <!--<div style="width:300px; height:250px"><iframe width="300" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=J+P+Nagar+Post+Office@12.9120318,77.587137&ie=UTF8&z=12&t=m&iwloc=near&output=embed"></iframe><br /><table width="200" cellpadding="0" cellspacing="0" border="0"><tr><td align="left"><small><a href="http://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=J+P+Nagar+Post+Office@12.9120318,77.587137&ie=UTF8&z=12&t=m&iwloc=near">View Larger Map</a></small></td><td align="right"><small></small></td></tr></table></div><br /><br />-->
					 <div style="width:300px; height:250px"><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3305.7253775373315!2d-118.26551305006988!3d34.050914980511045!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2c7b06f8a239b%3A0xe774c480f4aa1625!2sTitan+Offices%2C+Inc.!5e0!3m2!1sen!2sin!4v1497962661317" width="300" height="250" frameborder="0" style="border:0" allowfullscreen></iframe><br /><table width="200" cellpadding="0" cellspacing="0" border="0"><tr><td align="left"><small><a href="https://www.google.co.in/maps/place/Titan+Offices,+Inc./@34.050915,-118.2655131,17z/data=!3m1!4b1!4m5!3m4!1s0x80c2c7b06f8a239b:0xe774c480f4aa1625!8m2!3d34.050915!4d-118.263319">View Larger Map</a></small></td><td align="right"><small></small></td></tr></table></div><br /><br />
                    <!--<h3>Contact Person:</h3>
                   <?php //echo $addss['addr_name']; ?></b></p>-->
				   <table><tr><td><b>Email</b></td><td>: support@fixpluz.org</td></tr>
				   <tr><td><b>Mobile (USA)</b></td><td>: +1 213-269-4290</td></tr>
				   </table>
                </div>
                <div class="span9" style="width:500px;">
                    <div class="page-header">
                        <h1  style="line-height: 0;">Contact us</h1>
                    </div>

                    <!-- Headings & Paragraph Copy -->
                    <div class="row">
                  

                        <div class="span9" style="width:500px;">
             <form class="form-horizontal"  action="" method="post" name="contactform" onSubmit="return validateEmail();" />
                         <fieldset>
                     <p>We believe that the success of an organization is derived from the vision of its leadership and effectiveness of its members. If you've got any question concerning our services, quotation, we might like to hear from you.</p><br />
									   <?php 
					 if(isset($_REQUEST['succ']))
					 {
					 ?>
					 <div style="color:#006633;" align="center">Your enquiry has been sent successfully !!!</div><br>
					 <?php } ?>
					    <?php 
					 if(isset($_REQUEST['err']))
					 {
					 ?>
					 <div style="color:#FF0000;" align="center">Mail not sent !!!</div><br>
					 <?php }
					 
					 	 if(isset($_REQUEST['caperr']))
					 {
					 ?>
					 <div style="color:#FF0000;" align="center">Captcha is invalid, Please Try Again !!!</div><br>
					 <?php } ?>
					 
                                    <div class="control-group">
                                        <label for="focusedInput" class="control-label">First Name:</label>
                                        <div class="controls">
                                            <input type="text" name="name" placeholder="your first name" id="name" class="input-xlarge focused span6" value="<?php if(isset($_SESSION['capname'])) { echo $_SESSION['capname']; } ?>" required/>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Mobile Number:</label>
                                        <div class="controls">
                                            <input type="text" placeholder="your mobile" onKeyPress="return phnumbersonly(this, event)"  maxlength="11"  name="mobile" id="mobile" class="input-xlarge span6" value="<?php if(isset($_SESSION['capmobile'])) { echo $_SESSION['capmobile']; } ?>" required/>
                                        </div>
                                    </div>
									
									<div class="control-group">
                                        <label class="control-label">E-Mail Address:</label>
                                        <div class="controls">
                                            <input type="text" placeholder="your email" name="email" id="email" class="input-xlarge span6" value="<?php if(isset($_SESSION['capemail'])) { echo $_SESSION['capemail']; } ?>" required/>
                                        </div>
                                    </div>
									
									<div class="control-group">
                                        <label class="control-label">Subject:</label>
                                        <div class="controls">
                                            <input type="text" placeholder="your subject" name="subject" id="subject" class="input-xlarge span6" value="<?php if(isset($_SESSION['capsubject'])) { echo $_SESSION['capsubject']; } ?>" required/>
                                        </div>
                                    </div>
									
                                    <div class="control-group">
                                        <label for="textarea" class="control-label">Enquiry:</label>
                                        <div class="controls">
                                            <textarea rows="3" name="message" id="message" placeholder="What would you like to contact us about?" class="input-xlarge span6" required><?php if(isset($_SESSION['capmessage'])) { echo $_SESSION['capmessage']; } ?></textarea>
                                        </div>
                                    </div>
									
									
									  <div class="control-group">
                                        <label for="textarea" class="control-label">&nbsp;</label>
                                        <div class="controls">
                                          <img src="CaptchaSecurityImages.php?width=100&height=40&characters=5" />
                                        </div>
                                    </div>
									
									  <div class="control-group">
                                        <label for="textarea" class="control-label">Security Code :</label>
                                        <div class="controls">
                                            <input id="security_code" name="security_code" type="text" placeholder="Security Code" required="required"  />
                                        </div>
                                    </div>
									
						

                                    <div class="span8">
                                        <button class="btn btn-primary pull-right" style="margin-right: 350px;" type="submit" name="contact">Continue</button>
                                    </div>
                                </fieldset>
                            </form>

                        </div>


                    </div><!-- /row -->

                </div>

            </div>
			
			<?php include("includes/footer.php"); ?>
		</div>
		<script src="js/jquery.js"></script>
        <script src="js/bootstrap.js"></script>
	</body>
</html>