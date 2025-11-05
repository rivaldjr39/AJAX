<?php
header("Content-Type: application/json");


$id = isset($_GET['id']) ? intval($_GET['id']) : null;


$retour = array(
    0 => array("Nom" => "Rakoto", "Prenom" => "John", "AnneeNaissance" => 1990),
    1 => array("Nom" => "Rasoa", "Prenom" => "Kininina", "AnneeNaissance" => 1994),
    2 => array("Nom" => "Rabe", "Prenom" => "Jean", "AnneeNaissance" => 1993)
);

sleep(5);


function bdconnect()
{
    $bdd = mysqli_connect('localhost', 'root', '', 'ajax');
    if (!$bdd) {
        die(json_encode(["error" => "Erreur de connexion à la base de données"]));
    }
    return $bdd;
}

$bdd = bdconnect();
$sql = "SELECT * FROM Personne";
$query = mysqli_query($bdd, $sql);
$base = array();
while ($requete = mysqli_fetch_assoc($query)) {
    $base[] = $requete;
}
mysqli_free_result($query);
mysqli_close($bdd);


if ($id !== null && isset($base[$id])) {
    echo json_encode($base[$id]);
} else {
    echo json_encode(["error" => "ID non trouvé"]);
}
?>
