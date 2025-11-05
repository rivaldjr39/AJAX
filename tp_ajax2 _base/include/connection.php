<?php
function bdconnect(){
    $host = 'localhost';
    $dbname = 'ajax2';
    $user = 'root';
    $pass = '';
  try {
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
  }
  catch(PDOException $e) {
      echo $e->getMessage();
  }
    return $DBH;
}
?>