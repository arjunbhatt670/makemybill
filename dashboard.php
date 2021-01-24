<?php
session_start();

//  echo '<pre>';
//     var_dump($_SESSION);
//     echo '</pre>';
include "conn.php";

      $i=1;
      while($i < 1000){
        // echo $i;
        if(isset($_SESSION['quant'.$i]))
        unset($_SESSION['quant'.$i]);
        else
      break;
        $i++;
      }

// $_SESSION["orggstnum"];

if(!isset($_SESSION["loggedin"]))
{
header("location: login.php");
exit;
}


if(isset($_POST['orgid'])){
  $_SESSION['orggstnum']=$_POST['orgid'];
}

$usergst=$_SESSION['orggstnum'];

if(isset($_SESSION['temp_flow'])){
unset($_SESSION['temp_flow']);
}




$sql4="select * from organisation where orggstnum='$usergst'";
$result4=mysqli_query($conn,$sql4);
$row4 = mysqli_fetch_array($result4);
$username=$row4["orgname"];
$userlogo=$row4["orgimg"];




$sql3="SELECT * from bill where orggstnum='$usergst'";

// $result3=$mysqli->query($sql3);

$result3=mysqli_query($conn,$sql3);


$sql2="SELECT * from cust_details where orggstnum='$usergst'";
$result2=mysqli_query($conn,$sql2);
$count2=mysqli_num_rows($result2);

    $sp=0;
    $cp=0;

while($row3 = mysqli_fetch_array($result3)){
            $item_id=$row3['item_id'];
            $rate=$row3['price'];
            $quantity=$row3['quantity'];
            $amount=$rate*$quantity;
            $sp+=$amount;

            $sql="SELECT * from product where item_id='$item_id'";
            $result=mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result);
            $cp+=($row['price_cost']*$quantity);



}
$profit=0;
if($sp!=0&&$cp!=0)
$profit=round(($sp-$cp)*100/$cp, 2);




//$total=0;
//$query="SELECT * FROM organisation where orggstnum='$user'";
//$query="SELECT * FROM product";
//$result=mysqli_query($conn,$query);
//$count=mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="css/dashboard.css" />
    <title> DASHBOARD</title>
  </head>
  <body id="body">
    <div class="container k">
      <nav class="navbar">
        <div class="nav_icon" onclick="toggleSidebar()">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
        <div class="navbar__left">
          <a href="#">__</a>
       
        </div>
        <div class="navbar__right">
          <a href="#">
            Home&nbsp;
           
          </a>
        <div class="btn-group user_profile" style="float: right;">
        <?php

            $img = mysqli_query($conn, "SELECT orgimg FROM organisation where orggstnum='$usergst'");
                
                $row = mysqli_fetch_array($img); 
        ?> 
                 <?php echo '<img src="images/'.$row['orgimg'].'" width="20" height="20" class="btn btn-sec dropdown-toggle kk" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                 ?>
                  <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item" type="button" formaction="addorg.php">Add Organisation</button>
                    <button class="dropdown-item" type="button" formaction="">GST Number</button>
                  </div>
                  </div>
               </div>
      </nav>


      <main>
        <div class="main__container k">
         

          <div class="main__title">
            <img src="assets/hello.svg" alt="" />
            <div class="main__greeting">
              <h1>Hello <?php echo $username; ?>!</h1>
              <p>Welcome to your dashboard</p>
            </div>
          </div>

         
          <div class="main__cards">
            <div class="card">
            
              <div class="card_inner">
                <p class="text-primary-p">Expenses</p>
                <span class="font-bold text-title"><?php echo $cp; ?></span>
              </div>
            </div>

            <div class="card">
            
              <div class="card_inner">
                <p class="text-primary-p">Sales</p>
                <span class="font-bold text-title"><?php echo $sp; ?></span>
              </div>
            </div>

            <div class="card">
           
              <div class="card_inner">
                <p class="text-primary-p">Profit</p>
                <span class="font-bold text-title"><?php echo $profit; ?></span>
              </div>
            </div>
           

            <div class="card">
            
              <div class="card_inner">
                <p class="text-primary-p">Orders</p>
                <span class="font-bold text-title"><?php echo $count2; ?></span>
              </div>
            </div>
          </div>
        </div>
      </main>
       
      <div id="sidebar" style="height: 100%;">
        <br>
        <div class="sidebar__title">
          <div class="sidebar__img">

          <?php

            $img = mysqli_query($conn, "SELECT orgimg FROM organisation where orggstnum='$usergst'");
                
                $row = mysqli_fetch_array($img); 
          ?> 
            <?php echo '<img src="images/'.$row['orgimg'].'" height="100" width="100" style="border-radius : 50%;" aria-haspopup="true" aria-expanded="false">';
                 ?>
            <!-- <img src="assets/logo.png" alt="logo" style="margin-left: 0;" /> -->
            <h1>&nbsp;&nbsp;<?php echo $username ?>&nbsp;&nbsp;</h1>
          </div>
          <i
            onclick="closeSidebar()"
            class="fa fa-times"
            id="sidebarIcon"
            aria-hidden="true"
          ></i>
        </div>
         
        <div class="sidebar__menu">
          <div class="sidebar__link active_menu_link">
            <i class="fa fa-home"></i>
            <a href="#">Dashboard</a>
          </div>
      
          <div class="sidebar__link">
            <i class="fa fa-user-plus" aria-hidden="true"></i>
            <a href="addorg.php">Add Organisation</a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-user-secret" aria-hidden="true"></i>
            <a href="cust_details.php">Billing</a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-building-o"></i>
            <a href="inventory.php">Inventory</a>
          </div>
          <div class="sidebar__link">
            <i class="fa fa-wrench"></i>
            <a href="editprofile.php">Edit Organization Details</a>
          </div>
          
          <br>
          <h2><a href="addorg.php">LEAVE</a></h2>
         
          <div class="sidebar__logout">
            <i class="fa fa-power-off"></i>
            <a href="logout.php?dash=true">Log out</a>
          </div>
        </div>
      </div>
    </div>
    
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
<script src='http://cdn.jsdelivr.net/jquery.slick/1.6.0/slick.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="js/dashboard.js"></script>
  </body>
</html>
