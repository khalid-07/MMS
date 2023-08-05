<?php
include "database.php";
session_start();
$fname = "";
$emailerror = "";
/*
if (isset($_POST['submitButton'])) {
    sleep(1);
    echo "LOGIN";
    $email = ($_POST["email"]);
    $checkQuery = "SELECT user_email FROM UserTable where user_email = '$email'";
    $check_email = mysqli_query($conn, $checkQuery);
    if (mysqli_num_rows($check_email) > 0) {
        echo ('Email Already exists');
        echo mysqli_num_rows($check_email);
        echo "<script>
        $('#loadingimage2').hide();
        </script>";
        $emailerror = "Email Aready Exist.";
    } else {
        //echo ("you can register");
        $fname = ($_POST["fname"]);
        $lname = ($_POST["lname"]);
        $email = ($_POST["email"]);
        $phone = ($_POST["phone"]);
        $password = ($_POST["password"]);
        date_default_timezone_set("Asia/Qatar");
        $date = date("Y/m/d H:i:s");
        echo $date;
        $findQuery = "";
        $query = "INSERT into tblUsers(user_firstname,user_lastname,user_email,user_password,user_phone,user_dateRegister) values('$fname','$lname','$email','$password','$phone','$date')";
        //$result = $conn->query($query);
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));

        //echo $result;
        echo "<br>";

        if ($result) {
            echo "Form Submitted";
        } else {
            echo "Problem submitting the form";
        }
    }
    /* $fname = ($_POST["fname"]);
    $lname = ($_POST["lname"]);
    $email = ($_POST["email"]);
    $phone = ($_POST["phone"]);
    $password = ($_POST["password"]);
    $date = date('Y/m/d H:i:s');
    $findQuery = "";
    $query = "INSERT into testuser(firstname,lastname,email,phone,lpassword,dateRegister) values('$fname','$lname','$email','$phone','$password','$date')";
    //$result = $conn->query($query);
    $result = mysqli_query($conn, $query); //or die(mysqli_error());
    if ($result) {
    echo "Form Submitted";
    } else {
    echo "Problem submitting the form";
    }
    
    $conn->close();
}*/


?>
<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/styleFile.css" type="text/css">
        <link rel="stylesheet" href="bootstrap5/bootstrap-icons-1.10.2/bootstrap-icons.css" type="text/css">
        <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
        <!-- <script type="text/javascript" src="js/jquery.form.js"></script> -->
        <script src="bootstrap5/js/bootstrap.min.js" type="text/javascript"></script>
        <link href="fontawesome-free-6.2.1-web/css/fontawesome.css" rel="stylesheet">
        <link href="fontawesome-free-6.2.1-web/css/brands.css" rel="stylesheet">
        <link href="fontawesome-free-6.2.1-web/css/solid.css" rel="stylesheet">
        <script>
            $(function () {
                $("#nav-placeholder").load("navbar.html");

            });
            function checkValue(val) {
                if (val == "txtFName") {
                    if ($('#' + val).val() == "") {
                        $('#' + val).css({
                            'border-color': 'red'
                        });
                    }
                    else {
                        $('#' + val).css({
                            'border-color': ''
                        });
                    }

                    //alert("value: " + val);
                }
                if (val == "txtLName") {
                    if ($('#' + val).val() == "") {
                        $('#' + val).css({
                            'border-color': 'red'
                        });
                    }
                    else {
                        $('#' + val).css({
                            'border-color': ''
                        });
                    }
                    //alert("value: " + val)
                }
                if (val == "txtEmail") {
                    if ($('#' + val).val() == "") {
                        $('#' + val).css({
                            'border-color': 'red'
                        });
                    }
                    else {
                        $('#' + val).css({
                            'border-color': ''
                        });
                    }
                    //alert("value: " + val)
                }
                if (val == "txtPhone") {
                    if ($('#' + val).val() == "") {
                        $('#' + val).css({
                            'border-color': 'red'
                        });
                    }
                    else {
                        $('#' + val).css({
                            'border-color': ''
                        });
                    }
                    //alert("value: " + val)
                }
            }
            function showFile() {
                //var fu1 = document.getElementById("fileUpload");
                //alert("You selected " + fu1.value);
                //alert($('#fileUpload').val().split("\\").pop());
            }

            $(document).ready(function () {
                $('#testField').val('');
                $('#loadingimage2').hide();
                //$('#errormessage').removeClass();

                //$('#btnSignup').prop("disabled", false);

                $('#btnCheck').click(function () {
                    //alert($('#testField').val());
                })
                $('#btnSignup').click(function () {
                    $('#testField').val('testing');
                    //e.preventDefault();
                    var result = false;
                    //let formData = new formData();
                    //formData.append("file", fileUpload.files[0]);
                    var fname = document.getElementById("txtFName").value;
                    var lname = document.getElementById("txtLName").value;
                    var phone = document.getElementById("txtPhone").value;
                    var email = $('#txtEmail').val();
                    var password = $('#txtPassword').val();
                    var confirmPassword = $('#txtCPassword').val();
                    var cPasswordError = $('#lblCPasswordLengthError').val();
                    var uploadFile = $('#fileUpload').val().split("\\").pop();
                    //var thisForm = $('#myForm').val();
                    //let thisform = document.getElementById("myForm");
                    //let fd = new FormData(thisform);
                    // var form = $('#myform').val();
                    //var data = new FormData(document.getElementById("myform"));
                    //var thisform = new FormData(this);
                    //var uploadFile = $('#fileUpload')[0].files[0];
                    //var fileName = uploadFile.name;
                    //alert("uu: "fileName);
                    //var uploadedFile = $('#fileUpload').html();
                    var signupForm = document.getElementById("myform");
                    var formData = new FormData(signupForm);
                    //var uploadedFile = document.getElementById("fileUpload").name
                    //var form_data = new FormData();
                    //form_data.append("fileUpload", uploadedFile);
                    //var uploadFile = $('#fileUpload').files[0].name;
                    //var uploadFile = document.getElementById("fileUpload").files[0].name;

                    var requestProcess = "signup";
                    $('#message').text(cPasswordError);
                    var filename = $('#fileUpload').val();

                    //alert("file size: " + filename);
                    if (filename != "") {
                        var extensionCheck = 0;
                        var fileExtension = ["jpg", "jpeg", "png"];
                        var file = $("#fileUpload")[0].files[0].size;
                        var extension = filename.substring(filename.lastIndexOf('.') + 1);
                        var newExtension = jQuery.trim(extension);
                        //alert("extension:" + extension + "pop");
                        if (fileExtension.indexOf(newExtension) < 0) {
                            $('#lblFileTypeError').html('*wrong file types*').css({
                                'color': 'red'
                            });
                            extensionCheck = 1;
                            //alert("new: " + newExtension);
                            //alert("ext: " + extensionCheck + " : " + newExtension);
                        }
                        // if (newExtension != 'jpg') {
                        //     $('#lblFileTypeError').html('*wrong file types*').css({
                        //         'color': 'red'
                        //     });
                        // }
                        // else if (newExtension != 'jpeg') {
                        //     $('#lblFileTypeError').html('*wrong file types*').css({
                        //         'color': 'red'
                        //     });
                        // }
                        // else if (newExtension != 'png') {
                        //     $('#lblFileTypeError').html('*wrong file types*').css({
                        //         'color': 'red'
                        //     });
                        // }
                        else {
                            extensionCheck = 0;
                            $('#lblFileTypeError').html('').css({
                                'color': ''
                            });
                            if (file > 5000000) {
                                $('#fileUpload').css({
                                    'border-color': 'red'
                                });
                                $('#lblFileError').html('*Max 5MB allowed*').css({
                                    'color': 'red'
                                });
                            }
                            else {
                                $('#lblFileError').html('').css({
                                    'color': ''
                                });
                            }
                        }

                    }
                    if (filename == "") {
                        $('#lblFileError').html('').css({
                            'color': ''
                        });
                        $('#lblFileTypeError').html('').css({
                            'color': ''
                        });
                    }
                    if (fname == "") {
                        //alert(fname);
                        $('#txtFName').css({
                            'border-color': 'red'
                        });
                        $('#lblFnameError').html('').css({
                                'color': ''
                            });
                    }
                    if (fname != "") {
                        $('#txtFName').css({
                            'border-color': ''
                        });
                        if (fname.match(/^[A-Za-z\s]*$/)) {
                            $('#txtFName').css({
                                'border-color': ''
                            });
                            $('#lblFnameError').html('').css({
                                'color': ''
                            });
                            //alert("Yes alpha");
                        }
                        else {
                            $('#txtFName').css({
                                'border-color': 'red'
                            });
                            //alert("no alpha")
                            $('#lblFnameError').html('Only alphabets').css({
                                'color': 'red'
                            });
                        }
                        //document.getElementById("lblFnameError").innerHTML = "";
                        //alert("khalid");
                        //return false;
                    }

                    if (lname == "") {
                        //document.getElementById("lblLnameError").innerHTML = "*Last Name Required*"
                        //document.getElementById("lblLnameError").style.color = "red";
                        //return false;
                        $('#txtLName').css({
                            'border-color': 'red'
                        });
                        $('#lblLnameError').html('').css({
                                'color': ''
                            });
                    }
                    if (lname != "") {
                        //document.getElementById("lblLnameError").innerHTML = "";
                        //alert("khalid202");
                        // $('#txtLName').css({
                        //     'border-color': ''
                        // });
                        if (lname.match(/^[A-Za-z\s]*$/)) {
                            $('#txtLName').css({
                                'border-color': ''
                            });
                            $('#lblLnameError').html('').css({
                                'color': ''
                            });
                            //alert("Yes alpha");
                        }
                        else {
                            $('#txtLName').css({
                                'border-color': 'red'
                            });
                            //alert("no alpha")
                            $('#lblLnameError').html('Only alphabets').css({
                                'color': 'red'
                            });
                        }
                    }
                    if (email == "") {

                        $('#txtEmail').css({
                            'border-color': 'red'
                        });
                        $('#lblEmailError').html('').css({
                                'color': ''
                            });
                    }
                    if (email != "") {
                        //alert("yess email");
                        var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                        $('#txtEmail').css({
                            'border-color': ''
                        });
                        if (email.match(mailformat)) {
                            $('#txtEmail').css({
                                'border-color': ''
                            });
                            $('#lblEmailError').html('').css({
                                'color': ''
                            });
                            //alert("Yes email");
                        }
                        else {
                            $('#txtEmail').css({
                                'border-color': 'red'
                            });
                            //alert("no alpha")
                            $('#lblEmailError').html('Invalid Address').css({
                                'color': 'red'
                            });
                        }
                        //$('#lblEmailError').text("");
                    }
                    if (password == "") {
                        $('#txtPassword').css({
                            'border-color': 'red'
                        });
                    }
                    if (password != "") {
                        $('#txtPassword').css({
                            'border-color': ''
                        });
                    }
                    if (confirmPassword == "") {
                        $('#txtCPassword').css({
                            'border-color': 'red'
                        });
                    }
                    if (confirmPassword != "") {
                        $('#txtCPassword').css({
                            'border-color': ''
                        });

                    }
                    if (phone == "") {
                        $('#txtPhone').css({
                            'border-color': 'red'
                        });
                        $('#lblPhoneError').html('Invalid Phone').css({
                                'color': 'red'
                            });

                        //document.getElementById("lblPhoneError").innerHTML = "*Phone Required*"
                        //document.getElementById("lblPhoneError").style.color = "red";
                        //return false;
                    }
                    if (phone != "") {
                        var numberFormat = /^\+?[0-9].{5,}$/;
                        if (phone.match(numberFormat)) {
                            $('#lblPhoneError').html('').css({
                                'color': ''
                            });
                            $('#txtPhone').css({
                                'border-color': ''
                            });
                        }
                        else {
                            $('#lblPhoneError').html('Invalid Phone').css({
                                'color': 'red'
                            });
                            $('#txtPhone').css({
                                'border-color': 'red'
                            });
                        }
                        //document.getElementById("lblPhoneError").innerHTML = "";
                    }
                    if (confirmPassword != "" && password != confirmPassword) {
                        $('#lblCPasswordError').text("Password is not matching").css({
                            'color': 'red'
                        });
                        $('#txtCPassword').css({
                            'border-color': 'red'
                        });
                    }
                    if (confirmPassword != "" && password == confirmPassword) {
                        $('#lblCPasswordError').text("Password is matching").css({
                            'color': 'green'
                        });
                    }
                    if (password.length < 8 && password != "" && !password.match(/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z])(?=.{8})/)) {
                        $('#lblPasswordError').text("Password must be 8 characters long").css({
                            'color': 'red'
                        });
                        $('#txtPassword').css({
                            'border-color': 'red'
                        });
                    }
                    /* if (!password.match(/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])(?=.*[A-Za-z\d@$!%*?&])(?=.*{8,})/)) {
                         $('#lblPasswordError').text("Password must be strong").css({
                             'color': 'red'
                         });
                     }*/
                    if (!password.match(/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z])(?=.{8})/) && password != "" && password.length >= 8) {
                        $('#lblPasswordError').text("Password must be strong").css({
                            'color': 'red'
                        });
                        $('#txtPassword').css({
                            'border-color': 'red'
                        });
                    }
                    if (password != "" && password.length >= 8 && password.match(/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z])(?=.{8})/)) {
                        $('#lblPasswordError').text("");
                        $('#txtPassword').css({
                            'border-color': ''
                        });
                    }
                    //if($('#lblCPasswordError').val()!="")
                    if ((filename != "" && file > 5000000) || (filename != "" && extensionCheck != 0) || fname == "" || 
                    lname == "" || phone == "" || email == "" || password == "") {
                        $('#feedback').removeClass().addClass('noticeui noticeui-error').html('Please fill all required fields!').show().css({
                            'padding': '4px',
                            'width': 'auto',
                            'text-align': 'center',
                            'display': 'inline-block'
                        });
                        $("html, body").animate({
                            scrollTop: 0
                        }, "fast");
                        return false;
                    }
                    if(!fname.match(/^[A-Za-z\s]*$/) || !email.match(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/) || 
                    !lname.match(/^[A-Za-z\s]*$/) || !phone.match(/^\+?[0-9].{5,}$/) || 
                    password != confirmPassword || password.length < 8 || 
                    !password.match(/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z])(?=.{8})/)){
                        $('#feedback').removeClass().addClass('noticeui noticeui-error').html('Please enter valid data!').show().css({
                            'padding': '4px',
                            'width': 'auto',
                            'text-align': 'center',
                            'display': 'inline-block'
                        });
                        $("html, body").animate({
                            scrollTop: 0
                        }, "fast");
                        return false;
                    }
                    else {
                        //alert("yalla");
                        //showwait();
                        $("#feedback").removeClass().html("");
                        $("#feedback").show();
                        $('#loadingimage2').show();
                        $.ajax({
                            cache: false,
                            type: "post",
                            url: "signupCheck.php",
                            data: formData,
                            contentType: false,
                            processData: false,
                            // data: {
                            //     passFnameValue: fname,
                            //     passLnameValue: lname,
                            //     passEmailValue: email,
                            //     passPhoneValue: phone,
                            //     passPasswordValue: password,
                            //     passFileValue: uploadFile,
                            //     passFile: uploadedFile,
                            //     //passMyFile: form_data,
                            //     passProcess: requestProcess
                            // }
                            success: function (response) {
                                //alert(data);
                                //alert(response);
                                if (response.indexOf('already') > -1) {
                                    $("#loadingimage2").hide();
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Email already Exist.').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    $('#txtEmail').css({
                                        'border-color': 'red'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('slow');
                                    }, 3000);
                                } else if (response.indexOf('Success') > -1) {
                                    $("#loadingimage2").hide();
                                    $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Registration Successfull').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('slow');
                                        window.location.replace("signin.php");
                                    }, 2000);
                                }
                                else if (response.indexOf('photo') > -1) {
                                    $("#loadingimage2").hide();
                                    $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Registration Successfull').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('slow');
                                    }, 3000);
                                    //window.location.href("signin.php");
                                }
                                else {
                                    $("#loadingimage2").hide();
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Problem encountered').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                }

                                /*if (response.indexOf('successfull') > -1) {
                                    $("#loadingimage2").hide();
                                    window.location.replace("homepage.php");
                                    return false;
                                } else if (response.indexOf('Invalid') > -1) {
                                    $("#loadingimage2").hide();
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Invalid username or password').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
             
             
                                }
                                else if (response.indexOf('khalid') > -1) {
                                    $("#loadingimage2").hide();
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Yess Signup').show().css({
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
                        //return true;
                    }

                    //document.getElementById("message").innerHTML = fname;
                });

            });

            function signup() {

            }

            function checkpassword() {
                var pass = document.getElementById("txtPassword");
                var name = "khalid";
                /*if (pass != "") {
                    $('#lblPasswordError').text("");
                }
                /*if (pass.value.length < 8) {
                    $('#lblPasswordLengthError').text("•Minimum 8 characters are required*").css({
                        'color': 'red'
                    });
                } else {
                    $('#lblPasswordLengthError').text("");
                }*/
                var strengthbar = document.getElementById("strength");
                var strength = 0;
                var progesslabel = "";
                var color = "";
                var lblColor = "";
                if (pass.value.match(/[a-z]+/)) {
                    strength += 1;
                }
                if (pass.value.match(/[A-Z]+/)) {
                    strength += 1;
                }
                if (pass.value.match(/[0-9]+/)) {
                    strength += 1;
                }
                if (pass.value.match(/[$@#&!]+/)) {
                    strength += 1;
                }

                switch (strength) {
                    case 0:
                        strengthbar.value = 0;
                        progesslabel = ""
                        break;

                    case 1:
                        strengthbar.value = 20;
                        progesslabel = "<b>Weak</b>"
                        color = "red"
                        break;

                    case 2:
                        strengthbar.value = 40;
                        progesslabel = "<b>Med</b>"
                        color = "orange"
                        break;

                    case 3:
                        strengthbar.value = 60;
                        progesslabel = "<b>Good</b>"
                        color = "lightgreen"
                        break;

                    case 4:
                        strengthbar.value = 80;
                        progesslabel = "<b>Good</b>"
                        color = "lightgreen"
                        break;
                    case 5:
                        strengthbar.value = 100;
                        progesslabel = "<b>Strong</b>"
                        color = "green"
                        break;
                }
                if (pass.value.length >= 8 && pass.value.match(/(?=.*[A-Z])(?=.*[!@#$&*])(?=.*[0-9])(?=.*[a-z])(?=.{8})/)) {
                    strengthbar.value = 100;
                    progesslabel = "<b>Strong</b>"
                    color = "green"
                    $('#txtPassword').css({
                        'border-color': ''
                    });
                    $('#lblPasswordError').html('');

                }
                document.getElementById("progresslabel").innerHTML = progesslabel;
                document.getElementById("progresslabel").style.color = color;
            }

            function checkrepeatpassword() {
                if (document.getElementById("txtCPassword").value.length > 0) {
                    //$('#lblCPasswordError').text("");
                    if (
                        document.getElementById("txtPassword").value ==
                        document.getElementById("txtCPassword").value
                    ) {
                        document.getElementById("lblCPasswordError").style.color = "green";
                        document.getElementById("lblCPasswordError").innerHTML = "Password is matching";
                        $('#txtCPassword').css({
                            'border-color': ''
                        });
                    } else {
                        document.getElementById("lblCPasswordError").style.color = "red";
                        document.getElementById("lblCPasswordError").innerHTML = "Password is not matching";
                        return false;
                    }
                } else {
                    document.getElementById("lblCPasswordLengthError").innerHTML = "";
                }
            };
        </script>
        <style>
            .card {
                box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.4);
                border-radius: 5px;
                padding-left: 30px;
                margin-top: 10px;
            }

            .child {
                /*width: 70%;*/
                float: none;
                /*background-color: red;
            /* Center horizontally*/
                margin: 0 auto;
            }

            .messagediv {
                position: absolute;
                background-color: #00386c;
                color: white;
                height: 20%;
                width: 50%;
                top: 25%;
                left: 20%;
                right: 50%;
                opacity: 5.0;
                border-radius: 5px;
            }

            #feedbackDiv {
                text-align: center;
                width: 100%;
                height: 50px;
                margin: 0 auto;
                position: relative;
            }
        </style>
    </head>

    <body>
        <?php include "navbar.php" ?>
        <div class="container" id="maindiv" runat="server">
            <div class="child card col-12 col-sm-6 mt-5" style="padding: 0px 30px 30px 30px">
                <h1 style="text-align: center;color:#093c59" class="pt-2">Sign Up</h1>
                <label id="message"></label>
                <div id="feedbackDiv">
                    <div id="feedback">

                    </div>
                    <img id="loadingimage2" height="50px" src="img/preload.gif" />
                    <?php echo "<span id=\"errormessage\" style=\"color:red;font-weight:bolder\">" . $emailerror . "</span>"
                        ?>
                </div>
                <!-- STARTING OF THE FORM -->
                <input hidden id="signup" />
                <form class="row" id="myform" name="myform" enctype="multipart/form-data">

                    <div class="form-group col-12 col-sm-6">
                        <strong>
                            <label id="lblFname" for="txtFName">First Name</label></strong><span
                            class="requiredSymbol">*</span> &nbsp;
                        <label id="lblFnameError"></label>
                        <input class="form-control" name="fname" value="<?php echo $fname ?>"
                            PlaceHolder="Enter First Name" id="txtFName" onkeyup="checkValue('txtFName')"
                            oninvalid="this.setCustomValidity('Field ')" oninput="this.setCustomValidity('')">
                    </div>
                    <div class="form-group col-12 col-sm-6">

                        <strong>
                            <label id="lblLname" for="txtLName">Last Name</label><span class="requiredSymbol">*</span>
                            &nbsp;
                            <label id="lblLnameError"></label>
                        </strong>
                        <input class="form-control" PlaceHolder="Enter Last Name" onkeyup="checkValue('txtLName')"
                            name="lname" id="txtLName" />

                    </div>
                    <div class="form-group col-12 col-sm-6">

                        <strong>
                            <label id="lblEmail" Text="Email">Email</label></strong><span class="requiredSymbol">
                            *</span>
                        <label id="lblEmailError" type="email"></label>
                        <input class="form-control" type="email" name="email" onkeyup="checkValue('txtEmail')"
                            PlaceHolder="Enter Email" oninvalid="this.setCustomValidity('Please Enter valid email')"
                            oninput="this.setCustomValidity('')" id="txtEmail" />

                    </div>
                    <div class="form-group col-12 col-sm-6">
                        <strong>
                            <label id="lblPhone">Phone</label>
                        </strong><span class="requiredSymbol">*</span>
                        <label id="lblPhoneError"></label>
                        <input class="form-control" name="phone" onkeyup="checkValue('txtPhone')" PlaceHolder="Enter Phone" id="txtPhone" type="tel" />
                    </div>
                    <div class="form-group col-12 col-sm-6">

                        <strong>
                            <label id="lblPass">Passwords</label></strong>&nbsp;<span class="requiredSymbol">*</span>
                        <div id="tooltip">&#9432;
                            <span id="tooltiptext">
                                <strong>Password must be 8 characters long</strong><br />
                                Password must contain atleast

                                <li>One special character</li>
                                <li>One capital letter</li>
                                <li>One small letter</li>
                                <li>One number</li>

                            </span>
                        </div>
                        <span class="label-info"></span>


                        <input onkeyup="checkpassword()" class="form-control" type="password" PlaceHolder="Enter Password"
                            name="password" id="txtPassword" />
                        <label id="lblPasswordError"></label>
                        <progress max="100" value="0" id="strength"></progress>&nbsp;&nbsp;<span
                            id="progresslabel"></span><br />

                        <label id="lblPasswordLengthError" style="height:5px;"></label>
                    </div>

                    <div class="form-group col-12 col-sm-6">

                        <strong>
                            <label id="lblCPass">Confirm Password</label></strong>&nbsp;<span
                            class="requiredSymbol">*</span>

                        <input onkeyup="checkrepeatpassword()" class="form-control" id="txtCPassword" type="password"
                            PlaceHolder="Enter to Confirm" />
                        <label id="lblCPasswordError"></label>
                        <label id="lblCPasswordLengthError" style="height:5px;"></label>

                    </div>
                    <div class="form-group col-12 col-sm-6">

                        <strong>
                            <label>Upload Image</label>
                        </strong>
                        <br />
                        <strong><small><label class="text-warning">(Only jpg, jpeg and png
                                    allowed)</label></small></strong>

                        <input type="file" name="fileUpload" id="fileUpload" />
                        <label id="lblFileError"></label>
                        <label id="lblFileTypeError"></label>

                    </div>
                    <div class="row">

                        <div class="form-group col-12 col-sm-12 mt-4 text-center">
                            <!-- <input name="submitButton" id="btnSignup" type="button" value="PRESS" />
                            <input name="checkFieldButton" onclick="showHidden()" id="btnCheck" type="button"
                                value="Check" /> -->

                            <input id="testField" type="text" hidden name="testInput" />
                            <button type="button" id="btnSignup" name="submitButton"
                                class="btn btn-block buttonStyle w-50 mb-2">Sign
                                Up</button>


                        </div>
                        <div class="form-group col-sm-12" style="text-align: center">
                            <strong><label ID="lblSignin">Already have an account?</label></strong><br />
                            <a href="signin.php">Sign In</a>
                        </div>
                </form>
            </div>

        </div>
        <!--here-->
    </body>

</html>