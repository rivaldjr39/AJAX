<?php
    session_start();
    header("Content-Type: application/json");

    $username =  $_POST['username'];
    $password =  $_POST['password'];
    $session_username = $_SESSION['username'];

    $retour = array(
        0 => array("username" => "Rivaldo@gmail.com", "password" => "rivaldo123"),
        1 => array("username" => "Rabe@gmail.com","password" => 123)
    );
    $exit = 0;
    for($i=0 ; $i < count($retour); $i++){
        if($retour[$i]['username'] == $username && $retour[$i]['password'] == $password){
            $exit = 1;
            break;
        }
    }
    echo json_encode($exit);
?>