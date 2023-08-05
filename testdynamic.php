<?php
if (isset($_POST['field_name'])) {
	$field_values_array = $_POST['field_name'];
	$Second_field_values_array = $_POST['secondfield_name'];
	print_r($field_values_array);
	print_r($Second_field_values_array);
	echo "<br />";
	foreach ($field_values_array as $value) {
		echo $value;
		echo "<br />";
	}
	//echo "<br />";
	foreach ($Second_field_values_array as $value) {
		echo $value;
		echo "<br />";
	}
	for ($i = 0; $i < sizeof($Second_field_values_array); $i++) {
		echo "olley";
		echo "<br />";
		echo $field_values_array[$i];
		echo " ";
		echo $Second_field_values_array[$i];
		echo "<br />";
	}
}
?>

<html>

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/style.css" />
	<script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
	<script type="text/javascript">
		function showArray() {
			alert("hala");
			var testArray = [];
			testArray.push("khalid");
			testArray.push("Omer");
			alert("List: " + testArray);
		}
		$(document).ready(function() {

			var maxField = 10; //Input fields increment limitation
			var addButton = $(".add_button"); //Add button selector
			var wrapper = $(".field_wrapper"); //Input field wrapper
			var x = 1;
			var y = 1;
			//Initial field counter is 1

			//Once add button is clicked
			$(addButton).click(function() {
				//Check maximum number of input fields
				var fieldHTML =
					'<div><label>Name </label> &nbsp;' +
					'<input type="text" id="firstFields' + x + '" name="field_name[]" class="dynamicFields1" value="" /> ' +
					'<label>Task </label>' +
					'<input type="text" id="secondFields' + x + '" name="secondfield_name[]" class="dynamicFields2" value="" />' +
					'<a href="javascript:void(0);" class="remove_button">' +
					'<button type="button" id="btnAdd" name="addButton" class="btn btn-primary">' +
					'<span class="glyphicon glyphicon-minus" aria-hidden="true"></span>' +
					'</button></a></div>'; //New input field html
				if (x < maxField) {
					x++; //Increment field counter
					$(wrapper).append(fieldHTML); //Add field html
				}
			});
			console.log(x);

			//Once remove button is clicked
			$(wrapper).on("click", ".remove_button", function(e) {
				e.preventDefault();
				$(this).parent("div").remove(); //Remove field html
				x--; //Decrement field counter
			});
			$("#btnOk").click(function() {
				var testArray = "khalid";
				testArray.append("Omer");
				alert("List: " + testArray);
			});
			$("#btnSignin").click(function() {
				alert("yesss Submit");
				var firstFieldArray = [];
				var secondFieldArray = [];

				var count1 = 0;
				var count2 = 0;
				//var firstFieldList = $('input[name=field_name]').val();
				// var firstFieldList = $(".myclass .textclass").map(function() {
				// 	return $(this).val();
				// }).get();
				// var testArray = "khalid";
				// testArray.append("Omer");
				// if ($('.dynamicFields1').length) {
				// 	//alert("hala");
				// 	var result = false;

				// 	//var result2 = false;
				// 	$(".dynamicFields1").each(function() {

				// 	})
				// }

				//alert("List: " + testArray);
				if ($("#firstField").val() == "") {
					$('#firstField').css({
						'border-color': 'red'
					});
					//return false;
				}
				if ($("#secondField").val() == "") {
					$('#secondField').css({
						'border-color': 'red'
					});
					//return false;
				}
				if ($("#firstField").val() != "") {
					//var result = false;
					$('#firstField').css({
						'border-color': ''
					});
				}
				if ($("#secondField").val() != "") {
					$('#secondField').css({
						'border-color': ''
					});
					//return false;
				}
				if ($('.dynamicFields1').length) {
					//alert("hala");
					var result = false;

					//var result2 = false;
					$(".dynamicFields1").each(function() {

						var id = $(this).attr("id");
						//alert("Field 1 id: " + id);
						//alert("Length is: " + $('.dynamicFields1').length)

						if ($("#" + id).val() != "") {
							count1++;
							//alert("Field 1 contains");
							$("#" + id).css({
								'border-color': ''
							});
							//result = true;
						}
						if ($("#" + id).val() == "") {
							//alert("Field 1 not contains");
							$("#" + id).css({
								'border-color': 'red'
							});
							//return false;
							//result = false;

							//exit;
						}
						//return result;
						//alert("id: " + id);
						//return false;
					});
					$(".dynamicFields2").each(function() {

						var id = $(this).attr("id");
						//alert("Field 2 id: " + id);
						if ($("#" + id).val() != "") {
							count2++;
							//alert("Field 2 contains");
							$("#" + id).css({
								'border-color': ''
							});
							//result = true;
						} else if ($("#" + id).val() == "") {
							$("#" + id).css({
								'border-color': 'red'
							});
							//result = false;
							//break;
						}
						//return result;

						//alert("id: " + id);
					});
					/*$(".dynamicFields2").each(function() {

						var id = $(this).attr("id");
						alert("id: " + id);
						if ($("#" + id).val() == "") {
							$("#" + id).css({
								'border-color': 'red'
							});
							result = false;
							//break;
						}
						/*if ($("#" + id).val() != "") {
							//alert("doobara");
							$("#" + id).css({
								'border-color': ''
							});
							result = true;
						}*/
					//alert("id: " + id);
					//return false;
					//});
					/*$(".dynamicFields2").each(function() {

						var id = $(this).attr("id");
						alert("id: " + id);
						/*if ($("#" + id).val() == "") {
							$("#" + id).css({
								'border-color': 'red'
							});
							result = false;
							//break;
						}*/
					/*if ($("#" + id).val() != "") {
							//alert("doobara");
							$("#" + id).css({
								'border-color': ''
							});
							result = true;
						}
						//alert("id: " + id);
					});

*/
					//if (count1 == $('.dynamicFields1').length && $('.dynamicFields1').length == count2) {
					//	result = true;
					//}
					//return result;
				}
				if ($('#txtEmail').val() == "") {
					alert("Email empty");
					$('#txtEmail').css({
						'border-color': 'red'
					});
					//return false;
				}
				if ($('#txtEmail').val() == "" || $("#firstField").val() == "" || $("#secondField").val() == "" || count1 != $('.dynamicFields1').length || $('.dynamicFields1').length != count2) {
					alert("Please fill all fields");
					return false;
				} else {
					alert("yssss");
					firstFieldArray.push($("#firstField").val());
					secondFieldArray.push($("#secondField").val());
					//var testFirst = new Array();
					if ($('.dynamicFields1').length) {
						alert("hala dynamic fields");
						//var result = false;

						//var result2 = false;
						$(".dynamicFields1").each(function() {
							var id = $(this).attr("id");

							//testFirst.push("kaka")
							//firstFieldArray.push("kaka");
							firstFieldArray.push($("#" + id).val());
							//alert($("#" + id).val());
						})
						$(".dynamicFields2").each(function() {
							var id = $(this).attr("id");
							secondFieldArray.push($("#" + id).val());
							//secondFieldAray.push("lala");
							alert($("#" + id).val());
						})
					}
					alert("List: " + firstFieldArray);
					alert("2nd List: " + secondFieldArray);
					//alert("test List: " + testFirst);
				}
				/*if ($('.dynamicFields2').length) {
					var result = false;
					$(".dynamicFields2").each(function() {

						var id = $(this).attr("id");
						alert("Field 2 id: " + id);

						if ($("#" + id).val() != "") {
							alert("Field 2 contains");
							$("#" + id).css({
								'border-color': ''
							});
							result = true;
						}
						if ($("#" + id).val() == "") {
							alert("Field 2 not contains");
							$("#" + id).css({
								'border-color': 'red'
							});
							result = false;
							//return false;
							//break;
						}

						//return result;
						//alert("id: " + id);
					});
					return result;
				}*/
				/*if ($('.dynamicFields2').length) {
					//alert("hala");
					$(".dynamicFields2").each(function() {
						//alert("hala");
						var id = $(this).attr("id");
						if ($("#" + id).val() == "") {
							$("#" + id).css({
								'border-color': 'red'
							});
							result = false;
							//break;
						}
						if ($("#" + id).val() != "") {
							//alert("doobara");
							$("#" + id).css({
								'border-color': ''
							});
							result = true;
						}
						//alert("id: " + id);
					});
					return result;
				}*/

			});

		});
	</script>
	<script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
</head>

<body>
	<form method="post" action="">
		<div class="field_wrapper">
			<div class="myclass">
				<label>Name </label>
				<input type="text" id="firstField" name="field_name[]" value="" />
				<label>Task</label>
				<input type="text" id="secondField" name="secondfield_name[]" value="" />
				<a href="javascript:void(0);" class="add_button" title="Add field">
					<button type="button" id="btnAdd" name="addButton" class="btn btn-primary">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
					</button>
				</a>
			</div>

		</div>
		<input onkeyup="checkField('txtEmail')" class="form-control" type="email" name="email" PlaceHolder="Enter Email" oninvalid="this.setCustomValidity('Please Enter valid email')" oninput="this.setCustomValidity('')" id="txtEmail" />
		<input type="submit" id="btnSignin" name="submitButton" value="submit" class="btn btn-outline-primary" />
		<input type="button" value="OK" id="btnOk" onclick="showArray()" />
	</form>

</body>

</html>