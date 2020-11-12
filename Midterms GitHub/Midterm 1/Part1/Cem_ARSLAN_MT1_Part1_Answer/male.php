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
      color:#ddd;
      text-align:center;
    }
    #tableHead{
      font-weight:bold;
      background:#aaa;
    }
    table{
      margin:30px auto;
      width:900px;
      border-collapse:collapse;
    }
    td{
      height: 40px;
    }
    .one{
      background:#DDD;
    }
    #paging{
      text-align:center;
    }
    
    </style>
</head>
<body>
<nav>
    <div class="nav-wrapper">
      <a id="cemSpecifying" style="margin-left:260px;" href="./Cem_ARSLAN.php" class="brand-logo" ><i style="font-size:40px;" class="material-icons">home</i>HOME</a>
      <?php echo "<ul id='nav-mobile' class='right hide-on-med-and-down'>";
      if(isset($_GET["gender"]))
      {
        $g=$_GET["gender"];
        if($g=="male"){   //show colorfull one which is selected
          echo "<li style='margin-right:15px;'><a href='./female.php?gender=".urlencode("female")."'>FEMALE</a></li>";
          echo "<li style='margin-right:250px;background:#d9d9d9'><a href='./male.php?gender=".urlencode("male")."'>MALE</a></li>";
        }
        else{
          echo "<li style='margin-right:15px;background:#d9d9d9'><a href='./female.php?gender=".urlencode("female")."'>FEMALE</a></li>";
          echo "<li style='margin-right:250px;><a href='./male.php?gender=".urlencode("male")."'>MALE</a></li>";
        }
      }else{ // show like normal home page 
        echo "<li style='margin-right:15px; font-weight:bold;'><a href='./female.php?gender=".urlencode("female")."'>FEMALE</a></li>";
        echo "<li style='margin-right:250px;font-weight:bold;'><a href='./male.php?gender=".urlencode("male")."'>MALE</a></li>";
      }
      echo "</ul>";
      ?>
    </div>
</nav>

<?php
  
  $genderr = $_GET["gender"];
  //var_dump($_GET);
  require "./db.php";

    if($genderr=="male"){
      echo "<table>";
       echo "<tr id='tableHead'><td>Name</td><td>Age</td><td>Product</td><td>Price</td></tr>";
      $maleUsersInfo=[];
        foreach($users as $mail=>$oneUser){
          if($oneUser["gender"]=="male"){
            foreach($orders as $oneOrder)
            {
              if($oneOrder["email"]==$mail){
                extract($oneUser);
                extract($oneOrder);
              
                $pairs = explode("/", $birthday);
                $result= "$pairs[2]"."-"."$pairs[1]"."-"."$pairs[0]";
                //echo $result; //tested, it worked
                
                $today = new DateTime();
                $birthDate = new DateTime($result);
                $dateDifference = $today->diff($birthDate) ;  //age will be retreived with the difference

                $maleUsersInfo[]=["name"=>$fullname,"age"=>$dateDifference->y,"prd"=>$prd_name,"prc"=>$price];
                
                //echo "<tr><td>$fullname</td><td>$dateDifference->y</td><td>$prd_name</td><td>$price $</td></tr>";
                
              }
            }
          }
        }


        usort($maleUsersInfo, function($b,$a) {  //ascending order sorting
          return $b["name"] <=> $a["name"] ;
      }) ;

      
      if(isset($_GET["pageNumber"])) //iiiiiiiiiiiiiiiiiiiiiiiiif pageNumber is set.
      {
        $arraySize=count($maleUsersInfo);
        $pageNum=$_GET["pageNumber"];
         $head=($pageNum*10)-10;
         if($head+10>$arraySize)
         {
          $tail=$head+($arraySize%10);
         }
         else{
          $tail=($pageNum*10);
         }
        $styleOftr=0;
        for($head;$head<$tail;$head++){
          if($styleOftr%2==0) { //style 1 #ddd
            echo "<tr class='one'><td>".$maleUsersInfo[$head]["name"]."</td>";
            echo "<td>".$maleUsersInfo[$head]["age"]."</td>";
            echo "<td>".$maleUsersInfo[$head]["prd"]."</td>";
            echo "<td>".$maleUsersInfo[$head]["prc"]."$"."</td></tr>";
            $styleOftr++;
          }else{
             echo "<tr><td>".$maleUsersInfo[$head]["name"]."</td>";
            echo "<td>".$maleUsersInfo[$head]["age"]."</td>";
            echo "<td>".$maleUsersInfo[$head]["prd"]."</td>";
            echo "<td>".$maleUsersInfo[$head]["prc"]."$"."</td></tr>";
           $styleOftr++;          
         }
        }
      }else{  //iiiiiiiiiiiiiiiiiiiiiiif it is not set, meaning it here is reached via home page
      $i=0;
      $styleOftr=0;
        for($i;$i<10;$i++)
        {
         if($styleOftr%2==0)  //style 1 #ddd
          {
            echo "<tr class='one'><td>".$maleUsersInfo[$i]["name"]."</td>";
           echo "<td>".$maleUsersInfo[$i]["age"]."</td>";
            echo "<td>".$maleUsersInfo[$i]["prd"]."</td>";
            echo "<td>".$maleUsersInfo[$i]["prc"]."$"."</td></tr>";
            $styleOftr++;
         }
          else{
            echo "<tr><td>".$maleUsersInfo[$i]["name"]."</td>";
            echo "<td>".$maleUsersInfo[$i]["age"]."</td>";
            echo "<td>".$maleUsersInfo[$i]["prd"]."</td>";
            echo "<td>".$maleUsersInfo[$i]["prc"]."$"."</td></tr>";
            $styleOftr++;          
         }
        }
      }


        echo "</table>";
        //------------------------------------------------------------------------PAGING PART
        $cntOfArray = count($maleUsersInfo);
        $totalPageNumber=intdiv($cntOfArray,10);
        echo "</table>";
        echo "<div id='paging'>";
          if(isset($_GET["pageNumber"]))////check if pageNumber is entered to the GET method
          {
            $pag=$_GET["pageNumber"];
           echo "<ul class='pagination'>";
            if($pag==1)           //right and left arrowssssssss
            {
              echo "<li class='disabled'><a href='#!'><i class='material-icons'>chevron_left</i></a></li>";
            }else{
              $continueTO=$pag-1;
              echo "<li class='waves-effect'><a href='./male.php?pageNumber={$continueTO}&gender=".urlencode("male")."'><i class='material-icons'>chevron_left</i></a></li>";
            }
            
            
            for($k=1;$k<=$totalPageNumber+1;$k++)
            {
              if($k==$pag)
              {
                echo "<li class='active'><a href='./male.php?pageNumber={$k}&gender=".urlencode("male")."'>$k</a></li>";
              }
              else{
                echo "<li class='waves-effect'><a href='./male.php?pageNumber={$k}&gender=".urlencode("male")."'>$k</a></li>";
              }
            }


            if($pag<$totalPageNumber+1)  //right and left arrowssssssss
            {
              $stop=$pag+1;
              echo "<li class='waves-effect'><a href='./male.php?pageNumber={$stop}&gender=".urlencode("male")."'><i class='material-icons'>chevron_right</i></a></li>";
            }
            else{
              echo "<li class='disabled'><a href='#!'><i class='material-icons'>chevron_right</i></a></li>";
              
            }

            echo "</ul>";

          }else{ // $_get["pageNUmber"] is empty, meaning here is reached from home page first time
            echo "<ul class='pagination'>";
            echo "<li class='disabled'><a href='#!'><i class='material-icons'>chevron_left</i></a></li>";
            echo "<li class='active'><a href='./male.php?pageNumber=1&gender=".urlencode("male")."'>1</a></li>";
            for($pn=2;$pn<=$totalPageNumber+1;$pn++){
              echo "<li class='waves-effect'><a href='./male.php?pageNumber={$pn}&gender=".urlencode("male")."'>$pn</a></li>";
            }
            echo "<li class='waves-effect'><a href='./male.php?pageNumber=2&gender=".urlencode("male")."'><i class='material-icons'>chevron_right</i></a></li>";
            echo "</ul>"; 
          }


        echo "</div>";
      }
?>
</body>
</html>