<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("location:signin.php");
}
if (isset($_SESSION["detailsId"])) {
    unset($_SESSION["detailsId"]);
}
if (isset($_SESSION["editId"])) {
    unset($_SESSION["editId"]);
}
if($_SESSION["role"]=="admin"){
    if(!isset($_SESSION["userProfile"])){
        header("location:users.php");
    }
}

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
            function enableField() {
                $('.oneType').prop('disabled', false);
                $('#editButton').hide();
                $('#cancelButton').show();
                $('#saveButton').show();
//                $('#cancelButton').css("display", "inline");
//                $('#saveButton').css("display", "inline");
            }
            function disableField() {
                $('.oneType').prop('disabled', true);
                $('#editButton').show();
                $('#cancelButton').hide();
                $('#saveButton').hide();
            }
            function showKhalid(){
                //alert("dfhlsadhflkjd");
            }
            function loadUserData(){
                var action = "fetchUser";
                    $.ajax({
                        url: "getMeetingMinutes.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function (data) {
                            //alert("title: " + data)
                            
                            $("#userDiv").html(data);
                        }
                    })
            }
            function submitForm(){
                var signupForm = document.getElementById("myform");
                    var formData = new FormData(signupForm);
                    //alert("hala hal");
                    var fname = document.getElementById("txtFName").value;
                    var lname = document.getElementById("txtLName").value;
                    var phone = document.getElementById("txtPhone").value;
                    var email = $('#txtEmail').val();
                    var filename = $('#fileUpload').val();
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
                    }
                    if (lname == "") {
                        //document.getElementById("lblLnameError").innerHTML = "*Last Name Required*"
                        //document.getElementById("lblLnameError").style.color = "red";
                        //return false;
                        $('#txtLName').css({
                            'border-color': 'red'
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
                    if (phone == "") {
                        $('#txtPhone').css({
                            'border-color': 'red'
                        });
                    }
                    if (phone != "") {
                        var numberFormat = /^[0-9\s]*$/;
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
                    }
                    if ((filename != "" && file > 5000000) || (filename != "" && extensionCheck != 0) || fname == "" || lname == "" || phone == "") {
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
                    else{
                        $.ajax({
                            cache: false,
                            type: "post",
                            url: "editProfile.php",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                            //alert(response);
                            if (response.indexOf('Success') > -1) {
                                    //$("#loadingimage2").hide();
                                    $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Edited Successfully').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('fast');
                                        loadUserData();
                                    }, 2000);
                                }else if (response.indexOf('Failed') > -1) {
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Failed to Edit').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('slow');
                                    }, 3000);
                                    //window.location.href("signin.php");
                                }else{
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Problem encountered').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });

                                }

                        }

                    });

                    }
            }
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
                if (val == "txtPhone") {
                    if ($('#' + val).val() == "") {
                        $('#' + val).css({
                            'border-color': 'red'
                        });
                    }
                    else {
                        var numberFormat = /^[0-9\s]*$/;
                        if ($('#' + val).val().match(numberFormat)) {
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
                        $('#' + val).css({
                            'border-color': ''
                        });
                    }
                    //alert("value: " + val)
                }
            }
            $(document).ready(function () {
                $('#cancelButton').hide();
                $('#saveButton').hide();
                $('#khalid').hide();
                loadUserProfile();
                loadAdminUserProfile();
                function loadUserProfile() {
                   
                    //$('#editButton').hide();
                    var action = "fetchUser";
                    $.ajax({
                        url: "getMeetingMinutes.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function (data) {
                            //alert("title: " + data)
                            
                            $("#userDiv").html(data);
                        }
                    })
                }
                function loadAdminUserProfile() {
                   
                   //$('#editButton').hide();
                   var action = "fetchUserProfile";
                   $.ajax({
                       url: "getMeetingMinutes.php",
                       method: "POST",
                       data: {
                           action: action
                       },
                       success: function (data) {
                           //alert("title: " + data)
                           
                           $("#userProfileDiv").html(data);
                       }
                   })
               }
                
                $('#editButton').click(function () {

                });
                $('#khalid').click(function(){
                    //alert("kahldiidid");
                })
                $('#saveButton').click(function () {
                    var signupForm = document.getElementById("myform");
                    var formData = new FormData(signupForm);
                    //alert("hala hal");
                    var fname = document.getElementById("txtFName").value;
                    var lname = document.getElementById("txtLName").value;
                    var phone = document.getElementById("txtPhone").value;
                    var email = $('#txtEmail').val();
                    var filename = $('#fileUpload').val();
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
                    }
                    if (lname == "") {
                        //document.getElementById("lblLnameError").innerHTML = "*Last Name Required*"
                        //document.getElementById("lblLnameError").style.color = "red";
                        //return false;
                        $('#txtLName').css({
                            'border-color': 'red'
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
                    if (phone == "") {
                        $('#txtPhone').css({
                            'border-color': 'red'
                        });
                    }
                    if (phone != "") {
                        var numberFormat = /^[0-9\s]*$/;
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
                    }
                    if ((filename != "" && file > 5000000) || (filename != "" && extensionCheck != 0) || fname == "" || lname == "" || phone == "") {
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
                    else{
                        $.ajax({
                            cache: false,
                            type: "post",
                            url: "editProfile.php",
                            data: formData,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                            //alert(response);
                            if (response.indexOf('Success') > -1) {
                                    //$("#loadingimage2").hide();
                                    $("#feedback").removeClass().addClass('noticeui noticeui-success').html('Edited Successfully').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('slow');
                                    }, 2000);
                                }else if (response.indexOf('Failed') > -1) {
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Failed to Edit').show().css({
                                        'padding': '4px',
                                        'width': 'auto',
                                        'text-align': 'center',
                                        'display': 'inline-block'
                                    });
                                    setTimeout(function () {
                                        $('#feedback').fadeOut('slow');
                                    }, 3000);
                                    //window.location.href("signin.php");
                                }else{
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Problem encountered').show().css({
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
                });
           
            
            
        
        </script>
    </head>

    <body>
        <?php
        include "navbar.php";
        ?>
        <div class="container card col-11 col-sm-4">
            <div class="child mt-3">
                <?php 
                if($_SESSION["role"]!="admin"){
                    ?>
                    <div id="userDiv">
                
                    </div>
                    <?php
                }else{
                    ?>
                    <div id="userProfileDiv">
                
                    </div>
                    <?php
                }
                ?>
                
                <div class="text-center mb-3">
                <!-- <button class="btn w-50 buttonStyle" id="editButton" onclick="enableField()">Edit profile</button> -->
                    
</div>
            </div>
        </div>
<div>
</div>

    </body>

</html>