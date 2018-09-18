<?php
/* Database connection settings */
$ServerName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'fuocribs';

$conn = mysqli_connect($ServerName, $username, $password, $dbName) or die(mysqli_error($conn));
