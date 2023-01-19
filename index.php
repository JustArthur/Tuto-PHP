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

            <!-- <div class="text erreur">Ceci est une erreur</div>
            <div class="text success">Ceci est un success</div> -->

            <input type="text" class="" name="identifiant" placeholder="Identifiant">

            <input type="password" class="" name="password" placeholder="Mot de passe">

            <button type="submit" name="connexion">Se connecter</button>

        </form>

        <p>Vous n'avez pas de compte ? <a href="register">S'inscrire</a></p>
    </main>
    <div class="cercle-2"></div>
</body>
</html>