<?php
session_start();
//error_reporting(E_ALL & ~ E_NOTICE);
//require ('textlocal.class.php');
echo "<script>console.log('We are in controller.php file')</script>";
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
                $email_id = $_POST['email_id'];
                $otp1 = rand(100000, 999999);//4 digit random mobile OTP
                $otp2 = rand(100000, 999999);//6 digit random Email OTP
                $_SESSION['mobile_otp'] = $otp1;
                $_SESSION['email_otp'] = $otp2;
                header('Location: verify-form.php');
                
                // echo "<h2>Mobile : $mobile_number </h2>";
                // echo "<h2>Email Id : $email_id </h2>"; 
                // echo "<h2>Random OTP generated : $otp </h2>"; 
                // 
                // $apiKey = urlencode('ZWJmYTM4OGY2ZDdlOTE2ZjFiNjY0OGM5NzAwZTIxZjY=');
                // $Textlocal = new Textlocal(false, false, $apiKey);  //!uU5eTB!8CuyP5W
                
                // $numbers = array(
                //     $mobile_number
                // );
                // $sender = 'PHPPOT';
                // $otp = rand(100000, 999999);
                // $_SESSION['session_otp'] = $otp;
                // $message = "Your One Time Password is " . $otp;
                
                // try{
                //     $response = $Textlocal->sendSms($numbers, $message, $sender);
                //     require_once ("verification-form.php");
                //     exit();
                // }catch(Exception $e){
                //     die('Error: '.$e->getMessage());
                // }
                break;
                  
            case "verify_otp":
                echo "<script>console.log('We are in controller.php file')</script>";
                $otp_mob = $_POST['otp_mob'];
                $otp_em = $_POST['otp_em'];
                 /*&& $otp_em == $_SESSION['email_otp']*/
                if ($otp_mob == $_SESSION['mobile_otp']) {
                    
                   // unset($_SESSION['mobile_otp']);
                    unset($_SESSION['email_otp']);
                    echo json_encode(array("type"=>"success", "message"=>"Your mobile number is verified!"));
                } else {
                    echo json_encode(array("type"=>"error", "message"=>"Mobile number verification failed"));
                }
                break;
        }
    }
}
$controller = new Controller();
?>