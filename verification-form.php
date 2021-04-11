<div class="error"></div>
<div class="success"></div>
<form id="frm-mobile-verification">
<?php session_start(); ?>
	
	<div class="form-row">
		<label>OTP is sent to Your Mobile Number</label>		
	</div>

	<div class="form-row">
		<input type="text"  id="mobileOtp" class="form-input" placeholder="Enter the MOBILE OTP">		
	</div>

	<div class="form-row">
		<label>OTP is sent to Your Email ID</label>		
	</div>

	<div class="form-row">
		<input type="text"  id="emailOtp" class="form-input" placeholder="Enter the EMAIL OTP">		
	</div>

	<div class="row">
		<input id="verify" type="button" class="btnVerify" value="Verify" onClick="verifyOTP();">		
	</div>
</form>
