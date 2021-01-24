<?php
$uid="";
session_start();

if(isset($_GET['dash'])&&$_GET['dash']=="true"){
    // $_SESSION = array();
    // $uid=$_SESSION["uid"];
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    // session_destroy();
    // session_start();
    // $_SESSION["uid"]=$uid;
    // $_SESSION["loggedin"]=true;
    // echo '<pre>';
    // var_dump($_SESSION);
    // echo '</pre>';
    header("location: addorg.php");
    exit;
} else{
    $_SESSION = array();
    session_destroy();
    header("location: login.php?logout=true");
    exit;
}

?>