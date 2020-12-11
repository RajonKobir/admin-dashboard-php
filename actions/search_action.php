<?php
include('../php-includes/connect.php');

if(isset($_POST['query'])){

    $input_text = $_POST['query'];

    $query = PDO_FetchAll("SELECT user_id FROM user WHERE user_id LIKE '%$input_text%'");
    $result = count($query);
    if($result > 0){
            for($i=0; $i < $result; $i++){
            echo "<a class='list-group-item list-group-item-action border-1'>".$query[$i]['user_id']."</a>";
        }
    }else{
        echo "<p class='list-group-item border-1'> No Results!  </p>";
    }
}





?>