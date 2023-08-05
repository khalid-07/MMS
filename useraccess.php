<?php
session_start();
if (isset($_POST["action"])) {
    include("database.php");
    $email = $_SESSION["username"];
    if ($_POST["action"] == "fetch") {
        $output = "";
        $selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult = (mysqli_query($conn, $selectQuery));
        $output .= "
        <table class=\"table table-bordered table-striped\">
        <tr>
        <td>Email</td>
        <td>Name</td>
        <td>Status</td>
        </tr>
        
        ";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                $checkBox = "";
                $userId = $row["id"];
                //$min_Id = $row[""];
                $selectAccessQuery = "SELECT * FROM tblUserMinutes WHERE user_id = '$userId' AND minute_id = 16";
                $selectAccessResult = (mysqli_query($conn, $selectAccessQuery));
                if (mysqli_num_rows($selectAccessResult) > 0) {
                    $checkBox = "<input checked id=\"" . $row["id"] . "\" class=\"actioning\" type=\"checkbox\" onclick=\"checkChange(" . $row["id"] . ")\" />";
                } else {
                    $checkBox = "<input id=\"" . $row["id"] . "\" class=\"actioning\" type=\"checkbox\" onclick=\"checkChange(" . $row["id"] . ")\" />";
                }
                $output .= "
                <tr>
                <td>" . $row["user_email"] . "</td>
                <td>" . $row["user_firstname"] . "</td>
                <td>$checkBox</td>
                </tr>
                ";
            }
        }
        $output .= "</table>";

        echo $output;
    }
    if ($_POST["action"] == "grant") {
        //echo "Yalla habibi";
        $user_Id = $_POST["id"];

        $insertQuery = "INSERT into tblUserMinutes(user_id,minute_id,user_access) values('$user_Id',16,'shared')";
        $result = mysqli_query($conn, $insertQuery);
        if ($result) {
            echo "minute shared";
        } else {
            echo "problm happened";
        }
    }
    if ($_POST["action"] == "revoke") {
        //echo "Yalla habibi";
        $user_Id = $_POST["id"];

        $deleteQuery = "DELETE FROM tblUserMinutes WHERE user_id = '$user_Id' AND minute_id = 16";
        $result = mysqli_query($conn, $deleteQuery);
        if ($result) {
            echo "minute revoked";
        } else {
            echo "problem happened";
        }
    }
    if ($_POST["action"] == "ActiveUser") {
        //echo "Yalla habibi";
        $user_Id = $_POST["id"];
        $updateQuery = "UPDATE tblUsers SET user_status = 1 WHERE id = '$user_Id'";
        //$updateQuery = "DELETE FROM tblUserMinutes WHERE user_id = '$user_Id' AND minute_id = 16";
        $result = mysqli_query($conn, $updateQuery);
        if ($result) {
            echo "User Activated";
        } else {
            echo "problem Activating";
        }
    }
    if ($_POST["action"] == "DeavtiveUser") {
        //echo "Yalla habibi";
        $user_Id = $_POST["id"];
        $updateQuery = "UPDATE tblUsers SET user_status = 0 WHERE id = '$user_Id'";
        //$updateQuery = "DELETE FROM tblUserMinutes WHERE user_id = '$user_Id' AND minute_id = 16";
        $result = mysqli_query($conn, $updateQuery);
        if ($result) {
            echo "User DeActivated";
        } else {
            echo "problem Activating";
        }
    }
}
