function sendOTP() {
	$(".error").html("").hide();
	var number = $("#mobile").val();
	var email = $("#email").val();
	if (number.length == 10 && number != null && email != '') {
		var input = {
			"mobile_number" : number,
			"email" : email,
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
	}  else
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

function verifyOTP() {
	$(".error").html("").hide();
	$(".success").html("").hide();
	var otp = $("#mobileOtp").val();
	var input = {
		"otp" : otp,
		"action" : "verify_otp"
	};
	if (otp.length == 4 && otp != null) {
		$.ajax({
			url : 'controller.php',
			type : 'POST',
			dataType : "json",
			data : input,
			success : function(response) {
				$("." + response.type).html(response.message)
				$("." + response.type).show();
			},
			error : function() {
				alert("ss");
			}
		});
	} else {
		console.log(otp,otp.length);
		$(".error").html('Either one or both OTP entered are wrong .')
		$(".error").show();
	}
}

function verifyOTP1() {
	$(".errorEm").html("").hide();
	$(".successEm").html("").hide();
	var otp1 = $("#emailOtp").val();
	var input = {
		"otp1" : otp1,
		"action" : "verify_otp1"
	};
	if (otp1.length == 6 && otp1 != null) {
		$.ajax({
			url : 'controller.php',
			type : 'POST',
			dataType : "json",
			data : input,
			success : function(response) {
				$("." + response.type).html(response.message)
				$("." + response.type).show();
			},
			error : function() {
				alert("ss");
			}
		});
	} else {
		console.log(otp,otp.length);
		$(".error").html('Either one or both OTP entered are wrong .')
		$(".error").show();
	}
}