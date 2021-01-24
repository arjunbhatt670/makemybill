<?php
session_start();
include "conn.php";
if(!isset($_SESSION["orggstnum"]))
header("location: login.php");
$user=$_SESSION["orggstnum"];
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(!$_POST['cust_name']){
        $cust_name=$_POST['cust_name2'];
        $cust_gst=$_POST['cust_gst2'];
        $cust_phone=$_POST['cust_phone2'];
        $cust_address=$_POST['cust_address2'];
        
    }
    else{
        $cust_name=$_POST['cust_name'];
        $cust_gst=$_POST['cust_gst'];
        $cust_phone=$_POST['cust_phone'];
        $cust_address=$_POST['cust_address'];
        

    }
    $org_id=$_SESSION['orggstnum'];

    $sql="insert into cust_details(cust_name, cust_phone, cust_address, orggstnum, cust_gst) values('$cust_name','$cust_phone','$cust_address','$org_id', '$cust_gst')";

    if(mysqli_query($conn, $sql)){
        $query="SELECT * FROM cust_details where bill_id=(select max(bill_id) from cust_details)";
        $result=mysqli_query($conn,$query);
        if(!$result){
            echo $conn->error;
            exit;
        }
        
        $row = mysqli_fetch_array($result);
        header("location: add_to_bill.php?bill_id=".$row['bill_id']);
    }
        
        else
        echo $conn->error;

}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Billing</title>
    <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
    <link rel="stylesheet" href="css/style_bill.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
  <style>
       .btn-success{
     border-radius: 20px;
     width: fit-content;
 }
 h2{
     font-family: Ubuntu;
 font-size: 25px;
 letter-spacing: 3px;
 text-align: center;
 margin: 40px 0;
}
hr{
 width: 30%;
 margin: 0 auto;
 background-color: black;
}
</style>
</head>
  <body style="margin: 3vw;">
<h1><b>ADD EXISTING CUSTOMER</b></h1>
    <hr>
    <br>
    <br>
    <div class="content">
      <table style="margin:0 auto">
        <tr class="head_table">
          <td id="cust_name">Customer Name</td>
          <td id="cust_gst">GST NO</td>
          <td id="cust_phone">Customer Phone</td>
          <td id="cust_address">Customer Address</td>
          <?php

          $query="SELECT DISTINCT cust_name, cust_gst, cust_phone, cust_address FROM cust_details where orggstnum='$user'";
          //$query="SELECT * FROM product";
          $result1=mysqli_query($conn,$query);
          $count=false;
          if($result1)
          $count=mysqli_num_rows($result1);

          if($count)
          while ($row1= mysqli_fetch_array($result1)) {
            
          ?> 
        </tr>
        <br>
        <tr style="margin-top: 10px;">
          <td class="cust_name"><?php echo $row1['cust_name'];?></td>
          <td class="cust_gst"><?php echo $row1['cust_gst'];?></td>
          <td class="cust_phone"><?php echo $row1['cust_phone'];?></td>
          <td class="cust_address"><?php echo $row1['cust_address'];?></td>
          <td><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="text" value="<?php echo $row1['cust_name'];?>" name="cust_name2" hidden>
            <input type="text" value="<?php echo $row1['cust_gst'];?>" name="cust_gst2" hidden>
            <input type="text" value="<?php echo $row1['cust_phone'];?>" name="cust_phone2" hidden>
            <input type="text" value="<?php echo $row1['cust_address'];?>" name="cust_address2" hidden>
            <button type="submit" class="btn btn-success">GO</button></td>
          </form>
        </tr>
        <?php
       }
       else
          echo '<tr style="margin-top: 10px;">
           <td colspan="2" class="">No history of customers</td>
       
            </tr>';
       ?>
    </table>
</div>


<h4> ADD CUSTOMER DETAILS </h4>

  <div class="container">
        <div class="row">
            <div class="col-md-offset-4 col-sm-offset-3 col-sm-12">
                <div class="form-container">
                    <h3 class="title"><i class="far fa-caret-square-right"></i><b>Enter Details<b></h3>
                    <form class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                        <div class="form-group">
                            <label for=""><b>Customer name</b></label>
                            <input type="text" name="cust_name" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for=""><b>Customer GST</b></label>
                            <input type="text" name="cust_gst" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for=""><b>Customer phone number<b></label>
                            <input type="tel" name="cust_phone" required class="form-control">
                        </div>
                        <div class="form-group">
                            <label for=""><b>Shipping address</b></label>
                            <input type="text" name="cust_address" required class="form-control">
                        </div>
                        <button type="submit" class="btn signup">Submit</button>
                        <br>
                        <button class="btn signup" onclick="goBack()">Back</button>
                        <script>
                        function goBack() {
                        window.history.back();
                        }
                        </script>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </body>
</html>
