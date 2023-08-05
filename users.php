<?php
session_start();
if(isset($_SESSION["userProfile"])){
    unset($_SESSION["userProfile"]);
}
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
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
        <title>Users</title>
        <script>
            function detailsPage(id) {
                var action = "userProfile";
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
                        window.location.href = "profile.php";

                    }
                });
            }
            function changeStatus(id)
            {
                var x = $('#' + id)[0].checked;
                if (x) {
                    //alert("check");
                    var action = "ActiveUser";
                $.ajax({
                    type: "post",
                    cache: false,
                    url: "useraccess.php",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        //alert(data);
                        //window.location.href = "profile.php";

                    }
                });
                }else{
                    var action = "DeavtiveUser";
                    $.ajax({
                    type: "post",
                    cache: false,
                    url: "useraccess.php",
                    data: {
                        action: action,
                        id: id
                    },
                    success: function (data) {
                        //alert(data);
                        //window.location.href = "profile.php";

                    }
                });
                    //alert("uncheck");
                }
                var action = "ActiveUser";
                
                //alert("id is: "+id);
            }
             $(document).ready(function () {
                loadUsers();
                function loadUsers() {
                    var action = "fetchallUsers";
                    $.ajax({
                        url: "getMeetingMinutes.php",
                        method: "POST",
                        data: {
                            action: action
                        },
                        success: function (data) {
                            $("#UsersDiv").html(data);
                        }
                    })
                }
             })
        </script>
    </head>
    <body>
    <div id="nav-placeholder3">
            <?php
            include "navbar.php";
            ?>
        </div>
        <div class="container">
<h1 class="text-center"> Users </h1>
        
        <div id="UsersDiv" class="row" style="padding:8px">
            
        </div>
            </div>
    </body>
</html>