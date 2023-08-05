<?php
$target_dir = "uploads/";
$file = $_POST["fileToUpload"];
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
//$target_file = $target_dir . ;

//move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
echo "The file is" . $file;
echo "<br />";
echo "The target is" . $target_file;
?>

<html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="stylesheet" href="css/styleFile.css" type="text/css">
        <link rel="stylesheet" href="bootstrap5/bootstrap-icons-1.10.2/bootstrap-icons.css" type="text/css">
        <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
        <script>
            function show() {
                var check = document.getElementById("fileToUpload");

                alert("seee: " + check.name);
            }
            function checkIt() {
                var checkValue = document.getElementById("fileToUploads").value;
                alert("pk: " + checkValue);
                if (checkValue == "") {
                    alert("Please select an image");
                    return false;
                }
                // else {
                //     return true:
                // }
            }
            $(document).ready(function () {
                $('#but_upload').click(function () {
                    var maform = document.getElementById("myform");
                    var formData = new FormData(maform);
                    var name = $('#FName').val();
                    if (name == "") {
                        $('#FName').css({
                            'border-color': 'red'
                        });
                    }
                    else {
                        $.ajax({
                            type: 'POST',
                            url: "testUploadFile.php",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                console.log("success");
                                alert(response);
                                //console.log(data);
                            },
                            error: function (response) {
                                console.log("error");
                                console.log(response);
                            }
                        });
                    }

                    //alert("yahooooo: " + formData);
                })
                /*$('#myform').on('submit', (function (e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    var name = $('#FName').val();
                    if (name == "") {
                        $('#FName').css({
                            'border-color': 'red'
                        });
                    }
                    else {

                        $.ajax({
                            type: 'POST',
                            url: "testUploadFile.php",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (response) {
                                console.log("success");
                                alert(response);
                                //console.log(data);
                            },
                            error: function (response) {
                                console.log("error");
                                console.log(response);
                            }
                        });
                    }



                }));*/

                $("#ImageBrowse").on("change", function () {
                    $("#imageUploadForm").submit();
                });
            });
        </script>
    </head>

    <body>
        <form action="" method="post" enctype="multipart/form-data">
            Select image to upload:
            <input type="file" name="fileToUpload" id="fileToUploads">
            <input type="submit" onclick="checkIt()" value="Upload Image" name="submit">
        </form>
        <br />
        <br />
        <h1>Testing</h1>
        <form method="post" enctype="multipart/form-data" id="myform">
            <div class='preview'>
                <img src="" id="img" width="100" height="100">
            </div>
            <div>
                <input type="text" id="FName" name="FName" />
                <input type="file" id="file" name="file" />
                <input type="button" class="button" value="Upload" id="but_upload">
            </div>
        </form>
        <!-- <button onclick="show()">see</button> -->
        <button id="khalidbutton">ok</button>
    </body>

</html>