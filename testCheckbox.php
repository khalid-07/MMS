<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styleFile.css" type="text/css">
    <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        function checkChange(i) {
            alert("yesss: " + i)
            alert("yalla")
            var x = $('#' + i)[0].checked;
            if (x) {
                alert("Its been checked: " + i);
                var action = "grant";
                $.ajax({
                    url: "useraccess.php",
                    method: "POST",
                    data: {
                        id: i,
                        action: action
                    },
                    success: function(data) {
                        //loadUsersAccess();
                        alert(data);
                    }
                })
            } else {
                alert("Unckecked!!: " + i);
                var action = "revoke";
                $.ajax({
                    url: "useraccess.php",
                    method: "POST",
                    data: {
                        id: i,
                        action: action
                    },
                    success: function(data) {
                        //loadUsersAccess();
                        alert(data);
                    }
                })
            }


        }
        $(document).ready(function() {
            loadUsersAccess();

            function loadUsersAccess() {
                var action = "fetch";
                $.ajax({
                    url: "useraccess.php",
                    method: "POST",
                    data: {
                        action: action
                    },
                    success: function(data) {
                        $("#usersDiv").html(data);
                    }
                })
            }
            // $('.action').click(function(i) {
            //     var x = $('#1').val();
            //     alert("value: " + x);

            // })
        })
    </script>

</head>

<body>
    <?php
    for ($i = 0; $i < 5; $i++) {


    ?>
        <label> <?php echo $i ?></label>

        <br />

    <?php
    }
    ?>
    <button id="checkButton" onclick="checkChange()">hello</button>
    <div id="usersDiv">

    </div>

    <table class="table table-bordered">
        <tr>
            <th>Name</th>
            <th>Place</th>
        </tr>
        <tr>
            <td>Khalid</td>
            <td>Lahore</td>
        </tr>
    </table>
</body>

</html>