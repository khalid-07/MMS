<?php
date_default_timezone_set("Asia/Qatar");
echo "The time is " . date("d-m-Y h:i:s") . "\n";
$dohaTime = date("d-m-Y h:i:s");
echo "<br>";
date_default_timezone_set("Asia/singapore");
$dating = date("d/m/Y h:i:s");
echo $dating;
echo "<br>";
if ($dohaTime == $dating) {
    echo "they are same";
} else {
    echo "they are difff";
}
