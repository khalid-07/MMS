<?php
//include "index.php";
$db_host = 'localhost';
$db_user = 'khalid07';
$db_password = 'Khalid@2497';
$db_db = 'fyp_2022';

$conn = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
);

if ($conn->connect_error) {
    echo 'Errno: ' . $conn->connect_errno;
    echo '<br>';
    echo 'Error: ' . $conn->connect_error;
    exit();
}

/*echo 'Success: A proper connection to MySQL was made.';
echo '<br>';
echo 'Host information: ' . $conn->host_info;
echo '<br>';
echo 'Protocol version: ' . $conn->protocol_version;*/

//$conn->close();
