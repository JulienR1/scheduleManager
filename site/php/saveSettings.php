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