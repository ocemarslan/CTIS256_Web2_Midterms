<?php

  require "./db.php" ;

  $urll = $_GET["url"] ;

  try {
      $stmt = $db->prepare("delete from bookmark where url = :urll") ;
      $stmt->execute(["urll" => $urll]) ;
  } catch(PDOException $ex) {
     
  }
  // Redirection
  header("Location: bookmark.php") ;

  ?>