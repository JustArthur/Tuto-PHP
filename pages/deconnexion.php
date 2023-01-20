<?php
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
    
    include_once('../include.php');

    $dateLog = date('Y-m-d H:i:s');

    $log = $DB->prepare("INSERT INTO logs (idUser, utilisateur, nomLog, dateLog) VALUES(?, ?, ?, ?)");
    $log->execute([$_SESSION['utilisateur'][0], $_SESSION['utilisateur'][1], "Déconnexion d'un utilisateur", $dateLog]);

    $_SESSION = array();

    session_destroy();

    header('Location: ../index');
    exit;
?>