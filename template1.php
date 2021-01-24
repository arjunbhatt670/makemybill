<?php
session_start();
require_once "conn.php";

// $_SESSION["loggedin"] = true;
// $_SESSION["uid"]="1";

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // $current_email = $_SESSION["email"];
    $current_uid = $_SESSION["uid"];
    $current_org = $_SESSION["orggstnum"];
    // $payment = $_SESSION["payment"];
}
else{
	header("location: login.php");
}

if(isset($_SESSION['temp_flow'])&&$_SESSION['temp_flow']===true){
  $_SESSION['temp_flow']=false;
  // header("location: dashboard.php");
} else {
  header("location: dashboard.php");
  exit;
}



$uid=$current_uid;
$bill_id=$_SESSION['bill_id'];
$orggstnum=$_SESSION["orggstnum"];

$sql="SELECT * from organisation where uid='$uid' and orggstnum='$orggstnum'";
if($stmt=mysqli_query($conn,$sql)){
        if($row=mysqli_fetch_array($stmt)){
            $organisation_name=$row['orgname'];
            $gst=$row['orggstnum'];
            $address=$row['orgaddress'];
            $image=$row['orgimg'];
            $email=$row['orgemail'];
            $pno=$row['orgpno'];
        }
}



$sql2="SELECT * from cust_details where bill_id='$bill_id' and orggstnum='$orggstnum'";
if($stmt2=mysqli_query($conn,$sql2)){
        if($row2=mysqli_fetch_array($stmt2)){
            $cust_name=$row2['cust_name'];
            $cust_phone=$row2['cust_phone'];
            $cust_address=$row2['cust_address'];
            $cust_gst=$row2['cust_gst'];
        }
}

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
    <title>Bill Template</title>
  </head>
  <body style="font-family: Ubuntu">
    <div class="container">
        <div class="row">
          <div class="col-7">
            <p><h3><?php echo $organisation_name; ?></h3></p>
            <p><?php echo $address; ?></p>
            <p><?php echo $email; ?></p>
            <p><?php echo $pno; ?></p>
            <p><?php echo $gst; ?></p>
            
          </div>
          <div class="col-3">
            <p><h3>INVOICE</h3></p>
            <table class="table" style="table-layout: auto">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">INVOICE NUMBER</th>
                    <th scope="col">DATE</th>
                    <th scope="col">CUSTOMER ID</th>
                    <th scope="col">EWAY BILL NO.</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row"><?php echo $bill_id; ?>/2021</th>
                    <td ><?php $dt = new DateTime(); echo $dt->format('Y-m-d');?></td>
                    <td ><?php echo $bill_id; ?></td>
                    <td > <?php echo rand(00000,99999);?></td>
                    <!-- <td>@mdo</td> -->
                  </tr>
                </tbody>
              </table>

          </div>
          
        </div>
        
        <div class="row" >
        <div  class="col-6">
          <p style="background-color: darkgrey; font-family: Ubuntu;"><b> BILL TO</b></p>
          <p><?php echo $cust_name; ?></p>
          <p><?php echo $cust_phone; ?></p>
          <p><?php echo $cust_address; ?></p>
 
        </div>
        <div class="col-6">
          <p style="background-color: darkgrey; font-family: Ubuntu"><b> SHIP TO</b></p>
          <p><?php echo $cust_name; ?></p>
          <p><?php echo $cust_phone; ?></p>
          <p><?php echo $cust_address; ?></p>
        </div>
        </div>
        <br>
        <table class="table">
            <thead class="thead-light">
              <tr>
                <th scope="col">DESCRIPTION</th>
                <th scope="col">QTY</th>
                <th scope="col">UNIT PRICE</th>
                <th scope="col">AMOUNT</th>
              </tr>
            </thead>
            <tbody>
           <?php

              $sql3="SELECT * from bill where bill_id='$bill_id' and orggstnum='$orggstnum'";

              // $result3=$mysqli->query($sql3);

              $result3=mysqli_query($conn,$sql3);
              $count3=mysqli_num_rows($result3);

              // if($count3>0){

              // }

                  $total=0;
              while($row3 = mysqli_fetch_array($result3)){
                          $item_name=$row3['item_name'];
                          $item_id=$row3['item_id'];
                          $rate=$row3['price'];
                          $quantity=$row3['quantity'];
                          $amount=$rate*$quantity;
                          $total+=$amount;

              echo '<tr>
                <th scope="row">'.$item_name.'</th>
                <td>'.$quantity.'</td>
                <td>'.$rate.'</td>
                <td>'.$amount.'</td>
              </tr>' ;

                // $sql4="select stock from product where item_id='$item_id'";
                // $result4=mysqli_query($conn,$sql4);
                // $row4 = mysqli_fetch_array($result4);
                // echo $stock=$row4['stock'];

              $sql5="UPDATE product SET `stock`= stock-'$quantity' WHERE `item_id` = '$item_id'";
              if(!mysqli_query($conn,$sql5))
              echo $conn->error;

              }
              ?>
            </tbody>
          </table>  
          <div class="row">
              <div class="col-9">

              </div>
              <div class="col-3">
                  <div class="row">

                  
                  <div class="col-3">
                      <p>TOTAL</p>
                  </div>
                  <div class="col-9">
                  Rs. <?php echo number_format($total); ?>
                  </div>
                  <div class="col-3">
                      <p>PAYMENT METHOD</p>
                  </div>
                  <b>
                  <div class="col-9" id="paymentMethod">
                  </div>
                  </b>
                  </p>
                  <script>
                    document.getElementById('paymentMethod').innerHTML=sessionStorage.getItem("payment");
                  </script>
              </div>
              </div>
              <script>
                    function Print(){
                        window.print();
                        location.href="dashboard.php";
                    }
               
                </script>
              <button onclick="Print()">Print</button>
          </div>
    <br>
    <br>
    
    <center>For any query about the invoice please contact</center> 
    
    
    <center><?php echo $organisation_name; ?>, <?php echo $address; ?>, <?php echo $email; ?> </center>
    
</div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>