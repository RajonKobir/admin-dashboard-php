<?php
include('../php-includes/connect.php');
// include('../php-includes/check-login.php');
// $user_id = $_SESSION['userid'];
// $search = $user_id;
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">
<title>Ideal IT - Member's Pay Chart</title>


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
<h1 class="page-header page_heading text-center">Members Pay Chart</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<div class="row">
<div class="col-lg-6 col-lg-offset-3">
<!-- <form action="" method="post" name=>
    <input type="text" name="search_box">
    <input type="submit" name="submit" value="search">
</form> -->
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->

<?php 

    $data =  '<table class="table table-bordered table-striped" style="overflow: auto;">
                    <tr>
                        <th>No.</th>
                        <th>User ID</th>
                        <th>Sponser ID</th>
                        <th>Stage</th>
                        <th>Level</th>
                        <th>P1</th>
                        <th>P2</th>
                        <th>L1 Half Bill Out Date</th>
                        <th>L1 Bill Out Date</th>
                        <th>L2 Half Bill Out Date</th>  
                        <th>L2 Bill Out Date</th>
                        <th>L3 Half Bill Out Date</th> 
                        <th>L3 Bill Out Date</th> 
                        <th>L4 Half Bill Out Date</th>
                        <th>L4 Bill Out Date</th> 
                    </tr>';  

$displayquery = PDO_FetchAll(" SELECT * FROM `tree`"); 
$result = count($displayquery);

if($result > 0){

$number = 1;
for($i=0; $i < $result; $i++) {
    
    $row = $displayquery[$i];

    $data .= '<tr>  
        <td>'.$number.'</td>
        <td>'.$row['userid'].'</td>
        <td>'.$row['under_userid'].'</td>
        <td>'.$row['stage'].'</td>
        <td>'.$row['level'].'</td>
        <td>'.$row['temp_leftcount'].'</td>
        <td>'.$row['temp_rightcount'].'</td>
        <td>'.$row['l1_half'].'</td>
        <td>'.$row['l1'].'</td>
        <td>'.$row['l2_half'].'</td>
        <td>'.$row['l2'].'</td>
        <td>'.$row['l3_half'].'</td>
        <td>'.$row['l3'].'</td>
        <td>'.$row['l4_half'].'</td>
        <td>'.$row['l4'].'</td>
    </tr>';
    $number++;

}
} 
$data .= '</table>';
echo $data;

//  } 

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