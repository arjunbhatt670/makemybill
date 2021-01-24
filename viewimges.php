
<?php

$db = mysqli_connect("localhost", "root", "", "makemybill"); 	
$img = mysqli_query($db, "SELECT orgimg FROM organisation");
    
     while ($row = mysqli_fetch_array($img)) {     
		$width=100;
		$height=100;
      	echo "<img src='images/".$row['orgimg']."' width=".$width."height=".$height." >";
  
      	echo'<br>';
    }

?> 