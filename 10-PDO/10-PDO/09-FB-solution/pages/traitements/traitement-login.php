<?php
$login = $_POST['login'];
$motdepasse = $_POST['motdepasse'];

sleep(1);

if ($login == "admin" && $motdepasse == "1234") {
    $data = [
        'reponse' => 1,
        'login' => $login
    ];
    echo json_encode($data);
} else {
    $data = [
        'reponse' => 0
    ];
    echo json_encode($data);
}
