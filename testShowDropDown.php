<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/styleFile.css" type="text/css">

    <script src="bootstrap5/js/bootstrap.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="bootstrap5/bootstrap-icons-1.10.2/bootstrap-icons.css" type="text/css">
    <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>

    <title>Document</title>
    <script>
        $(document).ready(function() {
            loadTest();

            function loadTest() {
                var action = "fetchTest";
                $.ajax({
                    url: "testGetDropdown.php",
                    method: "POST",
                    data: {
                        action: action
                    },
                    success: function(data) {
                        $("#testDiv").html(data);
                    }
                })
            }
        });

        function showValue() {
            alert($('#names').val());
        }

        function showCarValue() {
            //alert($('#cars'). [selectedIndex].id);
            var selectOne = $('#cars').val();
            // var select = document.getElementById("cars");
            // var options = select.options;
            // var id = options[options.selectedIndex].id;
            alert(selectOne);
            //alert("kdk" + id);
        }
    </script>
</head>

<body>
    <div id="testDiv">

    </div>
    <div class="dropdown">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown button
        </button>
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
        </ul>
    </div>
    <div>
        <label for="cars">Choose a car:</label>
        <select onchange="showCarValue()" class="form-control form-control-static" name="cars" id="cars">
            <option value="1">Volvo</option>
            <option value="2">Saab</option>
            <option value="3">Opel</option>
            <option value="4">Audi</option>
        </select>
    </div>
</body>

</html>