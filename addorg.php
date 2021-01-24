<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css?family=Lato|Patua+One&display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css'>
  

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
  <link href="css/addorg.css" rel="stylesheet">
  <script src="js/addorg.js"></script>
  <script >
    function VALIDATION() {
      var name=document.forms["orgform"]["cname"];
      var gstnumber=document.forms["orgform"]["cnumber"];

      if(name.value==""){
        window.alert("Company name cannot be blank");
        name.focus(); 
        return false; 
      }


      if(gstnumber.value==""){
        window.alert("GST number cannot be blank");
        gstnumber.focus(); 
        return false; 
      }

    }

  </script>



</head>
<body id="body">
<nav class="navbar">
    <div class="nav_icon" onclick="toggleSidebar()">
      <i class="fa fa-bars" aria-hidden="true"></i>
    </div>
    <div class="navbar__left">
      <a href="#">__</a>
    </div>
    <div class="navbar__right">
      <a href="#" style="margin-top: 7px;">

        Home&nbsp;

      </a>
      <a href="#">
        <br>
        <p id="popup" onclick="div_show()"> <span>Add Organisation&nbsp;<i class="fa fa-plus-square"></i></span></p>
      </div>
      <a class="btn btn-primary" href="edit_user.php">Edit User</a>
      <a class="btn btn-primary" href="logout.php">Logout</a>


    </nav>

  <div id="abc">


    <form class="addorgpop" action="addorgtodb.php" id="form" method="post" name="orgform" onsubmit="return VALIDATION()">

      <i id="close" class="fa fa-times" onclick ="div_hide()"></i>

      <h2>Add Organisation</h2>
      <hr>
      <input id="cname" name="cname" placeholder="Name" type="text">
      <input id="cnumber" name="cnumber" placeholder="GST Number" type="text">
      <br>
      <br>

      <input class="btn btn-primary" type="submit" value="Submit" name="submit">  
    </form>
  </div>
    <br>
    <br>
    <br>

    <?php
         $comment="";

         if(isset($_GET['added'])&&$_GET['added']=="true")
         $comment="Organisation Added Successfully";

         if(isset($_GET['added'])&&$_GET['added']=="false")
         $comment="Organizations cannot have same GST numbers";

         if($comment!=""){


          ?>

      <div class="personal-info">
        <div class="alert alert-success alert-dismissable">
          <a class="panel-close close" data-dismiss="alert" style="cursor : pointer">×</a>
          <i class="fa fa-coffee"></i>
          <?php echo $comment;?>
        </div>

          <?php

         }
    


        ?>

    <div class="container">           
      <div class="row">          
        <!-- <div class="card-group"> -->
         <?php
         require_once "conn.php";
        // Create connection
        //  $conn = mysqli_connect($servername, $username, $password,$db);
         if(!isset($_SESSION)) 
        { 
        session_start();
        } 
        // $_SESSION["loggedin"]=true;
         if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
          $current_uid = $_SESSION["uid"];
         } else{
            header("location: login.php");
         }
    // Check connection
         if (!$conn) {
           die("Connection failed: " . mysqli_connect_error());
         }
         $sql="select * from organisation where uid='$current_uid';";
         $result=mysqli_query($conn,$sql);
         if(mysqli_num_rows($result)>0)
         {
      //output data of each row
          while ($row = mysqli_fetch_assoc($result)) 
          {     

            $orgid=$row["orggstnum"];

            echo ' <div class="col-lg-3 col-md-12 col-sm-12">
            <div class="card">
            <i class="fa fa-users crd" style="background-color: rgb(17, 132, 136); height: 140px;" aria-hidden="true"></i>
            <div class="card-body">';

            echo "<b>Company : ".$row["orgname"]."</b><br>";
            echo "GST : ".$orgid."<br>";
            // echo "<b>Address : ".$row["orgaddress"]."</b><br>";
            // echo $row["orgpno"]."<br>";
            echo "<b>".$row["orgemail"]."</b><br><br>";
            // echo '<a href="dashboard.php">view</a>';
            $link="'deleteorg.php?id=".$orgid."'";
            echo '<form method="post" action="dashboard.php">
            <input type="text" name="orgid" value="'.$orgid.'" hidden>
            <button type="submit" style="margin: 10px 30px;" class="btn btn-primary rounded">View Dashboard</button></form>
        
            </div><button onclick="window.location.href='.$link.';" style="background-color :#ec550f ;" class="btn btn-primary rounded">Delete</button>
            
            </div>';
            // $st= sprintf('<a href="dashboard.php?orggstnum=%s&name=%s&img=%s" class="btn btn-primary rounded">&nbspView Dashboard&nbsp</a>',$row["orggstnum"],$row["orgname"],$row["orgimg"]);
            // echo $st;
            echo '</div>';
            // echo ' <a href="#dashboard.html" class="btn btn-outline-success btn-sm">View Dashboard</a>';
            
          } 

        }

        else
        {
          echo '<h4>You have not added any Organizations Yet!<h4>';

        }
        $conn->close();
        ?>
      <!-- </div> -->
    </div>
  </div>
  <br>
  <br>
</body>
</html>