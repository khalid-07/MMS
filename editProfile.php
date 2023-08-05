<?php
include "database.php";
session_start();

    if(isset($_POST['submitText'])){
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $email = $_POST["submitText"];
        $phone = $_POST["phone"];
    //echo "1: " . $fname . $lname . $email . $phone;
    $updateQuery = "";
    if (!empty($_FILES['fileUpload']['name'])) {
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
            $updateQuery = "UPDATE tblUsers
            SET user_firstname = '$fname', user_lastname = '$lname', user_phone = '$phone', user_picture = '$location'
            WHERE user_email = '$email'";
        echo "Not empty";
    }else{
        $updateQuery = "UPDATE tblUsers
            SET user_firstname = '$fname', user_lastname = '$lname', user_phone = '$phone'
            WHERE user_email = '$email'";
        //echo "empty Please select";
    }
    $result = mysqli_query($conn, $updateQuery) or die(mysqli_error($conn));
        if ($result) {
            echo "Update Successful";
        } else {
            echo "Update Failed";
        }
    }else{
    echo "Not set";
    }
   




?>