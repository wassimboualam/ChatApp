<?php
    session_start();
    require_once "config.php";
    $fname = mysqli_real_escape_string($conn, $_POST["fname"]);
    $lname = mysqli_real_escape_string($conn, $_POST["lname"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    if (!($fname=="" || $lname=="" || $email=="" || $password=="")) {
        // check if email valid
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) { // email is valid
            // check if email is unique
            $sql = mysqli_query($conn, "SELECT email FROM users WHERE email = '{$email}'");
            if (mysqli_num_rows($sql) > 0) { // email is duplicate
                echo "$email - This email already exists";
            } else { // email is unique
                // check if file is uploaded
                if (isset($_FILES["image"])) { // if file is uploaded
                    $img_name = $_FILES["image"]["name"];
                    $img_type = $_FILES["image"]["type"];
                    $tmp_name = $_FILES["image"]["tmp_name"];

                    // exploding image to get the extension name (jpg/png...)
                    $img_explode = explode(".", $img_name);
                    $img_ext = end($img_explode); // here is the image extension name

                    $extensions = ["png", "jpeg", "jpg"]; // valid image extensions

                    if (in_array($img_ext, $extensions)) {
                        $time = time();

                        $new_img_name = $time.$img_name;

                        move_uploaded_file($tmp_name, "./images/".$new_img_name);

                        $status = "Active now";

                        $random_id = rand($time,10000000);

                        // inserting data
                        $sql2 = mysqli_query($conn, "INSERT INTO users (unique_id, fname, lname, email, password, img, status)
                                            VALUES ({$random_id}, '{$fname}', '{$lname}', '{$email}', '{$password}', '{$new_img_name}', '{$status}')");
                        if ($sql2) { // if data is inserted
                            $sql3 = mysqli_query($conn,"SELECT * FROM users WHERE email = '{$email}'");
                            if (mysqli_num_rows($sql3) > 0) {
                                $row = mysqli_fetch_array($sql3);
                                $_SESSION["unique_id"] = $row["unique_id"]; // using this session we used user unique_id in other php file
                                echo "success";
                            }
                        } else {
                            echo "Something went wrong";
                        }
                        
                    } else {
                        $img_ext = "";
                    }
                } else {
                    echo "Please select an image file!";
                }
                
            }
        } else {
            echo "$email is not valid!";
        }
    }else {
        echo"All input fields are required!";
    }

?>