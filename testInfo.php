<?php
echo "LOGIN";
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
<script>
  function showDiv() {
    document.getElementById('Login').style.display = "none";
    document.getElementById('loadingGif').style.display = "block";
    setTimeout(function() {
      document.getElementById('loadingGif').style.display = "none";
      document.getElementById('showme').style.display = "block";
    }, 2000);

  }
  function showThis() {
    //alert("hello");
    var value = $('#phoneNumber').val();
    ///^[0-9\s]*$/
    if(value.match(/^\+?[0-9].{5,}$/)){
      alert("hello: "+value);
    }
    else{
      alert("no match");
    }
    
  }
</script>
<style>
  .tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
  }

  .tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    font-size: x-small;
    border-radius: 6px;
    padding: 5px 5px;

    /* Position the tooltip */
    position: absolute;
    z-index: 1;
  }

  .tooltip:hover .tooltiptext {
    visibility: visible;
  }
</style>
</head>
<body>


  <div id="showme" style="display:none;">You are signed in now.</div>
  <div id="loadingGif" style="display:none"><img src="https://media.giphy.com/media/3oEjI6SIIHBdRxXI40/giphy.gif"></div>
  <form action="" method="POST" name="myform" id="hello" onsubmit="return false">
    <input class="btn_green_white_innerfade btn_medium" type="submit" name="submit" id="Login" value="Sign in" width="104" height="25" border="0" tabindex="5" onclick="showDiv()">
  </form>

<input type="phone" id="phoneNumber" placeholder="Enter Phone" />
<button onclick="showThis()">check</button>

</body>

</html>