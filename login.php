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
    $usernameErr  = $usernameErr = $emailErr  = $phoneErr = "";
    $pwd1Err = $passwordErr = "";
    $error_msg = "";
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
		function form_err($text) {
			return "<span style='display:block; margin-top: 2%; font-size: 16px; color:red'>$text</span>";
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

 

      if (empty($_POST['password'])){
        $passwordErr = form_err("Password is required");
      }
      else {

          $password = test_input($_POST['password']);

      }

      if (isset($username) && isset($password)){
           
                $sql = "SELECT id, username, email  FROM students WHERE username = '$username' AND password = md5('$password')";
                $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                if (mysqli_num_rows($result) == 1){
                  //The user exists in the system
                  echo "<script> alert('User is logged in'); </script>";
                }
                else {
                  $error_msg = "<span style='color:red'>Invalid username or password</span>";
                }
            }
          }
        }

    







?>
<div class="container signup-form-bg" >
<div class="col-md-4" style="color: grey; margin-top:5%; margin-left: 13%;" >
		<h1>FUOCRIBS</h1>
	</div>
	<div class="col-md-5">
	<form class="login-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <h2>Log in </h2>
  <?php 
    if (isset($error_msg)) echo $error_msg;
     ?>
	<div class="form-group">
		<label for="username">Username:</label>
		<input type="username" class="form-control" name="username" id="username" placeholder="Enter your full name"
		value="<?php if (isset($username)) echo $username;?>" required>
		<?php if(isset($usernameErr)) echo $usernameErr ?>
	</div>

	<div class="form-group">
		<label for="password">Password:</label>
		<input type="password" class="form-control" name="password" id="password" placeholder="Enter your password again" required>
		<?php if(isset($passwordErr)) echo $passwordErr ?>
  </div>
  

  <button type="submit" class="btn btn-default">Log in</button>
  <a href="#" id='forgot-password'>Forgot password? </a>
	</form>
	
	
</div>