<?php
session_start();
require('../php-includes/connect.php');
$user_id = $_POST['user_id'];
$password = $_POST['password'];

$query = PDO_FetchAll("select * from admin where userid='$user_id' and password='$password'");
$sqlite_num_rows = count($query);
// print_r ($sqlite_num_rows);
if($sqlite_num_rows > 0){
	$_SESSION['userid'] = $user_id;
	$_SESSION['id'] = session_id();
	$_SESSION['login_type'] = "admin";
	
	echo '<script>alert("Logged In Successfully!.");window.location.assign("../pages/home.php");</script>';
	
}
else{
	echo '<script>alert("User ID id or Password is worng.");window.location.assign("../pages/index.php");</script>';
}

?>