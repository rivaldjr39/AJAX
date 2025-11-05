<?php
    include('../include/fonction.php');
    session_start();
    header("Content-Type: application/json");
    $bdd = bdconnect();

    $username =  $_POST['username'];
    $password =  $_POST['password'];
  
    $emp_membres = get_emp_membres();

    foreach($emp_membres as $membre){
        $retour[] = $membre;
    }
    $exit = 0;
    for($i=0 ; $i < count($retour); $i++){
        if($retour[$i]['email'] == $username && $retour[$i]['pwd'] == $password){
            $exit = 1;
            $_SESSION['id'] = $retour[$i]['id_membre'];
            break;
        }
    }
    echo json_encode($exit);
?>