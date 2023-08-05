<?php
include "database.php";
session_start();
$email = $_SESSION["username"];
$userId = $_SESSION["userId"];
if (isset($_POST["action"])) {
    if ($_POST["action"] == "fetchTest") {
        $selectQuery = "SELECT * FROM tblTest";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectResult = (mysqli_query($conn, $selectQuery));
        //$output .= "<div class=\"col-11\">";
        $output = "";
        $output .= "
        <label for=\"names\">Choose a car:</label>
        <select onchange=\"showValue()\" class=\"form-control form-control-static\" name=\"names\" id=\"names\">
        <option value=\"Select\">Select</option>";
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                $output .= "<option value=\"" . $row['place'] . "\">" . $row["name"] . "</option>";
            }
            $output .= " </select>";
        }
        echo $output;
    } else {
        echo "nahi mila";
    }
}
