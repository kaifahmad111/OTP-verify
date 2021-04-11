<?php
session_start();
error_reporting(E_ALL & ~ E_NOTICE);
require ('textlocal.class.php');

class Controller
{
    function __construct() {
        $this->processMobileVerification();
    }
    function processMobileVerification()
    {
        switch ($_POST["action"]) {
            case "send_otp":
                
                $mobile_number = $_POST['mobile_number'];
                $email = $_POST['email'];
                $otp = rand(1000, 9999);
                $otp1 = rand(100000, 999999);
                $_SESSION['session_otp'] = $otp;
                $_SESSION['email_otp'] = $otp1;
                //For Email
                $subject = "Email: OTP";
                $txt = "OTP: ".$otp1."";
                $headers = "From: kaifa.infoseek@gmail.com" . "\r\n" .
                            "CC: kaifahmad111@gmail.com";
                ini_set("SMTP","smtp.gmail.com");
                ini_set("smtp_port","587");
                ini_set("sendmail_from","kaifa.infoseek@gmail.com");
                ini_set("sendmail_path", "C:\xampp\sendmail\sendmail.exe -t");
                            
                mail($email,$subject,$txt,$headers);            
                //For Email
                        //echo $otp.' '.$otp1;
                //For Mobile
                #### 2Factor API Setting
                $APIKey='0e32913f-9936-11eb-80ea-0200cd936042';
                $OTPMessage="<p>We have sent an OTP to $mobile,<br>Please enter the same below</p>";

                ### Send OTP
                $API_Response_json=json_decode(file_get_contents("https://2factor.in/API/V1/$APIKey/SMS/$mobile_number/$otp"),false);
                $VerificationSessionId= $API_Response_json->Details;
                //For Mobile
                require_once ("verification-form.php");
                exit();
                break;
            
            case "verify_otp":
                $otp = $_POST['otp'];
                
                if ($otp == $_SESSION['session_otp']) {
                    //unset($_SESSION['session_otp']);
                    echo json_encode(array("type"=>"success", "message"=>"Your mobile number is verified!"));
                } else {
                    echo json_encode(array("type"=>"error", "message"=>"Mobile number verification failed"));
                }
                break;
            
            case "verify_otp1": //for Email OTP
                $otp1 = $_POST['otp1']; //email otp
                
                if ($otp1 == $_SESSION['email_otp']) {
                    //unset($_SESSION['email_otp']);
                    echo json_encode(array("type"=>"successEm", "message"=>"Your Email is verified!"));
                    } else {
                        echo json_encode(array("type"=>"errorEm", "message"=>"Email id verification failed"));
                    }
                    break;    
        }
    }
}
$controller = new Controller();
?>