<?php

session_start();
date_default_timezone_set("America/Toronto");
if (isset($_POST["save-tasks"]) && isset($_SESSION["userID"]) && isset($_SESSION["currentSetupDate"])) {

    require "dbHandler.php";

    $today = date("Y-m-d");
    $weekStartDate = $_SESSION["currentSetupDate"];
    $endDate = date("Y-m-d", strtotime($weekStartDate . " + 6 days"));

    if (strtotime($today) > strtotime($endDate)) {
        header("Location: ../calendar-setup.php?d=" . $today . "&err=pastDates");
        exit();
    }

    $actualStartDate = $weekStartDate;
    if (strtotime($today) > strtotime($weekStartDate)) {
        $actualStartDate = date("Y-m-d", strtotime($today . " + 1 day"));
    }

    $deletePreviousQueries = array('DELETE FROM dailytasktousers
    WHERE dailyTaskID IN (SELECT id
                        FROM dailytask
                        WHERE targetDate BETWEEN ? AND ?)',
        'DELETE FROM dailytask WHERE targetDate BETWEEN ? AND ?');
    executeSQL($deletePreviousQueries[0], "ss", $actualStartDate, $endDate);
    executeSQL($deletePreviousQueries[1], "ss", $actualStartDate, $endDate);

    $insertQueries = array('INSERT INTO dailytask (taskId, targetStartTime, targetEndTime, targetQuantity, targetDate)
                        VALUES (?, ?, ?, ?, ?)',
        'INSERT INTO dailytasktousers (dailyTaskId, userId) VALUES (?, ?)');

    $noTask = false;
    $noUsers = false;
    $partial = false;
    $dayCount = 0;
    foreach ($_POST["week"] as $day) {
        $targetDate = date("Y-m-d", strtotime($weekStartDate . "+" . $dayCount . " days"));

        if (strtotime($targetDate) >= strtotime($actualStartDate)) {
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
                    if (!($day["taskName"][$i] == -1 && $day["startTime"][$i] == "00:00" && $day["endTime"][$i] == "00:00" && $day["qty"][$i] == 0)) {
                        if ($day["taskName"][$i] != -1) {
                            $containedUsers = false;

                            executeSQL($insertQueries[0], "issis", $day["taskName"][$i], $day["startTime"][$i], $day["endTime"][$i], $day["qty"][$i], $targetDate);

                            $idTable = executeSQL("SELECT id FROM dailyTask WHERE targetDate = ? AND taskId = ? AND targetStartTime = ? AND targetEndTime = ? AND targetQuantity = ?", "sissi",
                                $targetDate, $day["taskName"][$i], $day["startTime"][$i], $day["endTime"][$i], $day["qty"][$i]);
                            $id = mysqli_fetch_assoc($idTable)["id"];

                            for ($j = 0; $j < sizeof($day["user-selection"][$i]) - 1; $j++) {
                                $user = $day["user-selection"][$i][$j];
                                if ($user != -1) {
                                    $containedUsers = true;
                                    executeSQL($insertQueries[1], "si", $id, $user);
                                }
                            }
                            if (!$containedUsers) {
                                $noUsers = true;
                            }
                        } else {
                            /*       print_r($day);
                            echo "<br>";
                            echo "<br>";*/
                            $noTask = true;
                        }
                    }
                }
            }
        }
        $dayCount += 1;
    }
    if ($noTask || $noUsers) {
        header("Location: ../calendar-setup.php?d=" . $weekStartDate .
            "&users=" . ($noUsers ? 1 : 0) .
            "&tasks=" . ($noTask ? 1 : 0));
        exit();
    }
    header("Location: ../calendar-setup.php?d=" . $weekStartDate . "&save=success");
    exit();
}
header("Location: /");
exit();