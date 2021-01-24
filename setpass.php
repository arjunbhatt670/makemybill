<?php
session_start();
require_once "config.php";

if(isset($_GET['user_id']))
$_SESSION['user_id']=$_GET['user_id'];
// echo $_SESSION['user_id'];

if(isset($_SESSION['user_id'])&&$_SERVER["REQUEST_METHOD"] == "POST"){
    $id=$_SESSION['user_id'];
    unset($_SESSION['user_id']);


    $sql="UPDATE user_details SET password =? WHERE user_id = ?";

    if($stmt = $mysqli->prepare($sql)){
        $stmt->bind_param("ss", $param_password, $param_user_id);
        $param_password=password_hash($_POST['pass1'], PASSWORD_DEFAULT);
        $param_user_id=$id;
        if($stmt->execute()){
            header("location: login.php?pass_change=true");
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }

        $stmt->close();
    }



    // if($mysqli->query($sql)){
       
    // } else{
    //     echo "error";
    // }
    // UPDATE `makemybill`.`user_details` SET `password` = 'pop' WHERE `user_id` = '11';

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

    <title>set new password</title>
    
</head>
<body>
    <div class="reset">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return check_confirm()">
            <h2  style="color: #fff;">Set New password</h2>
           
            <input type="password" name="pass1" id="pass1" placeholder="Set New password" onblur="validate('password','passerror',this.value)"/>
            <label id="passerror" class="error"></label><br><br>
            <input type="password" name="pass2" id="pass2" placeholder="Confirm password"/>
            <label id="passerror2" class="error"></label><br><br>
            <input type="submit" value="Save" /><br><br>
            <a href="login.php" style="text-decoration: none;">Go Back To Home Page</a><br><br>

           

            
                     


    </div>
</body>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript" src="js/signup.js"></script>
</html>