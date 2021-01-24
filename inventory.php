<?php
session_start();
include "conn.php";
// $_SESSION["orggstnum"]=12345;
if(!isset($_SESSION["orggstnum"]))
{
header("refresh:0; url = login.php");
}
$user=$_SESSION["orggstnum"];
$total=0;
$query="SELECT * FROM product where orggstnum='$user'";
//$query="SELECT * FROM product";
$result=mysqli_query($conn,$query);
$count=mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inventory Page</title>
    <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
    <link rel="stylesheet" href="css/inventory.css">
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
  <link href="https://fonts.googleapis.com/css2?family=Sansita+Swashed&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css" integrity="sha512-1PKOgIY59xJ8Co8+NE6FZ+LOAZKjy+KY8iq0G4B3CyeY6wYHN3yt9PW0XpSriVlkMXe40PTKnXrLnZ9+fkDaog==" crossorigin="anonymous" />
  <link href="https://fonts.googleapis.com/css?family=Lato|Patua+One&display=swap" rel="stylesheet">
  <link rel='stylesheet' href='https://netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.min.css'>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  </head>

  <body style="margin: 1vw;">
  <h3><b>INVENTORY</b></h3>
  <?php
    $comment="";
    if(isset($_GET['added'])&&$_GET['added']=="true")
      $comment="Item Added Successfully";
        //  if(isset($_GET['added'])&&$_GET['added']=="false")
        //  $comment="Organizations cannot have same GST numbers";
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
      <div class="row info">
        <div class="row">
          <div class="col-auto">
            <input type="text" readonly class="form-control" placeholder="Item Name">
          </div>
          <div class="col-auto">
            <input type="float" readonly class="form-control" placeholder="Cost Price">
          </div>
          <div class="col-auto">
            <input type="float" readonly class="form-control" placeholder="Selling Price">
          </div>
          <div class="col-auto">
            <input type="float" readonly class="form-control" placeholder="Stock">
          </div>
        </div>
        <br>
        <br>
         <script>
        //  function changeText(){
        //    var input1=document.getElementById("edit").value;
        //    if(input1=="Edit")
        //    document.getElementById("edit").value="Ok";
        //    else{
        //       edit.setAttribute('type', 'submit');
        //    }
        //  }
         </script>
      <?php
      while ($row = mysqli_fetch_array($result)) {
      ?>
        <!-- <div class="col-auto">
        <input type="text" value="" readonly id="input 1" class="form-control" placeholder="Itm Id" > -->
        <div class="row">
       <div class="col-auto">
        <input type="text" value="<?php echo $row['item_name']; ?>" readonly class="form-control">
      </div> <div class="col-auto">
        <input type="float" value="<?php echo $row['price_cost']; ?>" readonly  class="form-control">
      </div> <div class="col-auto">
        <input type="float" value="<?php echo $row['price_sell']; ?>" readonly class="form-control">
      </div> <div class="col-auto">
        <input type="float" value="<?php echo $row['stock']; ?>" class="form-control">
      </div>
      <a href="editProduct.php?item_id=<?php echo $row['item_id']; ?>"><button id="edit" class="btn btn-danger">Delete</button></a>
      <!-- <div class="col-auto">
        <button id="edit" onclick="changeItem()" class="btn btn-outline-success">Edit</button>
      </div><br><br> -->
      </div><br><br>
      <?php
       }
      ?>

      <div>
        <button style="margin-top: 3vw; margin-left: 49vw;" class="btn btn-danger pull-right addProduct">+ Add Product</button>
        <a href="dashboard.php"><button style="margin-top: 3vw;" class="btn btn-danger">Back to Dashboard</button></a>
      </div>
     
    </div>   
                
    <div class="container collapse">
            <div class="row">
                <div class="col-md-offset-4 col-sm-offset-3 col-sm-12">
                    <div class="form-container">
                        <h3 class="title"><i class="far fa-caret-square-right"></i> Inventory</h3>
                        <form class="form-horizontal" method="POST" action="feed.php">
                            <!--<div class="form-group">
                                <label for="">Item Id</label>
                                <input type="text" id="id1" required class="form-control">
                            </div>-->
                            <div class="form-group">
                                <label for=""><b>Item Name</b></label>
                                <input type="text" name="item_name" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for=""><b>Cost Price/Unit</b></label>
                                <input type="float"  name="price_cost" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for=""><b>Selling Price/Unit</b></label>
                                <input type="float"  name="price_sell" required class="form-control">
                            </div>
                            <div class="form-group">
                                <label for=""><b>Stock</b></label>
                                <input type="float" name="stock" id="id4" required class="form-control">
                            </div>
                         
                            <button class="btn signup" >Submit</button>
                           
                        </form>
                    </div>
                </div>
            
            </div>
        </div>
        <br>
        <!-- <a href="addorg.php"><button class="btn btn-primary">BACK</button></a> -->
   <script> 
    $(".addProduct").click(function(){
        $(".collapse").collapse('show');
        $(".collapse").collapse('hide');
    });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
      crossorigin="anonymous"></script>
  </body>
</html>
