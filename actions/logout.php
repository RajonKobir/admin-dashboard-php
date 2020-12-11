<?php
session_start();
session_destroy();
echo '<script>alert("Logged Out Successfully!");window.location.assign("../index.php");</script>';
?>