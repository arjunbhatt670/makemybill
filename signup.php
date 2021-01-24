<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "icon" href =  "assets/ed5.png" type = "image/x-icon">
    <link rel="stylesheet" media="screen and (max-width: 1170px)" href="css/phone.css">
    <link rel="stylesheet" href="css/logstyle.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Ubuntu"/>
    <title>Sign Up</title>
</head>
<body>
    <div id="container">
   <div class="signup">
       <form method="post" action="verify_user.php?verify=ok" onsubmit="return check()">
          <h2 style="color: #fff;">Sign Up</h2>
          <input type="text" id="fname" name="fname" placeholder="First name" required>
          <br><br>
          <input type="text" id="lname" name="lname" placeholder="Last name" required>
          <br><br>
          <input type="date" id="dob" name="dob" placeholder="DOB" required>
          <br><br>
          <input type="text" id="phone" name="phone" placeholder="Phone" required onblur="validate('mobilenum','mobnoerror',this.value)">
          <label id="mobnoerror" class="error"></label>
          <br><br>
          <input type="email" id="email" name="email" placeholder="Email" required onblur="validate('email','emailerror',this.value)">
          <label id="emailerror" class="error"></label>
          <br><br>
          <input type="password" id="pass1" name="pass1" placeholder="Password" required onblur="validate('password','passerror',this.value)">
          <label id="passerror" class="error"></label>
          <br><br>
          <input type="password" id="pass2" name="pass2" placeholder="Confirm Password" required>
          <label id="passerror2" class="error"></label>
          <br><br>
          
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
                <br><br>

                <input type="text" id="city" name="city" placeholder="City" required>
          <br><br>
          <input type="submit" value="Sign Up"><br><br>
          &nbsp;&nbsp;&nbsp;Already have Acoount?&nbsp;&nbsp;&nbsp;<a href="login.php">Log In</a>

          
         

       </form>
   </div>
</div>
   
</body>
<script type="text/javascript" src="js/validate.js"></script>
<script type="text/javascript" src="js/signup.js"></script>
</html>
