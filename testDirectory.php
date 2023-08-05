<?php
//$result = is_dir("../greg/demo");


$file_pointer = 'uploads';

if (!file_exists($file_pointer)) {
    mkdir("uploads");
    echo "We created The file $file_pointer for you";
}
// if (file_exists($file_pointer)) {
//     echo "The file $file_pointer exists";
// } else {
//     $result = mkdir("kapada");
//     echo "The file $file_pointer does not exists. We made a file for you";
// }
echo "<br />";
echo "this is.....<br/>" ;
$fileContent = readfile("../fyp/kakada/1.txt");
echo "<br/>this is.....<br/>" ;
//or die("Unable to open file!");
echo "<br />";
echo "size:" . $fileContent . "kb, yahoooo";

echo "<br />";
echo "------------------------------------ <br />";
$myfile = fopen("../fyp/kakada/1.txt", "r") or die("Unable to open file!");
$fileText = fread($myfile, filesize("../fyp/kakada/1.txt"));
echo "<br /> ---------------------------------";
echo $fileText;
echo "-------------------- <br />";
fclose($myfile);
echo "<br />";
echo "-------------------- <br />";
echo "-------------------- <br />";
echo "-------------------- <br />";
$file_pointer = "../fyp/kakada/6.txt";
        $fileText = "";
        //$file_pointer = "../fyp/voicenotes/23.txt";
        if (file_exists($file_pointer)) {
            $status=unlink($file_pointer);    
                if($status){  
                echo "File deleted successfully";    
                }else{  
                echo "Sorry!";    
                }  
        }else{
            echo "File not found";
        }
        echo "-------------------- <br />";
        echo "-------------------- <br />";
        echo "-------------------- <br />";
        echo "<br />";
$result = mkdir("hello");
if ($result) {
    echo "Success: " . $result;
} else {
    echo "oh no" . $result;
}

echo "<br /> ---------------------------------";
echo "Writing to the file";
$id = 2;
$myfile = fopen("../fyp/kakada/" . $id . ".txt", "a") or die("Unable to open file!: " . $id . ".txt");
$txt = "Johnny\n";
fwrite($myfile, $txt);
fclose($myfile);