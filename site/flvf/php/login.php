<?php

session_start();
$pageToLoad = isset($_SESSION["currentPage"]) ? $_SESSION["currentPage"] : "/flvf/index.php";

if (isset($_POST["login-submit"])) {

    require "dbHandler.php";

    $email = $_POST["email"];
    $password = $_POST["password"];

    if (empty($email) || empty($password)) {
        header("Location: " . $pageToLoad . "?login=f&err=emptyfields");
        exit();
    } else {
        $query = "SELECT * FROM users WHERE email=?";
        $userData = executeSQL($query, "s", $email);
        if ($row = mysqli_fetch_assoc($userData)) {
            $passwordCheck = password_verify($password, $row["pwd"]);
            if ($passwordCheck == false || $passwordCheck != true) {
                header("Location: " . $pageToLoad . "?login=f&err=invalidpassword");
                exit();
            } else {
                $_SESSION["userID"] = $row["id"];
                $_SESSION["userFirstname"] = $row["firstname"];
                $_SESSION["userLastname"] = $row["lastname"];
                $_SESSION["userImg"] = $row["img"];
                $_SESSION["isAdmin"] = $row["isAdmin"];

                header("Location: " . $pageToLoad . "?login=s");
                exit();
            }
        } else {
            header("Location: " . $pageToLoad . "?login=f&err=nouser");
            exit();
        }
    }

} else {
    header("Location: " . $pageToLoad);
    exit();
}