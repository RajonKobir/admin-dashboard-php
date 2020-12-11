<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Ideal IT -Login</title>
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

    

</head>

<body>

    <div class="container">
        <div class="row">
            


<?php 

// session_start();
if(isset($_SESSION['id']) && $_SESSION['login_type']=='admin'){
    echo '<script>window.location.assign("./home.php");</script>';
}

require('../php-includes/connect.php');

// // define variables and set to empty values
// // $user_id = $user_name = $email = "";
// // $mobile = $user_batch = "";
// // $father_name = $mother_name = $village_name = $post_number = $upazilla_name = "";
// // $zilla_name = $nominee_name = $nominee_mobile = $nominee_relation = $nominee_address = "";


$query = PDO_FetchAll("SELECT * FROM admin WHERE id = 1");
// $results = mysqli_query($con, $query);
// $values = mysqli_fetch_assoc($results);
$num_rows = $query[0]['userid'];
if($num_rows == ''){

echo '
<div class="panel-heading">
    <h1 class="text-center red"> SetUp Admin Please </h1>
    <h4 class="text-center red">Collect the admin password from the owner of this software!</h4>
</div>
<div class="col-lg-6">
<form method="post" id="main_form">
<div class="form-group">
<h2>Initial Info:</h2>
    <label>1. User ID <i class="fa fa-star text-danger"></i></label>
    <input type="text" name="user_id" class="form-control" autofocus required>
      
    <label>2. User Name <i class="fa fa-star text-danger"></i></label>
    <input type="text" name="user_name" class="form-control"  required>

    <label>3. User Batch Code </label>
    <input type="text" name="user_batch" class="form-control" >
</div>

<div class="form-group">
<h2>Guardian Info:</h2>
    <label>1. Father&rsquo;s Name</label>
    <input type="text" name="father_name" class="form-control" >
    <label>2. Mother&rsquo;s Name</label>
    <input type="text" name="mother_name" class="form-control" >
    <label>3. Mobile</label>
    <input type="text" name="nominee_mobile" class="form-control"  >
</div>
</div>


<div class="col-lg-6">
<div class="form-group">
<h2>Address Info:</h2>

    <label>1. Village</label>
    <input type="text" name="village_name" class="form-control" >
    <label>2. Post</label>
    <input type="text" name="post_number" class="form-control"  >
    <label>3. Upazilla</label>
    <input type="text" name="upazilla_name"  class="form-control"  >
    <label>4. Zilla</label>
    <input type="text" name="zilla_name" class="form-control"  >
    <label>5. Mobile</label>
    <input type="text" name="mobile" class="form-control"  >
    <label>6. Email</label>
    <input type="email" name="email" class="form-control" autocomplete="off">
    <br>
    <label> Admin Password: <i class="fa fa-star text-danger"></i> (Factory Password For Initialization)</label>
    <input id="myInput" type="password" name="admin_password" class="form-control" autocomplete="off" required>
    <input type="checkbox" onclick="myFunction()"> Show Password
</div>
<div class="form-group">
<input type="submit" name="join_user" class="btn border-0" value="Submit" >
<input type="reset" name="reset" class="btn" value="Reset" >
</div>
</div>
</form>
</div>
';


if(isset($_POST['join_user'])){

    $user_id = $_POST['user_id'];
    $user_name = $_POST['user_name'];
    $admin_password = $_POST['admin_password'];

    if($user_id!='' && $user_name!=''  && $admin_password!=''){
        
        $query = PDO_FetchAll("select * from admin where password='$admin_password'");
        $sqlite_num_rows = count($query[0]);

        if($sqlite_num_rows > 0){
        
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $user_batch = $_POST['user_batch'];
        $father_name = $_POST['father_name'];
        $mother_name = $_POST['mother_name'];
        $nominee_mobile = $_POST['nominee_mobile'];
        $village_name = $_POST['village_name'];
        $post_number = $_POST['post_number'];
        $upazilla_name = $_POST['upazilla_name'];
        $zilla_name = $_POST['zilla_name'];
        
$query = PDO_Execute("insert into user(`user_id`, `joining_date`,`user_name`,`email`,`mobile`,`user_batch`,`father_name`,`mother_name`,`village_name`,`post_number`,`upazilla_name`,`zilla_name`,`nominee_mobile`) values('$user_id', date('now'), '$user_name','$email','$mobile','$user_batch','$father_name','$mother_name','$village_name','$post_number','$upazilla_name','$zilla_name','$nominee_mobile')");
$query = PDO_Execute("insert into tree(`userid`,`user_name`) values('$user_id','$user_name')");
$query = PDO_Execute("UPDATE `admin` SET `userid`='$user_id' WHERE id=1");

            echo '<script>alert("Congratulations! Admin is added successfully!");window.location.assign("index.php");</script>';
            
        }
        else{
            echo '<script>alert("Invalid Admin Password. Try Again.");window.location.assign("index.php");</script>';
        }
        }else{
            echo '<script>alert("Please Fillup All Required Fields!");window.location.assign("index.php");</script>';
        }
    }




}else{

echo '
<div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
<div class="panel-heading">
    <h3 class="panel-title">Please Sign In</h3>
</div>
<div class="panel-body">
<form method="post" action="../actions/login.php">
    <fieldset>
        <div class="form-group">
            <input class="form-control" placeholder="user id" name="user_id" type="text" autofocus required>
        </div>
        <div class="form-group">
            <input id="myInput2" class="form-control" placeholder="Password" name="password" type="password" value="" required>
        </div>
        <input type="checkbox" onclick="myFunction2()"> Show Password
        <!-- Change this to a button or input when using this as a form -->
        <button type="submit"  class="btn btn-lg btn-block">Login</button>
    </fieldset>
</form>
</div>
</div>
</div>
';

}



// $query = PDO_FetchOne("SELECT count( * ) as  user_id FROM user");
// print_r ($query);


?>



                    

    </div>
    </div>


<script>
	function myFunction() {
  var x = document.getElementById("myInput");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
	}
}
	function myFunction2() {
  var x = document.getElementById("myInput2");
	if (x.type === "password") {
		x.type = "text";
	} else {
		x.type = "password";
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
