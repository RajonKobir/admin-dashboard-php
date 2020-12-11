<?php
include('../php-includes/connect.php');
// include('../php-includes/check-login.php');
// $userid = $_SESSION['userid'];
// $capping = 500;

    $user_id =  $user_name = $email = $mobile = $joining_date = $under_userid =
    $side = $user_batch = $father_name = $mother_name = $village_name = $post_number = $upazilla_name =
    $zilla_name = $nominee_name = $nominee_mobile = $nominee_relation =
    $nominee_address = '';


?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Ideal IT - Profile</title>


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


    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../assets/js/sb-admin-2.js"></script>


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
<h1 class="page-header page_heading text-center">Member's profile</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->



    <div class="row text-center">
        <div class="col-lg-12">
            <form method="GET" class="">
            <span>
                <input type="text" name="search" id="search" placeholder="Search..." class="form-control-lg">

               <input type="submit" name="view_profile" id="view_profile" value="View Profile" class="btn" >
            </span>
            </form>
        </div>
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="list-group show-list" id="show-list">

                </div>
            </div>
        </div>
    </div>



<?php



if(isset($_GET['view_profile'])){
    $data4 = $_GET['search'];
    $sql = PDO_FetchAll("SELECT * FROM user WHERE user_id='$data4'");
    $result = count($sql);

    if($result > 0){
    $row2 = $sql[0];

    $user_id = $row2['user_id'];
    $user_name = $row2['user_name'];
    $email = $row2['email'];
    $mobile = $row2['mobile'];
    $joining_date = $row2['joining_date'];
    $under_userid = $row2['under_userid'];
    $side = $row2['side'];
    $user_batch = $row2['user_batch'];
    $father_name = $row2['father_name'];
    $mother_name = $row2['mother_name'];
    $village_name = $row2['village_name'];
    $post_number = $row2['post_number'];
    $upazilla_name = $row2['upazilla_name'];
    $zilla_name = $row2['zilla_name'];
    $nominee_name = $row2['nominee_name'];
    $nominee_mobile = $row2['nominee_mobile'];
    $nominee_relation = $row2['nominee_relation'];
    $nominee_address = $row2['nominee_address'];



    $data =  '<br><br><table class="table table-bordered table-striped">
    <tr>
        <th>User ID</th>
        <th>User Name</th>
        <th>Sponser ID</th>
        <th>Sponser Side</th>
        <th>Joining Date </th>
        <th>Email Address</th>
    </tr>';


$data .= '<tr>
<td>'.$row2['user_id'].'</td>
<td>'.$row2['user_name'].'</td>
<td>'.$row2['under_userid'].'</td>
<td>'.$row2['side'].'</td>
<td>'.$row2['joining_date'].'</td>
<td>'.$row2['email'].'</td>
</tr>';

$data .=  '<tr>
    <th>Batch No.</th>
    <th>Father&rsquo;s Name</th>
    <th>Mother&rsquo;s Name </th>
    <th>Village Name </th>
    <th>Upazilla</th>
    <th>Mobile Number </th>
</tr>';

$data .= '<tr>
<td>'.$row2['user_batch'].'</td>
<td>'.$row2['father_name'].'</td>
<td>'.$row2['mother_name'].'</td>
<td>'.$row2['village_name'].'</td>
<td>'.$row2['upazilla_name'].'</td>

</tr>';

$data .=  '<tr>
    <th>POST </th>
    <th>Zilla</th>
    <th>Nominee Name</th>
    <th>Nominee Relation </th>
    <th>Nominee Mobile </th>
    <th>Nominee Address </th>
</tr>';

$data .= '<tr>
<td>'.$row2['post_number'].'</td>
<td>'.$row2['zilla_name'].'</td>
<td>'.$row2['nominee_name'].'</td>
<td>'.$row2['nominee_relation'].'</td>
<td>'.$row2['nominee_mobile'].'</td>
<td>'.$row2['nominee_address'].'</td>

</tr>';


$data .= '</table>';
$data .= '<div class="text-center"><button id="click_button" class="btn">Edit</button></div>';
echo $data;

}



}







?>



<!-- //////////////// after update ////////////////// -->
<div class="modal fade" id="update_user_modal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Here Member Info</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

    <form method="POST" id="main_form">
                        <div class="form-group">
                            <h2>Initial Info:</h2>
                                <label>1. User ID </label>
        <input type="text" name="user_id" value="<?php echo $user_id;?>" class="form-control" readonly>

                                <label>2. User Name </label>
                                <input type="text" name="user_name" value="<?php echo $user_name;?>" class="form-control"  required>

                                <label>3. User Batch Code </label>
                                <input type="text" name="user_batch" value="<?php echo $user_batch;?>" class="form-control" >
                        </div>


                        <div class="form-group">
                            <h2>Others Info:</h2>
                                <label>1. Father's Name</label>
                                <input type="text" name="father_name" value="<?php echo $father_name;?>" class="form-control" >
                                <label>2. Mother's Name</label>
                                <input type="text" name="mother_name" value="<?php echo $mother_name;?>" class="form-control" >
                                <label>3. Village</label>
                                <input type="text" name="village_name" value="<?php echo $village_name;?>" class="form-control" >
                                <label>4. Post</label>
                                <input type="text" name="post_number" value="<?php echo $post_number;?>" class="form-control"  >
                                <label>5. Upazilla</label>
                                <input type="text" name="upazilla_name" value="<?php echo $upazilla_name;?>" class="form-control"  >
                                <label>6. Zilla</label>
                                <input type="text" name="zilla_name" value="<?php echo $zilla_name;?>" class="form-control"  >
                                <label>7. Mobile</label>
                                <input type="text" name="mobile" value="<?php echo $mobile;?>" class="form-control"  >
                                <label>8. Email</label>
                                <input type="email" name="email" value="<?php echo $email;?>" class="form-control" >
                        </div>

                        <div class="form-group">
                            <h2>Nominee Info:</h2>
                                <label>1. Name</label>
                                <input type="text" name="nominee_name" value="<?php echo $nominee_name;?>" class="form-control"  >
                                <label>2. Mobile</label>
                                <input type="text" name="nominee_mobile" value="<?php echo $nominee_mobile;?>" class="form-control"  >
                                <label>3. Relation</label>
                                <input type="text" name="nominee_relation" value="<?php echo $nominee_relation;?>" class="form-control"  >
                                <label>4. Address</label>
                                <textarea form="main_form" name="nominee_address" class="form-control" ><?php echo $nominee_address;?></textarea>
                        </div>


            <div class="form-group">
                <input type="submit" name="update_user" class="btn" value="Update" >
                <button type="button" class="btn" data-dismiss="modal">Close</button>
            </div>

    </form>



      </div>

      <!-- Modal footer -->
    <!-- <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_click">Update</button>
    </div> -->



    </div>
  </div>
</div>




<?php

if(isset($_POST['update_user'])) {

    $user_id2 = $_POST['user_id'];
    $user_name2 = $_POST['user_name'];
    $email2 = $_POST['email'];
    $mobile2 = $_POST['mobile'];
    $user_batch2 = $_POST['user_batch'];
    $father_name2 = $_POST['father_name'];
    $mother_name2 = $_POST['mother_name'];
    $village_name2 = $_POST['village_name'];
    $post_number2 = $_POST['post_number'];
    $upazilla_name2 = $_POST['upazilla_name'];
    $zilla_name2 = $_POST['zilla_name'];
    $nominee_name2 = $_POST['nominee_name'];
    $nominee_mobile2 = $_POST['nominee_mobile'];
    $nominee_relation2 = $_POST['nominee_relation'];
    $nominee_address2 = $_POST['nominee_address'];


    PDO_Execute("UPDATE `user` SET
    `user_name`='$user_name2',
    `email`= '$email2',
    `mobile`='$mobile2',
    `user_batch`='$user_batch2',
    `father_name`='$father_name2',
    `mother_name`='$mother_name2',
    `village_name`='$village_name2',
    `post_number`='$post_number2',
    `upazilla_name`='$upazilla_name2',
    `zilla_name`='$zilla_name2',
    `nominee_name`='$nominee_name2',
    `nominee_mobile`='$nominee_mobile2',
    `nominee_relation`='$nominee_relation2',
    `nominee_address`='$nominee_address2'
    WHERE user_id='$user_id2'
    ");

    //update tree
    PDO_Execute("UPDATE `tree` SET
    `user_name`='$user_name2'
    WHERE userid='$user_id2'
    ");

   // mysqli_query($con,"UPDATE `user` SET `user_name` = '$user_name2' WHERE `user_id` = '$user_id2'");
    //header ("Location: member_profile.php?search=$user_id2");
    $url = "member_profile.php?search=$user_id2&view_profile=View+Profile";
    echo '<script language="javascript">
    window.location.href ="'.$url.'"
    </script>';

    exit();


}


// $query = PDO_FetchAll("SELECT user_id FROM user WHERE user_id LIKE '%r2%'");
// $result = $query[0];
// print_r($result);

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

$(document).ready(function(){
    $("#search").keyup(function(){
        var search_text= $(this).val();

        if(search_text != ''){
            $.ajax({
                url: '../actions/search_action.php',
                method: 'post',
                data: {query:search_text},
                success: function(response){
                    $("#show-list").html(response);
                }
            });
        }else{
            $("#show-list").html('');
        }
    });

    $(document).on('click', 'a', function(){
        $("#search").val($(this).text());
        $("#show-list").html('');
    });


$('#click_button').click(function(){
    $("#update_user_modal").modal("show");

});



});

</script>




</body>
</html>