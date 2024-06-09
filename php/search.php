<?php
    session_start();
    include_once "config.php";
    $searchTerm = mysqli_real_escape_string($conn, $_POST["searchTerm"]);
    $output = '';
    $outgoing_id = $_SESSION["unique_id"];

    $sql = mysqli_query(
        $conn,
        "SELECT * FROM users
         WHERE CONCAT(fname,' ',lname) LIKE '%{$searchTerm}%'
         AND NOT unique_id = {$_SESSION['unique_id']}"
    );
    if (mysqli_num_rows($sql) > 0) {
        include "data.php";
    }else {
        $output .= "No user found related to your search term";
    }
    echo $output;
?>