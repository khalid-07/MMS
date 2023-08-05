<?php
session_start();
date_default_timezone_set("Asia/Qatar");
$date = date("d/m/Y");
$time = date("h:i A")
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
        let timing = "";
        let seconds = 0;
        let baseValue = "";

        function displayTime() {
            seconds = 00;
            $("#showTime").html(":0" + seconds);
            timing = setInterval(showTime, 1000);
        }

        /*function showBase() {
            if (baseValue != "") {
                alert("yes base have");
                var action = "saveBase";
                $.ajax({
                    url: "testSendingBase.php",
                    method: "POST",
                    data: {
                        base: baseValue,
                        action: action,
                    },
                    success: function(response) {
                        alert("Hello" + response);
                        //$("#minuteDiv").html(data);
                    },
                });
            } else {
                alert("Please Record the audio");
            }

            //alert(baseValue);
        }*/

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

        function showNextMeeting() {
            //alert("hello");
            $('#nextMeetingDiv').show();
            $('#nextMeetingButton').hide();

        }

        function hideNextMeeting() {
            //alert("hello");
            $('#nextMeetingButton').show();
            $('#nextMeetingDiv').hide();
            $('#nextMeetingDate').val('');
            $('#txtNextMeetingPurpose').val('');
            $('#nextMeetingDate').css({
                'border-color': ''
            });
            $('#txtNextMeetingPurpose').css({
                'border-color': ''
            });
        }

        function showTakeaways() {
            $('#takeawayTable').show();
            $('#takeawayButton').hide();
            $('#takeawayCancelButton').show();
            //takeawayCancelButton
        }

        function hideTakeawayTable() {
            //alert("yes cancel");
            $('#takeawayTable').hide();
            $('#takeawayButton').show();
            $('#takeawayCancelButton').hide();


        }

        function checkField(field) {
            $('#' + field).css({
                'border-color': ''
            });
        }
        // $(function() {
        //     $("#datepicker").datepicker();
        // });
        $(document).ready(function() {
            $('#nextMeetingDiv').hide();
            $('#takeawayTable').hide();
            $('#takeawayCancelButton').hide();
            $("#recordImage").hide();
            $("#stopRecord").hide();
            loadGroups();
            //var maxField = 10; //Input fields increment limitation
            var addButton = $(".add_button"); //Add button selector
            //var wrapper = $(".field_wrapper"); //Input field wrapper
            //var x = 0;
            var y = 1;

            function loadGroups() {
                var action = "fetchAllGroupList";
                $.ajax({
                    url: "groupCrud.php",
                    method: "POST",
                    data: {
                        action: action,
                    },
                    success: function(data) {
                        //alert("title: " + data)
                        $("#groupsDiv").html(data);
                    },
                });
            }

            // $('#audioButton').click(function() {
            //     alert("hello: " + baseValue);
            // })

            var wrapper = $(".field_wrapper");
            var maxField = 10;
            var x = 0;
            $(addButton).click(function() {
                //Check maximum number of input fields
                var fieldHTML =
                    '<tr><td><input onkeyup="checkField(id)" type="text" id="firstFields' + x + '" name="field_name[]"' +
                    'class="dynamicFields1 form-control" value="" /> </td>' +
                    '<td><input onkeyup="checkField(id)" type="text" id="secondFields' + x + '" name="secondfield_name[]"' + 
                    'class="dynamicFields2 form-control" value="" /></td>' +
                    '<td style="text-align: center;"><a href="javascript:void(0);" class="remove_button"' +
                    'style="background-color:blue">' +
                    '<button type="button" id="btnAdd" name="addButton" class="btn btn-danger">' +
                    '<i class="fa-sharp fa-solid fa-minus"></i>' +
                    '</button></a></td></tr>'; //New input field html
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });
            $(wrapper).on("click", ".remove_button", function(e) {
                e.preventDefault();
                $(this).closest("tr").remove();
                x--;
            });

            $('#takeawayCancelButton').click(function(e) {
                //alert("hala khaas");
                if ($('.dynamicFields1').length) {
                    //alert("Yess there are dynamic fields: " + x);
                    //alert("Length of dynamic fields: " + $('.dynamicFields1').length);
                    $(".dynamicFields1").each(function() {
                        e.preventDefault();
                        $(this).closest("tr").remove();
                        x--;
                    });
                    //alert("Remaining: " + x);
                    $('#takeawayTable').hide();
                    $('#takeawayCancelButton').hide();
                    $('#takeawayButton').show();
                    $('#firstField').val('');
                    $('#firstField').css({
                        'border-color': ''
                    });
                    $('#secondField').css({
                        'border-color': ''
                    });

                    $('#secondField').val('');
                } else {
                    $('#takeawayTable').hide();
                    $('#takeawayCancelButton').hide();
                    $('#takeawayButton').show();
                    $('#firstField').val('');
                    $('#firstField').css({
                        'border-color': ''
                    });
                    $('#secondField').css({
                        'border-color': ''
                    });
                    $('#secondField').val('');
                }
            });
            $('#chkBtn').click(function() {
                let value = $('#groups').val();
                if (value == 0) {
                    //alert("ohh no");
                } else {
                    //alert("yahooo: " + value);
                }

            })
            $('#btnCreateMinutes').click(function() {
                var firstFieldArray = [];
                var secondFieldArray = [];
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
                    count1 = 0,
                    count2 = 0,
                    requestProcess = "createMinutesProcess";




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
                if (!$('#takeawayTable').is(":hidden")) {
                    if (firstFieldValue == "") {
                        $('#firstField').css({
                            'border-color': 'red'
                        });
                        //return false;
                    }
                    if (secondFieldValue == "") {
                        $('#secondField').css({
                            'border-color': 'red'
                        });
                        //return false;
                    }
                    if (firstFieldValue != "") {
                        //var result = false;
                        $('#firstField').css({
                            'border-color': ''
                        });
                    }
                    if (secondFieldValue != "") {
                        $('#secondField').css({
                            'border-color': ''
                        });
                        //return false;
                    }
                    if ($('.dynamicFields1').length) {
                        //alert("hala");
                        var result = false;

                        //var result2 = false;
                        $(".dynamicFields1").each(function() {

                            var id = $(this).attr("id");
                            //alert("Field 1 id: " + id);
                            //alert("Length is: " + $('.dynamicFields1').length)

                            if ($("#" + id).val() != "") {
                                count1++;
                                //alert("Field 1 contains");
                                $("#" + id).css({
                                    'border-color': ''
                                });
                                //result = true;
                            }
                            if ($("#" + id).val() == "") {
                                //alert("Field 1 not contains");
                                $("#" + id).css({
                                    'border-color': 'red'
                                });
                                //return false;
                                //result = false;

                                //exit;
                            }
                            //return result;
                            //alert("id: " + id);
                            //return false;
                        });
                        $(".dynamicFields2").each(function() {

                            var id = $(this).attr("id");
                            //alert("Field 2 id: " + id);
                            if ($("#" + id).val() != "") {
                                count2++;
                                //alert("Field 2 contains");
                                $("#" + id).css({
                                    'border-color': ''
                                });
                                //result = true;
                            } else if ($("#" + id).val() == "") {
                                $("#" + id).css({
                                    'border-color': 'red'
                                });
                                //result = false;
                                //break;
                            }
                            //return result;

                            //alert("id: " + id);
                        });

                        //if (count1 == $('.dynamicFields1').length && $('.dynamicFields1').length == count2) {
                        //  result = true;
                        //}
                        //return result;
                    }
                }

                if (!$('#nextMeetingDiv').is(":hidden")) {
                    if (nextMeetingDateValue == "") {
                        $('#nextMeetingDate').css({
                            'border-color': 'red'
                        });
                    }
                    if (nextMeetingDateValue != "") {
                        $('#nextMeetingDate').css({
                            'border-color': ''
                        });
                    }
                    if (nextMeetingPurposeValue == "") {
                        $('#txtNextMeetingPurpose').css({
                            'border-color': 'red'
                        });
                    }
                    if (nextMeetingPurposeValue != "") {
                        $('#txtNextMeetingPurpose').css({
                            'border-color': ''
                        });
                    }

                }
                if (nameValue == "" || objectiveValue == "" ||
                    attendeesValue == "" || locationValue == "" || groupValue == 0 || discussionValue == "" ||
                    (!$('#takeawayTable').is(":hidden") && $('#firstField').val() == "") ||
                    (!$('#takeawayTable').is(":hidden") && $('#secondField').val() == "") ||
                    count1 != $('.dynamicFields1').length || $('.dynamicFields1').length != count2 ||
                    (!$('#nextMeetingDiv').is(":hidden") && nextMeetingDateValue == "") ||
                    (!$('#nextMeetingDiv').is(":hidden") && nextMeetingPurposeValue == "") || 
                    !attendeesValue.match(/^[A-Za-z,\s]*(?<!,)(?<!\s)$/)) {
                    $('#feedback').removeClass().addClass('noticeui noticeui-error').html('Please fill all required fields!')
                    .show().css({
                        'padding': '4px',
                        'width': 'auto',
                        'text-align': 'center',
                        'display': 'inline-block'
                    });
                    $("html, body").animate({
                        scrollTop: 0
                    }, "fast");
                } else {
                    $('#feedback').removeClass().html('');
                    if ($("#firstField").val() != "") {
                        firstFieldArray.push($("#firstField").val());
                        secondFieldArray.push($("#secondField").val());
                    }

                    if ($('.dynamicFields1').length) {
                        //alert("hala dynamic fields");
                        //var result = false;

                        //var result2 = false;
                        $(".dynamicFields1").each(function() {
                            var id = $(this).attr("id");

                            //testFirst.push("kaka")
                            //firstFieldArray.push("kaka");
                            firstFieldArray.push($("#" + id).val());
                            //alert($("#" + id).val());
                        })
                        $(".dynamicFields2").each(function() {
                            var id = $(this).attr("id");
                            secondFieldArray.push($("#" + id).val());
                            //secondFieldAray.push("lala");
                            //alert($("#" + id).val());
                        })
                    }
                    //alert("List: " + firstFieldArray);
                    //alert("2nd List: " + secondFieldArray);
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
                            passActionItemValue: firstFieldArray,
                            passOwnerValue: secondFieldArray,
                            passNextMeetingDateValue: nextMeetingDateValue,
                            passNextMeetingPurposeValue: nextMeetingPurposeValue,
                            base: baseValue,
                            passProcess: requestProcess
                        },
                        success: function(response) {
                            //alert(data);
                            //alert(response);
                            if (response.indexOf('successfull') > -1) {
                                //$("#loadingimage2").hide();
                                //alert("message: bhai log " + response);
                                $("html, body").animate({
                                    scrollTop: 0
                                }, "fast");
                                $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Minutes Created').show().css({
                                    'padding': '4px',
                                    'width': 'auto',
                                    'text-align': 'center',
                                    'display': 'inline-block'
                                });
                                setTimeout(function() {
                                    $('#feedback').fadeOut('fast');
                                    window.location.replace("homepage.php");
                                }, 2000);

                                //return false;
                                //alert("message: " + response);
                            } else if (response.indexOf('Prob') > -1) {
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
                                $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Error in processing your request').show().css({
                                    'padding': '4px',
                                    'width': 'auto',
                                    'text-align': 'center',
                                    'display': 'inline-block'
                                });
                            }

                        }

                    });
                    //alert("success");


                }

            });
        });
    </script>
</head>

<body>
    <?php include "navbar.php" ?>
    <div class="container" id="maindiv" runat="server">
        <div class="child card col-12 col-sm-10 mt-3">


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
                    <input onkeyup="checkField('txtName')" class="form-control" name="fname" value="" PlaceHolder="Enter Name" id="txtName" oninvalid="this.setCustomValidity('Field ')" oninput="this.setCustomValidity('')">
                </div>

                <div class="form-group col-12 col-sm-6 mb-2">

                    <strong>
                        <label id="lblObjective">Objective</label><span class="requiredSymbol">*</span>
                    </strong>
                    <label id="lblObjectiveError"></label>
                    <input onkeyup="checkField(id)" class="form-control" PlaceHolder="Enter Objective" name="`objective" id="txtObjective" />

                </div>
                <div class="form-group col-6 col-sm-3 mb-2">

                    <strong>
                        <label id="lblDate" for="txtDate">Date</label> &nbsp;
                        <label id="lblLnameError"></label>
                    </strong>
                    <input disabled class="form-control" name="ldate" id="txtDate" value="<?php echo $date ?>" />

                </div>
                <div class="form-group col-6 col-sm-3 mb-2">

                    <strong>
                        <label id="lblLocation" for="txtLocation">Location</label><span class="requiredSymbol">*</span> &nbsp;
                        <label id="lblLocationError"></label>
                    </strong>
                    <input onkeyup="checkField(id)" class="form-control" PlaceHolder="Enter Location" name="lname" id="txtLocation" />
                </div>

                <div class="form-group-lg col-6 col-sm-3 mb-2">

                    <strong>
                        <label id="lblTime" for="txtDate">Recorded by</label> &nbsp;
                        <label id="lblLnameError"></label>
                    </strong>
                    <input disabled class="form-control" PlaceHolder="Enter Recorder Name" name="ltime" id="txtTime" value=<?php echo $_SESSION["name"] ?> />

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
                    <input onkeyup="checkField(id)" class="form-control" PlaceHolder="Enter names with comma separated" name="attendees" id="txtAttendees" />

                </div>
                <div class="form-group col-12 col-sm-12 mb-2">

                    <strong>
                        <label id="lblAbsentees">Absentees</label>
                    </strong>
                    <label id="lblEmailError"></label>
                    <input onkeyup="checkField(id)" class="form-control" PlaceHolder="Enter Absentees" name="absentees" id="txtAbsentees" />

                </div>
                <div class="form-group col-12 col-sm-12 mb-2">
                    <label>
                        <h4>Discussion</h4>
                    </label>
                    <span class="requiredSymbol">*</span>
                    <textarea onkeyup="checkField(id)" class="form-control" type="textarea" style="resize: none;" rows="6" col="3" id="txtDiscussion"></textarea>

                </div>
                <div class="form-group col-12 col-sm-12 mb-2">

                    <h4>Additional Notes</h4>
                    <textarea class="form-control" id="txtAdditional" type="textarea" style="resize: none;" rows="3" cols="1"> </textarea>

                </div>

                <div class="form-group col-lg-12 col-xs-12 mb-2">

                    <strong>
                        <h4 id="lblEmail">Takeaways</h4>
                    </strong>
                    <button class="btn buttonStyle" id="takeawayButton" type="button" onclick="showTakeaways()">Add Takeaways</button>


                    <label id="lblEmailError"></label>
                    <table id="takeawayTable" class="table table-bordered table-hover table-striped">
                        <tr>
                            <th>Action Item</th>
                            <th>Owner</th>
                            <th></th>
                        </tr>
                        <tbody class="field_wrapper">
                            <tr>
                                <td>
                                    <input onkeyup="checkField(id)" type="text" class="form-control" id="firstField" name="field_name[]" />
                                </td>
                                <td>
                                    <input onkeyup="checkField(id)" type="text" class="form-control" id="secondField" name="secondfield_name[]" />
                                </td>
                                <td style="text-align:center;padding-right:0px">
                                    <a href="javascript:void(0);" class="add_button" style="padding-left:10px">
                                        <button type="button" id="btnAdd" name="addButton" class="btn btn-success me-3">
                                            <i class="fa-sharp fa-solid fa-plus"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="button" class="btn pull-right buttonStyle" id="takeawayCancelButton">Cancel</button>
                </div>
                <div class="form-group col-12 col-sm-12 mb-2">

                    <h4>Next Meeting</h4>
                    <button onclick="showNextMeeting()" class="btn buttonStyle" id="nextMeetingButton" type="button">Add Next Meeting Information</button>
                    <div class="row" id="nextMeetingDiv">
                        <div class="form-group col-12 col-sm-6">
                            <label id="lblNextMeetingDate">Date & Time</label>
                            <input oninput="checkField(id)" class="form-control" type="datetime-local" id="nextMeetingDate" />
                        </div>
                        <div class="form-group col-12 col-sm-6 mb-1">
                            <label id="lblNextMeetingPorpuse">Purpose</label>
                            <input onkeyup="checkField(id)" class="form-control" type="text" id="txtNextMeetingPurpose" />
                        </div>
                        <div class="form-group col-12 col-sm-12">
                            <button onclick="hideNextMeeting()" class="btn buttonStyle pull-right" id="cancelButton" type="button">Cancel</button>
                        </div>

                    </div>

                </div>
                <div class="form-group col-12 col-sm-6 mb-2">
                    <h4>Recording</h4>
                    <div>
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
                            alert("baseValue is empty");
                        }
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
                    <input type="button" id="btnCreateMinutes" name="CreateMinutesButton" value="Create" class="btn btn-block buttonStyle w-50" />

                </div>


                <!-- </form> -->
            </div>

            <!--here-->
        </div>
    </div>

</body>

</html>