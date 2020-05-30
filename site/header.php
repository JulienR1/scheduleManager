<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ferme les Vieilles Forges</title>

    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/header/header.css">
    <link rel="stylesheet" href="css/header/connection.css">
</head>

<body>

    <header>
        <h1>Ferme<br>les Vieilles Forges</h1>

        <figure>
            <div class="wrapper">
                <img src="assets/img/elon_musk.jpg" alt="Face picture">
                <figcaption>
                    <div class="wrapper">
                        <div id="name">
                            Karol<br><b>Destroismaisons</b>
                        </div>
                        <button display id="login-button" onclick="openLogin()">Se connecter</button>
                        <form action="" method="post">
                            <button type="submit" name="logout-submit">Déconnexion</button>
                        </form>
                    </div>
                </figcaption>
            </div>

        </figure>

        <nav>
            <ul>
                <li><a href="#">Horaire</a></li>
                <li><a href="#">Mes dispos</a></li>
                <li><a href="#">Mes heures</a></li>
            </ul>
        </nav>
    </header>

    <section id="login">
        <h2>Se connecter</h2>
        <form action="" method="post">
            <input type="text" name="email" placeholder="Courriel">
            <input type="password" name="password" placeholder="Mot de passe">
            <button type="submit" name="login-submit">Ok</button>
        </form>

        <button class="navButton" onclick="openSignup()">Créer un compte</button>
        <button class="navButton" onclick="openForgotPassword()">Mot de passe oublié?</button>
    </section>

    <section id="signup">
        <h2>Créer un compte</h2>
        <form action="" method="post">
            <input type="text" name="firstname" placeholder="Prénom">
            <input type="text" name="lastname" placeholder="Nom de famille">
            <input type="text" name="email" placeholder="Courriel">
            <input type="password" name="password" placeholder="Mot de passe">
            <input type="password" name="password-repeat" placeholder="Confirmer le mot de passe">
            <button type="submit" name="signup-submit">S'inscrire</button>
        </form>
    </section>

    <div id="dark-overlay"></div>