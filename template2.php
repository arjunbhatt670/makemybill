<?php 
session_start();
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    $current_email = $_SESSION["email"];
    $current_uid = $_SESSION["uid"];
}
else{
	header("location: login.php");
}


// $_SESSION['temp_flow']=false;
if(isset($_SESSION['temp_flow'])&&$_SESSION['temp_flow']===true){
    $_SESSION['temp_flow']=false;
    // header("location: dashboard.php");
  } else {
    header("location: dashboard.php");
    exit;
  }


// require_once "config.php";

require_once "conn.php";

$uid=$current_uid;
$bill_id=$_SESSION['bill_id'];
$orggstnum=$_SESSION["orggstnum"];


// echo $orggstnum;

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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="template2.css">
    <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

</head>
<body>
    
<!------ Include the above in your HEAD tag ---------->

<!--Author      : @arboshiki-->
<div id="invoice">
    <div class="invoice overflow-auto">
        <div style="min-width: 300px">
            <header>
                <div class="row">
                    <div class="col company-details">
                            <h2 style="font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;" class="text-center">
                            <?php echo $organisation_name; ?>
                            </h2>
                        <p class="text-center"><?php echo $address; ?></p>
                        <p class="text-center">GSTIN : <?php echo $gst; ?></p>
                        <p class="text-center">PNO : <?php echo $pno; ?></p>
                    </div>
                </div>
            </header>
            <main>
                <div class="row contacts">
                  
                    <div class="col invoice-details">
                        <h1 class="invoice-id text-center">TAX INVOICE</h1>
                        <br><br>
                        <table>
                            <tbody>
                                <tr>
                                    <div class=" text-left">
                                       <td style="background-color: white;"><h3 class="text-left">PARTY'S DETAILS</h3>  
                                       <h3 class="text-left">M/S <?php echo $cust_name; ?></h3>
                                       <h3 class="text-left"><?php echo $cust_address; ?></h3> 
                                       <h3 class="text-left"><?php echo$cust_phone; ?></h3></td>
                                    </div>
                                    <td style="background-color: white;">   
                                        <div class="date">INVOICE NO.  :  <?php echo $bill_id; ?>/2021</div>
                                        <div class="date">INVOICE DATE :  <?php $dt = new DateTime();
                                                                            echo $dt->format('Y-m-d');?></div>
                                        <div class="date">EWAY BILL NO. :  <?php echo rand(00000,99999);?>
                                        <br>
                                        <div class="date">PAYMENT METHOD :<b><span id="paymentMethod">
                                        </span></b></div>
                                        <script>
                                            document.getElementById('paymentMethod').innerHTML=sessionStorage.getItem("payment");
                                        </script>
                                        
                                    </td>
                                    
                                </tr>
                                
                            </tbody>
                        </table>
                        
                       
                    </div>
                </div>
                <table border="1px solid black" cellspacing="0" cellpadding="0">
                    <thead>
                        <tr style="border-top: 15px solid #030549;border-bottom: 15px solid #030549;">
                    
                            <th  style="" class="text-center">DESCRIPTION OF GOODS</th>
                            <th class="text-right">ITEM CODE</th>
                            <th class="text-right">RATE</th>
                            <th class="text-right">QUANTITY</th>
                            <th class="text-right">AMOUNT</th>
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

                                    // echo $item_name;
                    

                            echo '<tr  style=" border: 1px solid black;">';
                           
                            echo '<td style="border: 1px solid black;" class="">'.$item_name.'</td>';
                            echo '<td style="border: 1px solid black;" class="">'.$item_id.'</td>';
                            echo '<td style="border: 1px solid black;" class="">'.$rate.'</td>';
                            echo '<td style="border: 1px solid black;" class="">'.$quantity.'</td>';
                            echo '<td style="border: 1px solid black;" class="">'.$amount.'</td>';
                            
                            
                            echo '</tr>';

                            $sql5="UPDATE product SET `stock`= stock-'$quantity' WHERE `item_id` = '$item_id'";
                            if(!mysqli_query($conn,$sql5))
                            echo $conn->error;

                        }
                        ?>
                
                    </tbody>
                    <tfoot>
                        <tr style="background-color: #030549;">
                            <td colspan="2"></td>
                            <td style="color: white;" colspan="2">TOTAL AMOUNT</td>
                            <td style="color: white;">Rs. <?php echo $total; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2">Add CGST</td>
                            <td colspan="2">00%</td>
                            <td>00</td>
                        </tr>
                        <tr>
                            <td colspan="2">ADD SGST</td>
                            <td colspan="2">00%</td>
                            <td>00</td>
                        </tr>
                        <tr style="background-color: #030549;">
                            <td colspan="2"></td>
                            <td style="color: white;" colspan="2">GRAND TOTAL</td>
                            <td style="color: white;">Rs. <?php echo number_format($total); ?></td>
                        </tr>
                    </tfoot>
                </table>
                <script>
                    function Print(){
                        window.print();
                        location.href="dashboard.php";
                    }
               
                </script>
                <!-- <div class="notices">
                    
                    <div>Total Amount (INR - in Words) :</div>
                    <div class="notice">Twenty three thousands only</div>
                </div> -->
            </main>
            
            <footer style="color: black; font-weight: bolder;">
                For <?php echo $organisation_name; ?>
                <br><br><br>
                Authorised Signatory
            </footer>
            <button onclick="Print()">Print</button>
        
            
        </div>
    </div>
</div>
    

<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>