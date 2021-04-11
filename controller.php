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
                echo $otp.' '.$otp1;
                require_once ("verification-form.php");
                exit();
                break;
                //header('Location: verification-form.php');
                // $message = "Your One Time Password is " . $otp;
                
                // try{
                //     $response = $Textlocal->sendSms($numbers, $message, $sender);
                //     require_once ("verification-form.php");
                //     exit();
                // }catch(Exception $e){
                //     die('Error: '.$e->getMessage());
                // }
                
                
            case "verify_otp":
                $otp = $_POST['otp'];
                $otp1 = $_POST['otp1']; //email otp
                
                if ($otp == $_SESSION['session_otp'] && $otp1 == $_SESSION['email_otp']) {
                    unset($_SESSION['session_otp']);
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