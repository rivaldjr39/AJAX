<?php
function bdconnect()
{
    $bdd = mysqli_connect('localhost', 'root', '', 'ajax2');
    if (!$bdd) {
        die(json_encode(["error" => "Erreur de connexion à la base de données"]));
    }
    return $bdd;
}
?>