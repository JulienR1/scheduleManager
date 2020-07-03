<?php

require "php/dbHandler.php";

$query = "SELECT id, firstname, lastname
        FROM users
        WHERE isActive = TRUE
        ORDER BY firstname ASC, lastname ASC";
$usersTable = executeSafeSQL($query);

$user = "";
$validUsers = array();
while (($user = mysqli_fetch_assoc($usersTable)) != null) {
    array_push($validUsers, $user);
}

$taskQuery = "SELECT id, taskName
            FROM tasks
            ORDER BY taskName ASC";
$taskTable = executeSafeSQL($taskQuery);

$task = "";
$validTasks = array();
while (($task = mysqli_fetch_assoc($taskTable)) != null) {
    array_push($validTasks, $task);
}

echo '<script type="text/javascript">var validUsers = ' . json_encode($validUsers) . "; var validTasks = " . json_encode($validTasks) . ";</script>";