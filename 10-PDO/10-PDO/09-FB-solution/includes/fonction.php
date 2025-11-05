<?php
require "connexion.php";

function toUpperCase($mot)
{
    return strtoupper($mot);
}

function toLowerCase($mot)
{
    return strtolower($mot);
}

function formatNumber($number)
{
    return number_format($number, 1, ',', ' ');
}

function formatText($text)
{
    return nl2br(htmlspecialchars($text));
}

function insertPublication($publication, $auteur)
{
    $sql = "INSERT INTO publications (publication, auteur, date_publication) 
            VALUES ('%s', '%s', NOW())";

    $sql = sprintf($sql, $publication, $auteur);
    return mysqli_query(dbconnect(), $sql);
}

function duree($dateString)
{
    $timestampDate = strtotime($dateString);
    $timestampNow = time();

    $diff = abs($timestampNow - $timestampDate); 

    $jours = floor($diff / 86400);   
    $heures = floor(($diff % 86400) / 3600);
    $minutes = floor(($diff % 3600) / 60);
    // $secondes = $diff % 60;

    if ($jours == 0 && $heures == 0 && $minutes == 0) {
        return "À l'instant";
    } elseif ($jours == 0 && $heures == 0) {
        return "il y a $minutes min";
    } elseif ($jours == 0) {
        return "il y a $heures h";
    }

}

function getPublications()
{
    $sql = "SELECT * FROM publications ORDER BY date_publication DESC";
    $request = mysqli_query(dbconnect(), $sql);

    $publications = [];
    while ($row = mysqli_fetch_assoc($request)) {
        $publications[] = [
            'id' => $row['id'],
            'publication' => formatText($row['publication']),
            'auteur' => $row['auteur'],
            'date_publication' => $row['date_publication']
        ];
    }

    mysqli_free_result($request);

    return $publications;
}