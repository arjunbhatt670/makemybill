<?php
session_start();
// if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
//     header("location: dashboard.php");
//     exit;
// }
$_SESSION['email']="";

if(isset($_GET["registered"]) && $_GET["registered"] === "ok"){
?><script>alert("You have successfully registered! Please Sign in");</script>
<?php
}

if(isset($_GET["logout"]) && $_GET["logout"] === "true"){
    ?><script>alert("You have successfully logged out");</script><?php
}

if(isset($_GET["pass_change"]) && $_GET["pass_change"] === "true"){
    ?><script>alert("Your new password is set successfully! Please Sign in now");</script><?php
}

require_once "config.php";
$email = $password = "";
$email_err = $password_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    $_SESSION["email"]=$_POST["email"];

   
    // $_SESSION["email"]=$password;
    
    // Validate credentials
    if(empty($email_err) && empty($password_err)){
        // header("location: dashboard.php");
        $sql = "SELECT user_id, email, password FROM user_details WHERE email = ?";
        // echo("popp");
        if($stmt = $mysqli->prepare($sql)){
            $stmt->bind_param("s", $param_email);
            $param_email = $email;
            if($stmt->execute()){
                $stmt->store_result();
                if($stmt->num_rows == 1){                    
                    $stmt->bind_result($uid, $email, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            session_start();
                            $_SESSION["loggedin"] = true;
                            $_SESSION["uid"] = $uid;
                            $_SESSION["email"] = $email;                            
                            header("location: addorg.php");
                        } else{
                            $password_err= "The password you entered was not valid.";
                        }
                    }
                } else{
                    $email_err= "No account found with that email.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            $stmt->close();
        }
    }
    $mysqli->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/logstyle.css" rel="stylesheet" type="text/css">
   
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu"/>
    <title>Login Page</title>
     <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
</head>
<body>
   <div class="signin">
       <form action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
           <h2 style="color: white;">Log in user</h2>
           <input type="text" name="email" placeholder="Email" value="<?php echo $_SESSION["email"]?>">
           <span class="help-block"><?php echo $email_err; ?></span>
           <br><br>
           <input type="password" name="password" placeholder="Password">
           <span class="help-block"><?php echo $password_err; ?></span>
           <br><br>
           <input type="submit" value="Log In"><br>
           <br>
           <div id="container">
               <!-- <a href="resetpass.php" style=" margin-right:0px; font-size:15px; font-family:Tahoma, Geneva, sans-serif;">Reset Password?</a>&nbsp;&nbsp; -->
               <a href="forgot.php" style=" margin-right:0px; font-size:15px; font-family:Tahoma, Geneva, sans-serif;">Forget Password</a>
           </div>
           <br>
           Don't have account?<a href="signup.php">&nbsp;&nbsp;Sign Up</a>
       </form>
   </div> 
</body>
</html>
