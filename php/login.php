<?php
    session_start();
    require_once "config.php";
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);

    // check if user entered email and password
    if (!empty($email) && !empty($password)) {
        // check for existing email and password in database
        $sql = mysqli_query($conn, "SELECT * FROM users WHERE email = '{$email}' AND password = '{$password}'");
        if (mysqli_num_rows($sql) > 0) {
            $row = mysqli_fetch_assoc($sql);
            $_SESSION["unique_id"] = $row["unique_id"];
            // update user status
            $sql2 = mysqli_query($conn,"UPDATE users SET `status` = 'Active now' WHERE unique_id = '{$_SESSION["unique_id"]}'");
            if ($sql2) { // if update successful
                echo "success";
            } else { // if update failed
                echo "Server error";
            }            
        } else {
            echo"Email or Password is incorrect";
        }
    }
    else {
        echo "All input fields are required!";
    }
?>