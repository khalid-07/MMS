<?php
include "database.php";
session_start();
if (isset($_SESSION["minuteId"])) {
    unset($_SESSION["minuteId"]);
}
if (!isset($_SESSION["username"])) {
    header("location:signin.php");
}
// if (isset($_SESSION["detailsId"])) {
//     $detailsId = $_SESSION["detailsId"];
//     //header("location:signin.php");
// }
if(isset($_SESSION["detailsId"])){
    
        $output = "";
        $userId = $_SESSION["userId"];
        $id = $_SESSION["detailsId"];
        $finalId = trim($id);
        //echo $id;
        $file_pointer = "../fyp/voicenotes/".$finalId.".txt";
        $fileText = "";
        //$file_pointer = "../fyp/voicenotes/23.txt";
        if (file_exists($file_pointer)) {
            //mkdir("uploads");
            $myfile = fopen($file_pointer, "r") or die("Unable to open file!");
            $fileText = fread($myfile, filesize($file_pointer));
            $hala = "File is there....";
            //echo "File is there....<br/>";
        }
        //echo $fileText;
        $selectAccessQuery = "SELECT user_access FROM tblUserMinutes WHERE user_id ='$userId' AND minute_id='$id'";
        $selectAccessResult = (mysqli_query($conn, $selectAccessQuery));
        $accessRow = $selectAccessResult->fetch_assoc();
        if($_SESSION["role"]!="admin"){
            $access = $accessRow["user_access"];
        }
        
        $outputButton = "
        <button id=\"printButton\" class=\"btn buttonStyle float-end btn-md mt-2 ms-2\">
                    <i class=\"fa-sharp fa-solid fa-share-nodes\"> </i> Share
                </button>
                <button id=\"deleteButton\" class=\"btn buttonStyle float-end btn-md mt-2 ms-2\" data-bs-toggle=\"modal\" data-bs-target=\"#deleteModal\">
                    <i class=\"fa-sharp fa-solid fa-trash\"> </i> Delete
                </button>";
        $takeAwayOutput = "";
        $selectQuery = "SELECT * FROM tblMinutes WHERE id = '$id'";
        $selectTakeawayQuery = "SELECT * FROM tblTakeaways where minute_id = '$id'";
        $selecttakeawayResult = (mysqli_query($conn, $selectTakeawayQuery));
        if (mysqli_num_rows($selecttakeawayResult) > 0) {
            $takeAwayOutput .= "
           
            <tr>
            <th colspan=\"4\" style=\"font-size:1.2rem\">
            Takeaways
            </th>
            </tr>
                <tr>
                <th colspan=\"1\" >#</th>
                <th>Action Item</th>
                <th>Owner</th>
                </tr>
                ";
            $index = 1;
            while ($takeawayRow = mysqli_fetch_assoc($selecttakeawayResult)) {
                $takeAwayOutput .= "
                <tr>
                <td colspan=\"1\">" . $index . "</td>
                <td>" . $takeawayRow["takeaway_item"] . "</td>
                <td>" . $takeawayRow["takeaway_owner"] . "</td>
                </tr>
                ";
                $index++;
            }
            $takeAwayOutput .= "";
        }else{
            $takeAwayOutput = "
           
            <tr>
            <th colspan=\"4\" style=\"font-size:1.2rem\">
            Take Aways
            </th>
            </tr>
            <tr>
            <td colspan=\"4\" >
            None
            </td>
            </tr>
            
            ";
        }
        $selectResult = (mysqli_query($conn, $selectQuery));
        $row = $selectResult->fetch_assoc();
        $absentees = "";
        $additionalNotes = "";
        $nxtMeetingDateTime = "";
        $nextMeetingDate = "";
        $nextMeetingTime = "";
        $nxtMeetingPurpose = "";
        if ($row["minute_absentees"] == NULL) {
            $absentees = "None";
        }
        if ($row["minute_absentees"] != NULL) {
            $absentees = $row["minute_absentees"];
        }
        if ($row["minute_note"] == NULL) {
            $additionalNotes = "None";
        }
        if ($row["minute_note"] != NULL) {
            $additionalNotes = $row["minute_note"];
        }
        if ($row["minute_nxt_date"] == NULL) {
            $nxtMeetingDateTime = "N/A";
        }
        if ($row["minute_nxt_purpose"] == NULL) {
            $nxtMeetingPurpose = "N/A";
        }
        $attendees = trim($row["minute_attendees"]);
        $attendeesArray = explode (",", $attendees);
        $attendeesOutput = "<ul>";
        foreach ($attendeesArray as $value) {
            $attendeesOutput.="<li style=\"font-size:1.2rem\">$value</li>";
          }
        $attendeesOutput .= "</ul>";
        if($nxtMeetingDateTime != "N/A"){
            $nextDateTimeOutput = "
            <td colspan=\"2\"><strong style=\"font-size:1.2rem\">Date: </strong><label style=\"font-size:1.2rem\">" . date("d-m-Y", strtotime($nxtMeetingDateTime)) . "</label> </td>
            <td colspan=\"2\"><strong style=\"font-size:1.2rem\">Time: </strong><label style=\"font-size:1.2rem\">" . date("h:m:s A", strtotime($nxtMeetingDateTime)) . "</label> </td>
            ";
        }else{
            $nextDateTimeOutput = "
            <td colspan=\"2\"><strong style=\"font-size:1.2rem\">Date: </strong><label style=\"font-size:1.2rem\">" . $nxtMeetingDateTime . "</label> </td>
            <td colspan=\"2\"><strong style=\"font-size:1.2rem\">Time: </strong><label style=\"font-size:1.2rem\">" . $nxtMeetingDateTime . "</label> </td>
            ";
        }
        $output.="
        <table class=\"table table-bordered\">
        <thead>
        </thead>
        <tbody>
        <tr>
            <td colspan=\"4\" style=\"font-size:1.4rem\"><strong>Meeting Title: </strong>" . $row["minute_title"] . " </td>
        </tr>
        <tr>
        <td colspan=\"4\" style=\"font-size:1.4rem\"><strong>Objective: </strong>" . $row["minute_objective"] . " </td>
        </tr>
        <tr>
        <td colspan=\"2\"><strong style=\"font-size:1.2rem\">Date: </strong><label style=\"font-size:1.2rem\">" . date("d-m-Y", strtotime($row["minute_date"])) . "</label> </td>
        <td colspan=\"2\"><strong style=\"font-size:1.2rem\">Time: </strong><label style=\"font-size:1.2rem\">" . date("h:m:s A", strtotime($row["minute_date"])) . "</label> </td>
        </tr>
        <tr>
        <td colspan=\"2\" style=\"font-size:1.2rem\"><strong>Location: </strong>" . $row["minute_location"] . " </td>
        <td colspan=\"2\" style=\"font-size:1.2rem\"><strong>Recorded By: </strong>" . $row["minute_recordedby"] . " </td>
        </tr>
        <tr>
        <th colspan=\"2\" style=\"font-size:1.2rem\">
        Attendees
        </th>
        <th style=\"font-size:1.2rem\">
        Absentees
        </th>
        </tr>
        <tr>
        <td colspan=\"2\">
        $attendeesOutput
        </td>
        <td>
        $absentees
        </td>
        </tr>
        <tr>
        <th colspan=\"4\" style=\"font-size:1.2rem\">
        Discussion
        </th>
        </tr>
        <tr>
        <td colspan=\"4\">
        ".$row["minute_discussion"]."
        </td>
        </tr>
        <tr>
        <th colspan=\"4\" style=\"font-size:1.2rem\">
        Additional Notes
        </th>
        </tr>
        <tr>
        <td colspan=\"4\">
        $additionalNotes
        </td>
        </tr>
        $takeAwayOutput
        <tr>
        <th colspan=\"4\" style=\"font-size:1.2rem\">
        Next Meeting
        </th>
        </tr>
        <tr>
        ".$nextDateTimeOutput."
        </tr>
        </tbody>
        </table>
        ";
    
}else{
    header("location:homepage.php");
}

?>

<html>

<head>


<!-- <script> var $jq132 = jQuery.noConflict( true ); </script> -->
        
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styleFile.css" type="text/css">
    <link rel="stylesheet" href="bootstrap5/bootstrap-icons-1.10.2/bootstrap-icons.css" type="text/css">
    <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
    <script src="bootstrap5/js/bootstrap.min.js" type="text/javascript"></script>
    <link href="fontawesome-free-6.2.1-web/css/fontawesome.css" rel="stylesheet">
    <link href="fontawesome-free-6.2.1-web/css/brands.css" rel="stylesheet">
    <link href="fontawesome-free-6.2.1-web/css/solid.css" rel="stylesheet">
    
    <script>
        function halaClick(){

            //alert("hello");
            //loadMinuteDetails()
        }
        function loadMinuteDetails() {
                var action = "fetchOne";
                $.ajax({
                    url: "getMeetingMinutes.php",
                    method: "POST",
                    data: {
                        id: <?php echo $_SESSION["detailsId"] ?>,
                        action: action
                    },
                    success: function(data) {
                        //alert("title: " + data)
                        $("#minuteDiv").html(data);
                    }
                })
            }
            function deleteMinute(){
                var action = "deleteMinute";
                $.ajax({
                    url: "getMeetingMinutes.php",
                    method: "POST",
                    data: {
                        id: <?php echo $_SESSION["detailsId"] ?>,
                        action: action
                    },
                    success: function(data) {
                        alert("id: " + data)
                        if (data.indexOf('success') > -1) {
                                $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Minute Deleted Successfully').show().css({
                                    'padding': '4px',
                                    'width': 'auto',
                                    'text-align': 'center',
                                    'display': 'inline-block'
                                });
                                setTimeout(function() {
                                    $('#feedback').fadeOut('fast');
                                    window.location.replace("homepage.php");
                                }, 2000);
                            } else {
                                $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Problem in deleting minute').show().css({
                                    'padding': '4px',
                                    'width': 'auto',
                                    'text-align': 'center',
                                    'display': 'inline-block'
                                });
                                setTimeout(function() {
                                    $('#feedback').fadeOut('fast');
                                }, 2000);
                            }
                        $("#feedback").html(data);
                    }
                })

            }
        // $k(document).ready(function() {
        //     //loadMinuteDetails();
            
        //     function loadMinuteDetails() {
        //         var action = "fetchOne";
        //         $.ajax({
        //             url: "getMeetingMinutes.php",
        //             method: "POST",
        //             data: {
        //                 id: <?php echo $_SESSION["detailsId"] ?>,
        //                 action: action
        //             },
        //             success: function(data) {
        //                 //alert("title: " + data)
        //                 $("#minuteDiv").html(data);
        //             }
        //         })
        //     }
        // })
        
        
    </script>
</head>

<body>
    <div id="nav-placeholder3">
        <?php
        include "navbar.php";
        ?>

    </div>
    <div class="container">
        
        <div class="child card col-12 col-sm-9 mt-3">
        <div id="feedback">
        </div>
            <div>
            
            <button id="printButton" class="btn float-end buttonStyle mt-2 ms-2">
                    <i class="fa-sharp fa-solid fa-print"></i> </i>Print
                </button>

                <?php
                if($_SESSION["role"]!="admin"){
                    if($access == "Owner"){
                        echo $outputButton;
                    }
                }
                
                 ?>
            </div>
            <div class="mt-3">
                <table class="table">
                <tr>
                    <td>
                        <?php 
                        if(!empty($fileText)){
                            ?>
                            <audio controls="true" ccontrols controlsList="nodownload" src=<?php echo $fileText ?>></audio>
                        <?php }
                        else{
                            echo "There is no Audio File.";
                        }?>
                    
            </td>
            </tr>
            </table>
            
            </div>
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="editModalLabel">Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="deleteMinuteDiv" class="modal-body">
                        <!-- The loop of meeting minutes -->
                        <p>Are you sure you want to delete "<b> <?php echo $row["minute_title"] ?>"</b></p>
                        <div class="modal-footer">
                        <button type="button" onclick="deleteMinute()" class="btn btn-danger btn-block w-25" data-bs-dismiss="modal" >
            <i class="fa-solid fa-check"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-block w-25" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark"></i>
                    </button>
                    </div>
                    </div>

                </div>
            </div>
        </div>
            <div id="minuteDiv" class="mt-3">
            <?php echo $output ?>
            </div>
            
            
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
            <script> var $jq133 = jQuery.noConflict( true ); </script>
            <!-- <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script> -->
            <script src="print/printThis.js"></script>
            <script src="print/custom.js"></script>
            
        </div>
        

            </div>
</body>

</html>