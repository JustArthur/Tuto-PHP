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

            <!-- <div class="text-erreur">Ceci est une erreur</div>
            <div class="text-success">Ceci est un success</div> -->

            <input type="text" class="" name="identifiant" placeholder="Identifiant">

            <input type="email" class="" name="email" placeholder="Adresse mail">

            <input type="password" class="" name="new-password" placeholder="Mot de passe">

            <input type="password" class="" name="conf_password" placeholder="Confirmer le mot de passe">

            <button type="submit" name="inscription">S'inscrice</button>

        </form>

        <p>Vous avez déjà un compte ? <a href="index">Se connecter</a></p>
    </main>
    <div class="cercle-2"></div>
</body>
</html>