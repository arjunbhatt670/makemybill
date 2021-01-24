<?php
define('DB_SERVER', '148.66.138.117');
define('DB_USERNAME', 'myuser');
define('DB_PASSWORD', 'localpass');
define('DB_NAME', 'my_db');
 
$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>
