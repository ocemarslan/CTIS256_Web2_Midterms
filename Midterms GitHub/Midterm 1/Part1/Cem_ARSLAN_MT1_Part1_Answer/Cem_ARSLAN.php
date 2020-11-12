<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
    #cemSpecifying :hover{
      color:black;
      transition:all ease-in-out 0.4s;
    }
    .MyStudentInfo{
      color:#ccc;
      text-align:center;
      font-weight:bold;
    }
    </style>
</head>
<body>
<nav>
    <div class="nav-wrapper">
      <a id="cemSpecifying" style="margin-left:260px;" href="./Cem_ARSLAN.php" class="brand-logo" ><i style="font-size:40px;" class="material-icons">home</i>HOME</a>
      <?php echo "<ul id='nav-mobile' class='right hide-on-med-and-down'>";
        echo "<li style='margin-right:15px; font-weight:bold;'><a href='./female.php?gender=".urlencode("female")."'>FEMALE</a></li>";
        echo "<li style='margin-right:250px;font-weight:bold;'><a href='./male.php?gender=".urlencode("male")."'>MALE</a></li>";
      echo "</ul>";
      ?>
    </div>
</nav>
    <h2 class="MyStudentInfo">Osman Cem ARSLAN</h2>
    <h3 class="MyStudentInfo">21602491</h3>
    <h4 class="MyStudentInfo">Midterm 1 - Part 1</h4>
</body>
</html>