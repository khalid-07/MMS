<?php

echo "Kaka";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Document</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" />
        <link rel="stylesheet" href="css/styleFile.css" type="text/css">
        <link rel="stylesheet" href="bootstrap5/bootstrap-icons-1.10.2/bootstrap-icons.css" type="text/css">
        <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
        <!-- <script type="text/javascript" src="js/jquery.form.js"></script> -->
        <script src="bootstrap5/js/bootstrap.min.js" type="text/javascript"></script>
<script>
	function checkValue(){
		var regex = (/^(([a-zA-Z0-9\s](,)?)*)+$/);
		var inputValue = $('#tstInput').val();
		var finalValue = inputValue.match(regex);
		// /^[a-z0-9](,[a-z0-9])*$/
		///^([a-z0-9\s]+,)*([a-z0-9\s]+){1}$/i
		if(inputValue.match(/^[A-Za-z,\s]*(?<!,)(?<!\s)$/)){
		//if(inputValue.match(/^[A-Za-z\s],[A-Za-z\s]*$/)){
			alert("Yess it is fine:")
		}else{
			alert("No. problem is there");
		}


	}
</script>
</head>

<body>
	<div id="testKhalid">
		<?php echo "KAKA" ?>
		<h2>Khalid can print</h2>
	</div>
	<button id="printButton">Print</button>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="print/printThis.js"></script>
	<script src="print/custom.js"></script>
	<h1>hello</h1>
	<input id="tstInput" />
	<button id="btnCheck" onclick="checkValue()">Check</button>
</body>

</html>