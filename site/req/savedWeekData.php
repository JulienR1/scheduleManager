<?php

require "php/dbHandler.php";

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
for ($i = 0; $i < 7; $i++) {
    array_push($weekTasks, array());
    while ($taskData != null && date("w", strtotime($taskData["targetDate"])) == $i) {
        if (sizeof($weekTasks[$i]) == 0) {
            array_push($weekTasks[$i], array());
        }
        for ($j = 0; $j < sizeof($weekTasks[$i]); $j++) {
            if (sizeof($weekTasks[$i][$j]) == 0 || (isset($weekTasks[$i][$j]["taskId"]) && $weekTasks[$i][$j]["taskId"] != $taskData["taskId"])) {
                $currentTaskData = array(
                    "taskId" => $taskData["taskId"],
                    "startTime" => $taskData["targetStartTime"],
                    "endTime" => $taskData["targetEndTime"],
                    "taskName" => $taskData["taskName"],
                    "users" => array("firstname" => $taskData["firstname"], "lastname" => $taskData["lastname"]),
                );
                if (sizeof($weekTasks[$i][$j]) == 0) {
                    $weekTasks[$i][$j] = $currentTaskData;
                } else {
                    array_push($weekTasks[$i][$j], $currentTaskData);
                }
            } else {
                array_push($weekTasks[$i][sizeof($weekTasks[$i]) - 1], array("firstname" => $taskData["firstname"], "lastname" => $taskData["lastname"]));
            }
        }
        $taskData = mysqli_fetch_assoc($weekTaskTable);
    }
}

echo '<script type="text/javascript">var weekData = ' . json_encode($weekTasks) . ";</script>";