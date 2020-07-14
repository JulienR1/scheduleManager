<?php

require "dbHandler.php";

if (isset($_POST["save-users"])) {
    if (!isset($_POST["userCheck"])) {
        if (executeSafeSQL("UPDATE users SET isActive = 0")) {
            successExit();
        } else {
            failExit();
        }
    } else {
        $checkedUsers = $_POST["userCheck"];
        $activeUsers = "";
        foreach ($checkedUsers as $activeUserId) {
            if (is_numeric($activeUserId)) {
                $activeUsers .= $activeUserId . ",";
            }
        }
        if (strlen($activeUsers) > 0) {
            $activeUsers = substr($activeUsers, 0, -1);
            $saveActive = executeSafeSQL("UPDATE users SET isActive = 1 WHERE id IN (" . $activeUsers . ")");
            $saveInactive = executeSafeSQL("UPDATE users SET isActive = 0 WHERE id NOT IN (" . $activeUsers . ")");
            if ($saveActive && $saveInactive) {
                successExit();
            } else {
                failExit();
            }
        } else {
            failExit();
        }
    }
}
if (isset($_POST["save-tasks"])) {
    $tasks = $_POST["taskNames"];

    $taskIds = executeSafeSQL("SELECT id FROM tasks ORDER BY taskName ASC");
    $currentTaskId = "";
    $index = 0;
    while (($currentTaskId = mysqli_fetch_assoc($taskIds)) != null) {
        if (strlen($tasks[$index]) > 0) {
            executeSQL("UPDATE tasks SET taskName = ? WHERE id = " . $currentTaskId["id"], "s", $tasks[$index]);
        }
        $index += 1;
    }
    while ($index < sizeof($tasks)) {
        executeSQL("INSERT INTO tasks (taskName) VALUES (?)", "s", $tasks[$index]);
        $index += 1;
    }
    successExit();
}
failExit();

function successExit()
{
    header("Location: ../general-settings.php?s=success");
    exit();
}

function failExit()
{
    header("Location: ../general-settings.php?s=fail");
    exit();
}