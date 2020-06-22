<?php

require "php/dbHandler.php";

$query = "SELECT firstname, lastname
        FROM users
        WHERE isActive = TRUE
        ORDER BY firstname ASC, lastname ASC";
$usersTable = executeSafeSQL($query);

$user = "";
$validUsers = array();
while(($user = mysqli_fetch_assoc($usersTable))!=null){
    array_push($validUsers, $user);
}

echo '<script type="text/javascript">var validUsers = ' . json_encode($validUsers) . ";</script>";