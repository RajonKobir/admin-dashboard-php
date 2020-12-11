<?php
// include('../php-includes/check-login.php');
include('../php-includes/connect.php');
// $user_id = $_SESSION['userid'];

// initializing the variables
$current_date = strtotime(date('Y-m-d')); 
$current_date_day = date('D', $current_date);
if($current_date_day == "Mon"){
    $next_monday_date = date('Y-m-d', $current_date);
}else{
    $next_monday = strtotime('next monday', $current_date);
    $next_monday_date = date('Y-m-d', $next_monday);
}
$pre_monday = strtotime('previous monday', $current_date);
$pre_monday_date = date('Y-m-d', $pre_monday);

// Total Honorable Members
$row = PDO_FetchOne("SELECT count( * ) as  user_id FROM user");
// $query = PDO_FetchOne("SELECT count( * ) as  user_id FROM user");
// $result = $con->query($query);
// $row = mysqli_fetch_assoc($result);

// Joined This Week
$row2 = PDO_FetchOne("SELECT COUNT( * ) FROM user WHERE joining_date BETWEEN '$pre_monday_date' AND '$next_monday_date'");
// $query2 = "SELECT count( * ) FROM user WHERE (joining_date < CAST('$next_monday_date' AS DATE)) AND (joining_date >= CAST('$pre_monday_date' AS DATE))";
// $result2 = $con->query($query2);
// $row2 = mysqli_fetch_assoc($result2);

// Joined This Month
$next_month = strtotime('last day of this month', $current_date);
$next_month_date = date('Y-m-d', $next_month);
$pre_month = strtotime('first day of this month', $current_date);
$pre_month_date = date('Y-m-d', $pre_month);
$row3 = PDO_FetchOne("SELECT count( * ) FROM user WHERE joining_date BETWEEN '$pre_month_date' AND '$next_month_date'");
// $query3 = "SELECT count( * ) FROM user WHERE (joining_date <= CAST('$next_month_date' AS DATE)) AND (joining_date >= CAST('$pre_month_date' AS DATE))";
// $result3 = $con->query($query3);
// $row3 = mysqli_fetch_assoc($result3);



// Joined This Year
$next_year = strtotime('last day of december this year', $current_date);
$next_year_date = date('Y-m-d', $next_year);
$pre_year = strtotime('first day of january this year', $current_date);
$pre_year_date = date('Y-m-d', $pre_year);
$row4 = PDO_FetchOne("SELECT count( * ) FROM user WHERE joining_date BETWEEN '$pre_year_date' AND '$next_year_date'");
// $query4 = "SELECT count( * ) FROM user WHERE 
// (joining_date <= CAST('$next_year_date' AS DATE)) AND (joining_date >= CAST('$pre_year_date' AS DATE))
// ";
// $result4 = $con->query($query4);
// $row4 = mysqli_fetch_assoc($result4);


// Billout This Week
$row5 = PDO_FetchOne("SELECT count( * ) FROM tree WHERE 
(l1 BETWEEN '$pre_monday_date' AND '$next_monday_date')
OR (l2 BETWEEN '$pre_monday_date' AND '$next_monday_date')
OR (l3 BETWEEN '$pre_monday_date' AND '$next_monday_date')
OR (l4 BETWEEN '$pre_monday_date' AND '$next_monday_date')
");
// $query5 = "SELECT count( * ) FROM tree WHERE 
// (l1 > CAST('$pre_monday_date' AS DATE) AND l1 <= CAST('$next_monday_date' AS DATE))
// OR (l2 > CAST('$pre_monday_date' AS DATE) AND l2 <= CAST('$next_monday_date' AS DATE))
// OR (l3 > CAST('$pre_monday_date' AS DATE) AND l3 <= CAST('$next_monday_date' AS DATE))
// OR (l4 > CAST('$pre_monday_date' AS DATE) AND l4 <= CAST('$next_monday_date' AS DATE))
// ;";
// $result5 = $con->query($query5);
// $row5 = mysqli_fetch_assoc($result5);


// Billout This Month
$row6 = PDO_FetchOne("SELECT count( * ) FROM tree WHERE 
(l1 BETWEEN '$pre_month_date' AND '$next_month_date')
OR (l2 BETWEEN '$pre_month_date' AND '$next_month_date')
OR (l3 BETWEEN '$pre_month_date' AND '$next_month_date')
OR (l4 BETWEEN '$pre_month_date' AND '$next_month_date')
");
// $query6 = "SELECT count( * ) FROM tree WHERE 
// (l1 >= CAST('$pre_month_date' AS DATE) AND l1 < CAST('$next_month_date' AS DATE))
// OR (l2 >= CAST('$pre_month_date' AS DATE) AND l2 < CAST('$next_month_date' AS DATE))
// OR (l3 >= CAST('$pre_month_date' AS DATE) AND l3 < CAST('$next_month_date' AS DATE))
// OR (l4 >= CAST('$pre_month_date' AS DATE) AND l4 < CAST('$next_month_date' AS DATE))
// ;";
// $result6 = $con->query($query6);
// $row6 = mysqli_fetch_assoc($result6);




// Billout Previous Month
$pre_month2 = strtotime('first day of previous month', $current_date);
$pre_month_date2 = date('Y-m-d', $pre_month2);
$pre_month3 = strtotime('last day of previous month', $current_date);
$pre_month_date3 = date('Y-m-d', $pre_month3);
$row7 = PDO_FetchOne("SELECT count( * ) FROM tree WHERE 
(l1 BETWEEN '$pre_month_date2' AND '$pre_month_date3')
OR (l2 BETWEEN '$pre_month_date2' AND '$pre_month_date3')
OR (l3 BETWEEN '$pre_month_date2' AND '$pre_month_date3')
OR (l4 BETWEEN '$pre_month_date2' AND '$pre_month_date3')
");
// $query7 = "SELECT count( * ) FROM tree WHERE 
// (l1 >= CAST('$pre_month_date2' AS DATE) AND l1 <= CAST('$pre_month_date3' AS DATE))
// OR (l2 >= CAST('$pre_month_date2' AS DATE) AND l2 <= CAST('$pre_month_date3' AS DATE))
// OR (l3 >= CAST('$pre_month_date2' AS DATE) AND l3 <= CAST('$pre_month_date3' AS DATE))
// OR (l4 >= CAST('$pre_month_date2' AS DATE) AND l4 <= CAST('$pre_month_date3' AS DATE))
// ;";
// $result7 = $con->query($query7);
// $row7 = mysqli_fetch_assoc($result7);


// Joined Previous Month
$row8 = PDO_FetchOne("SELECT count( * ) FROM user WHERE joining_date BETWEEN '$pre_month_date3' AND '$pre_month_date2'");
// $query8 = "SELECT count( * ) FROM user WHERE (joining_date <= CAST('$pre_month_date3' AS DATE)) AND (joining_date >= CAST('$pre_month_date2' AS DATE))";
// $result8 = $con->query($query8);
// $row8 = mysqli_fetch_assoc($result8);


// Joined Previous Week
$pre_monday2 = strtotime('previous monday', $pre_monday);
$pre_monday_date2 = date('Y-m-d', $pre_monday2);
$row9 = PDO_FetchOne("SELECT count( * ) FROM user WHERE joining_date BETWEEN '$pre_monday_date2' AND '$pre_monday_date'");
// $query9 = "SELECT count( * ) FROM user WHERE (joining_date >= CAST('$pre_monday_date2' AS DATE)) AND (joining_date < CAST('$pre_monday_date' AS DATE))";
// $result9 = $con->query($query9);
// $row9 = mysqli_fetch_assoc($result9);



?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Ideal IT - Home</title>


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
                        <h1 class="page-header page_heading text-center">Admin Home</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">

                	<div class="col-lg-4">
                    	<div class="panel panel-info">
                        	<div class="panel-heading">
                            	<h4 class="panel-title red" id="first_header">Total Honorable Members</h4>
                            </div>
                            <div class="panel-body red">
                                    <?php echo $row; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    	<div class="panel panel-success">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Joined This Week</h4>
                            </div>
                            <div class="panel-body">
                                    <?php echo $row2; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    	<div class="panel panel-danger">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Billout This Week</h4>
                            </div>
                            <div class="panel-body">
                            <?php echo $row5; ?>
                            </div>
                        </div>
                    </div>
                </div> <!-- /.row -->

                 <!-- /.row -->
                <div class="row">

                <div class="col-lg-4">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <h4 class="panel-title">Joined This Month</h4>
                        </div>
                        <div class="panel-body">
                        <?php echo $row3; ?>
                        </div>
                    </div>
                </div>    
                
                    <div class="col-lg-4">
                    	<div class="panel panel-success">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Joined Previous Week</h4>
                            </div>
                            <div class="panel-body">
                            <?php echo $row9; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                    	<div class="panel panel-danger">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Billout This Month</h4>
                            </div>
                            <div class="panel-body">
                            <?php echo $row6; ?>
                            </div>
                        </div>
                    </div>
                </div>  <!-- /.row -->


<!-- /.row -->
<div class="row">

<div class="col-lg-4">
    <div class="panel panel-info">
        <div class="panel-heading">
            <h4 class="panel-title">Joined This Year</h4>
        </div>
        <div class="panel-body">
            <?php echo $row4; ?>
        </div>
    </div>
</div>


<div class="col-lg-4">
    <div class="panel panel-success">
        <div class="panel-heading">
            <h4 class="panel-title">Joined Previous Month</h4>
        </div>
        <div class="panel-body">
        <?php echo $row8; ?>
        </div>
    </div>
</div>
<div class="col-lg-4">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h4 class="panel-title">Billout Previous Month</h4>
        </div>
        <div class="panel-body">
        <?php echo $row7; ?>
        </div>
    </div>
</div>
</div>  <!-- /.row -->




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
