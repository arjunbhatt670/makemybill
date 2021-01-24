<?php
  session_start();
  require_once "conn.php";
  if(!isset($_SESSION['orggstnum'])){
    header('location : addorg.php');
  }

  $orgid=$_SESSION['orggstnum'];
  $sql1="select * from organisation where orggstnum='$orgid'";

    $result=mysqli_query($conn,$sql1);
    $row = mysqli_fetch_array($result);


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Profile</title>
  <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
  <link rel="stylesheet" type="text/css" href="css/editprofile.css" />
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu" />
  <link
  href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css"
  rel="stylesheet"
  integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1"
  crossorigin="anonymous"
  />
</head>

<script >
  function VALIDATION() {

    var gstnumber=document.forms["orgform"]["cnumber"];
    if(gstnumber.value==""){
      window.alert("GST number cannot be blank");
      gstnumber.focus(); 
      return false; 
    }

  }

</script>


<body>
  <div class="container">
    <h1 style="padding: 20px" >Edit Profile</h1>
    <hr />
    <div class="row">
      <!-- <h4 class="p-2">Upload Your Logo</h4> -->
      <!-- edit form column -->
      <?php
         $comment="Enter GST number and Organisation name to edit details";
         if(isset($_GET['added'])&&$_GET['added']=="true")
         $comment="ORGANISATION DEATILS EDITED SUCCESSFULLY !";
          ?>

      <div class="personal-info">
        <div class="alert alert-success alert-dismissable">
          <a class="panel-close close" data-dismiss="alert" style="cursor : pointer">×</a>
          <i class="fa fa-coffee"></i>
          <?php echo $comment;?>
      </div>

      <!-- <div class="col-md-8 personal-info">
        <div class="alert alert-success alert-dismissable">         
          Enter GST number and Organisation name to edit details
        </div> -->
        <h3>Add/Edit details</h3>

        <form action="editdetails.php" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">
          <br />
          <div class="form-group">
          <label class="col-lg-3 control-label">Organization Address:</label>
            <div class="col-lg-8">
              <input class="form-control" value="<?php echo $row['orgaddress']; ?>" name ="address" type="text" placeholder="Address" />
            </div>
          </div>
          <br />
          <div class="form-group">
            <label class="col-lg-3 control-label">GST Number:</label>
          <div class="col-lg-8">
            <input
            class="form-control"
            type="text"
            placeholder="GST Number"
            name ="cnumber"; 
            value="<?php echo $_SESSION['orggstnum'];?>"
            readonly
            />
          </div>
        </div>
        <br />
        <div class="form-group">
        <label class="col-lg-3 control-label">Phone No:</label>
        <div class="col-lg-8">
          <input
          name ="pno"; 
          class="form-control"
          type="number"
          placeholder="Phone Number"
          value="<?php echo $row['orgpno']; ?>"
          />
        </div>
      </div>
      <br />
      <div class="form-group">
      <label class="col-lg-3 control-label">Email Address:</label>
      <div class="col-lg-8">
        <input name ="email" class="form-control" value="<?php echo $row['orgemail']; ?>" type="text" placeholder="Email" />
      </div>
    </div>

    <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-8">
        
          <strong>Upload Company Logo</strong>
          <br>
            <input type="file" name="uploadfile" value=""/> 
            <br><br>
            <button class="btn btn-primary" type="submit" name="upload">UPDATE</button> 
            <script>
              function goBack() {
              window.history.back();
              }
              </script>
      </div>
    </div>
  </form><br><a href="dashboard.php"><button class="btn btn-danger">Back to Dashboard</button></a>
</div>
</div>
</div>
<hr />
<script>
  function showPreviewOne(event) {
    if (event.target.files.length > 0) {
      let src = URL.createObjectURL(event.target.files[0]);
      let preview = document.getElementById("logoImg");
      preview.src = src;
      preview.style.display = "block";
    }
  }
</script>

<script
src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW"
crossorigin="anonymous"
></script>
</body>
</html>
