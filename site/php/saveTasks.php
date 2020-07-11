<?php

session_start();
if (isset($_POST["save-tasks"]) && isset($_SESSION["userID"]) && isset($_SESSION["currentSetupDate"])) {

    require "dbHandler.php";

    $today = date("Y-m-d");
    $startDate = $_SESSION["currentSetupDate"];
    $endDate = date("Y-m-d", strtotime($startDate . " + 6 days"));

    if (strtotime($today) > strtotime($endDate)) {
        header("Location: ../calendar-setup.php?d=" . $today . "&flag=pastDates" . $endDate);
        exit();
    }

    if (strtotime($today) > strtotime($startDate)) {
        $startDate = date("Y-m-d", strtotime($today . " + 1 day"));
    }

    $deletePreviousQueries = array('DELETE FROM dailytasktousers
    WHERE dailyTaskID IN (SELECT id
                        FROM dailytask
                        WHERE targetDate BETWEEN ? AND ?)',
        'DELETE FROM dailytask WHERE targetDate BETWEEN ? AND ?');
    executeSQL($deletePreviousQueries[0], "ss", $startDate, $endDate);
    executeSQL($deletePreviousQueries[1], "ss", $startDate, $endDate);

    $insertQueries = array('INSERT INTO dailytask (taskId, targetStartTime, targetEndTime, targetQuantity, targetDate)
                        VALUES (?, ?, ?, ?, ?)',
        'INSERT INTO dailytasktousers (dailyTaskId, userId) VALUES (?, ?)');

    $noTask = false;
    $noUsers = false;
    $partial = false;
    $dayCount = 0;
    foreach ($_POST["week"] as $day) {
        $referenceCount = -1;
        $sameSize = true;
        foreach ($day as $data) {
            if ($referenceCount == -1) {
                $referenceCount = sizeof($data);
            } else if (sizeof($data) != $referenceCount) {
                $sameSize = false;
            }
        }

        if ($sameSize) {
            for ($i = 0; $i < $referenceCount; $i++) {
                if ($day["taskName"][$i] != -1) {
                    $containedUsers = false;

                    $targetDate = date("Y-m-d", strtotime($startDate . "+" . $dayCount . " days"));
                    executeSQL($insertQueries[0], "issis", $day["taskName"][$i], $day["startTime"][$i], $day["endTime"][$i], $day["qty"][$i], $targetDate);

                    $idTable = executeSQL("SELECT id FROM dailyTask WHERE targetDate = ? AND taskId = ? AND targetStartTime = ? AND targetEndTime = ? AND targetQuantity = ?", "sissi",
                        $targetDate, $day["taskName"][$i], $day["startTime"][$i], $day["endTime"][$i], $day["qty"][$i]);
                    $id = mysqli_fetch_assoc($idTable)["id"];

                    foreach ($day["user-selection"][$i] as $user) {
                        if ($user != -1) {
                            $containedUsers = true;

                            executeSQL($insertQueries[1], "si", $id, $user);
                            $partial = true;
                        }
                    }
                    if (!$containedUsers) {
                        $noUsers = true;
                    }
                } else {
                    $noTask = true;
                }
            }
        }
        $dayCount += 1;
    }

    if ($noTask || $noUsers) {
        header("Location: ../calendar-setup.php?d=" . $startDate .
            "&save=" . ($partial == true ? "partial" : "none") .
            "&users=" . (!$noUsers ? 1 : 0) .
            "&tasks=" . (!$noTask ? 1 : 0));
        exit();
    }
    header("Location: ../calendar-setup.php?d=" . $startDate . "&save=success");
    exit();
}
header("Location: /");
exit();