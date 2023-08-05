<?php
include "database.php";
session_start();
sleep(1);
if ($_POST['testInput']) {
    $testName = $_POST["testInput"];
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    date_default_timezone_set("Asia/Qatar");
    $date = date("Y/m/d H:i:s");
    //$halapassword = $_POST["password"];
    $hashPassword = password_hash($password, PASSWORD_DEFAULT);
    $checkQuery = "SELECT user_email FROM tblUsers where user_email = '$email'";
    $check_email = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($check_email) > 0) {
        echo "Email already Exist";

    } else {
        $insertQuery = "";
        $userStatus = 1;
        $userRole = "user";
        if (!empty($_FILES['fileUpload']['name'])) {
            //echo "Success";
            $file_pointer = 'profilephotos';
            if (!file_exists($file_pointer)) {
                mkdir("profilephotos");
            }
            $filename = $_FILES['fileUpload']['name'];
            $location = "profilephotos/" . $filename;
            $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
            $newFilename = $email . "." . $imageFileType;
            $location = "profilephotos/" . $newFilename;
            move_uploaded_file($_FILES['fileUpload']['tmp_name'], $location);
            $insertQuery = "INSERT into tblUsers(user_firstname,user_lastname,user_email,user_password,user_phone,user_dateRegister,user_role,user_picture,user_status) values('$fname','$lname','$email','$hashPassword','$phone','$date','$userRole','$location','$userStatus')";

        } else {
            $dp = "profilephotos/default.jpg";
            $insertQuery = "INSERT into tblUsers(user_firstname,user_lastname,user_email,user_password,user_phone,user_dateRegister,user_role,user_picture,user_status) values('$fname','$lname','$email','$hashPassword','$phone','$date','$userRole','$dp','$userStatus')";
            //$result = mysqli_query($conn, $insertQuery) or die(mysqli_error($conn));
            // if ($result) {
            //     echo "Registration Successful";
            // } else {
            //     echo "Registration Failed";
            // }
            // echo "photo";
        }
        $result = mysqli_query($conn, $insertQuery) or die(mysqli_error($conn));
        if ($result) {
            echo "Registration Successful";
        } else {
            echo "Registration Failed";
        }


    }
}


// if (password_verify($password, $hash)) {
//     echo "password: " . $password . " , new: " . $hash . "----Yes they are same";
// } else {
//     echo "They are not same";
// }
//$existingpassword = preg_replace('/([\r\n\t])/', '', $hash);
//echo "old password: " . $hash . " --  new Password: " . $existingpassword;
//echo "name: " . $fname . " " . $lname . " : " . $email . " : " . $phone . " : " . $password . " : " . $hash . " : " . $testName;
else {
    echo "not set";
}



?>