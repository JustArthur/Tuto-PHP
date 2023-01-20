<?php
    //Début de la session
    session_start();

    //Fichier de connexion à la base de donnée
    include_once('php/database/connexionBD.php');

    //Fichiers pour l'import des class
    include_once('php/class/inscriptionClass.php');
    include_once('php/class/connexionClass.php');

    //Appel des class
    $_INSCRIPTION = new Inscription;
    $_CONNEXION = new Connexion;
?>