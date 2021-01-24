<?php
$servername ="localhost:3307";
$username="root";
$password="root";
$database="makemybill";

$conn = mysqli_connect($servername,$username,$password,$database);
if(!$conn)
{
	die("Connection failed:".mysqli_connect_error());
}
else
{
	//echo "connected successfully";
}


?>