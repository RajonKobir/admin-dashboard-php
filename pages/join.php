<?php
include('../php-includes/connect.php');
// include('../php-includes/check-login.php');
// $userid = $_SESSION['userid'];
// $capping = 500;
?>
<?php

// define variables and set to empty values
$user_id = $user_name = $email = "";
$mobile = $under_userid = $side = $user_batch = "";
$father_name = $mother_name = $village_name = $post_number = $upazilla_name = "";
$zilla_name = $nominee_mobile = "";
$current_date = date('Y-m-d');


//User clicked on join
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$side='';
	$user_id = $_POST['user_id'];
	$user_name = $_POST['user_name'];
	$email = $_POST['email'];
	$mobile = $_POST['mobile'];
	$under_userid = $_POST['under_userid'];
	$admin_password = $_POST['admin_password'];
	$side = $_POST['side'];
	$user_batch = $_POST['user_batch'];
	$father_name = $_POST['father_name'];
	$mother_name = $_POST['mother_name'];
	$village_name = $_POST['village_name'];
	$post_number = $_POST['post_number'];
	$upazilla_name = $_POST['upazilla_name'];
	$zilla_name = $_POST['zilla_name'];
	$nominee_mobile = $_POST['nominee_mobile'];
	$current_date = $_POST['current_date'];
	
	
	$flag = 0;
	
	if($user_id!='' && $user_name!='' && $under_userid!='' && $side!='' && $admin_password!=''){
		if(admin_check($admin_password)){
			if(user_id_check($user_id)){
				//Email is ok
				if(!user_id_check($under_userid)){
					//Under userid is ok
					if(side_check($under_userid,$side)){
						//Side check
						$flag=1;
					}else{
						echo '<script>alert("The side you have selected is not available!");</script>';
					}
				}else{
					//check under userid
					echo '<script>alert("Invalid Sponsor ID!");</script>';
				}
			}else{
				//check email
				echo '<script>alert("This user id already existed. Please Try A New One!");</script>';
			}
		}else{
			echo '<script>alert("Invalid Admin Password!");</script>';
		}
	}else{
		//check all fields are fill
		echo '<script>alert("Please fill all the required  fields!");</script>';
	}
	
	//Now we are heree
	//It means all the information is correct
	//Now we will save all the information
	if($flag==1){
		
		//Insert into User profile
		$query = PDO_Execute("insert into user(`user_id`, `joining_date`,`user_name`,`email`,`mobile`,`under_userid`,`side`,`user_batch`,`father_name`,`mother_name`,`village_name`,`post_number`,`upazilla_name`,`zilla_name`,`nominee_mobile`) values('$user_id', '$current_date', '$user_name','$email','$mobile','$under_userid','$side','$user_batch','$father_name','$mother_name','$village_name','$post_number','$upazilla_name','$zilla_name','$nominee_mobile')");
		
		//Insert into Tree
		//So that later on we can view tree.
		$query = PDO_Execute("insert into tree(`userid`, `user_name`, `under_userid`,`side`) values('$user_id', '$user_name', '$under_userid','$side')");
		
		//Insert to side
		$query = PDO_Execute("update tree set `$side`='$user_id' where userid='$under_userid'");
		
		
		//Update count and Income.
		$temp_under_userid = $under_userid;

		$temp_side_count = $side.'count'; //leftcount or rightcount
		$temp_side_count2 = 'temp_'.$side.'count'; //leftcount or rightcount
		
		$temp_side = $side;

		$total_count=1;
		$i=1;
		while($total_count>0){
			$i;
			$q = PDO_FetchAll("select * from tree where userid='$temp_under_userid'");
			$r = $q[0];
			// $r = mysqli_fetch_array($q);
			$current_temp_side_count = $r[$temp_side_count]+1;
			$current_temp_side_count2 = $r[$temp_side_count2]+1;
			// $temp_under_userid;
			// $temp_side_count;
			PDO_Execute("update tree set `$temp_side_count`=$current_temp_side_count where userid='$temp_under_userid'");
			PDO_Execute("update tree set `$temp_side_count2`=$current_temp_side_count2 where userid='$temp_under_userid'");

			RAJON($temp_under_userid);
		
				$next_under_userid = getUnderId($temp_under_userid);
				$temp_side = getUnderIdPlace($temp_under_userid);
				$temp_side_count = $temp_side.'count';
				$temp_side_count2 = 'temp_'.$temp_side.'count';
				$temp_under_userid = $next_under_userid;	
				
				$i++;
			
			
				

			//Chaeck for the last user
			if($temp_under_userid==""){
				$total_count=0;
			}
			
		}//Loop

		// echo mysqli_error($con);


		
		echo '<script>alert("Member Included Successfully!");</script>';

	}
	
}

?><!--/join user-->
<?php 


// $query = PDO_FetchAll("select * from tree where userid='rajon2'");
// 	$row = $query[0];
// 	print_r(count($row));


//functions

function RAJON($user_id_stage_level){
	global $con;
	global $current_date;
	$query = PDO_FetchAll("select * from tree where userid='$user_id_stage_level'");
	$row = $query[0];
	

    if (count($row) > 0) {
        // output data of each row
        $temp_leftcount = $row['temp_leftcount'];
        $temp_rightcount = $row['temp_rightcount'];
        $temp_level = $row['level'];
		$temp_stage = $row['stage'];
		$temp_l4 = $row['l4'];


if($temp_level == 0){

	if($temp_stage == 0){

		if($temp_leftcount == 1 && $temp_rightcount == 0){
	$query = PDO_Execute("update tree set `l1_half`='$current_date' where userid='$user_id_stage_level'");
		}
		if($temp_leftcount == 0 && $temp_rightcount == 1){
	$query = PDO_Execute("update tree set `l1_half`='$current_date' where userid='$user_id_stage_level'");
		}

        if($temp_leftcount >= 1 && $temp_rightcount >= 1){
            $temp_level++;
	$query = PDO_Execute("update tree set `level`='$temp_level' where userid='$user_id_stage_level'");
	$query = PDO_Execute("update tree set `l1`='$current_date' where userid='$user_id_stage_level'");
    $temp_leftcount = $temp_leftcount - 1;
$query = PDO_Execute("update tree set `temp_leftcount`='$temp_leftcount' where userid='$user_id_stage_level'");
    $temp_rightcount = $temp_rightcount - 1;
$query = PDO_Execute("update tree set `temp_rightcount`='$temp_rightcount' where userid='$user_id_stage_level'");
	}
		}

	if($temp_stage > 0){

		$current_date = strtotime($current_date); 
		$next_monday = strtotime('next monday', strtotime($temp_l4));
		$current_date_day = date('D', $current_date);
	
		if($current_date_day == "Mon" || $current_date < $next_monday){
			$temp_leftcount = 0;
			$query = PDO_Execute("update tree set `temp_leftcount`='$temp_leftcount' where userid='$user_id_stage_level'");
			$temp_rightcount = 0;
			$query = PDO_Execute("update tree set `temp_rightcount`='$temp_rightcount' where userid='$user_id_stage_level'");
		}
		if($current_date > $next_monday){
			if($temp_leftcount >= 1 && $temp_rightcount >= 1){
				$temp_level++;
		$query = PDO_Execute("update tree set `level`='$temp_level' where userid='$user_id_stage_level'");
		$query = PDO_Execute("update tree set `l1`='$current_date' where userid='$user_id_stage_level'");
		$temp_leftcount = $temp_leftcount - 1;
	$query = PDO_Execute("update tree set `temp_leftcount`='$temp_leftcount' where userid='$user_id_stage_level'");
		$temp_rightcount = $temp_rightcount - 1;
	$query = PDO_Execute("update tree set `temp_rightcount`='$temp_rightcount' where userid='$user_id_stage_level'");
			}
			}
	}
}


if($temp_level == 1){

	if($temp_stage == 0){
		if($temp_leftcount == 2 && $temp_rightcount < 2){
			$query = PDO_Execute("update tree set `l2_half`='$current_date' where userid='$user_id_stage_level'");
		}
		if($temp_leftcount < 2 && $temp_rightcount == 2){
			$query = PDO_Execute("update tree set `l2_half`='$current_date' where userid='$user_id_stage_level'");
		}
	}



        if($temp_leftcount >= 2 && $temp_rightcount >= 2){
            $temp_level++;
    $query = PDO_Execute("update tree set `level`='$temp_level' where userid='$user_id_stage_level'");
	$query = PDO_Execute("update tree set `l2`='$current_date' where userid='$user_id_stage_level'");

    $temp_leftcount = $temp_leftcount - 2;
$query = PDO_Execute("update tree set `temp_leftcount`='$temp_leftcount' where userid='$user_id_stage_level'");
    $temp_rightcount = $temp_rightcount - 2;
$query = PDO_Execute("update tree set `temp_rightcount`='$temp_rightcount' where userid='$user_id_stage_level'");
}
		}
		


if($temp_level == 2){

	if($temp_stage == 0){
		if($temp_leftcount == 4 && $temp_rightcount < 4){
			$query = PDO_Execute("update tree set `l3_half`='$current_date' where userid='$user_id_stage_level'");
		}
		if($temp_leftcount < 4 && $temp_rightcount == 4){
			$query = PDO_Execute("update tree set `l3_half`='$current_date' where userid='$user_id_stage_level'");
		}
	}

        if($temp_leftcount >= 4 && $temp_rightcount >= 4){
            $temp_level++;
    $query = PDO_Execute("update tree set `level`='$temp_level' where userid='$user_id_stage_level'");
	$query = PDO_Execute("update tree set `l3`='$current_date' where userid='$user_id_stage_level'");
	
    $temp_leftcount = $temp_leftcount - 4;
$query = PDO_Execute("update tree set `temp_leftcount`='$temp_leftcount' where userid='$user_id_stage_level'");
    $temp_rightcount = $temp_rightcount - 4;
$query = PDO_Execute("update tree set `temp_rightcount`='$temp_rightcount' where userid='$user_id_stage_level'");
		}
        }



if($temp_level == 3){

	if($temp_stage == 0){
		if($temp_leftcount == 8 && $temp_rightcount < 8){
			$query = PDO_Execute("update tree set `l4_half`='$current_date' where userid='$user_id_stage_level'");
		}
		if($temp_leftcount < 8 && $temp_rightcount == 8){
			$query = PDO_Execute("update tree set `l4_half`='$current_date' where userid='$user_id_stage_level'");
		}
	}

        if($temp_leftcount >= 8 && $temp_rightcount >= 8){
            $temp_level = 0;
    $query = PDO_Execute("update tree set `level`='$temp_level' where userid='$user_id_stage_level'");
            $temp_stage++;
    $query = PDO_Execute("update tree set `stage`='$temp_stage' where userid='$user_id_stage_level'");

    $temp_leftcount = 0;
$query = PDO_Execute("update tree set `temp_leftcount`='$temp_leftcount' where userid='$user_id_stage_level'");
    $temp_rightcount = 0;
$query = PDO_Execute("update tree set `temp_rightcount`='$temp_rightcount' where userid='$user_id_stage_level'");
$query = PDO_Execute("update tree set `l4`='$current_date' where userid='$user_id_stage_level'");
		}
        }

 }
// end of if (count($row) > 0)
}
// end of function RAJON



function admin_check($password){
	global $con;
	$query = PDO_FetchAll("select * from admin where password='$password'");
	if(count($query) > 0){
		return true;
	}
	else{
		return false;
	}
}


function user_id_check($user_id){
	global $con;
	
	$query = PDO_FetchAll("select * from user where user_id='$user_id'");
	if(count($query) > 0){
		return false;
	}
	else{
		return true;
	}
}


function side_check($user_id,$side){
	global $con;
	
	$query = PDO_FetchAll("select * from tree where userid='$user_id'");
	$result = $query[0];
	$side_value = $result[$side];
	if($side_value==''){
		return true;
	}
	else{
		return false;
	}
}


function tree($userid){
	global $con;
	$data = array();
	$query = PDO_FetchAll("select * from tree where userid='$userid'");
	$result = $query[0];
	$data['left'] = $result['left'];
	$data['right'] = $result['right'];
	$data['leftcount'] = $result['leftcount'];
	$data['rightcount'] = $result['rightcount'];
	
	return $data;
}


function getUnderId($userid){
	global $con;
	$query = PDO_FetchAll("select * from user where user_id='$userid'");
	$result = $query[0];
	return $result['under_userid'];
}


function getUnderIdPlace($userid){
	global $con;
	$query = PDO_FetchAll("select * from user where user_id='$userid'");
	$result = $query[0];
	return $result['side'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<title>Ideal IT  - Join</title>
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

    <div id="wrapper">

        <!-- Navigation -->
        <?php include('../php-includes/menu.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header page_heading text-center">Join Members</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-4">
						<form method="post" id="main_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> 
                            <div class="form-group">
							<h2>Initial Info:</h2>
                                <label>1. User ID <i class="fa fa-star text-danger"></i></label>
                                <input type="text" name="user_id" value="<?php echo $user_id;?>" class="form-control"  required>
  								
                                <label>2. User Name <i class="fa fa-star text-danger"></i></label>
                                <input type="text" name="user_name" value="<?php echo $user_name;?>" class="form-control"  required>

                                <label>3. User Batch Code </label>
                                <input type="text" name="user_batch" value="<?php echo $user_batch;?>" class="form-control" >
							</div>
							
							<div class="form-group">
							<h2>Guardian Info:</h2>
								<label>1. Father's Name</label>
                                <input type="text" name="father_name" value="<?php echo $father_name;?>" class="form-control" >
                                <label>2. Mother's Name</label>
                                <input type="text" name="mother_name" value="<?php echo $mother_name;?>" class="form-control" >
                                <label>3. Mobile</label>
                                <input type="text" name="nominee_mobile" value="<?php echo $nominee_mobile;?>" class="form-control">
                            </div>
							</div>


							<div class="col-lg-4">
                            <div class="form-group">
							<h2>Address Info:</h2>
                                <label>1. Village</label>
                                <input type="text" name="village_name" value="<?php echo $village_name;?>" class="form-control" >
                                <label>2. Post</label>
                                <input type="text" name="post_number" value="<?php echo $post_number;?>" class="form-control"  >
                                <label>3. Upazilla</label>
                                <input type="text" name="upazilla_name" value="<?php echo $upazilla_name;?>" class="form-control"  >
                                <label>4. Zilla</label>
                                <input type="text" name="zilla_name" value="<?php echo $zilla_name;?>" class="form-control"  >
                                <label>5. Mobile</label>
								<input type="text" name="mobile" value="<?php echo $mobile;?>" class="form-control"  >
								<label>6. Email</label>
                                <input type="email" name="email" value="<?php echo $email;?>" class="form-control" >
                            </div>
                            </div>
							
							<div class="col-lg-4">

                            </div>

							<div class="col-lg-4">
                            <div class="form-group">
							<h2>Final Info:</h2>
                                <label>1. Sponsor User ID <i class="fa fa-star text-danger"></i></label>
                                <input type="text" name="under_userid" value="<?php echo $under_userid;?>" class="form-control"  required>
                                <label>2. Side <i class="fa fa-star text-danger"></i></label><br>
                                <input class="join_radio" type="radio" name="side" <?php if (isset($side) && $side=="left") echo "checked";?> value="left" required> P1
                                <input class="join_radio" type="radio" name="side" <?php if (isset($side) && $side=="right") echo "checked";?> value="right" required> P2
								<br>
								<label>3. Joining Date <i class="fa fa-star text-danger"></i></label>
                                <input type="date" name="current_date" value="<?php  echo $current_date; ?>" class="form-control" required>
                            <br>
								<label> Admin Password: <i class="fa fa-star text-danger"></i> </label>
                                <input id="myInput" type="password" name="admin_password" class="form-control" autocomplete="off" required>
								<input type="checkbox" onclick="myFunction()"> Show Password
							</div>

							<div class="form-group">
                        	<input type="submit" name="join_user" class="btn" value="Submit" >
						</div>
                            </div>
                            

						<br>
						<br>
						<br>
                        </form>
                    </div>
                </div><!--/.row-->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
	<!-- /#wrapper -->
	

<script>
	function myFunction() {
  var x = document.getElementById("myInput");
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
