<?php

if(isset($_POST["submitBtn"]))  //----------------Check POST array in order to decide to use StickyForm or not.
{
  extract($_POST,EXTR_PREFIX_ALL,"p");  

  $error=[];


  //--------------------------------------------------------------Validate URL below

  $p_url_address=filter_var($p_url_address,FILTER_SANITIZE_STRING);  // Eliminate tags

  $urlAddressPatternResult = preg_match('/^((http|https)?:\/\/)(\w+\.){1,3}[a-z ]+$/', $p_url_address); //RexEx version which returns 1 or 0

  if($urlAddressPatternResult==0)
  {
      $warningForURL = "<p style='font-style:italic; color:red;'>URL is not valid!</p>";
      $error = [1];   
  }
  //-------------------------------------------------------------Validated!



  //----------------------------------------------------------Validation for Title below
  $p_title = filter_var($p_title, FILTER_SANITIZE_STRING);

  if(strlen(trim($p_title))==0)
  {
    $warningForTitle = "<p style='color:red; font-style:italic;'>Title cannot be empty!</p>";
    $error = [2];   
  }
 //----------------------------------------------------------Validated!


 //--------------------------------go to show view of result
 if(empty($error)){
  require "./result.php";
  exit;
 }


}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title><link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
   <style>
       .row{
           width: 60%;
           margin:40px auto;
       }
       form{
           margin:0px auto;
       }
       #shareP{
           background-color:#ddd;
           border-radius: 25px;
           text-align: center;
           width: 90px;
           height: 30px;
           padding-top:3px;
           margin-top: -15px;
       }

   </style>
</head>
<body>

    <div class="row">
      <h3 style="text-align:center;">New Bookmark</h3>
        <form class="" method="POST" action="">
            <div class="row">
                <div class="input-field col s12">
                  <i class="material-icons prefix">create</i>
                  <input id="title" type="text" name="title" <?php isset($p_title) ? print "value='$p_title'" : print ''?>>
                  <label for="title">Title</label>
                  <?php isset($warningForTitle) ? print $warningForTitle : print '' ;?>
                </div>
                <div class="input-field col s12">
                  <i class="material-icons prefix">insert_link</i>
                  <input id="url_address" name="url_address" type="text" <?php isset($p_url_address) ? print "value='$p_url_address'" : '' ?>>
                  <label for="url_address">URL</label>
                  <?php isset($warningForURL) ? print $warningForURL : print ''; ?>
                </div>
              </div>
          <div class="row">
            <div class="input-field col s6">
              <p id="shareP">Share</p>
            </div>
            <div class="switch">
                <label style="margin-left: 28%;">
                  Off
                  <input type="checkbox" name="share" id="share" name="share" <?= isset($p_share) ? "checked" : "" ?>>
                  <span class="lever"></span>
                  On
                </label>
            </div> 
           </div>
           <div class="row">
            <div class="input-field col s12">
                <button class="btn waves-effect waves-light" type="submit" name="submitBtn" id="submitBtn">Submit
                    <i class="material-icons right">send</i>
                </button>
            </div>
           </div>
        </form>
      </div>


</body>
</html>