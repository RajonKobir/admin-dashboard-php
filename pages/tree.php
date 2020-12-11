<?php
include('../php-includes/connect.php');
// include('../php-includes/check-login.php');
// $user_id = $_SESSION['userid'];
// $search = $user_id;


function tree_data($user_id){
global $con;
$data = array();
$tooltip = array();
$query = PDO_FetchAll("SELECT * FROM tree WHERE userid = '$user_id'");

if(count($query) > 0){
$result = $query[0];
// echo count($query);

array_push($tooltip, $result["user_name"]);

$data['left'] = $result['left'];
$data['right'] = $result['right'];
$data['leftcount'] = $result['leftcount'];
$data['rightcount'] = $result['rightcount'];

return $data;
}
}   //end of function tree_data



// to show names in tooltips
function show_name($user_id){
global $con;
$query = PDO_FetchAll("select * from tree where userid='$user_id'");
$result = $query[0];

$data = $result['user_name'];

return $data;
}



?>
<?php 
if(isset($_GET['search-id'])){
$search_id = $_GET['search-id'];
if($search_id!=""){
$query_check = PDO_FetchAll("select * from user where user_id='$search_id'");
if(count($query_check) > 0){
$search = $search_id;
}
else{
echo '<script>alert("Access Denied");window.location.assign("tree.php");</script>';
}
}
else{
echo '<script>alert("Access Denied");window.location.assign("tree.php");</script>';
} 
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
<title>Ideal IT - Tree</title>


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
<h1 class="page-header page_heading text-center">Tree</h1>
</div>
<!-- /.col-lg-12 -->
</div>
<!-- /.row -->
<div class="row">
<div class="col-lg-12">
<div class="table-responsive">
<table class="table" align="center" border="0" style="text-align:center;">
<tr height="100">
<?php
$data = tree_data($search);
?>
<td><?php echo $data['leftcount'] ?></td>
<td colspan="14"><i class="fa fa-star fa-4x" style="color:#1430B1;font-size:60px"></i><p title="<?php echo show_name($search);?>"><?php echo $search; ?></p></td>
<td><?php echo $data['rightcount'] ?></td>
</tr>
<tr height="100">
<?php
$first_left_user = $data['left'];
$first_right_user = $data['right'];
?>
<?php 
if($first_left_user!=""){
?>
<td colspan="8"><a title="<?php echo show_name($first_left_user);?>" href="tree.php?search-id=<?php echo $first_left_user ?>"><i class="fa fa-star fa-4x" style="color:#D520BE"></i><p><?php echo $first_left_user ?></p></a></td>
<?php 
}
else{
?>
<td colspan="8"><i class="fa fa-star fa-4x" style="color:#361515"></i><p><?php echo $first_left_user ?></p></td>
<?php
}
?>
<?php 
if($first_right_user!=""){
?>
<td colspan="12"><a title="<?php echo show_name($first_right_user);?>" href="tree.php?search-id=<?php echo $first_right_user ?>"><i class="fa fa-star fa-4x" style="color:#D520BE"></i><p><?php echo $first_right_user ?></p></a></td>
<?php 
}
else{
?>
<td colspan="12"><i class="fa fa-star fa-4x" style="color:#361515"></i><p><?php echo $first_right_user ?></p></td>
<?php
}
?>
</tr>
<tr height="100">
<?php 
$data_first_left_user = tree_data($first_left_user);
$second_left_user = $data_first_left_user['left'];
$second_right_user = $data_first_left_user['right'];

$data_first_right_user = tree_data($first_right_user);
$third_left_user = $data_first_right_user['left'];
$thidr_right_user = $data_first_right_user['right'];
?>
<?php 
if($second_left_user!=""){
?>
<td colspan="4"><a title="<?php echo show_name($second_left_user);?>" href="tree.php?search-id=<?php echo $second_left_user ?>"><i class="fa fa-star fa-4x" style="color:yellow;font-size:45px"></i><p><?php echo $second_left_user ?></p></a></td>
<?php 
}
else{
?>
<td colspan="4"><i class="fa fa-star fa-4x" style="color:#361515;font-size:45px"></i></td>
<?php
}
?>
<?php 
if($second_right_user!=""){
?>
<td colspan="4"><a title="<?php echo show_name($second_right_user);?>" href="tree.php?search-id=<?php echo $second_right_user ?>"><i class="fa fa-star fa-4x" style="color:yellow;font-size:45px"></i><p><?php echo $second_right_user ?></p></a></td>
<?php 
}
else{
?>
<td colspan="4"><i class="fa fa-star fa-4x" style="color:#361515;font-size:45px"></i></td>
<?php
}
?>
<?php 
if($third_left_user!=""){
?>
<td colspan="4"><a title="<?php echo show_name($third_left_user);?>" href="tree.php?search-id=<?php echo $third_left_user ?>"><i class="fa fa-star fa-4x" style="color:yellow;font-size:45px"></i><p><?php echo $third_left_user ?></p></a></td>
<?php 
}
else{
?>
<td colspan="4"><i class="fa fa-star fa-4x" style="color:#361515;font-size:45px"></i></td>
<?php
}
?>
<?php 
if($thidr_right_user !=""){
?>
<td colspan="4"><a title="<?php echo show_name($thidr_right_user);?>" href="tree.php?search-id=<?php echo $thidr_right_user ?>"><i class="fa fa-star fa-4x" style="color:yellow;font-size:45px"></i><p><?php echo $thidr_right_user ?></p></a></td>
<?php 
}
else{
?>
<td colspan="4"><i class="fa fa-star fa-4x" style="color:#361515;font-size:45px"></i></td>
<?php
}
?>


</tr>
<tr height="100">
<?php 
$level_3_1_2 = tree_data($second_left_user);
$level_3_1 = $level_3_1_2['left'];
$level_3_2 = $level_3_1_2['right'];

$level_3_3_4 = tree_data($second_right_user);
$level_3_3 = $level_3_3_4['left'];
$level_3_4 = $level_3_3_4['right'];

$level_3_5_6 = tree_data($third_left_user);
$level_3_5 = $level_3_5_6['left'];
$level_3_6 = $level_3_5_6['right'];

$level_3_7_8 = tree_data($thidr_right_user);
$level_3_7 = $level_3_7_8['left'];
$level_3_8 = $level_3_7_8['right'];

?>

<?php 
if($level_3_1 !=""){
?>
<td colspan="2"><a title="<?php echo show_name($level_3_1);?>" href="tree.php?search-id=<?php echo $level_3_1 ?>"><i class="fa fa-star fa-4x" style="color:#22CEFE;font-size:40px"></i><p><?php echo $level_3_1 ?></p></a></td>
<?php 
}
else{
?>
<td colspan="2"><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
<?php
}
?>
<?php 
if($level_3_2!=""){
?>
<td colspan="2"><a title="<?php echo show_name($level_3_2);?>" href="tree.php?search-id=<?php echo $level_3_2 ?>"><i class="fa fa-star fa-4x" style="color:#22CEFE;font-size:40px"></i><p><?php echo $level_3_2 ?></p></a></td>
<?php 
}
else{
?>
<td colspan="2"><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
<?php
}
?>
<?php 
if($level_3_3!=""){
?>
<td colspan="2"><a title="<?php echo show_name($level_3_3);?>" href="tree.php?search-id=<?php echo $level_3_3 ?>"><i class="fa fa-star fa-4x" style="color:#22CEFE;font-size:40px"></i><p><?php echo $level_3_3 ?></p></a></td>
<?php 
}
else{
?>
<td colspan="2"><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
<?php
}
?>
<?php 
if($level_3_4!=""){
?>
<td colspan="2"><a title="<?php echo show_name($level_3_4);?>" href="tree.php?search-id=<?php echo $level_3_4 ?>"><i class="fa fa-star fa-4x" style="color:#22CEFE;font-size:40px"></i><p><?php echo $level_3_4 ?></p></a></td>
<?php 
}
else{
?>
<td colspan="2"><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
<?php
}
if($level_3_5!=""){
    ?>
    <td colspan="2"><a title="<?php echo show_name($level_3_5);?>" href="tree.php?search-id=<?php echo $level_3_5 ?>"><i class="fa fa-star fa-4x" style="color:#22CEFE;font-size:40px"></i><p><?php echo $level_3_5 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td colspan="2"><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }
    ?>
    <?php 
    if($level_3_6!=""){
    ?>
    <td colspan="2"><a title="<?php echo show_name($level_3_6);?>" href="tree.php?search-id=<?php echo $level_3_6 ?>"><i class="fa fa-star fa-4x" style="color:#22CEFE;font-size:40px"></i><p><?php echo $level_3_6 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td colspan="2"><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }
    ?>
    <?php 
    if($level_3_7!=""){
    ?>
    <td colspan="2"><a title="<?php echo show_name($level_3_7);?>" href="tree.php?search-id=<?php echo $level_3_7 ?>"><i class="fa fa-star fa-4x" style="color:#22CEFE;font-size:40px"></i><p><?php echo $level_3_7 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td colspan="2"><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }
    ?>
    <?php 
    if($level_3_8!=""){
    ?>
    <td colspan="2"><a title="<?php echo show_name($level_3_8);?>" href="tree.php?search-id=<?php echo $level_3_8 ?>"><i class="fa fa-star fa-4x" style="color:#22CEFE;font-size:40px"></i><p><?php echo $level_3_8 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td colspan="2"><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }


?>



</tr>
<tr height="100">
<?php 
$level_4_1_2 = tree_data($level_3_1);
$level_4_1 = $level_4_1_2['left'];
$level_4_2 = $level_4_1_2['right'];

$level_4_3_4 = tree_data($level_3_2);
$level_4_3 = $level_4_3_4['left'];
$level_4_4 = $level_4_3_4['right'];

$level_4_5_6 = tree_data($level_3_3);
$level_4_5 = $level_4_5_6['left'];
$level_4_6 = $level_4_5_6['right'];

$level_4_7_8 = tree_data($level_3_4);
$level_4_7 = $level_4_7_8['left'];
$level_4_8 = $level_4_7_8['right'];

$level_4_9_10 = tree_data($level_3_5);
$level_4_9 = $level_4_9_10['left'];
$level_4_10 = $level_4_9_10['right'];

$level_4_11_12 = tree_data($level_3_6);
$level_4_11 = $level_4_11_12['left'];
$level_4_12 = $level_4_11_12['right'];

$level_4_13_14 = tree_data($level_3_7);
$level_4_13 = $level_4_13_14['left'];
$level_4_14 = $level_4_13_14['right'];

$level_4_15_16 = tree_data($level_3_8);
$level_4_15 = $level_4_15_16['left'];
$level_4_16 = $level_4_15_16['right'];

?>

<?php 
if($level_4_1 !=""){
?>
<td><a title="<?php echo show_name($level_4_1);?>" href="tree.php?search-id=<?php echo $level_4_1 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_1 ?></p></a></td>
<?php 
}
else{
?>
<td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
<?php
}
?>
<?php 
if($level_4_2 !=""){
?>
<td><a title="<?php echo show_name($level_4_2);?>" href="tree.php?search-id=<?php echo $level_4_2 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_2 ?></p></a></td>
<?php 
}
else{
?>
<td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
<?php
}
?>
<?php 
if($level_4_3 !=""){
?>
<td><a title="<?php echo show_name($level_4_3);?>" href="tree.php?search-id=<?php echo $level_4_3 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_3 ?></p></a></td>
<?php 
}
else{
?>
<td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
<?php
}
?>
<?php 
if($level_4_4!=""){
?>
<td><a title="<?php echo show_name($level_4_4);?>" href="tree.php?search-id=<?php echo $level_4_4 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_4 ?></p></a></td>
<?php 
}
else{
?>
<td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
<?php
}
if($level_4_5!=""){
    ?>
    <td><a title="<?php echo show_name($level_4_5);?>" href="tree.php?search-id=<?php echo $level_4_5 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_5 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }
    ?>
    <?php 
    if($level_4_6!=""){
    ?>
    <td><a title="<?php echo show_name($level_4_6);?>" href="tree.php?search-id=<?php echo $level_4_6 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_6 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }
    ?>
    <?php 
    if($level_4_7!=""){
    ?>
    <td><a title="<?php echo show_name($level_4_7);?>" href="tree.php?search-id=<?php echo $level_4_7 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_7 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }
    ?>
    <?php 
    if($level_4_8!=""){
    ?>
    <td><a title="<?php echo show_name($level_4_8);?>" href="tree.php?search-id=<?php echo $level_4_8 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_8 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }


if($level_4_9 !=""){
    ?>
    <td><a title="<?php echo show_name($level_4_9);?>" href="tree.php?search-id=<?php echo $level_4_9 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_9 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }
    ?>
    <?php 
    if($level_4_10!=""){
    ?>
    <td><a title="<?php echo show_name($level_4_10);?>" href="tree.php?search-id=<?php echo $level_4_10 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_10 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }
    ?>
    <?php 
    if($level_4_11!=""){
    ?>
    <td><a title="<?php echo show_name($level_4_11);?>" href="tree.php?search-id=<?php echo $level_4_11 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_11 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }
    ?>
    <?php 
    if($level_4_12!=""){
    ?>
    <td><a title="<?php echo show_name($level_4_12);?>" href="tree.php?search-id=<?php echo $level_4_12 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_12 ?></p></a></td>
    <?php 
    }
    else{
    ?>
    <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
    <?php
    }
    if($level_4_13!=""){
        ?>
        <td><a title="<?php echo show_name($level_4_13);?>" href="tree.php?search-id=<?php echo $level_4_13 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_13 ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
        <?php
        }
        ?>
        <?php 
        if($level_4_14!=""){
        ?>
        <td><a title="<?php echo show_name($level_4_14);?>" href="tree.php?search-id=<?php echo $level_4_14 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_14 ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
        <?php
        }
        ?>
        <?php 
        if($level_4_15!=""){
        ?>
        <td><a title="<?php echo show_name($level_4_15);?>" href="tree.php?search-id=<?php echo $level_4_15 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_15 ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
        <?php
        }
        ?>
        <?php 
        if($level_4_16!=""){
        ?>
        <td><a title="<?php echo show_name($level_4_16);?>" href="tree.php?search-id=<?php echo $level_4_16 ?>"><i class="fa fa-star fa-4x" style="color:green;font-size:40px"></i><p><?php echo $level_4_16 ?></p></a></td>
        <?php 
        }
        else{
        ?>
        <td><i class="fa fa-star fa-4x" style="color:#361515;font-size:40px"></i></td>
        <?php
        }
    
    

?>






</tr>
</table>
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