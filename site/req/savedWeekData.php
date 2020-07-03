<?php

require "php/dbHandler.php";

$query = 'SELECT *
    FROM tasks, (SELECT taskId, targetStartTime, targetEndTime, targetDate, targetQuantity, userId, firstname, lastname
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
    $dayTasks = array();

    while ($taskData != null && date("w", strtotime($taskData["targetDate"])) == $i) {
        $userInfo = array("userId" => $taskData["userId"], "firstname" => $taskData["firstname"], "lastname" => $taskData["lastname"]);

        $taskInstanceCreated = false;
        for ($j = 0; $j < sizeof($dayTasks); $j++) {
            if ($dayTasks[$j]["taskId"] == $taskData["taskId"]) {
                $taskInstanceCreated = true;
                array_push($dayTasks[$j]["users"], $userInfo);
            }
        }
        if (!$taskInstanceCreated) {
            array_push($dayTasks, array(
                "taskId" => $taskData["taskId"],
                "taskName" => $taskData["taskName"],
                "startTime" => $taskData["targetStartTime"],
                "endTime" => $taskData["targetEndTime"],
                "targetDate" => $taskData["targetDate"],
                "targetQuantity" => $taskData["targetQuantity"],
                "users" => array($userInfo),
            ));
        }
        $taskData = mysqli_fetch_assoc($weekTaskTable);
    }
    array_push($weekTasks, $dayTasks);
}

echo '<script type="text/javascript">var weekData = ' . json_encode($weekTasks) . ";</script>";