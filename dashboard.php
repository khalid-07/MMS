<?php
include "database.php";
session_start();
$userid = $_SESSION["userId"];
date_default_timezone_set("Asia/Qatar");
$date = date("H");
//$date = 17;
$greeting = "";
if($date < 12){
  $greeting = "Good Morning!";
}
else if($date < 18){
$greeting = "Good Afternoon!";
}
else {
  $greeting = "Good Evening!";
}
//Admin counts
$selectCountUsers = "SELECT Count(*) as CountUsers FROM tblUsers WHERE user_role != 'admin'";
$selectCountMinutes = "SELECT Count(*) as CountMinutes FROM tblMinutes";
$selectCountGroups = "SELECT Count(*) as CountGroups FROM tblGroups";
$selectCountUserResult = (mysqli_query($conn, $selectCountUsers));
$selectCountMinuteResult = (mysqli_query($conn, $selectCountMinutes));
$selectCountGroupResult = (mysqli_query($conn, $selectCountGroups));
$rowUser = $selectCountUserResult->fetch_assoc();
$rowMinute = $selectCountMinuteResult->fetch_assoc();
$rowGroup = $selectCountGroupResult->fetch_assoc();

//User Counts
$selectCountUserMinutes = "SELECT Count(*) as CountUserMinutes FROM tblUserMinutes WHERE user_id ='$userid'";
$selectCountUserGroups = "SELECT Count(*) as CountUserGroups FROM tblUserGroups WHERE user_id ='$userid'";
$selectCountUserMinutesResult = (mysqli_query($conn, $selectCountUserMinutes));
$selectCountUserGroupsResult = (mysqli_query($conn, $selectCountUserGroups));
$rowUserMinutes = $selectCountUserMinutesResult->fetch_assoc();
$rowUserGroups = $selectCountUserGroupsResult->fetch_assoc();
?>

<html>

<head>
  <title>Dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/styleFile.css" type="text/css">
        <link rel="stylesheet" href="bootstrap5/bootstrap-icons-1.10.2/bootstrap-icons.css" type="text/css">
        <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
        <script src="bootstrap5/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="fontawesome-free-6.2.1-web/css/fontawesome.css" rel="stylesheet">
        <link href="fontawesome-free-6.2.1-web/css/brands.css" rel="stylesheet">
        <link href="fontawesome-free-6.2.1-web/css/solid.css" rel="stylesheet">

</head>

<body>
  <!--Header for the page-->
  <?php include "navbar.php" ?>
  <!--Header end for the page-->
  <div class="container">
    <h1><label style="font-size:2rem"><?php echo $greeting?></label> <label><?php echo $_SESSION["name"]?></label></h1>
<!-- <h2><?php echo $greeting ?></h2> -->
<hr />
<div class="row">
<?php

if (isset($_SESSION["role"])) {
if($_SESSION["role"]=="admin"){
    ?>
    <div>

<div class="row child col-12 col-sm-8">
<div class="col-6 col-sm-4 card" style="padding: 20px 15px 20px 15px">
                    <div style="font-style:oblique;font-size:1.3rem;text-align:center">
                    <h2>Users</h2>    
                    <b><label>
                        <?php echo $rowUser["CountUsers"] ?>
                        </label></b>
                    </div>
                    <div style="font-style:oblique;">
                        <label style="font-style:oblique;width:150px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                      
                      </label>
                    </div>
</div>
<div class="col-6 col-sm-4 card" style="padding: 20px 15px 20px 15px">
                    <div style="font-style:oblique;font-size:1.3rem;text-align:center">
                    <h2>Minutes</h2>    
                    <b><label>
                        <?php echo $rowMinute["CountMinutes"] ?>
                        </label></b>
                    </div>
                    <div style="font-style:oblique;">
                        <label style="font-style:oblique;width:150px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                      
                      </label>
                    </div>
</div>
<div class="col-6 col-sm-4 card" style="padding: 20px 15px 20px 15px">
                    <div style="font-style:oblique;font-size:1.3rem;text-align:center">
                    <h2>Groups</h2>    
                    <b><label>
                        <?php echo $rowGroup["CountGroups"] ?>
                        </label></b>
                    </div>
                    <div style="font-style:oblique;">
                        <label style="font-style:oblique;width:150px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                      
                      </label>
                    </div>
</div>
</div>
</div>
<?php 
}else{
    ?>

<div class="row child col-12 col-sm-6">
<div class="col-6 col-sm-6 card" style="padding: 20px 15px 20px 15px">
                    <div style="font-style:oblique;font-size:1.3rem;text-align:center">
                    <h2>Minutes</h2>    
                    <b><label>
                        <?php echo $rowUserMinutes["CountUserMinutes"] ?>
                        </label></b>
                    </div>
                    <div style="font-style:oblique;">
                        <label style="font-style:oblique;width:150px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                      
                      </label>
                    </div>
</div>
<div class="col-6 col-sm-6 card" style="padding: 20px 15px 20px 15px">
                    <div style="font-style:oblique;font-size:1.3rem;text-align:center">
                    <h2>Groups</h2>    
                    <b><label>
                        <?php echo $rowUserGroups["CountUserGroups"] ?>
                        </label></b>
                    </div>
                    <div style="font-style:oblique;">
                        <label style="font-style:oblique;width:150px; display: inline-block;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;">
                      
                      </label>
                    </div>
</div>
    <?php
}
}
?>
</div>
  </div>


  
</body>


</html>