<?php
session_start();
include "conn.php";

$_SESSION['temp_flow']=true;

if(isset($_GET['bill_id']))
$_SESSION["bill_id"]=$_GET['bill_id'];
// else
// header("location: login.php");


if(!isset($_SESSION["orggstnum"]))
{
header("refresh:0; url = login.php");
}
$user=$_SESSION["orggstnum"];


// $count=0;
if($_SERVER["REQUEST_METHOD"] == "POST"){


    $item_id=$_POST['item_id'];
    $j=$_POST['quant_var'];
    $_SESSION['quant'.$j]=$quantity=$_POST['quantity'];
    $bill_id=$_SESSION["bill_id"];
    $orggstnum=$_SESSION["orggstnum"];

  //   if($_SESSION['quant'.$j]=="")
  // $count++;

  // $_SESSION['quant'.$j]=$quantity;
    
//take item details from product table
    $sql1="select * from product where orggstnum='$user' and item_id='$item_id'";

    $result=mysqli_query($conn,$sql1);
    $row = mysqli_fetch_array($result);

    $item_name=$row['item_name'];
    $price=$row['price_sell'];

    if($row['stock']<$quantity){
      echo "<script>alert('Out of stock value!!');
                    window.history.back();</script>";
      $_SESSION['quant'.$j]="";
      exit;
      // header("location: add_to_bill.php");  
    }



    //insert data to bill table

    $sql2 = "SELECT item_id FROM bill WHERE item_id = '$item_id' and bill_id='$bill_id'";
    $select = mysqli_query($conn,$sql2);
    if(mysqli_num_rows($select) ==0){
      $sql="insert into bill(bill_id, orggstnum, item_id, item_name, quantity, price) 
      values('$bill_id','$orggstnum','$item_id','$item_name','$quantity','$price')";
      if(!mysqli_query($conn, $sql)){
        echo $conn->error;
      }
        
    } else{
      $sql="UPDATE bill SET `quantity` = '$quantity' WHERE `bill_id` = '$bill_id' AND `item_id` = '$item_id'";
      if(!mysqli_query($conn, $sql)){
        echo $conn->error;
      }
    }
    








}






?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Billing</title>
    <link rel="stylesheet" href="css/style_bill.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu"/>
    <style>
    .btn-success{
        border-radius: 20px;
        width: fit-content;
    }
    h2{
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
          <?php

          $query="SELECT * FROM cust_details where orggstnum='$user'";
          //$query="SELECT * FROM product";
          $result1=mysqli_query($conn,$query);
          $count=mysqli_num_rows($result1);

          $i=1;
          while ($row1= mysqli_fetch_array($result1)) {
            if(!isset($_SESSION['quant'.$i]))
            $_SESSION['quant'.$i]="";
          ?> 
        </tr>
        <br>
        <tr style="margin-top: 10px;">
          <td class="cust_name"><?php echo $row1['cust_name'];?></td>
          <td class="cust_gst"><?php echo $row1['cust_gst'];?></td>
          <td><form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button type="submit" class="btn btn-success">GO</button></td>
          </form>
        </tr>
        
        
      <!--<tr style="margin-top: 10px;>
          <td class="id">1</td>
          <td class="item_name">3</td>
          <td class="price">7</td>
          <td class="quantity"><input type="text" class="quantity_to_bill"></td>
          <td class="add_bill"><button class="btn btn-success">Add To Bill</button></td>
          </tr>-->
                
      </table>
    </div>
    <br>
    <a href="select_temp.php" style="text-decoration: none;color: white;"><button class="btn btn-primary" style="align: center"> NEXT</button></a>
    <button class="btn btn-primary" onclick="goBack()">BACK</button>
    <script>
      function goBack() {
      window.history.back();
      }
    </script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
      crossorigin="anonymous"
    >
  </body>
</html>
