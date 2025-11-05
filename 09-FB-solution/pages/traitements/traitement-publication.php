<?php
require "../../includes/fonction.php";

if (isset($_POST['publication']) || isset($_POST['auteur'])) {
    $publication = $_POST['publication'];
    $auteur = $_POST['auteur'];

    sleep(1);

    insertPublication($publication, $auteur);

    exit;
}

$publications = getPublications();

echo json_encode($publications);