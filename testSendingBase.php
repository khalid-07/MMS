<?php
if (isset($_POST["action"])) {
    //include("database.php");
    if ($_POST["action"] == "saveBase") {
        $baseText = $_POST["base"];
        $id = "jojo";
        $myfile = fopen("../fyp/kakada/" . $id . ".txt", "w") or die("Unable to open file!: " . $id . ".txt");
        //$txt = "Johnny\n";
        fwrite($myfile, $baseText);
        fclose($myfile);
        echo "yes base is saved! CHECK!!";
    } else {
        echo "problem saving base";
    }
}
