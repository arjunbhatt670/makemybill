<?php
  session_start();
  require_once "conn.php";
  if(!isset($_SESSION['orggstnum'])){
    header('location : addorg.php');
  }
  $uid=$_SESSION["uid"];
  $sql="select * from user_details where user_id='$uid'";
  $result=mysqli_query($conn,$sql);
  $row = mysqli_fetch_assoc($result);


  if($_SERVER["REQUEST_METHOD"] == "POST"){
      $phone=$_POST['phone'];
      $state=$_POST['state'];
      $city=$_POST['city'];

      $sql2="UPDATE user_details SET phone='$phone', state='$state', city='$city'  WHERE user_id='$uid'";
      if(mysqli_query($conn, $sql2)){
        $comment="Details updated successfully";
      } else{
          echo $conn->error;
      }
  }

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
    //   $comment="";
      if($_SERVER["REQUEST_METHOD"] != "POST")
         $comment="Edit your personal details.";
          ?>

      <div class="personal-info">
        <div class="alert alert-success alert-dismissable">
          <!-- <a class="panel-close close" data-dismiss="alert" style="cursor : pointer">×</a> -->
          <i class="fa fa-coffee"></i>
          <?php echo $comment;?>
      </div>

      <!-- <div class="col-md-8 personal-info">
        <div class="alert alert-success alert-dismissable">         
          Enter GST number and Organisation name to edit details
        </div> -->
        <h3>Add/Edit details</h3>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form-horizontal" role="form" method="post" enctype="multipart/form-data">

        <br />
          <div class="form-group">
          <label class="col-lg-3 control-label">Name</label>
            <div class="col-lg-8">
              <input class="form-control" name ="name" type="text" value="<?php echo $row['firstname'].' '.$row['lastname']; ?>" />
            </div>
          </div>
         <br>
          <div class="form-group">
          <label class="col-lg-3 control-label">Email</label>
            <div class="col-lg-8">
              <input class="form-control" name ="email" type="text" value="<?php echo $row['email']; ?>" />
            </div>
          </div>


          <br />
          <div class="form-group">
          <label class="col-lg-3 control-label">Phone number</label>
            <div class="col-lg-8">
              <input class="form-control" name ="phone" type="text" placeholder="Phone number" />
            </div>
          </div>
          <br />

          <div class="form-group">
          <label class="col-lg-3 control-label">State</label>
            <div class="col-lg-8">
            <select name="state" id="state" class="form-control" oninvalid="this.setCustomValidity('Please Select the state')" oninput="setCustomValidity('')" required>
                <option value="">Select State</option>
                <option value="Andhra Pradesh">Andhra Pradesh</option>
                <option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
                <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                <option value="Assam">Assam</option>
                <option value="Bihar">Bihar</option>
                <option value="Chandigarh">Chandigarh</option>
                <option value="Chhattisgarh">Chhattisgarh</option>
                <option value="Dadar and Nagar Haveli">Dadar and Nagar Haveli</option>
                <option value="Daman and Diu">Daman and Diu</option>
                <option value="Delhi">Delhi</option>
                <option value="Lakshadweep">Lakshadweep</option>
                <option value="Puducherry">Puducherry</option>
                <option value="Goa">Goa</option>
                <option value="Gujarat">Gujarat</option>
                <option value="Haryana">Haryana</option>
                <option value="Himachal Pradesh">Himachal Pradesh</option>
                <option value="Jammu and Kashmir">Jammu and Kashmir</option>
                <option value="Jharkhand">Jharkhand</option>
                <option value="Karnataka">Karnataka</option>
                <option value="Kerala">Kerala</option>
                <option value="Madhya Pradesh">Madhya Pradesh</option>
                <option value="Maharashtra">Maharashtra</option>
                <option value="Manipur">Manipur</option>
                <option value="Meghalaya">Meghalaya</option>
                <option value="Mizoram">Mizoram</option>
                <option value="Nagaland">Nagaland</option>
                <option value="Odisha">Odisha</option>
                <option value="Punjab">Punjab</option>
                <option value="Rajasthan">Rajasthan</option>
                <option value="Sikkim">Sikkim</option>
                <option value="Tamil Nadu">Tamil Nadu</option>
                <option value="Telangana">Telangana</option>
                <option value="Tripura">Tripura</option>
                <option value="Uttar Pradesh">Uttar Pradesh</option>
                <option value="Uttarakhand">Uttarakhand</option>
                <option value="West Bengal">West Bengal</option>
                </select>
            </div>
          </div><br>

          <div class="form-group">
            <label class="col-lg-3 control-label">City</label>
          <div class="col-lg-8">
            <input
            class="form-control"
            type="text"
            placeholder="City"
            name ="city"; 
            />
          </div>
        </div>
        <br />
        <!-- <div class="form-group">
        <label class="col-lg-3 control-label">Phone No:</label>
        <div class="col-lg-8">
          <input
          name ="pno"; 
          class="form-control"
          type="number"
          placeholder="Phone Number"
          />
        </div>
      </div>
      <br />
      <div class="form-group">
      <label class="col-lg-3 control-label">Email Address:</label>
      <div class="col-lg-8">
        <input name ="email" class="form-control" type="text" placeholder="Email" />
      </div>
    </div> -->

    <div class="form-group">
      <label class="col-md-3 control-label"></label>
      <div class="col-md-8">
            <button class="btn btn-primary" type="submit" name="upload">Save</button> 
            <button class="btn btn-danger" onclick="goBack()">BACK</button>
            <script>
              function goBack() {
              window.history.back();
              }
              </script>
      </div>
    </div>
  </form>
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
