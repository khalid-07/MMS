<?php
include "database.php";
session_start();
if (isset($_SESSION["minuteId"])) {
    unset($_SESSION["minuteId"]);
}
if (isset($_SESSION["detailsId"])) {
    unset($_SESSION["detailsId"]);
}
if (isset($_SESSION["editId"])) {
    unset($_SESSION["editId"]);
}
// if (isset($_SESSION["detailsId"])) {
//     unset($_SESSION["detailsId"]);
// }
if (!isset($_SESSION["username"])) {
    header("location:signin.php");
}
// if (isset($_SESSION["editId"])) {
//     $editId = $_SESSION["editId"];
//     //header("location:signin.php");
// }
$email = $_SESSION["username"];
$userId = $_SESSION["userId"];
$name = $_SESSION["name"];
$role = $_SESSION["role"];
//$selectUserQuery = "SELECT id FROM tblUsers where user_email = '$email'";
//$selectResult = (mysqli_query($conn, $selectUserQuery));
//if (mysqli_num_rows($selectResult) > 0) {
//$row = mysqli_fetch_assoc($selectResult);
//$userId = $row["id"];
//$selectUsers = "SELECT * FROM tblUsers";
//$selectMinutesQuery = "SELECT * FROM fyp_2022.tblMinutes AS min JOIN fyp_2022.tblUserMinutes AS usermin ON min.id = usermin.minute_id AND usermin.user_id = '$userId' ORDER BY  min.minute_date DESC;";
//$selectResult = (mysqli_query($conn, $selectMinutesQuery));
/*if (mysqli_num_rows($selectResult) > 0) {
while ($row = mysqli_fetch_assoc($selectResult)) {
echo "id: " . $row["id"];
echo "name: " . $row["minute_name"];
}
}*/
//$row = mysqli_fetch_assoc($selectResult);
//$userId = $row["id"];




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
            /*$(function() {
                $("#nav-placeholder").load("navbar.html");
    
            });*/
            function showDetails(id) {
                //alert("yessss " + id);

                $.ajax({
                    type: "post",
                    cache: false,
                    url: "editMeetingMinute.php",
                    data: {
                        minuteid: id
                    },
                    success: function (data) {
                        //alert(data);
                        window.location.href = "editMeetingMinute.php";

                    }
                });

                //window.location.href = "editMeetingMinute.php";
            }

            function detailsPage(id) {
                var action = "details";
                //alert("detaiillslslslsls");
                $.ajax({
                    type: "post",
                    cache: false,
                    url: "Redirect.php",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        //alert(data);
                        window.location.href = "detailsMeetingMinute.php";

                    }
                });
            }

            function editPage(id) {
                var action = "send";
                $.ajax({
                    type: "post",
                    url: "Redirect.php",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        //alert(data);
                        window.location.href = "editMeetingMinute.php";
                        //$("#usersDiv").html(data);
                    }
                })
            }

            function shareMinutes(id) {

                //alert('yahooooo:' + id);
                var action = "fetchUsers";
                $.ajax({
                    url: "getMeetingMinutes.php",
                    method: "POST",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        $("#usersDiv").html(data);
                    }
                })

            }


            function changeStatus(userId, minuteId) {
                //alert("yesss: " + userId)
                //alert("yalla")
                var x = $('#' + userId)[0].checked;
                if (x) {
                    //alert("Its been checked: " + userId);
                    var action = "grant";
                    $.ajax({
                        url: "getMeetingMinutes.php",
                        method: "POST",
                        data: {
                            id: userId,
                            minuteId: minuteId,
                            action: action
                        },
                        success: function (data) {
                            //loadUsersAccess();
                            //alert(data);
                        }
                    })
                } else {
                    alert("Unckecked!!: " + userId);
                    var action = "revoke";
                    $.ajax({
                        url: "getMeetingMinutes.php",
                        method: "POST",
                        data: {
                            id: userId,
                            minuteId: minuteId,
                            action: action
                        },
                        success: function (data) {
                            //loadUsersAccess();
                           // alert(data);
                        }
                    })
                }


            }
            $(document).ready(function () {
                loadMeetingMinutes();
                function loadMeetingMinutes() {
                    var action = "fetchall";
                    $.ajax({
                        url: "getMeetingMinutes.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function (data) {
                            $("#minutesDiv").html(data);
                        }
                    })
                }
                
                <?php 
                if($_SESSION["role"]!="admin"){
                    ?>
                    loadGroups();
                    <?php
                }
                ?>
                
                $('#loadingimage2').hide();
                $('#titleName').val('');

                

                function loadGroups() {
                    var action = "checkGroups";
                    $.ajax({
                        url: "groupCrud.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function (data) {
                            if (data.indexOf('Success') < 0) {
                                $("#feedback").removeClass().addClass('noticeui noticeui-warn').html('<strong><?php echo $name ?></strong>, You need to create or join a group to create meeting minutes').show().css({
                                    'padding': '4px',
                                    'width': 'auto',
                                    'text-align': 'center',
                                    'display': 'inline-block'
                                });
                            } else {

                            }
                        }
                    })
                }
                $('#search2Button').click(function(){
                    var month = $('#monthList').val();
                    var year = $('#yearList').val();
                    $('#minuteDate').val('');
                    $('#titleName').val();
                    var action = "filter2Minutes";
                    $("#loadingimage2").show();
                    $("#minutesDiv").hide();
                        $.ajax({
                            url: "getMeetingMinutes.php",
                            method: "POST",
                            data: {
                                month: month,
                                year: year,
                                action: action
                            },
                            success: function (data) {
                                $("#loadingimage2").hide();
                                $("#minutesDiv").show();
                                $("#minutesDiv").html(data);
                                //$('#feedback').html("");
                            }
                        })

                    //alert("month: "+month+" year: "+year);
                })
                $('#searchButton').click(function () {
                    var title = $('#titleName').val();
                    var minuteDate = $('#minuteDate').val();
                    $('#monthList').val('0');
                    $('#yearList').val('0');
                    //var mydate = new Date(minuteDate);
                    //var date = new Date(minuteDate);
                    //var month =date.toLocaleString('default', { month: 'short' });
                    // var month = date.getMonth()+1;
                    var trimTitle = jQuery.trim(title);
                    //alert("date: "+minuteDate);
                    // if (trimTitle == "") {
                    //     loadMeetingMinutes();
                    // }
                    // else {
                        var action = "filterMinutes";
                        $.ajax({
                            url: "getMeetingMinutes.php",
                            method: "POST",
                            data: {
                                title: trimTitle,
                                date: minuteDate,
                                action: action
                            },
                            success: function (data) {
                                $("#minutesDiv").html(data);
                            }
                        })
                   // }
                })

            })
        </script>
    </head>

    <body>
        <div id="nav-placeholder3">
            <?php
            include "navbar.php";
            ?>

        </div>
        <h1 class="text-center">Meeting Minutes</h1>
    <!-- <h1>Minutes pages</h1>
    <h2><?php echo $_SESSION["userId"] ?></h2>
    <h2><?php echo $_SESSION["username"] ?></h2>
    <h3><?php echo $_SESSION["userId"] ?></h3>
    <h3><?php echo $_SESSION["name"] ?></h3>
    <h3><?php echo $_SESSION["role"] ?></h3> -->
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12">
                   <div class="row">
                    <div class="col-6 col-sm-6">

                   <button class="btn buttonStyle float-end w-100" id="searchButtons" data-bs-toggle="modal" data-bs-target="#tndModal"><i class="fa-sharp fa-solid fa-search"></i> <strong>Title & Date</strong></button>
        </div>
        <div class="col-6 col-sm-6">

                   <button class="btn buttonStyle float-end w-100" id="searchButtonss" data-bs-toggle="modal" data-bs-target="#mnyModal"><i class="fa-sharp fa-solid fa-search"></i> <strong>Month & Year</strong></button>
        </div>
        </div>
        <div class="modal fade" id="tndModal" tabindex="-1" aria-labelledby="tndModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tndModalLabel">Search by Title & Date</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- The loop of meeting minutes -->
                        <div class="row">
                        <div class="col-12 col-sm-6">
                        <lable>Search by Title</lable>
                        <input class="form-control" placeholder="Enter Title" id="titleName" />
                        </div>
                        <div class="col-12 col-sm-6">
                        <lable>Search by Date</lable>
                        <input class="form-control" type="date" placeholder="Select date" id="minuteDate" />
                        </div>
                        <div class="col-12 col-sm-12 mt-2 text-end">
                        <button class="btn buttonStyle w-25" data-bs-dismiss="modal" id="searchButton"><i class="fa-sharp fa-solid fa-search"></i> <strong>Search</strong></button>
                        <button class="btn buttonStyle w-25" data-bs-dismiss="modal"><i class="fa-sharp fa-solid fa-cancel"></i> <strong>Cancel</strong></button>
                        </div>
                        
                    </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="modal fade" id="mnyModal" tabindex="-1" aria-labelledby="mnyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="mnyModalLabel">Search by Month & Year</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- The loop of meeting minutes -->
                        <div class="row">
                        <div class="col-12 col-sm-6">
                <label>Search by Month</label>
                <select class="form-control" id="monthList">
                        <option value="0">Select</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                </select>
                
                </div>
                <div class="col-12 col-sm-6">
                    <label>Search by Year</label>
                <select class="form-control" id="yearList">
                        <option value="0">Select</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                        <option value="2026">2026</option>
                        <option value="2027">2027</option>
                        <option value="2028">2028</option>
                        <option value="2029">2029</option>
                        <option value="2030">2030</option>
                </select>
                
                </div>
                <div class="col-12 col-sm-12 mt-2 text-end">
                <button class="btn buttonStyle w-25" data-bs-dismiss="modal" id="search2Button"><i class="fa-sharp fa-solid fa-search"></i> <strong>Search</strong></button>
                <button class="btn buttonStyle w-25" data-bs-dismiss="modal"><i class="fa-sharp fa-solid fa-cancel"></i> <strong>Cancel</strong></button>
                </div>
        </div>
                        
                    </div>
                    </div>

                </div>
            </div>
        </div>   
                </div>  
            </div>
        </div>
        <hr />
        <div class="container">
            <div class="row">
            <div id="feedback">
                
                </div>  
                <?php
                    if($_SESSION["role"]!="admin"){
                        ?>
                            <div class="col-12 col-sm-12">
                                <a href="createMinutes.php">
                                <button class="btn buttonStyle float-end"><strong><i class="fa-sharp fa-solid fa-plus">&nbsp;</i>Create</strong></button>
                                </a>
                            </div>
                            <?php
                    }
                ?>
                
            </div>
        </div>

        <div class="container">
            <div class="text-center">
            <!-- <img id="loadingimage2" height="50px" src="img/preload.gif" /> -->
        </div>
            <div id="minutesDiv" class="row" style="padding:8px">
            
            </div>
            
        </div>
        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Share
    </button> -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content" style="background-color:e7e7e7">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Share</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div id="usersDiv" class="modal-body">
                        <!-- The loop of meeting minutes -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal">
                            OK
                        </button>

                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="container">
        <div class="row">
            <div class="row">
                <div class="col-6 col-sm-3 carda mt-2">1.col-6 .col-sm</div>
                <div class="col-6 col-sm-3 carda">2.col-6 .col-sm</div>

                 Force next columns to break to new line
                <div class="w-100"></div> 

                <div class="col-6 col-sm-3 carda">3.col-6 .col-sm</div>
                <div class="col-6 col-sm-3 carda">4.col-6 .col-sm</div>
                <i class="bi bi-share">hello</i>
            </div>

        </div>
        <button onclick="checkRedirect(101)"> Redirect</button>
        <audio autoplay controls src="//static.base64.guru/uploads/media/beep.mp3">
            The “audio” tag is not supported by your browser. Click [here] to download the sound file.
        </audio>
        <audio autoplay controls src="data:audio/mpeg;base64,/+MYxAAEaAIEeUAQAgBgNgP/////KQQ/////Lvrg+lcWYHgtjadzsbTq+yREu495tq9c6v/7vt/of7mna9v6/btUnU17Jun9/+MYxCkT26KW+YGBAj9v6vUh+zab//v/96C3/pu6H+pv//r/ycIIP4pcWWTRBBBAMXgNdbRaABQAAABRWKwgjQVX0ECmrb///+MYxBQSM0sWWYI4A++Z/////////////0rOZ3MP//7H44QEgxgdvRVMXHZseL//540B4JAvMPEgaA4/0nHjxLhRgAoAYAgA/+MYxAYIAAJfGYEQAMAJAIAQMAwX936/q/tWtv/2f/+v//6v/+7qTEFNRTMuOTkuNVVVVVVVVVVVVVVVVVVVVVVVVVVVVVVV">
            The “audio” tag is not supported by your browser. Click [here] to download the sound file.
        </audio>
        <button class="btn">Record</button>
    </div> -->
    </body>

</html>