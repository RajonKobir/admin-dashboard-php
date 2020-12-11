<?php
include('../php-includes/connect.php');
include('../php-includes/check-login.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Ideal IT - Password</title>


<link rel="icon" href="../assets/images/favicon.png" type="image/x-icon">

<!-- Bootstrap Core CSS -->
<link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

<!-- MetisMenu CSS -->
<link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../assets/css/sb-admin-2.css" rel="stylesheet">

<!-- Custom CSS -->
<link href="../assets/css/rajon.css" rel="stylesheet">

<!-- Custom Fonts -->
<link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

<style>
input[type="password"]{
    width: 50%;
}
</style>


</head>
<body>
<div id="wrapper">
<!-- Navigation -->
<?php include('../php-includes/menu.php'); ?>
<!-- Page Content -->
<div id="page-wrapper">
<div class="container-fluid">
<div class="row">
<div class="col-lg-12">
<h1 class="page-header text-center">Passwords Setting</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
<div class="col-lg-6 col-lg-offset-3">

</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->



  <h2 class="text-center">Change Admin Passwords Here:</h2>
  <h4 class="text-center">You can change both "login password" && "join password" separately!</h4>

  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home"><span style="color:#1BA0E1;">Home</span></a></li>
    <li><a data-toggle="tab" href="#menu1"><span style="color:#1BA0E1;">Change Login Password</span></a></li>
    <li><a data-toggle="tab" href="#menu2"><span style="color:#1BA0E1;">Change Join Member Password</span></a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h1 class="text-center">HOME</h1>
      <p class="text-center" style="color:#C90809;">The Initial Passwords for "login" && "join member" are the same. 
      If you had never changed these, please use the "factory password" as the "old password",
      which was given by the owner of this software. good luck!</p>
      <h4>Go To The Tabs Right=======>></h4>
    </div>
    <div id="menu1" class="tab-pane fade">

<form method="post">
    <fieldset>
        <div class="form-group">
        Old Password:
            <input class="form-control myInput" placeholder="old pass..." name="old_pass1" type="password" autocomplete="off" autofocus required>
        </div>
        <div class="form-group">
        New Password:
            <input class="form-control myInput" placeholder="new pass..." name="new_pass1" type="password" required>
        </div>
        <div class="form-group">
        Repeat New Password:
            <input class="form-control myInput" placeholder="new pass again..." name="new_pass_repeat1" type="password" required>
        </div>
        <input type="checkbox" onclick="myFunction()">Show Password
        <!-- Change this to a button or input when using this as a form -->
        <button type="submit" name="submit1" class="btn">Change Login Password</button>
    </fieldset>
</form>

</div>
    <div id="menu2" class="tab-pane fade">

<form method="post">
    <fieldset>
        <div class="form-group">
        Old Password:
            <input class="form-control myInput2" placeholder="old pass..." name="old_pass2" type="password" autocomplete="off" autofocus required>
        </div>
        <div class="form-group">
        New Password:
            <input class="form-control myInput2" placeholder="new pass..." name="new_pass2" type="password" required>
        </div>
        <div class="form-group">
        Repeat New Password:
            <input class="form-control myInput2" placeholder="new pass again..." name="new_pass_repeat2" type="password" required>
        </div>
        <input type="checkbox" onclick="myFunction2()">Show Password
        <!-- Change this to a button or input when using this as a form -->
        <button type="submit" name="submit2"  class="btn">Change Join Password</button>
    </fieldset>
</form>

</div>
  </div>





  <?php

if(isset($_POST['submit1'])){

    $old_pass1 = $_POST['old_pass1'];
    $new_pass1 = $_POST['new_pass1'];
    $new_pass_repeat1 = $_POST['new_pass_repeat1'];

    if($old_pass1!='' && $new_pass1!=''  && $new_pass_repeat1!=''){

if($new_pass1 == $new_pass_repeat1){

if($new_pass1 != $old_pass1){

    $query = PDO_FetchAll("SELECT * FROM admin WHERE id=1");
    // $results = mysqli_query($con, $query);
    $values = $query[0];
    $num_rows = $values['password'];
    if($num_rows == $old_pass1){
        $query = PDO_Execute("UPDATE `admin` SET `password`='$new_pass1' WHERE id=1");
    echo '<script>alert("Congratulations! Password is changed successfully!");window.location.assign("settings.php");</script>';    

}else{
    echo '<script>alert("Invalid Old Password!");window.location.assign("settings.php");</script>';

}


}else{
    echo '<script>alert("Please Choose A New Password!");window.location.assign("settings.php");</script>';

}

}else{
    echo '<script>alert("New Passwords Do Not Match!");window.location.assign("settings.php");</script>';

}

}else{
    echo '<script>alert("Please Fillout All The Fields!");window.location.assign("settings.php");</script>';
    }
}





if(isset($_POST['submit2'])){
    $old_pass2 = $_POST['old_pass2'];
    $new_pass2 = $_POST['new_pass2'];
    $new_pass_repeat2 = $_POST['new_pass_repeat2'];

    if($old_pass2!='' && $new_pass2!=''  && $new_pass_repeat2!=''){

if($new_pass2 == $new_pass_repeat2){

if($new_pass2 != $old_pass2){

    $query = PDO_FetchAll("SELECT * FROM admin WHERE id=1");
    // $results = mysqli_query($con, $query);
    $values = $query[0];
    $num_rows = $values['join_pass'];
    if($num_rows == $old_pass2){
        $query = PDO_Execute("UPDATE `admin` SET `join_pass`='$new_pass2' WHERE id=1");
    echo '<script>alert("Congratulations! Password is changed successfully!");window.location.assign("settings.php");</script>';    

}else{
    echo '<script>alert("Invalid Old Password!");window.location.assign("settings.php");</script>';

}


}else{
    echo '<script>alert("Please Choose A New Password!");window.location.assign("settings.php");</script>';

}

}else{
    echo '<script>alert("New Passwords Do Not Match!");window.location.assign("settings.php");</script>';

}

}else{
    echo '<script>alert("Please Fillout All The Fields!");window.location.assign("settings.php");</script>';
    }
}


?>







</div>
</div>
</div>
</div>
<!-- /.container-fluid -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->



<script>
function myFunction() {
  var x = document.getElementsByClassName("myInput");
  for(i=0; i <= x.length; i++){
      if(x[i] !== '' && x[i] !== 'undefined'){
        if (x[i].type === "password") {
            x[i].type = "text";
        } else {
            x[i].type = "password";
        }
      }
  }
}
function myFunction2() {
  var x = document.getElementsByClassName("myInput2");
  for(i=0; i <= x.length; i++){
      if(x[i] !== '' && x[i] !== 'undefined'){
        if (x[i].type === "password") {
            x[i].type = "text";
        } else {
            x[i].type = "password";
        }
      }
  }
}
</script>




    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/js/sb-admin-2.js"></script>


</body>
</html>