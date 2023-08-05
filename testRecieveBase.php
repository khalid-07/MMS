<?php

$myfile = fopen("../fyp/voicenotes/23.txt", "r") or die("Unable to open file!");
$fileText = fread($myfile, filesize("../fyp/voicenotes/23.txt"));
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <div>
        <h1>Khalid</h1>
        <audio controls="true" ccontrols controlsList="nodownload" src=<?php echo $fileText ?>></audio>
    </div>
</body>

</html>