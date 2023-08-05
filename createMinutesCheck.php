<?php
session_start();
include "database.php";
if (isset($_POST['passProcess'])) {
    //echo "REACHED";
    $requestProcess = trim($_POST['passProcess']);
    if ($requestProcess == "createMinutesValue") {
        $name = ($_POST["passNameValue"]);
        $description = ($_POST["passDescValue"]);
        $attendees = ($_POST["passAttendeesValue"]);
        date_default_timezone_set("Asia/Qatar");
        $date = date("Y/m/d H:i:s");

        $eemail = $_SESSION["username"];
        $insertQuery = "INSERT into tblMinutes(minute_name,minute_desc,minute_date,minute_attendees) values('$name','$description','$date','$attendees')";
        //$selectQuery = "SELECT user_email FROM tblUsers where user_email = '$eemail'";
        $result = mysqli_query($conn, $insertQuery);
        //echo $result;
        //echo "<br/>";

        if ($result) {
            $minuteId = mysqli_insert_id($conn);
            $email = $_SESSION["username"];
            $selectUserQuery = "SELECT id FROM tblUsers where user_email = '$email'";
            $selectResult = (mysqli_query($conn, $selectUserQuery));
            if (mysqli_num_rows($selectResult) > 0) {
                $row = mysqli_fetch_assoc($selectResult);
                $userid = $row["id"];
                $insertMinuteQuery = "INSERT into tblUserMinutes(user_id,minute_id,user_access) values('$userid','$minuteId','Owner')";
                $resultUserMinute = mysqli_query($conn, $insertMinuteQuery);
                if ($resultUserMinute) {
                    echo "successfull";
                } else {
                    die(mysqli_error($conn));
                }
                //echo "The ID is: " . $minuteId . " and email: " . $email;
                //alert("id: " . $minuteId . " and email: " . $email);
                //echo "Minute Submitted";
            } else {
                echo "Problem finding the user";
            }
            //echo "Dandanadan";
        } else {
            echo "Problem in Creating Minutes";
            die(mysqli_error($conn));
        }
    }
    //---------- To get the value from the column using SELECT Statement --------------//
    //$selectUserQuery = "SELECT user_email FROM tblUsers where user_email = '$email'";
    //$selectResult = (mysqli_query($conn, $selectUserQuery));
    //if (mysqli_num_rows($selectResult) > 0) {
    //  $row = mysqli_fetch_assoc($selectResult);
    //$row["user_email"];
}
