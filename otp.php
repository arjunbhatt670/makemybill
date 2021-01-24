<?php
require_once "config.php";
session_start();
// if(!isset($_SESSION['otp_s']))
// $_SESSION['otp_s']="true";
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_GET["forget"])&& $_GET['forget']=="ok"){
    // && $_SESSION['otp_s']=="true"
    // $_SESSION['otp_s']="false";

    // $_GET['forget']="false";
require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";

// SMTP configuration
$mail = new PHPMailer;

// $mail->isSMTP();
// $mail->Host = 'localhost';
// $mail->SMTPAuth = false;
// $mail->SMTPAutoTLS = false; 
// $mail->Port = 25; 

$mail->isSMTP();
$mail->Host     = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'hitssolutions.billing@gmail.com';
$mail->Password = 'Billing@HITS';
$mail->SMTPSecure = 'ssl';
$mail->Port     = 465;

// $arr= json_decode($user_data, true);

 $user_id = $_GET["user_id"];
$email = $_GET["email"];
// $number=$_POST["number"];


// echo $plans." ".$plans_type."klo";


$mail->setFrom('hitssolutions.billing@gmail.com', 'makemybill');
$mail->addReplyTo('hitssolutions.billing@gmail.com', 'makemybill');


$mail->addAddress($email);

// Email subject
$mail->Subject = 'Email verification';

// Set email format to HTML
$mail->isHTML(true);

// $mail->addCustomHeader('MIME-Version: 1.0');
// $mail->addCustomHeader('Content-Type: text/html; charset=ISO-8859-1');

// Email body content

$otp=rand(11111,99999);

$mailContent='Your otp for verification is '.$otp;
$mail->Body = $mailContent;
// Send email
if(!$mail->send()){
    header("location: forgot.php");
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}else{
    echo "<script>sessionStorage.setItem('otp','".$otp."');</script>";
}
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
    <link rel="stylesheet" media="screen and (max-width: 1170px)" href="css/phone.css">
    <link rel="stylesheet" href="css/resetstyle.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu"/>

    <title>otp page</title>
    
</head>
<body>
<script type="text/javascript">

function checkOTP(){
    var otp=document.getElementById("otp").value;
    if(otp!=""){
        if(sessionStorage.getItem("otp")==otp){
            location.href="setpass.php?otp=ok&user_id=<?php echo $user_id;?>";
        } else {
            document.getElementById("resend-otp").innerHTML="Invalid OTP...redirecting";
            setTimeout(() => {
                document.getElementById("resend-otp").innerHTML="Email not verified";
                setTimeout(() => {
                    location.href="login.php";
                }, 2000);
            }, 2000);
            // location.href="add_organization.php"
        }
    } else{
        document.getElementById("resend-otp").innerHTML="Please enter OTP first";
    }
}
</script>


    <div class="reset">
            <h2  style="color: #fff;">Enter OTP Here</h2>
            <h2  style="color: #fff;">We have sent OTP to your registered Email id</h2>
           
            <input type="text" name="otp" id="otp" placeholder="Enter OTP">
            <label id="resend-otp" class="error"></label><br><br>
            <a href="" style=" margin-right:0px; font-size:15px; font-family:Tahoma, Geneva, sans-serif;">Resend OTP</a><br><br>
            <input type="submit" value="Submit"  onclick="checkOTP()" /><br><br>
          
            <a href="forgetpass.html" style="text-decoration: none;">Go Back To Home Page</a><br><br>


    </div>
</body>
</html>