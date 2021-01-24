<?php
require_once "config.php";

$email_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){


    $value=$_POST['email'];

    $sql = "SELECT user_id,email FROM user_details WHERE email = '$value'";
    $select = $mysqli->query($sql);
    $row = mysqli_fetch_array($select);

    if($value=="")
        $email_err= "Please enter your email";
    else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $value) ||  (mysqli_num_rows($select) == 0)) {
        $email_err="Invalid email or no account found.";
    } else {
        // echo '
        // <form method="post" id="f1" action="otp.php?forget=ok">
        // <input type="email" name="email" value='.$value.' hidden>
        // <input type="submit" hidden>
        // </form>
        // <script>f1.submit();</script>
        
        // ';
        // echo $row["user_id"];
        $url="otp.php?user_id=".$row['user_id']."&email=".$value."&forget=ok";
        header("location: ".$url);
        exit;
    }

}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" media="screen and (max-width: 1170px)" href="css/phone.css"> -->
    <link rel="stylesheet" href="css/forgetstyle.css" type="text/css">
    <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu"/>
    <title>Forget Password</title>
</head>
<body>
<div class="forget">
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
<h2>Forget password</h2>
<h5 style="font-size: 14px; color: yellow;">Enter your registered email address. We will send an OTP on your email to verify its you.</h5>
<input type="email" name="email" placeholder="email address">
<span class="help-block"><?php echo $email_err; ?></span><br><br>
<input type="submit" value="Send OTP" ><br><br>

<a href="login.php">Go back to Home page</a>


</form>

    </div>
</body>
</html>