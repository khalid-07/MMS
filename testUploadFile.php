<?php
//if(isset($_POST['F']))
$name = $_POST['FName'];
echo "name: " . $name;


if (isset($_FILES['file']['name'])) {
    if (!empty($_FILES['file']['name'])) {
        $filename = $_FILES['file']['name'];
        $location = "uploads/" . $filename;
        $imageFileType = pathinfo($location, PATHINFO_EXTENSION);
        $imageFileType = strtolower($imageFileType);
        $newFilename = "kaki" . "." . $imageFileType;
        $location = "uploads/" . $newFilename;
        move_uploaded_file($_FILES['file']['tmp_name'], $location);
        echo "File uploaded Successfully";
    } else {
        echo "Please upload file";
    }

    //echo "filename: " . $_FILES['file']['tmp_name'];
} else {
    echo "There is a ptoblem";
}
?>