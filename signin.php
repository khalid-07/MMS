<?php
session_start();
if (isset($_SESSION["username"])) {
    header("location:homepage.php");
}
//echo "Login shogin";
/*if (isset($_POST['passProcess'])) {
    echo "halahalahala";
    $requestProcess = trim($_POST['passProcess']);
    if ($requestProcess == "signinValue") {
        sleep(2);
        $email = $_POST['passEmailValue'];
        $password = $_POST['passPasswordValue'];
        echo $email . " : " . $password;
    }
};*/
?>
<!DOCTYPE html>
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
        <script type="text/javascript">
            function checkField(field) {
                $('#' + field).css({
                    'border-color': ''
                });
            }
            $(document).ready(function () {
                $("#loadingimage2").hide();
                $('#txtEmail').focus();


                $('#btnSignin').click(function () {
                    //alert("halahala");
                    var emailValue = $('#txtEmail').val(),
                        passwordValue = $('#txtPassword').val(),
                        requestProcess = "signinValue";
                    //alert("" + emailValue + " : " + passwordValue);
                    if (emailValue == "" || passwordValue == "") {
                        $('#feedback').removeClass().addClass('noticeui noticeui-error').html('Email and Password required').show().css({
                            'padding': '4px',
                            'width': 'auto',
                            'text-align': 'center',
                            'display': 'inline-block'
                        });
                        if (emailValue == "") {
                            $('#txtEmail').css({
                                'border-color': 'red'
                            });
                        }
                        if (passwordValue == "") {
                            $('#txtPassword').css({
                                'border-color': 'red'
                            });
                        }
                        $('#txtEmail').focus();
                        return false;
                    } else {
                        //alert(emailValue + " : " + passwordValue);
                        //ajax

                        $("#feedback").removeClass().html("");
                        $("#feedback").show();
                        $("#loadingimage2").show();
                        $.ajax({
                            cache: false,
                            type: "post",
                            url: "signincheck.php",
                            data: {
                                passEmailValue: emailValue,
                                passPasswordValue: passwordValue,
                                passProcess: requestProcess
                            },
                            success: function (response) {
                                //alert(data);
                                //alert(response);
                                if (response.indexOf('successfull') > -1) {
                                    $("#loadingimage2").hide();
                                    window.location.replace("dashboard.php");
                                    return false;
                                } else if (response.indexOf('Invalid') > -1) {
                                    $("#loadingimage2").hide();
                                    $("#feedback").removeClass().addClass('noticeui noticeui-error').html('Invalid username or password').show().css({
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
                    }

                    return false;
                });
            });
        </script>
    </head>

    <body>
        <?php include "navbar.php" ?>
        <div class="container" id="maindiv">
            <div class="child card row col-12 col-sm-4 mt-5" style="padding: 0px 30px 10px 30px">
                <h1 style="text-align: center;color:#093c59">Sign In</h1>

                <div id="feedbackDiv">

                    <div id="feedback">

                    </div><span><img id="loadingimage2" height="50px" src="img/preload.gif" /></span>

                </div>


                <!-- STARTING OF THE FORM -->

                <form enctype="multipart/form-data">


                    <div class="form-group col-lg-12 mb-2">

                        <strong>
                            <label id="lblEmail" Text="Email">Email</label>&nbsp;<strong style="color:red">*</strong>
                        </strong>
                        <label id="lblEmailError" type="email"></label>
                        <input onkeyup="checkField('txtEmail')" class="form-control" type="email" name="email"
                            PlaceHolder="Enter Email" oninvalid="this.setCustomValidity('Please Enter valid email')"
                            oninput="this.setCustomValidity('')" id="txtEmail" />

                    </div>
                    <div class="form-group col-lg-12">
                        <strong>
                            <label id="lblPass">Password</label>&nbsp;<strong style="color:red">*</strong>
                        </strong>
                        <span class="label-info"></span>
                        <label id="lblPasswordError"></label>

                        <input onkeyup="checkField('txtPassword')" type="password" class="form-control"
                            PlaceHolder="Enter Password" name="password" id="txtPassword" />
                        <label id="lblPasswordLengthError" style="height:5px;"></label>
                    </div>
                    <div>

                        <div class="form-group col-12 col-sm-12 text-center">

                            <!--<button id="btnSignins" name="submitButtons" class="btn btn-primary btn-block">Sign In</button>-->
                            <input type="button" id="btnSignin" name="submitButton" value="SIGN IN"
                                class="btn btn-block w-50 buttonStyle" />

                        </div>
                        <div class="form-group col-lg-12 col-md-12" style="text-align: center">
                            <label ID="lblSignin">Don't have an account?</label><br />
                            <a href="signup.php">Sign Upss</a>
                        </div>
                    </div>
                </form>
            </div>

            <!--here-->

        </div>
    </body>

</html>