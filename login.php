<?php
include "index.php";
  $db_host = 'localhost';
  $db_user = 'khalid07';
  $db_password = 'Khalid@2497';
  $db_db = 'testing';
 
  $conn = @new mysqli(
    $db_host,
    $db_user,
    $db_password,
    $db_db
  );
	
  if ($conn->connect_error) {
    echo 'Errno: '.$conn->connect_errno;
    echo '<br>';
    echo 'Error: '.$conn->connect_error;
    exit();
  }

  echo 'Success: A proper connection to MySQL was made.';
  echo '<br>';
  echo 'Host information: '.$conn->host_info;
  echo '<br>';
  echo 'Protocol version: '.$conn->protocol_version;

  $sql = "SELECT * FROM testwala";
$result = $conn->query($sql);
if($result){
    echo "<br>Connected to the table";
}
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<br> id: ". $row["ID"]."<br>". "Name: ". $row["fName"]. " " . $row["lName"] . "<br>"."age: ". $row["age"]." ". "<br>";
    }
} else {
    echo "0 results";
}
  $conn->close();
?>

<?php
echo '<h1>Login</h1>'
?>