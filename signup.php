/*creating a simple signup page, just the backend.*/

require_once 'db/connect_vars.php';


require_once 'validate.php';
$usa = '
<div class= "text-center">
<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
This username already exists in our database
</div>
</div>';

$pass = '
<div class= "text-center">
<div class="alert alert-danger">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
Your passwords do not match!
</div>
</div>';

$log = '
<div class= "text-center">
<div class="alert alert-success">
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
 Your registeration was successful, please check your mail for your login id
</div>
</div>';

if (isset($_POST['submit'])) {
	$fname =  mysqli_real_escape_string($conn, test_input($_POST['fname']));
  $lname =  mysqli_real_escape_string($conn, test_input($_POST['lname']));
  $pwd =  mysqli_real_escape_string($conn, md5($_POST['password']));
	$cpwd =  mysqli_real_escape_string($conn, test_input($_POST['c_password']));
  $email =  mysqli_real_escape_string($conn, test_input($_POST['email']));
  $phone =  mysqli_real_escape_string($conn, test_input($_POST['phone']));

	if ($_POST['password'] == $_POST['c_password']) {

 $em = "SELECT email FROM register Where email = '$email' ";
 $sql= mysqli_query($conn, $em);
 if (mysqli_num_rows($sql) > 0) {
	     echo $usa;
 }

 else {
	 $query=("INSERT INTO  register (fname, lname, email, password,phone)
																																			VALUES
	 ('$fname', '$lname', '$email', '$pwd', '$phone')");

	 $res = mysqli_query($conn, $query);
	 if ($res) {
		 echo $log;
	 }

 }
}
else {
	     echo $pass;
}

}
?>
