<?php
session_start();
include('../include/fonction.php');
header("Content-Type: application/json");
$bdd = bdconnect();

if (!isset($_POST['text_pub']) && !isset($_POST['text_comm'])) {
    $reponse = get_All_com_pub();
    foreach ($reponse as $item) {
        $data[] = $item;
    }
    echo json_encode($data);
    exit;
}

if (isset($_POST['text_pub'])) {
    $publication = $_POST['text_pub'];
    $session = $_SESSION['id'];
    $row1 = get_insert_text_pub($session, $publication);
    echo json_encode($row1);
    exit;
}

if (isset($_POST['text_comm']) && isset($_POST['id_publication'])) {
    $commentaire = $_POST['text_comm'];
    $id_publication = $_POST['id_publication'];

    $session = $_SESSION['id'];
    $row3 = get_insert_text_commentaire($session, $id_publication, $commentaire);
    echo json_encode($row3);
    exit;
}
?>
