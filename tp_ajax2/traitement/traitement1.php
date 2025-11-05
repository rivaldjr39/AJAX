<?php
    session_start();
    header("Content-Type: application/json");
    if (isset($_POST['text_pub']) ) {
       $publication = $_POST['text_pub'];
        echo json_encode($publication);
    }
    if (isset($_POST['text_comm'])) {
       $commentaire = $_POST['text_comm'];
        echo json_encode($commentaire);
    }
    
    
?>