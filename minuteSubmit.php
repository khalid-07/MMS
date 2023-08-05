<?php
session_start();
include "database.php";
$email = $_SESSION["username"];
$name = $_SESSION["name"];
$id = $_SESSION["userId"];
if (isset($_POST['passProcess'])) {
    if($_POST['passProcess']=="createMinutesProcess"){
        $result = "";
        $minuteName = trim($_POST['passNameValue']);
        $objective = trim($_POST['passObjectiveValue']);
        $location = trim($_POST['passLocationValue']);
        $group = trim($_POST["passgroupsValue"]);
        $attendees = trim($_POST['passAttendeesValue']);
        $absentees = trim($_POST['passAbsenteesValue']);
    
        if (empty($absentees)) {
            $absentees = null;
            //echo "The absentees is NULL: " . $absentees;
        }
        $discussion = trim($_POST['passDiscussionValue']);
        $additional = trim($_POST['passAdditionalValue']);
        if (empty($additional)) {
            $additional = null;
        }
        if (isset($_POST['passActionItemValue'])) {
            $actionItem = $_POST['passActionItemValue'];
        }
        if (isset($_POST['passOwnerValue'])) {
            $owner = $_POST['passOwnerValue'];
        }
    
        $nextMeetingDate = trim($_POST['passNextMeetingDateValue']);
        if (empty($nextMeetingDate)) {
            $nextMeetingDate = null;
        }
        $nextMeetingPurose = trim($_POST['passNextMeetingPurposeValue']);
        if (empty($nextMeetingPurose)) {
            $nextMeetingPurose = null;
        }
    
        //Date and time
        date_default_timezone_set("Asia/Qatar");
        $date = date("Y/m/d H:i:s");
        //Session name
        
        //This is just to check
        // if (!empty($actionItem)) {
        //     for ($i = 0; $i < sizeof($actionItem); $i++) {
        //         echo "item: " . $actionItem[$i] . " and Owner: " . $owner[$i];
        //     }
        // }
    
        //$insertQuery = "INSERT into tblTest(name,place) values('kaka','koko');";
        //echo "The nxt date is " . $nextMeetingDate;
        date_default_timezone_set("Asia/Qatar");
        $date = date("Y/m/d H:i:s");
        $type = "CM";
        $insertLogQuery = "INSERT into tblLog (user_id,user_name,minute_title,time,user_email,type) values ('$id','$name','$minuteName','$date','$email','$type')";
        $insertQuery = "INSERT into tblMinutes(minute_title,minute_objective,minute_date,minute_location,
        minute_recordedby,minute_attendees,minute_absentees,minute_discussion,minute_note,minute_nxt_date,
        minute_nxt_purpose,minute_grpId) 
        values('$minuteName','$objective','$date','$location','$name','$attendees',NULLIF('$absentees',''),
        '$discussion',NULLIF('$additional',''),NULLIF('$nextMeetingDate',''),NULLIF('$nextMeetingPurose',''),
        '$group')";
    
        $result = mysqli_query($conn, $insertQuery);
    
        if ($result) {
            //echo mysqli_insert_id($conn);
            $minuteId = mysqli_insert_id($conn);
            $selectUserQuery = "SELECT id FROM tblUsers where user_email = '$email'";
            $selectResult = (mysqli_query($conn, $selectUserQuery));
            $row = mysqli_fetch_assoc($selectResult);
            $insertUserMinuteQuery = "INSERT into tblUserMinutes(user_id,minute_id,user_access) 
            values('$id','$minuteId','Owner')";
            $resultUserMinute = mysqli_query($conn, $insertUserMinuteQuery);
            $insertResult = mysqli_query($conn, $insertLogQuery);
            if (!empty($actionItem)) {
                for ($i = 0; $i < sizeof($actionItem); $i++) {
                    $insertTakeawayQuery = "INSERT into tblTakeaways(takeaway_item,takeaway_owner,minute_id) 
                    values ('$actionItem[$i]','$owner[$i]','$minuteId')";
                    $resultTakeaways = mysqli_query($conn, $insertTakeawayQuery);
                }
            }
            if (isset($_POST['base'])) {
                $baseCode = trim($_POST['base']);
                if (!empty($baseCode)) {
                    $file_pointer = '../fyp/voicenotes';
    
                    if (file_exists($file_pointer)) {
                        echo "The file $file_pointer exists";
                        $myfile = fopen("../fyp/voicenotes/" . $minuteId . ".txt", "w") or die("Unable to open file!: " . $id . ".txt");
                        fwrite($myfile, $baseCode);
                        fclose($myfile);
                    } else {
                        $result = mkdir("voicenotes");
                        echo "The file $file_pointer does not exists. We made a file for you";
                        $myfile = fopen("../fyp/voicenotes/" . $minuteId . ".txt", "w") or die("Unable to open file!: " . $id . ".txt");
                        fwrite($myfile, $baseCode);
                        fclose($myfile);
                    }
                }
            }
            if ($resultUserMinute) {
                $result =  "successfull";
                //echo "<script>alert(\"Success hai bhaii\")</script>";
            }
        } else {
            echo mysqli_error($conn);
        }
        //echo "successfulliation";
        // foreach ($actionItem as $value) {
        //     echo $value;
        //     echo "<br />";
        // }
        // if (empty($actionItem)) {
        //     echo "There are no takeaways ";
        // } else {
        //     echo "There are takeaways " . "and the size is: " . sizeof($actionItem) . " ..id is: " . $_SESSION["userId"];;
        // }
    
        //echo "<script>alert('$actionItem');</script>";
        //echo "<script>alert('$owner')</script>";
        echo $result;
    }
    if($_POST['passProcess']=="editMinutes"){

        $result = "";
        $minuteName = trim($_POST['passNameValue']);
        $objective = trim($_POST['passObjectiveValue']);
        $location = trim($_POST['passLocationValue']);
        $group = trim($_POST["passgroupsValue"]);
        $attendees = trim($_POST['passAttendeesValue']);
        $absentees = trim($_POST['passAbsenteesValue']);
        $minuteId = trim($_POST['passMinuteId']);
        if (empty($absentees)) {
            $absentees = null;
            //echo "The absentees is NULL: " . $absentees;
        }
        $discussion = trim($_POST['passDiscussionValue']);
        $additional = trim($_POST['passAdditionalValue']);
        if (empty($additional)) {
            $additional = null;
        }
        $nextMeetingDate = trim($_POST['passNextMeetingDateValue']);
        if (empty($nextMeetingDate)) {
            $nextMeetingDate = null;
        }
        $nextMeetingPurose = trim($_POST['passNextMeetingPurposeValue']);
        if (empty($nextMeetingPurose)) {
            $nextMeetingPurose = null;
        }

        date_default_timezone_set("Asia/Qatar");
        $date = date("Y/m/d H:i:s");
        $type = "EM";
        $insertLogQuery = "INSERT into tblLog (user_id,user_name,minute_title,time,user_email,type) values ('$id','$name','$minuteName','$date','$email','$type')";
        $updateQuery = "UPDATE tblMinutes 
        SET minute_title = '$minuteName', minute_objective = '$objective', minute_location = '$location', minute_attendees = '$attendees',
            minute_absentees = NULLIF('$absentees',''), minute_discussion = '$discussion', minute_note = NULLIF('$additional',''), minute_nxt_date = NULLIF('$nextMeetingDate',''),
            minute_nxt_purpose = NULLIF('$nextMeetingPurose',''), minute_grpId = '$group' WHERE id = '$minuteId'";
        $result = mysqli_query($conn, $updateQuery) or die(mysqli_error($conn));
        if ($result) {
            $insertResult = mysqli_query($conn, $insertLogQuery);
            if (isset($_POST['base'])) {
                $baseCode = trim($_POST['base']);
                if (!empty($baseCode)) {
                    $file_pointer = '../fyp/voicenotes';
    
                    if (file_exists($file_pointer)) {
                        echo "The file $file_pointer exists";
                        $myfile = fopen("../fyp/voicenotes/" . $minuteId . ".txt", "w") or die("Unable to open file!: " . $id . ".txt");
                        fwrite($myfile, $baseCode);
                        fclose($myfile);
                    } else {
                        $result = mkdir("voicenotes");
                        echo "The file $file_pointer does not exists. We made a file for you";
                        $myfile = fopen("../fyp/voicenotes/" . $minuteId . ".txt", "w") or die("Unable to open file!: " . $id . ".txt");
                        fwrite($myfile, $baseCode);
                        fclose($myfile);
                    }
                }
            }
            echo "Update Successful";
        } else {
            echo "Update Failed";
        }
        echo "successfull";
    }
    
} else {
    echo "Problem";
}
