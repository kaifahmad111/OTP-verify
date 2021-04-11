function sendOTP() {
	$(".error").html("").hide();
	var number = $("#mobile").val();
	var email = $("#email").val();
	console.log(number);
	console.log(email);
	if (number.length == 10 && number != '' && email!= '') {
		var input = {
			"mobile_number" : number,
			"email_id" : email,
			"action" : "send_otp"
		};
		$.ajax({
			url : 'controller.php',
			type : 'POST',
			data : input,
			success : function(response) {
				$(".container").html(response);
			}
		});
	} else
	if(number == '' && email == '') {
		console.log('Every thing is null!!!');
		$(".error").html('Please enter valid Email and number!!!')
		$(".error").show();
	} else
	if(number == '' || number.length != 10) {
		console.log('number is null!!!');
		$(".error").html('Please enter a valid number!!!')
		$(".error").show();
	} else
	if(email == '') {
		console.log('email is null!!!');
		$(".error").html('Please enter a valid email!!!')
		$(".error").show();
	}
}
//For veryfing the OTP
function verifyOTP() {
	$(".error").html("").hide();
	$(".success").html("").hide();
	var otp_mob = $("#mobileOtp").val();
	var otp_em = $("#emailOtp").val();
	console.log(otp_mob,otp_em);
	var input = {
		"otpmob" : otp_mob,
		"otpem" : otp_em,
		"action" : "verify_otp"
	};
	if (otp_mob.length == 6 && otp_mob != null) {
		console.log('Going inside AJAX');
		$.ajax({
			url : 'controller.php',
			type : 'POST',
			dataType : "json",
			data : input,
			success : function(response) {
				console.log('Going inside AJAX');
				$("." + response.type).html(response.message);
				$("." + response.type).show();
			},
			error: function (jqXHR, exception) {
				var msg = '';
				if (jqXHR.status === 0) {
					msg = 'Not connect.\n Verify Network.';
				} else if (jqXHR.status == 404) {
					msg = 'Requested page not found. [404]';
				} else if (jqXHR.status == 500) {
					msg = 'Internal Server Error [500].';
				} else if (exception === 'parsererror') {
					msg = 'Requested JSON parse failed.';
				} else if (exception === 'timeout') {
					msg = 'Time out error.';
				} else if (exception === 'abort') {
					msg = 'Ajax request aborted.';
				} else {
					msg = 'Uncaught Error.\n' + jqXHR.responseText;
				}
				alert(msg);
			}
		});
	} else {
		$(".error").html('Either single or both entered wrong OTP.');
		$(".error").show();
	}
}