<?php
session_start();
require_once "conn.php";
$usergst=$_SESSION['orggstnum'];
$uid=$_SESSION['uid'];


if(isset($_SESSION['temp_flow'])&&$_SESSION['temp_flow']===false){
  header("location: dashboard.php");
}

$sql1="select * from organisation where orggstnum='$usergst'";
  $result1=mysqli_query($conn,$sql1);
  $row1 = mysqli_fetch_assoc($result1);

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
     <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="styles.css" />
    <title> DASHBOARD</title>
  </head>
  <body id="body">
    <div class="container k">
      


      <main>



        <br>
        <div class="template">

        <h3 class="temp">Choose a Template</h3>
         
        <hr>

        </div>

        <div class="main__container k">



        <script>

          function confirm1(){
            if(confirm("Do you want to print the receipt?"))
              location.href="template1.php";
          }

          function confirm2(){
            if(confirm("Do you want to print the receipt?"))
              location.href="template2.php";
          }
        </script>
         
         <br>
          <div class="main__cards">
        
                <div class="pair">
                <img src="assets/template 2.jpeg" width="360" height="400">
               
                <button onclick="confirm1()" class="btn btn-info">Select</button>
                </div>
            
            <div class="pair">
                <img src="assets/temp 5.jpeg" width="360" height="400">
               
                 <button onclick="confirm2()" class="btn btn-info">Select</button>
                </div>


                <div class="pair">
                    <img src="assets/template 1.jpeg" width="360" height="400">
                   
                    <button class="btn btn-info">Select</button>
                    </div>
                <div class="pair">
                    <img src="assets/temp 4.jpeg" width="360" height="400">
                   
                    <button class="btn btn-info">Select</button>
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
<h1>&nbsp;&nbsp;<?php echo $row1['orgname']; ?>&nbsp;&nbsp;</h1>
          </div>
          <i
            onclick="closeSidebar()"
            class="fa fa-times"
            id="sidebarIcon"
            aria-hidden="true"
          ></i>
        </div>
         
        <div class="sidebar__menu">

        
          <div class="sidebar__link">
            <i class="fa fa-home"></i>
            <a href="dashboard.php">Dashboard</a>
          </div>

          <h2>LEAVE</h2>
         
          <div class="sidebar__logout">
            <i class="fa fa-power-off"></i>
            <a href="#">Log out</a>
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
    <script src="script.js"></script>
  </body>
</html>