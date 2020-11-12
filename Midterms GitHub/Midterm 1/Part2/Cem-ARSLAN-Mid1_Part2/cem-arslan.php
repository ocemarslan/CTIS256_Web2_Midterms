<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <style>
    h5{
        margin:30px auto;
        text-align:center;
    }
    </style>
</head>
<body>
<nav style='width:60%;margin:0px auto;'>
    <div class="nav-wrapper">
      
      <a href="./cem-arslan.php" class="brand-logo"><i style="margin-right:10px" class="material-icons">home</i>BMS</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><i style="margin-right:10px" class="material-icons">person</i></li>
        <li style="margin-right:10px">Cem ARSLAN</li>
      </ul>
    </div>
</nav>
<?php
if(isset($_GET["action"])){
    require "./form.php";

}else{
    echo "<h5>Welcome to Bookmark Management System <a href='./cem-arslan.php?action=add' style='margin-left:30px;' class='btn-floating pulse'><i style='font-size:30px;' class='material-icons' >add</i></a></h5>";
}
?>


        
    
</body>
</html>