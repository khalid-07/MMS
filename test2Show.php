<?php 
include "database.php";

$resultString = "";
if(isset($_POST["name"]) && isset($_POST["place"])){
    if(!empty($_POST["name"]) && !empty($_POST["place"])){
        $tname = $_POST["name"];
        $tplace = $_POST["place"];
        $updateQuery = "UPDATE tblTest SET name = '$tname', place = '$tplace' WHERE id = 2";
        $result = mysqli_query($conn, $updateQuery) or die(mysqli_error($conn));
        if ($result) {
            $resultString = "Update Successful";
        } else {
            $resultString = "Update Failed";
        }
    }
    
}

$selectQuery = "SELECT * from tblTest WHERE id = 2";
$selectResult = (mysqli_query($conn, $selectQuery));




?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/styleFile.css" type="text/css">
        <link rel="stylesheet" href="bootstrap5/bootstrap-icons-1.10.2/bootstrap-icons.css" type="text/css">
        <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
        <script src="bootstrap5/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="fontawesome-free-6.2.1-web/css/fontawesome.css" rel="stylesheet">
        <link href="fontawesome-free-6.2.1-web/css/brands.css" rel="stylesheet">
        <link href="fontawesome-free-6.2.1-web/css/solid.css" rel="stylesheet">
        <script>
             function submitThis(){
                var $name = $('#name').val();
                var $place = $('#place').val();
                if($name == ""){
                    $('#h2Result').html("Fill all fields");
                    return false;
                }
                if($place == ""){
                    $('#h2Result').html("Fill all fields");
                    return false;
                }else{
                    return true;
                }
                
             }
            </script>
       
</head>
    <body>
        <h2 id="h2Result">
            <?php 
            if(!empty($resultString)){
                echo $resultString;
            }
            ?>
        </h2>
        <?php
        if (mysqli_num_rows($selectResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectResult)) {
                ?>
                <form action="" method="post">
                <label>Name: </label>
<input value="<?php echo $row["name"]?>" name="name" id="name"/>
<br/>
<label>Place: </label>
<input value="<?php echo $row["place"]?>" name="place" id="place" />
                <?php
            }
        }
        ?>
        <br/>
        <input type="submit" value="change" onclick="submitThis()" />
        </form>
</body>
    </html>