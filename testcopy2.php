<?php
//$msg = "";
/*if(isset($_POST['test'])){
    $num1=$_POST['lname'];
    $msg ="Name ".$num1;
}else{
    //$msg ="Name empty";
}
*/
    //echo "<div id=\"wordDiv\">lololololo</div>";
    $firstNameError = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {  

        if (empty($_POST["fname"])) {  
            $firstNameError = "Name is required";  
        }
        //return $firstNameError;
    }
    
    /*if(isset($_POST['passProcess'])){
        $requestProcess = trim($_POST['passProcess']);
        if (empty($_POST["txtFName"])) {  
            $firstNameError = "Name is required";  
        }
        if ($requestProcess == "txtLNameValue") {
        
            $wordFieldValue = trim($_POST['passLastName']);
            $wordFirstValue = trim($_POST['passFirstName']);
            if($wordFirstValue == ""){
                $firstNameError = "yalllllaaa youuu";
            }*/
            /*if($wordFirstValue == ""){
                echo "yesssssss";
                $firstNameError = "Firstoo Name";
            }
            //die();
            /*$wordFirstValue = trim($_POST['passFirstName']);
            if(empty($wordFieldValue)){
                echo "<span class=\"text-danger\">Last Name Required</span>";
                return false;
            }
            if(empty($wordFirstValue)){
                echo "First Name Required";
                return false;
            }
            else{
                echo "All SET!!!";
            }
    
        */
            //echo "All Fields are fine ".$wordFirstValue." ".$wordFieldValue;
        
        
        
            //die();
        //}
    //}
    


?>


<html>
    <head>
    <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <script src="jquery/jquery-3.6.1.min.js" type="text/javascript"></script>
  <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>

  <script type="text/javascript">
 /*$('#clickmetest').click(function(){
        $('#testhello').hide();
});*/

    $(document).ready(function () {
        $('#txtLName').focus();
       
        
        $("#valuebutton").click(function(){
            //$('#testhello').hide();
            var lastname = $('#txtLName').val();
            firstname =  $('#txtFName').val();
            requestProcess = "txtLNameValue";
            /*
            if(firstname==""){
                //alert("empty")
                $('#fnameerror').text("First Name required").css({'color':'red'});
                return false;
            }
            else{
                $('#fnameerror').text("");
            } if(lastname==""){
                $('#lnameerror').text("Last Name required").css({'color':'red'});
                return false;
            }else{
                $('#lnameerror').text("");
            }*/
            //$('#feedbackDiv').empty().removeClass().css({'height':'150px'});

            /*$.ajax({
                cache: false,
                type: "POST",
                url: "test.php",
                data: {	passLastName:lastname, passFirstName:firstname, passProcess:requestProcess }, 
                        
                success: function(data) { 
                    //alert(data);
                    $('#feedbackDiv').html(data);
                    $('#myform')[0].reset();
                    
                    //$('#txtLName').val("");
                    //$('#txtFName').val("");

                }
                
                
            });*/
        });

        
    });
    
  </script>
    </head>
<body>
    <div class="container">
    <h1 style="color:blue">Hello Khalid Naseer</h1>
<h2>Yes this is what it is</h2>
<h2>Khalid is waiting</h2>
<h2>khalid</h2>
    </div>
    <div id="testhello">
        <h1>heloooooooo</h1>
    </div>
<hr/>
<button id="clickmetest">
    click me
</button>
<div class="container">
<div class="form-group col-lg-6">
<form action="testcopy2.php" id="myform" method="POST" >
<div id="feedbackDiv" style="height:50px;"></div>
<strong>
    <label id="lblFName">First Name</label>
</strong>
<span id="fnameerror">

</span>
<span>
    <?php 
    echo "yalloo".$firstNameError;
    ?>
</span>
<input class="form-control" PlaceHolder="Enter First Name" name="fname" id="txtFName"/>
<strong>
    <label id="lblLName">Last Name</label>
</strong>
<span id="lnameerror">

</span>
<input class="form-control" PlaceHolder="Enter Last Name" name="lname" id="txtLName"/>
<div class="form-group col-lg-6 col-md-6 col-lg-offset-3">
<input class="btn btn-danger" type="submit" name="submit" id="valuebutton" value="Submit"/>
</div>

</form>
</div>
</div>
<span class="text-danger">yealalla</span>


</body>


</html>