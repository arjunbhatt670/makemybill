<?php
session_start();
// require_once "config.php";

// $otp="";

// if($_SERVER["REQUEST_METHOD"] == "POST"){
    // if($_POST['otp']==$otp){

if(!isset($_SESSION['otp_s']))
$_SESSION['otp_s']="true";

    if(isset($_GET['verify'])&&$_GET['verify']=="ok" && $_SESSION['otp_s']=="true"){
       
        insert();

    }
        

    function insert(){
        require_once "config.php";

        $firstname=$_POST['fname'];
        $lastname=$_POST['lname'];
        $dob=$_POST['dob'];
        $email=$_POST['email'];
        $password=$_POST['pass1'];
        $phone=$_POST['phone'];
        $state=$_POST['state'];
        $city=$_POST['city'];


        $sql = "INSERT INTO user_details (firstname, lastname, dob, phone, email, password, state, city) VALUES (?,?,?,?,?,?,?,?)";
         
                if($stmt = $mysqli->prepare($sql)){
                    $stmt->bind_param("ssssssss", $param_firstname, $param_lastname, $dob, $param_phone, $param_email, $param_password, $param_state, $param_city);
                    $param_firstname = $firstname;
                    $param_lastname = $lastname;
                    $dob=$dob;
                    $param_phone = $phone;
                    $param_email = $email;
                    $param_password = password_hash($password, PASSWORD_DEFAULT);
                    $param_state = $state;
                    $param_city = $city;
                    if($stmt->execute()){
                        // echo "inserted";
                        // header("location: add_organization.php");
                    } else{
                        echo "Something went wrong. Please try again later.";
                    }
                    $stmt->close();
                }



        // header("location: login.php");
     }
// }

if(isset($_GET['verify'])&&$_GET['verify']=="ok" && $_SESSION['otp_s']=="true"){
    $_SESSION['otp_s']="false";
    sendOTP();
}

// $number=array("");
function sendOTP(){

    $otp=rand(11111,99999);
    // echo $otp;

    $field = array(
        "sender_id" => "SMSINI",
        "language" => "english",
        "route" => "qt",
        "numbers" => $_POST['phone'],
        "message" => "43161",
        "variables" => "{#AA#}",
    "variables_values" => $otp
    );
    
    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://www.fast2sms.com/dev/bulk",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_SSL_VERIFYHOST => 0,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => json_encode($field),
      CURLOPT_HTTPHEADER => array(
        "authorization: x1lpHF4AgCPesLnW3IStVD6q2RU8XNEO9ov7fQiuzdcTaJBy5GOL6JPmzxbhaespB9vGnTyCl0WuZDcr",
        "cache-control: no-cache",
        "accept: */*",
        "content-type: application/json"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    
    if ($err) {
      echo "cURL Error #:" . $err;
    } else {
    //   echo $response;
      echo "<script>sessionStorage.setItem('otp','".$otp."');</script>";
    }
    
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- <link rel="stylesheet" media="screen and (max-width: 1170px)" href="../css/phone.css"> -->
    <link rel="stylesheet" href="css/resetstyle.css" rel="stylesheet" type="text/css">
    <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
    <title>otp page</title>
    
</head>
<script type="text/javascript">

        function checkOTP(){
            var otp=document.getElementById("otp").value;
            if(otp!=""){
                if(sessionStorage.getItem("otp")==otp){
                    location.href="login.php?registered=ok";
                } else {
                    document.getElementById("resend-otp").innerHTML="Invalid OTP";
                    setTimeout(() => {
                        document.getElementById("resend-otp").innerHTML="Mobile not verified";
                        setTimeout(() => {
                            location.href="login.php";
                        }, 2000);
                    }, 1000);
                    // location.href="add_organization.php"
                }
            } else{
                document.getElementById("resend-otp").innerHTML="Please enter OTP first";
            }
        }
</script>
<body>
    <div class="reset">
        <!-- <form method="post" action=""> -->
            <h3>Mobile verification</h3>
            <h2  style="color: #fff;">We have sent OTP to your Mobile Number</h2>
           
            <input type="text" name="otp" id="otp" placeholder="Enter OTP">
            <label id="resend-otp" class="error"></label><br><br>
            <!-- <a href="" style=" text-align : center ; margin-right:0px; font-size:15px; font-family:Tahoma, Geneva, sans-serif;">Resend OTP</a> -->
            <!-- <br><br> -->
            <input type="submit" value="Submit" onclick="checkOTP()"/><br><br>
          
            <a href="signup.php" style="text-decoration: none;">Go Back To Home Page</a><br><br>


    </div>
</body>
</html>