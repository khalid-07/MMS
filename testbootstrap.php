<?php
echo "hello";
?>

<!DOCTYPE html>
<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="bootstrap5/css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
	<script src="bootstrap5/js/bootstrap.min.js" type="text/javascript"></script>
	<script>
		//var myModal = document.getElementById("myModal");
		//var myInput = document.getElementById("myInput");

		//myModal.addEventListener("shown.bs.modal", function() {
		//	myInput.focus();
		//});
	</script>
</head>

<body>
	<h1>Bootstrap check</h1>
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
		Launch demo modal
	</button>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div id="usersDiv" class="modal-body">
					<strong>
						<label id="lblPass">Password</label>&nbsp;<strong style="color: red">*</strong>
					</strong>
					<span class="label-info"></span>
					<label id="lblPasswordError"></label>

					<input onkeyup="checkField('txtPassword')" class="form-control" placeholder="Enter Password" name="password" id="txtPassword" />
					<label id="lblPasswordLengthError" style="height: 5px"></label>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary btn-block" data-bs-dismiss="modal">
						Close
					</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div>
	<input method="post" type="submit" action="homepage.php" value="HAla" />
	<input value="halid" />
</body>

</html>