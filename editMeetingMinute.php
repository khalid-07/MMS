<?php
session_start();
include "database.php";
//if ($_POST['minute_id'])) {
if (isset($_SESSION["editId"])) {
    $minuteid = $_SESSION["editId"];
};
if (!isset($_SESSION["username"])) {
    header("location:signin.php");
}
//$_SESSION['minuteId'] = $minuteid;
//header("location:editMeetingMinute.php");
//}
// if (!isset($_SESSION['minuteId'])) {
//     header("location:homepage.php");
// }
$selectQuery = "SELECT * FROM tblMinutes WHERE id = '$minuteid'";
$selectTakeawayQuery = "SELECT * FROM tblTakeaways where minute_id = '$minuteid'";
$selectResult = (mysqli_query($conn, $selectQuery));
$selecttakeawayResult = (mysqli_query($conn, $selectTakeawayQuery));
$row = $selectResult->fetch_assoc();
$file_pointer = "../fyp/voicenotes/".$minuteid.".txt";
$fileText = "";
if (file_exists($file_pointer)) {
    //mkdir("uploads");
    $myfile = fopen($file_pointer, "r") or die("Unable to open file!");
    $fileText = fread($myfile, filesize($file_pointer));
    $hala = "File is there....";
    //echo "File is there....<br/>";
}
?>
<html>

<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
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
        <script>
            let timing = "";
        let seconds = 0;
        let baseValue = "";

        function displayTime() {
            seconds = 00;
            $("#showTime").html(":0" + seconds);
            timing = setInterval(showTime, 1000);
        }

        function showTime() {
            seconds++;
            let hours = Math.floor(seconds / 3600);
            let mins = Math.floor(seconds / 60) - hours * 60;
            let secs = Math.floor(seconds % 60);
            let output = "";
            if (mins == 0) {
                output = ":" + secs.toString().padStart(2, "0");
            } else {
                output =
                    mins.toString().padStart(2, "0") +
                    ":" +
                    secs.toString().padStart(2, "0");
            }

            $("#showTime").html(output);
        }
        function checkField(field) {
            $('#' + field).css({
                'border-color': ''
            });
        }

            $(document).ready(function() {
            $("#recordImage").hide();
            $("#stopRecord").hide();
            loadGroups();

            function loadGroups() {
                var action = "fetchOneGroupList";
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        id:<?php echo $row["minute_grpId"]?>,
                        action: action
                    },
                    success: function(data) {
                        //alert("title: " + data)
                        $("#groupsDiv").html(data);
                    },
                });
            }
            $('#btnEditMinutes').click(function() {
                var nameValue = $('#txtName').val(),
                    objectiveValue = $('#txtObjective').val(),
                    locationValue = $('#txtLocation').val(),
                    attendeesValue = $('#txtAttendees').val(),
                    absenteesValue = $('#txtAbsentees').val(),
                    discussionValue = $('#txtDiscussion').val(),
                    additionalValue = $('#txtAdditional').val(),
                    firstFieldValue = $('#firstField').val(),
                    secondFieldValue = $('#secondField').val(),
                    nextMeetingDateValue = $('#nextMeetingDate').val(),
                    nextMeetingPurposeValue = $('#txtNextMeetingPurpose').val(),
                    groupValue = $('#groups').val(),
                    minuteId = <?php echo $minuteid ?>,
                    count1 = 0,
                    count2 = 0,
                    requestProcess = "editMinutes";

                if (nameValue == "") {
                $('#txtName').css({
                    'border-color': 'red'
                });
                }
                if (nameValue != "") {
                    $('#txtName').css({
                        'border-color': ''
                    });
                }
                if (objectiveValue == "") {
                    $('#txtObjective').css({
                        'border-color': 'red'
                    });
                }
                if (objectiveValue != "") {
                    $('#txtObjective').css({
                        'border-color': ''
                    });
                }
                if (locationValue == "") {
                    $('#txtLocation').css({
                        'border-color': 'red'
                    });
                }
                if (locationValue != "") {
                    $('#txtLocation').css({
                        'border-color': ''
                    });
                }
                if (groupValue == 0) {
                    $('#groups').css({
                        'border-color': 'red'
                    });
                }
                if (groupValue != 0) {
                    $('#groups').css({
                        'border-color': ''
                    });
                }
                if (discussionValue == "") {
                    $('#txtDiscussion').css({
                        'border-color': 'red'
                    });
                }
                if (discussionValue != "") {
                    $('#txtDiscussion').css({
                        'border-color': ''
                    });
                }
                if (attendeesValue == "") {
                    $('#txtAttendees').css({
                        'border-color': 'red'
                    });
                }
                if (attendeesValue != "") {
                    $('#txtAttendees').css({
                        'border-color': ''
                    });
                    $('#lblAttendeesError').html('').css({
                                'color': ''
                            });
                    if(attendeesValue.match(/^[A-Za-z,\s]*(?<!,)(?<!\s)$/)){
                        $('#txtAttendees').css({
                        'border-color': ''
                    });
                    }else{
                        $('#lblAttendeesError').html('Invalid format').css({
                                'color': 'red'
                            });
                        $('#txtAttendees').css({
                        'border-color': 'red'
                    });
                    }
                }
                // if (nextMeetingDateValue == "") {
                //     $('#nextMeetingDate').css({
                //         'border-color': 'red'
                //     });
                // }
                // if (nextMeetingDateValue != "") {
                //     $('#nextMeetingDate').css({
                //         'border-color': ''
                //     });
                // }
                // if (nextMeetingPurposeValue == "") {
                //     $('#txtNextMeetingPurpose').css({
                //         'border-color': 'red'
                //     });
                // }
                // if (nextMeetingPurposeValue != "") {
                //     $('#txtNextMeetingPurpose').css({
                //         'border-color': ''
                //     });
                // }
                if (nameValue == "" || objectiveValue == "" ||
                    attendeesValue == "" || locationValue == "" || groupValue == 0 || discussionValue == "" || 
                    !attendeesValue.match(/^[A-Za-z,\s]*(?<!,)(?<!\s)$/))
                    {
                        $('#feedback').removeClass().addClass('noticeui noticeui-error').html('Please fill all required fields!').show().css({
                        'padding': '4px',
                        'width': 'auto',
                        'text-align': 'center',
                        'display': 'inline-block'
                    });
                    $("html, body").animate({
                        scrollTop: 0
                    }, "fast");
                    }else{
                        $('#feedback').removeClass().html('');
                        $.ajax({
                        cache: false,
                        type: "post",
                        url: "minuteSubmit.php",
                        data: {
                            passNameValue: nameValue,
                            passObjectiveValue: objectiveValue,
                            passLocationValue: locationValue,
                            passgroupsValue: groupValue,
                            passAttendeesValue: attendeesValue,
                            passAbsenteesValue: absenteesValue,
                            passDiscussionValue: discussionValue,
                            passAdditionalValue: additionalValue,
                            passNextMeetingDateValue: nextMeetingDateValue,
                            passNextMeetingPurposeValue: nextMeetingPurposeValue,
                            base: baseValue,
                            passMinuteId: minuteId,
                            passProcess: requestProcess
                        },
                        success: function(response) {
                            //alert(data);
                            //alert(response);
                            if (response.indexOf('Successful') > -1) {
                                //$("#loadingimage2").hide();
                                //alert("message: bhai log " + response);
                                $("html, body").animate({
                                    scrollTop: 0
                                }, "fast");
                                $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Minutes Edited').show().css({
                                    'padding': '4px',
                                    'width': 'auto',
                                    'text-align': 'center',
                                    'display': 'inline-block'
                                });
                                setTimeout(function() {
                                    $('#feedback').fadeOut('fast');
                                    //window.location.replace("homepage.php");
                                }, 2000);

                                //return false;
                                //alert("message: " + response);
                            } else if (response.indexOf('Failed') > -1) {
                                //$("#loadingimage2").hide();
                                $("html, body").animate({
                                    scrollTop: 0
                                }, "fast");
                                $("#feedback").removeClass().addClass('noticeui noticeui-error').html('There is a problem').show().css({
                                    'padding': '4px',
                                    'width': 'auto',
                                    'text-align': 'center',
                                    'display': 'inline-block'
                                });


                            } else {
                                $("#loadingimage2").hide();
                                $("html, body").animate({
                                    scrollTop: 0
                                }, "fast");
                                $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Error in processing your request').show().css({
                                    'padding': '4px',
                                    'width': 'auto',
                                    'text-align': 'center',
                                    'display': 'inline-block'
                                });
                            }

                        }

                    });
                    }
            });
            })
            </script>
</head>

<body>
    <?php include "navbar.php" ?>
    <!-- <h1><?php echo $minuteid ?></h1>
    <h1>khalid</h1> -->
    <br/>

    <div class="container" id="maindiv" runat="server">
        <div class="child card col-12 col-sm-10">


            <div class="row" style="background-color:white">
                <h1 style="text-align: center;padding-top:15px;">Meeting Minute</h1>
                <label id="message"></label>
                <div id="feedbackDiv">
                    <div id="feedback">

                    </div>
                </div>
                <!-- STARTING OF THE FORM -->



                <!-- <form method="POST" id="myform" name="myform" action="" enctype="multipart/form-data"> -->
                <div class="form-group col-12 col-sm-6 mb-2">
                    <strong>
                        <label id="lblFname" for="txtFName">Meeting Title</label><span class="requiredSymbol">*</span></strong> &nbsp;
                    <label id="lblFnameError" class="requiredSymbol"></label>
                    <input onkeyup="checkField('txtName')" class="form-control" name="fname" value='<?php echo $row["minute_title"]?>' PlaceHolder="Enter Name" id="txtName" oninvalid="this.setCustomValidity('Field ')" oninput="this.setCustomValidity('')">
                </div>

                <div class="form-group col-12 col-sm-6 mb-2">

                    <strong>
                        <label id="lblObjective">Objective</label><span class="requiredSymbol">*</span>
                    </strong>
                    <label id="lblObjectiveError"></label>
                    <input onkeyup="checkField(id)" class="form-control" value='<?php echo $row["minute_objective"] ?>' PlaceHolder="Enter Objective" name="`objective" id="txtObjective" />

                </div>
                <div class="form-group col-6 col-sm-3 mb-2">

                    <strong>
                        <label id="lblDate" for="txtDate">Date</label> &nbsp;
                        <label id="lblLnameError"></label>
                    </strong>
                    <input disabled class="form-control" name="ldate" id="txtDate" value="<?php echo date('d-m-Y', strtotime($row["minute_date"]))  ?>" />

                </div>
                <div class="form-group col-6 col-sm-3 mb-2">

                    <strong>
                        <label id="lblLocation" for="txtLocation">Location</label><span class="requiredSymbol">*</span> &nbsp;
                        <label id="lblLocationError"></label>
                    </strong>
                    <input onkeyup="checkField(id)" class="form-control" PlaceHolder="Enter Location" value="<?php echo $row["minute_location"]?>" name="lname" id="txtLocation" />
                </div>

                <div class="form-group-lg col-6 col-sm-3 mb-2">

                    <strong>
                        <label id="lblTime" for="txtDate">Recorded by</label> &nbsp;
                        <label id="lblLnameError"></label>
                    </strong>
                    <input disabled class="form-control" PlaceHolder="Enter Recorder Name" name="ltime" id="txtTime" value="<?php echo $row["minute_recordedby"]?>" />

                </div>
                <div class="form-group col-6 col-sm-3 mb-2">
                    <label>Select Group</label><span class="requiredSymbol">*</span>
                    <!-- <input class="form-control" placeholder="Enter haha" /> -->
                    <div id="groupsDiv">

                    </div>

                </div>
                <div class="form-group col-12 col-sm-12 mb-2">

                    <strong>
                        <label id="lblEmail">Attendees</label><span class="requiredSymbol">*</span>
                    </strong>
                    <div id="tooltip">&#9432;
                            <span id="tooltiptext">
                                <strong>Enter comma(,) separated names: </strong><br />
                                Example
                                <li>abc,xyz</li>
                            </span>
                        </div>
                    <label id="lblAttendeesError"></label>
                    <input onkeyup="checkField(id)" class="form-control" PlaceHolder="Enter names with comma separated" name="attendees" id="txtAttendees" value="<?php echo $row["minute_attendees"]?>" />

                </div>
                <div class="form-group col-12 col-sm-12 mb-2">

                    <strong>
                        <label id="lblAbsentees">Absentees</label>
                    </strong>
                    <label id="lblEmailError"></label>
                    <input onkeyup="checkField(id)" class="form-control" PlaceHolder="Enter Absentees" name="absentees" id="txtAbsentees" value="<?php echo $row["minute_absentees"] ?>" />

                </div>
                <div class="form-group col-12 col-sm-12 mb-2">
                    <label>
                        <h4>Discussion</h4>
                    </label>
                    <span class="requiredSymbol">*</span>
                    <textarea onkeyup="checkField(id)" class="form-control" type="textarea" style="resize: none;" rows="6" col="3" id="txtDiscussion"><?php echo $row["minute_discussion"]?></textarea>

                </div>
                <div class="form-group col-12 col-sm-12 mb-2">

                    <h4>Additional Notes</h4>
                    <textarea class="form-control" id="txtAdditional" type="textarea" style="resize: none;" rows="3" cols="1"><?php echo $row["minute_note"]?></textarea>
                </div>

                <div class="form-group col-lg-12 col-xs-12 mb-2">

                    <strong>
                        <h4 id="lblEmail">Takeaways</h4>
                    </strong>
                    <table id="takeawayTable" class="table table-bordered table-hover">
                       

                        <tbody class="field_wrapper">
                            <?php
                                if (mysqli_num_rows($selecttakeawayResult) > 0) {
                                    $index = 1;
                                    echo "
                                    <tr>
                                    <th>
                                        #
                                    </th>
                                    <th>
                                        Action Item
                                    </th>
                                    <th>
                                        Owner
                                    </th>
                                    </tr>
                                    ";
                                    while ($takeawayRow = mysqli_fetch_assoc($selecttakeawayResult)) {
                                   
                                    
                echo "
                <tr>
                <td>" . $index . "</td>
                <td>" . $takeawayRow["takeaway_item"] . "</td>
                <td>" . $takeawayRow["takeaway_owner"] . "</td>
                </tr>";
                $index++;
                                }
                            }else{ echo "<td>No Takeaways</td>";

                            }
                            ?>
                        </tbody>

                    </table>
                </div>
                <div class="form-group col-12 col-sm-12 mb-2">

                    <h4>Next Meeting</h4>
                    <div class="row" id="nextMeetingDiv">
                        <div class="form-group col-12 col-sm-6">
                            <label id="lblNextMeetingDate">Date & Time</label>
                            <input oninput="checkField(id)" class="form-control" type="datetime-local" id="nextMeetingDate" value="<?php echo $row["minute_nxt_date"] ?>" />
                        </div>
                        <div class="form-group col-12 col-sm-6 mb-1">
                            <label id="lblNextMeetingPorpuse">Purpose</label>
                            <input onkeyup="checkField(id)" class="form-control" type="text" id="txtNextMeetingPurpose" value="<?php echo $row["minute_nxt_purpose"]?>" />
                        </div>
                    </div>

                </div>
                <div class="form-group col-12 col-sm-6 mb-2">
                    <h4>Recording</h4>
                    <div>
                    <?php 
                        if(!empty($fileText)){
                            ?>
                            <audio controls="true" ccontrols controlsList="nodownload" src=<?php echo $fileText ?>></audio>
                        <?php }
                        else{
                            echo "<label class=\"text-default\">There is no Audio File.</label>";
                        }?>
                        <div class="float-start">
                            <button type="button" alt="record" class="btn btn-danger btn-circle btn-lg" id="record">
                                <i class="fa-solid fa-microphone"></i>
                            </button>
                            <button type="button" id="stopRecord" class="btn btn-stop btn-danger rounded-0" disabled>
                                <i class="fa-sharp fa-solid fa-stop"></i>
                            </button>
                            <img id="recordImage" src="img/stop_recording.gif" height="30px" width="30px" />
                            <label id="showTime" name="lblTimer"></label>
                        </div>

                        <div>
                            <audio id="recordedAudio"></audio>
                        </div>


                    </div>




                </div>
                <script>
                    navigator.mediaDevices.getUserMedia({
                        audio: true
                    }).then((stream) => {
                        handlerFunction(stream);
                    });

                    function showBase() {
                        if (baseValue != "") {
                            //alert("yes base have");
                            var action = "saveBase";
                            $.ajax({
                                url: "testSendingBase.php",
                                method: "POST",
                                data: {
                                    base: baseValue,
                                    action: action,
                                },
                                success: function(response) {
                                    //alert("Hello" + response);
                                    //$("#minuteDiv").html(data);
                                },
                            });
                        } else {
                            //alert("Please Record the audio");
                        }

                        //alert(baseValue);
                    }



                    function handlerFunction(stream) {
                        rec = new MediaRecorder(stream);
                        rec.ondataavailable = (e) => {
                            audioChunks.push(e.data);
                            if (rec.state == "inactive") {
                                let blob = new Blob(audioChunks, {
                                    type: "audio/mp3"
                                });
                                recordedAudio.src = URL.createObjectURL(blob);
                                recordedAudio.controls = true;
                                recordedAudio.controlsList = "nodownload";
                                recordedAudio.autoplay = false;
                                sendData(blob);
                            }
                        };
                    }

                    function sendData(data) {
                        //alert(data);
                        var reader = new FileReader();
                        let base64data = "";
                        reader.readAsDataURL(data);
                        reader.onloadend = function() {
                            base64data = reader.result;
                            console.log(base64data);
                            //testAudio.src = base64data;
                            baseValue = base64data;
                        };
                        //alert(base64data + "yallllaaaa");
                        //var process = new ffmpeg("");
                        loadbase(base64data);
                    }

                    function loadbase(base) {
                        //alert(base + "khalid");
                    }
                    record.onclick = (e) => {
                        //record.style.backgroundColor = "blue";
                        //alert("record clicked");
                        $("#record").hide();
                        $("#stopRecord").show();
                        seconds = 0;
                        displayTime();
                        $("#showTime").show();
                        //record.disabled = true;
                        stopRecord.disabled = false;
                        $("#recordImage").show();
                        audioChunks = [];
                        rec.start();
                    };
                    stopRecord.onclick = (e) => {
                        //record.disabled = false;
                        //stop.disabled = true;
                        //record.style.backgroundColor = "red";
                        //alert("stop clicked");
                        clearInterval(timing);
                        $("#record").show();
                        $("#stopRecord").hide();
                        $("#recordImage").hide();
                        $("#showTime").hide();

                        rec.stop();
                    };
                </script>

                <div class="form-group col-12 col-sm-12 text-center mb-3">
                    <input style="font-size:1.2rem" type="button" id="btnEditMinutes" name="CreateMinutesButton" value="Update" class="btn btn-block buttonStyle w-50" />
                </div>


                <!-- </form> -->
            </div>

            <!--here-->
        </div>
    </div>
</body>

</html>