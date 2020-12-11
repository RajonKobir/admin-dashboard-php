<?php
date_default_timezone_set('Asia/Dhaka');


// connecting SQLite3 database
include "../database/_pdo.php";


//Connecting to a database file
$db_file = "../database/ideal_software.sqlite3";
PDO_Connect("sqlite:$db_file");



    // $db_host = "localhost";
    // $db_user = "root";
    // $db_pass = "";
    // $db_name = "ideal_software";

    // $con =  mysqli_connect($db_host,$db_user,$db_pass,$db_name);
    // if(mysqli_connect_error()){
    //     echo 'connect to database failed';
    // }
?>