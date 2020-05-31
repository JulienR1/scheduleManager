<?php

session_start();

$pageToLoad = isset($_SESSION["currentPage"]) ? $_SESSION["currentPage"] : "/index.php";

session_unset();
session_destroy();
header("Location: " . $pageToLoad);
exit();