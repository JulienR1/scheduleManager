<?php

require "php/dbHandler.php";

addDays();

function addDays()
{
    $query = 'SELECT *
    FROM tasks, (SELECT taskId, targetStartTime, targetEndTime, targetDate, targetQuantity, firstname, lastname
                FROM dailytasktousers, users, dailytask
                WHERE users.id = dailytasktousers.userId
                    AND dailyTask.id = dailytasktousers.dailyTaskId
                    AND targetDate BETWEEN ? AND ?) AS A
    WHERE tasks.id = taskId
    ORDER BY targetDate, taskId';

    $date = $_GET["d"];
    $startDate = date("Y-m-d", strtotime($date));
    $endDate = date("Y-m-d", strtotime($startDate . " + 6 days"));

    $weekTaskTable = executeSQL($query, "ss", $startDate, $endDate);
    $taskData = mysqli_fetch_assoc($weekTaskTable);

    $weekTasks = array();
    $weekDays = array("Dimanche", "Lundi", "Mardi", "Mecredi", "Jeudi", "Vendredi", "Samedi");
    for ($i = 0; $i < 7; $i++) {
        echo '<div class="day shadow-bg-desktop" closed>';
        echo '<h4 onclick="toggleDayView(this)" class="shadow-bg">' . $weekDays[$i] . '</h4>';

        array_push($weekTasks, array());
        while ($taskData != null && date("w", strtotime($taskData["targetDate"])) == $i) {
            if (sizeof($weekTasks[$i]) == 0 || (isset($weekTasks[$i]["taskId"]) && $weekTasks[$i]["taskId"] != $taskData["taskId"])) {
                array_push($weekTasks[$i], array(
                    "taskId" => $taskData["taskId"],
                    "startTime" => $taskData["targetStartTime"],
                    "endTime" => $taskData["targetEndTime"],
                    "taskName" => $taskData["taskName"],
                    "users" => array(),
                ));
            } else {
                array_push($weekTasks[$i][sizeof($weekTasks[$i]) - 1], array("firstname" => $taskData["firstname"], "lastname" => $taskData["lastname"]));
            }
            $taskData = mysqli_fetch_assoc($weekTaskTable);
        }

        /*    while ($taskData != null && date("w", strtotime($taskData["targetDate"])) == $i) {
        $taskInfo = array(
        "taskId" => $taskData["taskId"],
        "startTime" => $taskData["targetStartTime"],
        "endTime" => $taskData["targetEndTime"],
        "taskName" => $taskData["taskName"],
        "users" => array());

        if (sizeof($tasks) > 0 && $tasks[sizeof($taskData) - 1]["taskId"] != $taskData["taskId"]) {
        if (sizeof($tasks) == 0) {
        $tasks = array($taskInfo);
        } else {
        array_push($tasks, $taskInfo);
        }
        }

        $userData = array(
        "firstname" => $taskData["firstname"],
        "lastname" => $taskData["lastname"]);
        if (sizeof($tasks[sizeof($tasks)]["users"]) == 0) {
        $tasks[sizeof($tasks)]["users"] = array($userData);
        } else {
        array_push($tasks[sizeof($tasks)]["users"], $userData);
        }

        $taskData = mysqli_fetch_assoc($weekTaskTable);
        $firstPass = false;
        }*/

        echo '</div>';
    }
}