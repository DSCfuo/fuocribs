<?php
require_once 'db/connect.php';
require_once 'validate.php';
require_once 'include/header.php';

if (isset($_SESSION['user_id'])){
    header('');
  }
  else {
    $output_form = true;
    $success_msg = false;
    $fullnameErr  = $usernameErr = $emailErr  = $phoneErr = "";
    $pwd1Err = $pwd2Err = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
		function form_err($text) {
			return "<span style='display:block; margin-top: 2%; font-size: 16px; color:red'>$text</span>";
		}
      if (empty($_POST['fullname'])){
        $fullnameErr = "fullname is required";
      }
      else {
        if (!preg_match("/^[a-zA-Z ]+$/",$_POST['fullname'])){
          $fullnameErr = form_err("Only letters and spaces are allowed");
        }
        else {
          if (strlen($_POST['fullname']) < 3) {
            $fullnameErr = form_err("Name is too short");
          }
          else {
            $fullname = test_input($_POST['fullname']);
          }
        }
	  }
	  
	  if (empty($_POST['phone'])){
        $phoneErr = form_err("Phone number is required");
      }
      else {
        if (!preg_match("/^0[789]\d{9}$/",$_POST['phone'])){
          $phoneErr = form_err("Invalid phone number");
        }
        else {
          if (strlen($_POST['fullname']) < 3) {
            $phoneErr = form_err("Invalid phone number");
          }
          else {
            $phone = test_input($_POST['phone']);
          }
        }
      }


      if (empty($_POST['username'])){
        $usernameErr = form_err("Username is required");
      }
      else {
        if (!preg_match("/^[a-zA-Z ]+[0-9]*?$/",$_POST['username'])){
          $usernameErr = form_err("Only letters and numbers are allowed");
        }
        else if ($_POST['username'] == "admin"){
          $usernameErr = form_err("Invalid username");
        }
        else {
          if (strlen($_POST['username']) < 4) {
            $usernameErr = form_err("Invalid username");
          }
          else {
              $username= test_input($_POST['username']);
          }

        }
      }

 

      if (empty($_POST['email'])){
        $emailErr = "Email is required";
      }
      else {
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $emailErr = form_err("Invalid email address");
          }
        else {
          $email = test_input($_POST['email']);
        }
      }



      if (empty($_POST['pwd1'])){
        $pwd1Err = "Password is required";
      }
      else {
        if (strlen($_POST['pwd1']) < 6){
          $pwd1Err = form_err("Your password must contain at least 6 characters");
        }
        else {
          $pwd1 = test_input($_POST['pwd1']);
        }
      }

      if (empty($_POST['pwd2'])){
        $pwd2Err = form_err("Password is required");
      }
      else {

          $pwd2 = test_input($_POST['pwd2']);

      }

      if (isset($fullname) && isset($username) && isset($email)
           && isset($pwd1) && isset($pwd2)){
            if ($pwd1 !== $pwd2){
              $pwd2Err = form_err("Both passwords don't match");
              $pwd1Err = "";
            }
            else {
              //check to see if a user with the provided email or username already exists
              $check_username = "SELECT *
                        FROM students
                        WHERE username = '$username';
                        ";
              $username_result = mysqli_query($conn, $check_username) or die('error checking if username already exists');
              $check_email = "SELECT *
                        FROM students
                        WHERE email = '$email';
                        ";
              $email_result = mysqli_query($conn, $check_email) or die('error checking if email already exists');

              if (mysqli_num_rows($username_result) == 1){
                //Username already exists
                $usernameErr = form_err("A user with this username already exists");
              }
              if (mysqli_num_rows($email_result) == 1){
                //email already exists
                $emailErr = form_err("A user with this email already exists");
              }


              if (mysqli_num_rows($username_result) < 1 && mysqli_num_rows($email_result)  < 1){
				  //unique user
                $query = "INSERT INTO students
                         (fullname, username, email, phone, signup_date, password)
                         VALUES ('$fullname', '$username', '$email', '$phone', NOW(), md5('$pwd1'));
                         ";
                mysqli_query($conn, $query) or die(mysqli_error($conn));
                $output_form = false;
                $success_msg = true;
              }
            }
          }
        }
      }






?>
<div class="col-md-5">
<?php if($output_form) { ?>
<form class="signup-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
 <h2>Create an account </h2>
  <div class="form-group">
    <label for="fullname">Full name:</label>
	<input type="fullname" class="form-control" name="fullname" id="fullname" placeholder="Enter your full name"
	value="<?php if (isset($fullname)) echo $fullname;?>" required>
	<?php if(isset($fullnameErr)) echo $fullnameErr ?>
  </div>

  <div class="form-group">
    <label for="email">Email:</label>
	<input type="email" class="form-control" name="email" id="email" placeholder="Enter your email"
	value="<?php if (isset($email)) echo $email;?>" required>
	<?php if(isset($emailErr)) echo $emailErr ?>
  </div>

  <div class="form-group">
    <label for="phone">Phone number:</label>
	<input type="phone" class="form-control" name="phone" id="phone" placeholder="Enter your phone number"
	value="<?php if (isset($phone)) echo $phone;?>" required>
	<?php if(isset($phoneErr)) echo $phoneErr ?>
  </div>

  <div class="form-group">
    <label for="pwd1">Password:</label>
	<input type="password" class="form-control" name="pwd1" id="pwd1" placeholder="create password" required>
	<?php if(isset($pwd1Err)) echo $pwd1Err ?>
  </div>

  <div class="form-group">
    <label for="pwd2">Confirm password:</label>
	<input type="password" class="form-control" name="pwd2" id="pwd2" placeholder="Enter your password again" required>
	<?php if(isset($pwd2Err)) echo $pwd2Err ?>
  </div>

  <button type="submit" class="btn btn-default">Sign up</button>
</form>
<?php } else {?>
	<p>You have successfully signed up. Please <a href='login.php'>click here to continue</a></p>
<?php } ?>
</div>