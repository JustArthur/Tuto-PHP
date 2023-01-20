<?php
    require_once('include.php');

    if(isset($_SESSION['utilisateur'][0])) {
        header('Location: pages/panel');
        exit;
    }

    $erreur_password = '';
    $erreur_identifiant = '';

    if(!empty($_POST)) {
        extract($_POST);

        if(isset($_POST['connexion'])) {
            [$text_erreur, $erreur_password, $erreur_identifiant, $class_erreur] = $_CONNEXION->connexion_utilisateur($identifiant, $password);
        }
    }
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="style/index.css">

    <title>Connexion · Tuto PHP</title>
</head>
<body>
    <div class="cercle-1"></div>
    <main>
        <h1>Connexion à mon compte</h1>

        <form method="POST">

            <?php if(isset($text_erreur)) { ?>
                <div class="text <?= $class_erreur ?>"><?= $text_erreur ?></div>
            <?php } ?>

            <input type="text" class="<?= $erreur_identifiant ?>" name="identifiant" maxlength="20" placeholder="Identifiant">

            <input type="password" class="<?= $erreur_password ?>" name="password" maxlength="32" placeholder="Mot de passe">

            <button type="submit" name="connexion">Se connecter</button>

        </form>

        <p>Vous n'avez pas de compte ? <a href="register">S'inscrire</a></p>
    </main>
    <div class="cercle-2"></div>
</body>
</html>