<?php
$servername ="148.66.138.117";
$username="myuser";
$password="localpass";
$database="my_db";

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
