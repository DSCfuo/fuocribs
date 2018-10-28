<?php
//require_once 'db/connect.php';
session_start();

if (isset($_POST['submit'])) {
$user =  mysqli_real_escape_string($conn, $_POST['username']);
$pwd =  mysqli_real_escape_string($conn, $_POST['password']);


$query = "SELECT username, password FROM login WHERE password='".md5($pwd)."' AND username='$user'";
$sql = mysqli_query($conn,$query);
 if (mysqli_num_rows($sql) == 1)
  {
    echo '<script>window.location.href = "../home"</script>';
    $_SESSION['email'] = $email;
  }
  else
    {
      echo $error;
    }
  }
 ?>
