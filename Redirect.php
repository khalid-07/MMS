<?php
include "database.php";
session_start();
$email = $_SESSION["username"];
$userId = $_SESSION["userId"];
if (isset($_POST["action"])) {
    if ($_POST["action"] == "send") {
        $_SESSION["editId"] = $_POST["id"];
        //echo "edit yaahoooo";
        //header("Location: homepage.php");
    }
    if ($_POST["action"] == "details") {
        $_SESSION["detailsId"] = $_POST["id"];
        echo "yahoooo" . $_POST["id"];
        //header("Location: deta.php");
    }
    if($_POST["action"] == "userProfile"){
        $_SESSION["userProfile"] = $_POST["id"];
    }
}
//header("Location: homepage.php");
