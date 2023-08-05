<?php
session_start();
include "database.php"; 

$selectDeleteQuery = "SELECT * FROM tblLog WHERE type = 'DM'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectDeleteResult = (mysqli_query($conn, $selectDeleteQuery));
        //$output .= "<div class=\"col-11\">";
        $deleteOutput = "";
        $deleteOutput .= "
        <br />
        <h3>Minutes Deleted</h3>
        <table class=\"table table-striped text-center\">
        <thead style=\"background-color:#093c59; color:white\">
        <tr>
        <th class=\"text-center\">
        Minute Title
        </th>
        <th class=\"text-center\">
        User Name
        </th>
        <th class=\"text-center\" >
        User Email
        </th>
        <th class=\"text-center\">Date</th>
        </tr>
        </thead>";
        if (mysqli_num_rows($selectDeleteResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectDeleteResult)) {
                $deleteOutput .= "<tr>
                <td>" . $row["minute_title"] . "</td>
                <td>" . $row["user_name"] . "</td>
                <td>" . $row["user_email"] . "</td>
                <td>" . $row["time"] . "</td>
                </tr>";
            }
            $deleteOutput .= " </table>";
        } else {
            $deleteOutput .= "<tbody>
            <tr>
            <td colspan=\"4\"><h3 style=\"text-align:center\">No Record</h3></td>
            </tr>
            </tbody>
            </table>";
        }

        $selectCreateQuery = "SELECT * FROM tblLog WHERE type = 'CM'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectCreateResult = (mysqli_query($conn, $selectCreateQuery));
        //$output .= "<div class=\"col-11\">";
        $createOutput = "";
        $createOutput .= "
        <br />
        <h3>Minutes Created</h3>
        <table class=\"table table-striped text-center\">
        <thead style=\"background-color:#093c59; color:white\">
        <tr>
        <th class=\"text-center\">
        Minute Title
        </th>
        <th class=\"text-center\">
        User Name
        </th>
        <th class=\"text-center\" >
        User Email
        </th>
        <th class=\"text-center\">Date</th>
        </tr>
        </thead>";
        if (mysqli_num_rows($selectCreateResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectCreateResult)) {
                $createOutput .= "<tr>
                <td>" . $row["minute_title"] . "</td>
                <td>" . $row["user_name"] . "</td>
                <td>" . $row["user_email"] . "</td>
                <td>" . $row["time"] . "</td>
                </tr>";
            }
            $createOutput .= " </table>";
        } else {
            $createOutput .= "<tbody>
            <tr>
            <td colspan=\"4\"><h3 style=\"text-align:center\">No Record</h3></td>
            </tr>
            </tbody>
            </table>";
        }
        $selectEditQuery = "SELECT * FROM tblLog WHERE type = 'EM'";
        //$selectQuery = "SELECT * from tblUsers WHERE user_email != '$email'";
        $selectEditResult = (mysqli_query($conn, $selectEditQuery));
        //$output .= "<div class=\"col-11\">";
        $editOutput = "";
        $editOutput .= "
        <br />
        <h3>Minutes Edited</h3>
        <table class=\"table table-striped text-center\">
        <thead style=\"background-color:#093c59; color:white\">
        <tr>
        <th class=\"text-center\">
        Minute Title
        </th>
        <th class=\"text-center\">
        User Name
        </th>
        <th class=\"text-center\" >
        User Email
        </th>
        <th class=\"text-center\">Date</th>
        </tr>
        </thead>";
        if (mysqli_num_rows($selectEditResult) > 0) {
            while ($row = mysqli_fetch_assoc($selectEditResult)) {
                $editOutput .= "<tr>
                <td>" . $row["minute_title"] . "</td>
                <td>" . $row["user_name"] . "</td>
                <td>" . $row["user_email"] . "</td>
                <td>" . $row["time"] . "</td>
                </tr>";
            }
            $editOutput .= " </table>";
        } else {
            $editOutput .= "<tbody>
            <tr>
            <td colspan=\"4\"><h3 style=\"text-align:center\">No Record</h3></td>
            </tr>
            </tbody>
            </table>";
        }
        //echo $output;
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
    </head>
    <body>
    <div id="nav-placeholder3">
            <?php
            include "navbar.php";
            ?>

        </div>
        <div class="container">
            <div class="row">
<div>
<?php echo $deleteOutput ?>
        </div>
        <div>
        <?php echo $createOutput ?>
        </div>
        <div>
        <?php echo $editOutput ?>
        </div>
                
            </div>
        </div>
    </body>

</html>