<?php
  if( $_SERVER["REQUEST_METHOD"] == "POST") {
     require "db.php" ;


     try {
        extract($_POST);
        $sql = "insert into bookmark (owner,title, url, note) values (?,?,?,?)" ;
        $stmt = $db->prepare($sql) ;
        $stmt->execute([$ownerName, $addTitle, $addURL, $addNote]) ;
        $msg = "Successfully Added!" ;
     } catch(PDOException $ex) {
        $msg = "Fail!" ;
     }

  }
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        .container > h2{
            text-align: center;
        }
        #innerTable{
            width:600px;
        }
        #main{
            text-align:center;
        }
        #infoTable{
            width:600px;
        }
        #addContainer{
            text-align:center;
            width:100px;
            
            margin:40px auto;
        }
        #mBody{
            text-align:center;

        }
        table{
            width:1000px;
            margin:10px auto;
        }

        #mainTable{
            text-align:center;
            margin:10px auto;
        }
        th{
            color:black;
        }
        #toast-container{
            position:fixed !important;
            bottom:0px !important;
            top:600px;
            left: 42% !important;
            width:206px;
        }
        .toast{
         background: green !important;
         color:white !important;
         text-align:center;
         } 
        
    </style>
</head>
<body>
<div class="container"><nav>
        <div class="nav-wrapper">
            <a href="cem_Arslan.php" class="brand-logo">BMS<i class="material-icons">home</i> </a>
          <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li><i class="material-icons">bookmark_border</i></li>
            <li><a href="bookmark.php">Bookmarks</a></li>
          </ul>
        </div>
      </nav>
</div>


<?php

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
             
   echo "<script>
   M.toast({html : '$msg!', classes:'rounded'});    
    </script>";
    }

  require_once "./db.php";
  $sqlBook = "select * from bookmark";
  $sqlUSERS = "select * from user";

  try {
     $stmtBook = $db->query($sqlBook);
     $stmtUSERS=$db->query($sqlUSERS);

     $size = $stmtBook->rowCount();


     $bookmarks = $stmtBook->fetchAll(PDO::FETCH_ASSOC);
     $users = $stmtUSERS->fetchAll(PDO::FETCH_ASSOC);
 } catch(PDOException $ex) {
    echo $ex->getMessage() ;
    die("<p>Try Again</p>") ;
 }
?>


<?php

if(isset($_GET["url"]))
{
    require "./delete.php";
}

?>


<div id="mainTable">
      <table>
       <tr>
         <th><a href="./bookmark.php?orderBy=owner">Owner</a></th>
         <th><a href="./bookmark.php?orderBy=title">Title</a></th>
         <th><a href="./bookmark.php?orderBy=note">Note</a></th>
         <th><a href="./bookmark.php?orderBy=date">Date</a></th>
         <th>Actions</th>
       </tr>
       <?php  



       $arr = [];
       $userIDs=[];
       foreach($users as $user)    //get values from database and send them to a new array
       {
            $userIDs[]=["name"=>$user["name"],"id"=>$user["id"]];
           foreach($bookmarks as $bkm){
               if($bkm["owner"]===$user["id"]){
                $arr[] = ["name"=>$user["name"],"title"=>$bkm["title"],"note"=>$bkm["note"],"created"=>$bkm["created"],"url"=>$bkm["url"],"ownerID"=>$bkm["owner"],"date"=>$bkm["created"]];
               }
           }
       }




       if(!isset($_GET["orderBy"])){    //default show ordered by date
           usort($arr, function($b,$a) { 
        return $b["created"] <=> $a["created"] ;
            }) ;
            $cnt=0;
           foreach($arr as $ar)
           {
            echo '<tr>
            <td>'.$ar["name"].'</td>
            <td>'.$ar["title"].'</td>
            <td>'.$ar["note"].'</td>
            <td>'.$ar["created"].'</td>';
            echo "<td><a href='./bookmark.php?url=".urlencode($ar["url"])."'><i class='material-icons'>delete</i></a></td>";
            echo '<td><a href="#'.$cnt.'" class="btn modal-trigger"><i class="material-icons">remove_red_eye</i></a></td>';
            echo '<td><div class="modal" id="'.$cnt.'">
                  <div class="modal-content">
                            
                            <table class="highlight" id="infoTable">
                            <tr>
                            <td>Owner</td>
                             <td>'.$ar["name"].'</td>
                            </tr>
            
                            <tr>
                                <td>Title:</td>
                                <td>'.$ar["title"].'</td>
                            </tr>
            
                             <tr>
                              <td>Note:</td>
                             <td>'.$ar["note"].'</td>
                            </tr>
            
                           <tr>
                           <td>URL:</td>
                           <td>'.$ar["url"].'</td>
                            </tr>
            
                           <tr>
                             <td>Date:</td>
                              <td>'.$ar["created"].'</td>
                             </tr>
            
                         </table>
                         </div>
                        </div>
            
            </td></tr>'; 
            $cnt++;  
            }
       }
       else{   //specify show styles below
            if($_GET["orderBy"]=="owner")
            {
                usort($arr, function($b,$a) {  
                return $b["name"] <=> $a["name"] ;
                 }) ;
            }

           if($_GET["orderBy"]=="title")
           {
                usort($arr, function($b,$a) {  
                return $b["title"] <=> $a["title"] ;
                }) ;

           }

           if($_GET["orderBy"]=="note")
           {
                usort($arr, function($b,$a) {  
             return $b["note"] <=> $a["note"] ;
            }) ;    
           }

           if($_GET["orderBy"]=="date")
           {
                usort($arr, function($b,$a) {  
             return $b["created"] <=> $a["created"] ;
            }) ;
           }

           $cnt=0;
            foreach($arr as $ar)  //write to the table
            {
                echo '<tr>
                <td>'.$ar["name"].'</td>
                <td>'.$ar["title"].'</td>
                <td>'.$ar["note"].'</td>
                <td>'.$ar["created"].'</td>';
                echo "<td><a href='./bookmark.php?url=".urlencode($ar["url"])."'><i class='material-icons'>delete</i></a></td>";
                echo '<td><a href="#'.$cnt.'" class="btn modal-trigger"><i class="material-icons">remove_red_eye</i></a></td>';
                echo '<td><div class="modal" id="'.$cnt.'">
                      <div class="modal-content">
                                
                                <table class="highlight" id="infoTable">
                                <tr>
                                <td>Owner</td>
                                 <td>'.$ar["name"].'</td>
                                </tr>
                
                                <tr>
                                    <td>Title:</td>
                                    <td>'.$ar["title"].'</td>
                                </tr>
                
                                 <tr>
                                  <td>Note:</td>
                                 <td>'.$ar["note"].'</td>
                                </tr>
                
                               <tr>
                               <td>URL:</td>
                               <td>'.$ar["url"].'</td>
                                </tr>
                
                               <tr>
                                 <td>Date:</td>
                                  <td>'.$ar["created"].'</td>
                                 </tr>
                
                             </table>
                             </div>
                            </div>
                
                </td></tr>'; 
                $cnt++;  
            }   
        }

?>

</table>
</div>




    

<div id="addContainer"><a id="addBtn" href="#terms" style="border-radius:50%;" class="btn red modal-trigger"><i class="material-icons">add</i></a></div>

<div class="modal" id="terms">
    <div class="modal-content">
        <form method="POST">
        <table id="innerTable">
        <tr>
        <td>
         <select class="browser-default" name="ownerName">
         <option value="" disabled selected>Choose your option</option>
         <?php foreach( $userIDs as $i) : ?>
            <option value="<?=$i["id"] ?>"><?=$i["name"]?></option>
         <?php endforeach ; ?>
         </select>
        </td>
        </tr>
        <tr><td><input type="text" placeholder="Title" name="addTitle" id="addTitle"></td></tr>
        <tr><td><input type="text" placeholder="URL" name="addURL" id="addURL"></td></tr>
        <tr><td><input type="text" placeholder="Notes" name="addNote" id="addNote"></td></tr>
        <tr><td><button class="btn waves-effect waves-light" type="submit" name="action">Submit
        <i class="material-icons right">send</i>
        </button></td></tr>
        </table>
        </form>
    </div>
</div>




<script>
    document.addEventListener('DOMContentLoaded', function() {
    const box = document.querySelectorAll(".modal");
    M.Modal.init(box,{});
    });

    $(document).ready(function(){
    $('select').formSelect();
  });
 </script> 
</body>
</html>