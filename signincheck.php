<?php
session_start();
include "database.php";
if (isset($_POST['passProcess'])) {
    $requestProcess = trim($_POST['passProcess']);
    if ($requestProcess == "signinValue") {
        sleep(1);
        $email = trim($_POST['passEmailValue']);
        $password = trim($_POST['passPasswordValue']);

        $checkEmailQuery = "SELECT user_email, user_password, id, user_firstname, user_lastname, user_role FROM tblUsers where user_email = '$email'";
        $check_email = mysqli_query($conn, $checkEmailQuery);
        if (mysqli_num_rows($check_email) > 0) {
            $row = mysqli_fetch_assoc($check_email);
            if (password_verify($password, $row["user_password"])) {
                $userId = $row["id"];
                $userEmail = $row["user_email"];
                $firstname = $row["user_firstname"] . " ";
                $lastname = $row["user_lastname"];
                //$role = $row["user_role"];
                $name = $firstname . " " . $lastname;
                $_SESSION["role"] = $row["user_role"];
                $_SESSION["username"] = $userEmail;
                $_SESSION["userId"] = $userId;
                $_SESSION["name"] = $name;
                echo "successfull";
            }
            else{
                echo "Invalid username or password";
            }
            
            
        } else {
            echo "Invalid username or password";
        }
    }
    if ($requestProcess == "signup") {
        //$file = trim($_POST["data" . "txtLName"]);
        //echo "hello: " . $file;
        echo "khalid";
        $fname = $_POST["fname"];
        echo "First name is: " + $fname;
        //echo "<script>alert(\"yes $file\")</script>";
        // if ($file) {
        //     echo "Yes file selected: " . $file;
        // } else {
        //     echo "please select the file";
        // }
        //$target_dir = "uploads/";
        //$target_file = $target_dir . basename($_FILES[$file]["name"]);
        //$target_file = $target_dir . ;
        //echo "target_file: " . $target_file;
        //move_uploaded_file($_FILES[$file]["tmp_name"], $target_file);
        // echo "kdhjdshfdsh";
        // $file = trim($_POST["passFile"]);
        // //echo "yaahoooooo";
        // // if (isset($_POST['fileUpload'])) {
        // //     if (empty($_FILES["fileUpload"]["name"])) {
        // //         echo "Khalid There is no file";
        // //     } else {
        // //         echo "Khalid There is file";
        // //     }
        // // }
        // $filename = trim($_POST["passFileValue"]);
        // // if (empty($_POST['uploadfile'])) {
        // //     echo "Please upload the file";
        // // }
        // //$ssFile = trim(uploadfile
        // //$test = "khalid/khalid.jpg";
        // //$newFilename = basename($file);
        // if (empty($file)) {
        //     echo "There is no file";
        // } else {
        //     $target_dir = "uploads/";
        //     $target_file = $target_dir . $file;
        //     move_uploaded_file($_FILES['passFile']['name'], $target_file);
        //     echo "Yes There is file: " . $file;
        // }
        //echo "khalid";

    }
}
;
//echo "not working";
