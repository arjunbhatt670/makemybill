<?php
include "conn.php";
session_start();
$_SESSION["orggstnum"];
if(!isset($_SESSION["orggstnum"]))
{
header("refresh:0; url = login.php");
}
$orggstnum=$_SESSION["orggstnum"];
$item_name=$_POST['item_name'];
$price_cost=$_POST['price_cost'];
$price_sell=$_POST['price_sell'];
$stock=$_POST['stock'];
$sql="INSERT into product(orggstnum, item_name, price_cost, price_sell, stock) VALUES('$orggstnum', '$item_name', '$price_cost', '$price_sell', '$stock')";
if(mysqli_query($conn, $sql))
header("location: inventory.php?added=true");
else
echo $conn->error;
?>
