<?php
include "database.php";
session_start();
$email = $_SESSION["username"];
$userId = $_SESSION["userId"];
