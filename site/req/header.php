<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
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

    <?php
if (strpos($_SESSION["currentPage"], "calendar.php") !== false) {
    echo '<link rel="stylesheet" href="css/calendar/calendar.css">';
    echo '<link rel="stylesheet" href="css/calendar/calendar-details.css">';
}
if (strpos($_SESSION["currentPage"], "calendar-setup.php") !== false) {
    echo '<link rel="stylesheet" href="css/calendar-setup/calendar-setup.css">';
}
?>

    <script src="https://kit.fontawesome.com/df8eedba6f.js" crossorigin="anonymous"></script>
</head>

<body>

    <header <?php if (!(isset($_GET["login"]) && $_GET["login"] == "f") || (isset($_GET["signup"]) && $_GET["signup"] == "f")) {
    echo "isDocked";
}
?>>
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
                <li>
                    <a href="calendar.php">Horaire</a>
                    <?php
if (isset($_SESSION["userID"])) {
    echo '
                    <ul>
                        <li><a href="calendar.php">Seulement moi</a></li>
                        <li><a href="calendar.php?filter=all">Tout le monde</a></li>' .
        (($_SESSION["isAdmin"]) ? '<li><a href="calendar-setup.php">Faire l\'horaire</a></li>' : "")
        . '</ul>';
}
?>
                </li>
                <li><a href="#">Mes dispos</a></li>
                <li><a href="#">Mes heures</a></li>
            </ul>
        </nav>
    </header>

    <?php
function getDataFromURL($tag)
{
    if (isset($_GET[$tag])) {
        return $_GET[$tag];
    }
}
?>

    <section id="login" <?php if (isset($_GET["login"]) && $_GET["login"] == "f") {echo 'active';}?>>
        <h2>Se connecter</h2>

        <?php if (getDataFromURL("err") == "emptyfields") {
    echo '<p class="error-msg">Une valeur est requise pour tous les champs.</p>';}?>

        <form action="php/login.php" method="post">
            <input type="text" name="email" placeholder="Courriel">
            <?php if (getDataFromURL("err") == "nouser") {
    echo '<p class="error-msg">Aucun utilisateur enregistré avec ce courriel.</p>';}?>

            <input type="password" name="password" placeholder="Mot de passe">
            <?php if (getDataFromURL("err") == "invalidpassword") {
    echo '<p class="error-msg">Le mot de passe est erroné.</p>';}?>

            <button type="submit" name="login-submit">Connexion</button>
        </form>

        <button class="navButton" onclick="openSignup()">Créer un compte</button>
        <button class="navButton" onclick="openForgotPassword()">Mot de passe oublié?</button>
    </section>

    <section id="signup" <?php if (isset($_GET["signup"]) && $_GET["signup"] == "f") {echo 'active';}?>>
        <h2>Créer un compte</h2>
        <?php if (getDataFromURL("err") == "emptyfields") {
    echo '<p class="error-msg">Une valeur est requise pour tous les champs.</p>';} else if (getDataFromURL("err") == "invaliddata") {
    echo '<p class="error-msg">Le nom et le courriel sont invalides.</p>';}?>

        <form action="php/signup.php" method="post">
            <input type="text" name="firstname" placeholder="Prénom" value="<?php echo getDataFromURL("fn"); ?>">
            <input type="text" name="lastname" placeholder="Nom de famille" value="<?php echo getDataFromURL("ln"); ?>">
            <?php if (getDataFromURL("err") == "invalidname") {
    echo '<p class="error-msg">Les noms doivent être composés de lettres uniquement.</p>';}?>

            <input type="text" name="email" placeholder="Courriel" value="<?php echo getDataFromURL("m"); ?>">
            <?php if (getDataFromURL("err") == "invalidmail" || getDataFromURL("err") == "emailtaken") {
    echo '<p class="error-msg">Le courriel est invalide ou est déjà enregistré.</p>';}?>

            <input type="password" name="password" placeholder="Mot de passe">
            <?php if (getDataFromURL("err") == "invalidpassword") {
    echo '<p class="error-msg">Un mot de passe doit contenir au moins 6 caractères.</p>';}?>

            <input type="password" name="password-repeat" placeholder="Confirmer le mot de passe">
            <?php if (getDataFromURL("err") == "passwordcheck") {
    echo '<p class="error-msg">Les mots de passe ne correspondent pas.</p>';}?>

            <button type="submit" name="signup-submit">S'inscrire</button>
        </form>
    </section>

    <?php
echo '<div ' . (((isset($_GET["login"]) && $_GET["login"] == "f") || (isset($_GET["signup"])) && $_GET["signup"] == "f") ? 'active' : '') . ' id="dark-overlay"></div>';
?>