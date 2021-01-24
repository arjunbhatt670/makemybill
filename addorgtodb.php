<?php

	require_once "conn.php";
    // $servername = "localhost:3307";
    // $username = "root";
    // $password = "root";
    // $db = "makemybill";
    // Create connection
    // $conn = mysqli_connect($servername, $username, $password,$db);
    // Check connection
    if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
    }

    session_start();
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	    $sessionuid = $_SESSION["uid"];
	}
	else{
		header("location: login.php");
	}


    $name=$_POST["cname"];
	$gstnumber=$_POST["cnumber"];

	

	$flag=0;//assume that organisation does not exist

	$sql1="select * from organisation;";
	$result1=mysqli_query($conn,$sql1);
	

	while ($row = mysqli_fetch_assoc($result1)) 
			{	
				if($row["orggstnum"]==$gstnumber)
					{
						$flag=1;//organisation already exists
					}
			}
	

    
	if($flag==0)
	{
		$sql="insert into organisation (orgname,orggstnum,uid) values('".$name."','".$gstnumber."','".$sessionuid."')";
		$r=mysqli_query($conn,$sql);
		mysqli_close($conn);
		// echo '<script>window.alert("Organisation Added Successfully")</script>';
		header('location: addorg.php?added=true');
		
	}
	else
	{
		//echo mysqli_error($conn); //use this for error checking
		mysqli_close($conn);
		// echo '<script>window.alert("Organizations cannot have same GST nnumbers");</script>';
		header('location: addorg.php?added=false');
		
	}
	
?>

