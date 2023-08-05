<?php
session_start();
date_default_timezone_set("Asia/Qatar");
$date = date("d/m/Y");
$time = date("h:i A")
?>

<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        function checkField(field) {
            $('#' + field).css({
                'border-color': ''
            });
        }

        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $(".add_button"); //Add button selector
            var wrapper = $(".field_wrapper"); //Input field wrapper
            var x = 1;
            var y = 1;
            $(addButton).click(function() {
                //Check maximum number of input fields
                var fieldHTML =
                    '<tr><td><input type="text" id="firstFields' + x + '" name="field_name[]" class="dynamicFields form-control" value="" /> </td>' +
                    '<td><input type="text" name="secondfield_name[]" class="dynamicFields form-control" value="" /></td>' +
                    '<td style="text-align: center;"><a href="javascript:void(0);" class="remove_button">' +
                    '<button type="button" id="btnAdd" name="addButton" class="btn btn-primary">' +
                    '<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>' +
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

            $('#btnCreateMinutes').click(function() {
                //alert("khalid");
                var nameValue = $('#txtName').val(),
                    descValue = $('#txtDesc').val(),
                    attendeesValue = $('#txtAttendees').val(),
                    requestProcess = "createMinutesValue";

                if (nameValue == "" || descValue == "" || attendeesValue == "") {
                    $('#feedback').removeClass().addClass('noticeui noticeui-error').html('Please fill all the fields!').show().css({
                        'padding': '4px',
                        'width': 'auto',
                        'text-align': 'center',
                        'display': 'inline-block'
                    });
                    if (nameValue == "") {
                        $('#txtName').css({
                            'border-color': 'red'
                        });
                    }
                    if (descValue == "") {
                        $('#txtDesc').css({
                            'border-color': 'red'
                        });
                    }
                    if (attendeesValue == "") {
                        $('#txtAttendees').css({
                            'border-color': 'red'
                        });
                    }
                    $('#txtEmail').focus();
                    return false;
                } else {
                    $('#feedback').removeClass().html("");
                    if ($('#txtDesc').val().length > 100) {
                        $('#lblLnameError').removeClass().addClass('limit-error').html('Max Limit 100').show();
                        return false;
                    } else {
                        $('#lblLnameError').removeClass().html("");

                        $.ajax({
                            cache: false,
                            type: "post",
                            url: "createMinutesCheck.php",
                            data: {
                                passNameValue: nameValue,
                                passDescValue: descValue,
                                passAttendeesValue: attendeesValue,
                                passProcess: requestProcess
                            },
                            success: function(response) {
                                //alert(data);
                                alert(response);
                                /* if (response.indexOf('REACH') > -1) {
                                     //$("#loadingimage2").hide();
                                     //window.location.replace("homepage.php");
                                     //return false;
                                 }
                                 /*else if (response.indexOf('not') > -1) {
                                                                    $("#loadingimage2").hide();
                                                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Invalid email or password').show().css({
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
                                                                }*/

                            }

                        });


                        $('#feedback').removeClass().addClass('noticeui noticeui-success').html('Success').show().css({
                            'padding': '4px',
                            'width': 'auto',
                            'text-align': 'center',
                            'display': 'inline-block'
                        });
                    }

                }
            });
        });
    </script>
</head>

<body>
    <?php include "navbar.php" ?>
    <div class="container" id="maindiv" runat="server">
        <div class="child card row col-lg-10" style="padding: 0px 30px 30px 30px">
            <h1 style="text-align: center">Meeting Minute</h1>
            <label id="message"></label>
            <div id="feedbackDiv">
                <div id="feedback">

                </div>
            </div>
            <!-- STARTING OF THE FORM -->

            <form method="POST" id="myform" name="myform" action="" enctype="multipart/form-data">
                <div class="form-group col-xs-12 col-lg-6">
                    <strong>
                        <label id="lblFname" for="txtFName">Meeting Title</label></strong> &nbsp;
                    <label id="lblFnameError"></label>
                    <input onkeyup="checkField('txtName')" class="form-control" name="fname" value="" PlaceHolder="Enter Name" id="txtName" oninvalid="this.setCustomValidity('Field ')" oninput="this.setCustomValidity('')">
                </div>

                <div class="form-group col-lg-6 col-xs-12">

                    <strong>
                        <label id="lblObjective">Objective</label>
                    </strong>
                    <label id="lblObjectiveError"></label>
                    <input onkeyup="checkField('txtAttendees')" class="form-control" PlaceHolder="Enter Objective" name="`objective" id="txtObjective" />

                </div>
                <div class="form-group col-lg-3 col-xs-6">

                    <strong>
                        <label id="lblDate" for="txtDate">Date</label> &nbsp;
                        <label id="lblLnameError"></label>
                    </strong>
                    <input disabled class="form-control" name="ldate" id="txtDesc" value="<?php echo $date ?>" />

                </div>
                <div class="form-group col-lg-3 col-xs-6">

                    <strong>
                        <label id="lblLocation" for="txtLocation">Location</label> &nbsp;
                        <label id="lblLocationError"></label>
                    </strong>
                    <input onkeyup="checkField('txtDesc')" class="form-control" PlaceHolder="Enter Location" name="lname" id="txtLocation" />
                </div>

                <div class="form-group col-lg-6 col-xs-12">

                    <strong>
                        <label id="lblTime" for="txtDate">Facilitator</label> &nbsp;
                        <label id="lblLnameError"></label>
                    </strong>
                    <input class="form-control" PlaceHolder="Enter Facilitator Name" name="ltime" id="txtTime" value="" />

                </div>
                <div class="form-group col-lg-12 col-xs-12">

                    <strong>
                        <label id="lblEmail">Attendees</label>
                    </strong>
                    <label id="lblEmailError"></label>
                    <input onkeyup="checkField('txtAttendees')" class="form-control" PlaceHolder="Enter Attendees Name" name="attendees" id="txtAttendees" />

                </div>
                <div class="form-group col-lg-12 col-xs-12">

                    <strong>
                        <label id="lblAbsentees">Absentees</label>
                    </strong>
                    <label id="lblEmailError"></label>
                    <input onkeyup="checkField('txtAttendees')" class="form-control" PlaceHolder="Enter Absentees" name="absentees" id="txtAbsentees" />

                </div>
                <div class="form-group col-lg-12 col-xs-12">

                    <h4>Agenda Items</h4>
                    <textarea class="form-control" type="textarea" row="5" col="3"> </textarea>

                </div>


                <div class="form-group col-lg-12 col-xs-12">

                    <h4>Next Meeting</h4>
                    <textarea class="form-control" type="textarea" row="5" col="3"> </textarea>
                    <input type="datetime-local" id="birthdaytime" name="birthdaytime">
                    <br />
                    <audio controls autoplay muted>
                        <source src="horse.ogg" type="audio/ogg">
                        <source src="horse.mp3" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                <div class="form-group col-lg-6 col-xs-12 col-lg-offset-3">

                    <div>
                        <input type="submit" id="btnCreateMinutes" name="CreateMinutesButton" value="Create" class="btn btn-primary btn-block" />
                    </div>
                </div>
            </form>
        </div>

        <!--here-->

    </div>
</body>

</html>