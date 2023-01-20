<?php
    require_once('include.php');

    if(isset($_SESSION['utilisateur'][0])) {
        header('Location: pages/panel');
        exit;
    }

    if(!empty($_POST)) {
        extract($_POST);

        if(isset($_POST['inscription'])) {
            [$erreur] = $_INSCRIPTION->inscription_utilisateur($identifiant, $email, $new_password, $conf_password);
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

    <title>S'inscrice · Tuto PHP</title>
</head>
<body>
    <div class="cercle-1"></div>
    <main>
        <h1>Créer mon compte</h1>

        <form method="POST">

            <?php if(isset($erreur)) { ?>
                <div class="text-<?= $erreur[0] ?>"><?= $erreur[1] ?></div>
            <?php } ?>

            <input type="text" class="" name="identifiant" maxlength="20" placeholder="Identifiant">

            <input type="email" class="" name="email" maxlength="32" placeholder="Adresse mail">

            <input type="password" class="" name="new_password" maxlength="32" placeholder="Mot de passe">

            <input type="password" class="" name="conf_password" maxlength="32" placeholder="Confirmer le mot de passe">

            <button type="submit" name="inscription">S'inscrire</button>

        </form>

        <p>Vous avez déjà un compte ? <a href="index">Se connecter</a></p>
    </main>
    <div class="cercle-2"></div>
</body>
</html>