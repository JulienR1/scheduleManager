<?php
session_start();
$_SESSION["currentPage"] = $_SERVER["PHP_SELF"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ferme les Vieilles Forges</title>

    <link rel="stylesheet" href="css/base.css">
    <link rel="stylesheet" href="css/header/header.css">
    <link rel="stylesheet" href="css/header/connection.css">

    <script src="https://kit.fontawesome.com/df8eedba6f.js" crossorigin="anonymous"></script>
</head>

<body>

    <header>
        <h1><a href="/">Ferme<br>les Vieilles Forges</a></h1>

        <figure>
            <div class="wrapper">
                <?php
if (isset($_SESSION["userID"])) {
    if (isset($_SESSION["userImg"])) {
        echo '<img src="' . $_SESSION["userImg"] . '" alt="Face">';
    } else {
        echo '<i class="fas fa-user"></i>';
    }
}
?>
                <figcaption>
                    <div class="wrapper">
                        <?php
echo '<div id="name">';
if (isset($_SESSION["userFirstname"]) && isset($_SESSION["userLastname"])) {
    echo $_SESSION["userFirstname"] . "<br><b>" . $_SESSION["userLastname"] . "</b>";
}
echo '</div>';

if (!isset($_SESSION["userID"])) {
    echo '<button display id="login-button" onclick="openLogin()">Se connecter</button>';
} else {
    echo '<form action="php/logout.php" method="post">
            <button type="submit" name="logout-submit">Déconnexion</button>
        </form>';
}
?>
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
        <form action="php/login.php" method="post">
            <input type="text" name="email" placeholder="Courriel">
            <input type="password" name="password" placeholder="Mot de passe">
            <button type="submit" name="login-submit">Ok</button>
        </form>

        <button class="navButton" onclick="openSignup()">Créer un compte</button>
        <button class="navButton" onclick="openForgotPassword()">Mot de passe oublié?</button>
    </section>

    <section id="signup">
        <h2>Créer un compte</h2>
        <form action="php/signup.php" method="post">
            <input type="text" name="firstname" placeholder="Prénom">
            <input type="text" name="lastname" placeholder="Nom de famille">
            <input type="text" name="email" placeholder="Courriel">
            <input type="password" name="password" placeholder="Mot de passe">
            <input type="password" name="password-repeat" placeholder="Confirmer le mot de passe">
            <button type="submit" name="signup-submit">S'inscrire</button>
        </form>
    </section>

    <div id="dark-overlay"></div>