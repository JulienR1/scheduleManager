<?php

if (isset($_SESSION["userID"]) && $_SESSION["isAdmin"]) {
    require "php/dbHandler.php";

    $query = "SELECT id, taskName FROM tasks ORDER BY taskName ASC";
    $taskTable = executeSafeSQL($query);

    $task = "";
    while (($task = mysqli_fetch_assoc($taskTable)) != null) {
        echo '<tr><td><input type="text" name="taskNames[]" value="' . $task["taskName"] . '"></td></tr>';
    }
}