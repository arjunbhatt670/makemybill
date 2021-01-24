<?php
error_reporting(0); 
?> 
<?php
include 'CONNECTDB.php';
$address=$_POST["address"];
$gstnumber=$_POST["cnumber"];
$pno=$_POST["pno"];
$email=$_POST["email"];
$logo=$_POST["uploadfile"];


//-------------------image addition to database----------------------

	if ($logo!="") { 

		$filename = $_FILES["uploadfile"]["name"];  
		$tempname = $_FILES["uploadfile"]["tmp_name"];   
		$folder = "images/".$filename;  

    // Get all the submitted data from the form 
		$sql = "UPDATE organisation set orgimg='$filename' WHERE orggstnum='$gstnumber'"; 

    // Execute query 
		mysqli_query($conn, $sql); 

    // Now let's move the uploaded image into the folder: image 
		if (move_uploaded_file($tempname, $folder)) { 
			$msg = "Image uploaded successfully"; 
		}else{ 
			$msg = "Failed to upload image"; 
		} 
	}
	
//-------------------------------------------------------------------------------
	
	// $check="select orggstnum from organisation where orggstnum='".$gstnumber."'";
	// $resultcheck=mysqli_query($conn,$check);



	// if(mysqli_num_rows($resultcheck)!=0 ){
		$sql="UPDATE organisation SET orgaddress = '".$address."', orgpno= '".$pno."', orgemail= '".$email."' WHERE orggstnum = '".$gstnumber."'";
		$result=mysqli_query($conn,$sql);

		if(!$result){
			echo $conn->error; 
		}

		// echo '<script>window.alert("done update of details")</script>';
		header("location: editProfile.php?added=true");

	// }
	// else{
	// 	header("location: editProfile.php?added=false");
	// }
	

	mysqli_close($conn);

	


	?>

