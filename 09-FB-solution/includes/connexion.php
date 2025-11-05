<?php
function dbconnect() {
    $host = 'localhost';
    $dbname = 'FB';
    $user = 'root';
    $pass = '';

    try {
        $connect = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
        // Mode d'erreur PDO activé
        $connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $connect;
    } 
    catch (PDOException $e) {
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
?>