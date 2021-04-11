<?php
session_start();
echo "<h2> ".$_SESSION['mobile_otp']."</h2>";
//echo "<h2> ".$_SESSION['email_otp']."</h2>";
?>


<div class="error"></div>
<div class="success"></div>
<form id="frm-mobile-verification">
	<div class="form-row">
		<label>Ener OTP is sent to Your Mobile Number</label>		
	</div>

	<div class="form-row">
		<input type="number"  id="mobileOtp" class="form-input" placeholder="Enter 6 digit mobile OTP">		
	</div>

	<!-- <div class="form-row">
		<label>Ener OTP is sent to Your Email Id</label>		
	</div>

	<div class="form-row">
		<input type="number"  id="emailOtp" class="form-input" placeholder="Enter 6 digit email OTP">		
	</div> -->

	<div class="row">
		<input id="verify" type="button" class="btnVerify" value="Verify" onClick="verifyOTP();">		
	</div>
</form>
