<?php
include('../php-includes/connect.php');
// include('../php-includes/check-login.php');
// $user_id = $_SESSION['userid'];
// $search = $user_id;

$current_date = strtotime(date('Y-m-d')); 
$current_date_day = date('D', $current_date);
if($current_date_day == "Mon"){
    $next_monday = $current_date;
    $next_monday_date = date('Y-m-d', $current_date);
}else{
    $next_monday = strtotime('next monday', $current_date);
    $next_monday_date = date('Y-m-d', $next_monday);
}

$pre_monday = strtotime('previous monday', $current_date);
$pre_monday_date = date('Y-m-d', $pre_monday);

if(isset($_POST['submit_date'])){
    $pre_monday_date = $_POST['starting_date'];
    $next_monday_date = $_POST['closing_date'];
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
<title class="avoid_print">Ideal IT - Bill-<?php  echo $next_monday_date; ?></title>


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
<h1 class="text-center" style="color:#FF0101;">Ideal Consultancy & Trading</h1>
<p class="text-center" style="color:#FF0101;">Plot#1/A, Road#1/B, Nikunja 2, Khilkhet, Dhaka-1229</p>
<h4 class="text-center" style="color:#FF0101;">Weekly Bill : <?php  echo $next_monday_date; ?> </h4>
<span class="avoid_print"> 
    <form method="post">
        <span style="color:#FF0101;"> Starting Date: <input type="date" name="starting_date" value="<?php  echo $pre_monday_date; ?>"> </span>
        <span style="color:#FF0101;"> Closing Date: <input type="date" name="closing_date" value="<?php echo $next_monday_date; ?>"> </span>
        <span> <input type="submit" name="submit_date" value="Submit" class="btn"> </span>
    <form>
</span>
<span style="margin-left: 5%"> <a class="btn avoid_print" title="Print Screen" alt="Print Screen" onclick="window.print();" target="_blank" style="cursor:pointer"> Print Now! </a> </span>

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

<?php 

    $data =  '<table class="table table-bordered table-striped">
                    <tr>
                        <th>No.</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Stage</th>
                        <th>Level</th>
                        <th>P1</th>
                        <th>P2</th>
                        <th>Level One</th> 
                        <th>Level Two</th> 
                        <th>Level Three</th> 
                        <th>Level Four</th> 
                        <th>Total Bill</th> 
                        <th>10% Less Bill</th> 
                        <th>Signature</th> 
                    </tr>';  
   
                    

if(isset($_POST['submit_date'])){
    $starting_date = $_POST['starting_date'];
    $closing_date = $_POST['closing_date'];
// Declare two dates 
$start_date = strtotime("$starting_date"); 
$end_date = strtotime("$closing_date"); 
  
// Get the difference and divide into  
// total no. seconds 60/60/24 to get  
// number of days 
// $day_difference_general = abs ( floor (($end_date - $start_date)/60/60/24)); 



$query = PDO_FetchAll("SELECT * FROM tree WHERE 
(l1 BETWEEN '$starting_date' AND '$closing_date')
OR (l1_half BETWEEN '$starting_date' AND '$closing_date')
OR (l2 BETWEEN '$starting_date' AND '$closing_date')
OR (l2_half BETWEEN '$starting_date' AND '$closing_date')
OR (l3 BETWEEN '$starting_date' AND '$closing_date')
OR (l3_half BETWEEN '$starting_date' AND '$closing_date')
OR (l4 BETWEEN '$starting_date' AND '$closing_date')
OR (l4_half BETWEEN '$starting_date' AND '$closing_date')
");
$result = count($query);

if($result > 0){

$number = 1;
$next_page = 1;
for($i=0; $i < $result; $i++) {
    $bill = 0;
    $row = $query[$i];


    if($next_page == 14){
        $data .=  "</table>
        <h1 class='text-center' style='color:#FF0101;'>Ideal Consultancy & Trading</h1>
        <p class='text-center' style='color:#FF0101;'>Plot#1/A, Road#1/B, Nikunja 2, Khilkhet, Dhaka-1229</p>
        <h4 class='text-center' style='color:#FF0101;'>Weekly Bill :   $next_monday_date</h4>
        <table class='table table-bordered table-striped'>
                    <tr>
                        <th>No.</th>
                        <th>User ID</th>
                        <th>User Name</th>
                        <th>Stage</th>
                        <th>Level</th>
                        <th>P1</th>
                        <th>P2</th>
                        <th>Level One</th> 
                        <th>Level Two</th> 
                        <th>Level Three</th> 
                        <th>Level Four</th> 
                        <th>Total Bill</th> 
                        <th>10% Less Bill</th> 
                        <th>Signature</th> 
                    </tr>";
                   $next_page = 1;
    }



    // convert the date to seconds 
    $d1_l1 = strtotime($row['l1']); 
    $d1_l1_half = strtotime($row['l1_half']); 

    if(($d1_l1 >= $start_date) && ($d1_l1 <= $end_date)){
        $bill += 1000;
        $l1 = 'yes';
    }
    elseif(($d1_l1_half >= $start_date) && ($d1_l1_half <= $end_date)){
        $bill += 500;
        $l1 = 'half';
    }else{
        $l1 = 'no';
    }

    
        // convert the date to seconds  
        $d1_l2 = strtotime($row['l2']); 
        $d1_l2_half = strtotime($row['l2_half']); 

        if(($d1_l2 >= $start_date) && ($d1_l2 <= $end_date)){
        $bill += 2000;
        $l2 = 'yes';
    }
    elseif(($d1_l2_half >= $start_date) && ($d1_l2_half <= $end_date)){
        $bill += 1000;
        $l2 = 'half';
    }else{
        $l2 = 'no';
    }

        //convert the date to seconds  
        $d1_l3 = strtotime($row['l3']); 
        $d1_l3_half = strtotime($row['l3_half']); 

    if(($d1_l3 >= $start_date) && ($d1_l3 <= $end_date)){
        $bill += 4000;
        $l3 = 'yes';
    }
    elseif(($d1_l3_half >= $start_date) && ($d1_l3_half <= $end_date)){
        $bill += 2000;
        $l3 = 'half';
    }else{
        $l3 = 'no';
    }

        // convert the date to seconds 
        $d1_l4 = strtotime($row['l4']); 
        $d1_l4_half = strtotime($row['l4_half']); 

    if(($d1_l4 >= $start_date) && ($d1_l4 <= $end_date)){
        $bill += 8000;
        $l4 = 'yes';
    }
    elseif(($d1_l4_half >= $start_date) && ($d1_l4_half <= $end_date)){
        $bill += 4000;
        $l4 = 'half';
    }else{
        $l4 = 'no';
    }



    $less_bill = $bill*90/100;

    $data .= '<tr>  
        <td>'.$number.'</td>
        <td>'.$row['userid'].'</td>
        <td>'.$row['user_name'].'</td>
        <td>'.$row['stage'].'</td>
        <td>'.$row['level'].'</td>
        <td>'.$row['temp_leftcount'].'</td>
        <td>'.$row['temp_rightcount'].'</td>
        <td>'.$l1.'</td>
        <td>'.$l2.'</td>
        <td>'.$l3.'</td>
        <td>'.$l4.'</td>
        <td>'.$bill.'</td>
        <td>'.$less_bill.'</td>
        <td>   </td>
    </tr>';
    $number++;
    $next_page++;

}   // end of for loop
} 
$data .= '</table>';
} 
echo $data;



?>


<!-- 
</div>
</div>
</div> -->


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