<?php
include('../include/connection.php');
function get_emp_membres() {
    $bdd = bdconnect();
    $sql = "SELECT * FROM emp_membre";
    $resultat = $bdd->query($sql);
    $resultat->setFetchMode(PDO::FETCH_ASSOC);
    while($row = $resultat->fetch()) {
       $retour[] = $row;
    }
    return $retour;
}

function get_All_com_pub()
{
    $bdd = bdconnect();
    $sql = "SELECT p.id_publication, p.texte AS publication_texte, m.nom AS auteur_pub
            FROM emp_publication p
            JOIN emp_membre m ON p.id_membre = m.id_membre
            ORDER BY p.id_publication DESC";
    $resultat = $bdd->query($sql);
    $resultat->setFetchMode(PDO::FETCH_ASSOC);

    $data = [];
    while ($pub = $resultat->fetch()) {
        $sql2 = "SELECT c.texte AS commentaire_texte, m.nom AS auteur_comm
                 FROM emp_commentaire c
                 JOIN emp_membre m ON c.id_membre = m.id_membre
                 WHERE c.id_publication = '" . $pub['id_publication'] . "'
                 ORDER BY c.id_commentaire ASC";
        $resultat2 = $bdd->query($sql2);
        $resultat2->setFetchMode(PDO::FETCH_ASSOC);

        $commentaires = [];
        while ($comm = $resultat2->fetch()) {
            $commentaires[] = $comm;
        }

        $pub['commentaires'] = $commentaires;
        $data[] = $pub;
    }

    return $data;
}
function get_insert_text_pub($session , $publication)
{
    $bdd = bdconnect();
    $sql = "INSERT INTO emp_publication (id_membre, texte) VALUES ('" . $session. "', '" . $publication . "')";
    $bdd->query($sql);

    $sql1 = "SELECT p.id_publication, p.texte, m.nom 
             FROM emp_publication p
             JOIN emp_membre m ON p.id_membre = m.id_membre
             ORDER BY p.id_publication DESC
             LIMIT 1";
    $resultat1 = $bdd->query($sql1);
    $resultat1->setFetchMode(PDO::FETCH_ASSOC);
    $row1 = $resultat1->fetch();
    return $row1; 
}
function get_insert_text_commentaire($session, $id_publication, $commentaire)
{
    $bdd = bdconnect();
    $sql2 = "INSERT INTO emp_commentaire (id_membre, id_publication, texte) VALUES ('" . $session . "', '" . $id_publication . "', '" . $commentaire . "')";
    $bdd->query($sql2);

    $sql3 = "SELECT c.id_commentaire, c.texte, m.nom 
             FROM emp_commentaire c
             JOIN emp_membre m ON c.id_membre = m.id_membre
             WHERE c.id_publication = '" . $id_publication . "'
             ORDER BY c.id_commentaire DESC
             LIMIT 1";
    $resultat3 = $bdd->query($sql3);
    $resultat3->setFetchMode(PDO::FETCH_ASSOC);
    $row3 = $resultat3->fetch();
    return $row3;
}
?>