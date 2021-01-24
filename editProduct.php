<?php
session_start();
require_once "conn.php";
if(isset($_GET['item_id'])){
    $item_id=$_GET['item_id'];

    $sql="delete from product where item_id='$item_id'";
    if(!mysqli_query($conn,$sql))
    echo $conn->error;
    else
    header("location: inventory.php");
}









?>