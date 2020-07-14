<?php

session_start();
$pageToLoad = isset($_SESSION["currentPage"]) ? $_SESSION["currentPage"] : "/flvf/index.php";

if (isset($_POST["signup-submit"])) {

    require "dbHandler.php";

    $MIN_PASSWORD_LENGTH = 6;

    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $passwordRepeat = $_POST["password-repeat"];

    if (empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($passwordRepeat)) {
        header("Location: " . $pageToLoad . "?signup=f&err=emptyfields&fn=" . $firstname . "&ln=" . $lastname . "&m=" . $email);
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z,.'-]*$/", $firstname . $lastname)) {
        header("Location: " . $pageToLoad . "?signup=f&err=invaliddata");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: " . $pageToLoad . "?signup=f&err=invalidmail&fn=" . $firstname . "&ln=" . $lastname);
        exit();
    } else if (!preg_match("/^[a-zA-Z,.'-]*$/", $firstname . $lastname)) {
        header("Location: " . $pageToLoad . "?signup=f&err=invalidname&m=" . $email);
        exit();
    } else if (strlen($password) < $MIN_PASSWORD_LENGTH) {
        header("Location: " . $pageToLoad . "?signup=f&err=invalidpassword&fn=" . $firstname . "&ln=" . $lastname . "&m=" . $email);
        exit();
    } else if ($password !== $passwordRepeat) {
        header("Location: " . $pageToLoad . "?signup=f&err=passwordcheck&fn=" . $firstname . "&ln=" . $lastname . "&m=" . $email);
        exit();
    } else {
        $query = "SELECT id FROM users WHERE email=?";
        $userRows = executeSQL($query, "s", $email);
        if (mysqli_num_rows($userRows) > 0) {
            header("Location: " . $pageToLoad . "?signup=f&err=emailtaken&fn=" . $firstname . "&ln=" . $lastname);
            exit();
        } else {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users (firstname, lastname, email, pwd, creationDate, isAdmin, img) VALUES (?, ?, ?, ?, CURDATE(), FALSE, NULL)";
            executeSQL($query, "ssss", $firstname, $lastname, $email, $hashedPassword);

            $_SESSION["userID"] = mysqli_fetch_assoc(executeSQL("SELECT id FROM users WHERE email=?", "s", $email))["id"];
            $_SESSION["userFirstname"] = $firstname;
            $_SESSION["userLastname"] = $lastname;
            $_SESSION["isAdmin"] = false;
            $_SESSION["userImg"] = null;

            header("Location: " . $pageToLoad . "?signup=s");
            exit();
        }
    }
} else {
    header("Location: " . $pageToLoad);
    exit();
}