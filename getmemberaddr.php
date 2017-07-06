<?php
   include("config/error.php");
   
    $memberid=addslashes($_REQUEST['memberid']);
    
     $userdet=mysql_fetch_array(mysql_query("select * from mlm_register where user_profileid='$memberid'"));
   $usrcountry=$userdet['user_country'];
   $usrstate=$userdet['user_state'];
   $usrcity=$userdet['user_city'];
   $usrdist=$userdet['user_district'];
   $usrpostal=$userdet['user_postalcode'];
     ?>
   <label for="form-field-1">Address 1 &nbsp;<span style="color:#FF0000;">*</span> : </label>
      <input style="width:400px; margin-bottom:16px;" class="input-block-level" readonly="readonly" type="text" name="nomaddress" value="<?php echo $userdet['user_commaddr1']; ?>" id="naddr1" />
   <label for="form-field-1">Address 2 &nbsp;&nbsp;: </label>
      <input style="width:400px; margin-bottom:16px;" class="input-block-level" type="text" value="<?php echo $userdet['user_commaddr2']; ?>" name="nomarea" readonly="readonly" id="naddr2" />
	   <label for="form-field-1">Postal Code &nbsp;<span style="color:#FF0000;">*</span> : </label>
      <input style="width:400px; margin-bottom:16px;" class="input-block-level" readonly="readonly" type="text" value="<?php echo $usrpostal;?>" name="nompostal" id="nzipcode" />
   <label for="form-field-1">Country &nbsp;<span style="color:#FF0000;">*</span> : </label>
      <select style="width:400px; margin-bottom:16px;" readonly="readonly" name="nomcountry" id="ncountry" onchange="return showstate1(this.value);">
         <?php 
            $sqlcon=mysql_query("select * from mlm_country where country_status='0' and country_id='$usrcountry'");
            while($rowcountry=mysql_fetch_array($sqlcon))
            {
            ?>
         <option value="<?php echo $rowcountry['country_id']; ?>"><?php echo $rowcountry['country_name']; ?></option>
         <?php } ?>
      </select>
   <label for="form-field-1">State &nbsp;<span style="color:#FF0000;">*</span> : </label>
      <select style="width:400px; margin-bottom:16px;" readonly="readonly" name="nomstate" id="nstate" onchange="return cityshow1(this.value);">
         <?php 
            $sqlstate=mysql_query("select * from mlm_state where state_status='0' and country_id='$usrcountry' and state_id='$usrstate'");
            while($rowstate=mysql_fetch_array($sqlstate))
            {
            ?>
         <option value="<?php echo $rowstate['state_id']; ?>"><?php echo $rowstate['state_name']; ?></option>
         <?php } ?>
      </select>
   <label for="form-field-1">City &nbsp;<span style="color:#FF0000;">*</span> : </label>
      <select style="width:400px; margin-bottom:16px;" readonly="readonly" name="nomcity" id="ncity" >
         <?php 
            $sqlcity=mysql_query("select * from mlm_city where city_status='0' and city_id='$usrcity'");
            while($rowcity=mysql_fetch_array($sqlcity))
            {
            ?>
         <option value="<?php echo $rowcity['city_id']; ?>"><?php echo $rowcity['city_name']; ?></option>
         <?php } ?>
      </select>
	  

  
