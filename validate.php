<?php
 //This function code is for security purpose
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  $data = htmlentities($data);
  $data = htmlspecialchars($data);
  return $data;
}
//Security Function Script Ends!
?>
