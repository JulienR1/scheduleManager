<?php

// General variables for generation

$month = max(1, min($_SESSION["month"], 12));
$year = max(18, min($_SESSION["year"], 22));

$previousMonth = (($month + 10) % 12 + 1);
$nextMonth = (($month + 12) % 12 + 1);

$numberOfDaysInMonth = date("t", strtotime("20" . $year . "-" . $month . "-01"));
$numberOfDayInPreviousMonth = date("t", strtotime("2020-" . $previousMonth . "-01"));
$startOfMonthIndex = date("N", strtotime("20" . $year . "-" . $month . "-01"));

$calendarData = array();

// Get the corresponding days to fill the 6 weeks of the calendar month

$index = 0;
for ($i = 0; $i < $startOfMonthIndex; $i++) {
    $calendarData[$index++] = "20" . $year . "-" . $previousMonth . "-" . ($numberOfDayInPreviousMonth - $startOfMonthIndex + $i + 1);
}
for ($i = 1; $i <= $numberOfDaysInMonth; $i++) {
    $calendarData[$index++] = "20" . $year . "-" . $month . "-" . $i;
}
for ($i = $index; $i < 42; $i++) {
    $calendarData[$index++] = "20" . $year . "-" . $nextMonth . "-" . ($index - $numberOfDaysInMonth - $startOfMonthIndex);
}

// Download task data for the current calendar

require "php/dbHandler.php";

$taskTable = "";
$showEveryone = isset($_SESSION["userID"]) && isset($_GET["filter"]) && $_GET["filter"] == "all";

$queryTasks = "SELECT A.*, firstname, lastname
            FROM users, (SELECT dailytask.id, taskName, targetStartTime, targetEndTime, targetQuantity, targetDate
                        FROM dailytask, tasks
                        WHERE tasks.id = taskId AND targetDate BETWEEN ? AND ? " .
    ($showEveryone ? "" :
    " AND dailyTask.id IN (SELECT dailyTaskId FROM dailytasktousers WHERE userId=?)
                        AND targetDate IN (SELECT targetDate FROM dailytasktousers, dailytask WHERE dailytask.id = dailyTaskId AND userId=?) ")
    . "ORDER BY targetDate ASC, targetStartTime ASC) AS A
            LEFT JOIN dailytasktousers ON dailytasktousers.dailyTaskId = A.id
            WHERE users.id = dailytasktousers.userId";

if ($showEveryone) {
    $taskTable = executeSQL($queryTasks, "ss", $calendarData[0], $calendarData[sizeof($calendarData) - 1]);
} else {
    $userID = isset($_SESSION["userID"]) ? $_SESSION["userID"] : "";
    $taskTable = executeSQL($queryTasks, "ssii", $calendarData[0], $calendarData[sizeof($calendarData) - 1], $userID, $userID);
}

$currentTask = mysqli_fetch_assoc($taskTable);
for ($i = 0; $i < sizeof($calendarData); $i++) {
    $calendarData[$i] = array("date" => $calendarData[$i], "tasks" => array());

    while ($currentTask != null && strtotime($currentTask["targetDate"]) == strtotime($calendarData[$i]["date"])) {
        $currentTaskId = $currentTask["id"];
        $users = array();
        $tasks = array();

        while ($currentTask != null && $currentTaskId == $currentTask["id"]) {
            array_push($users, array($currentTask["firstname"], $currentTask["lastname"]));

            $tasks = array(
                "id" => $currentTask["id"],
                "name" => $currentTask["taskName"],
                "startTime" => $currentTask["targetStartTime"],
                "endTime" => $currentTask["targetEndTime"],
                "quantity" => $currentTask["targetQuantity"],
                "users" => $users,
            );

            $currentTask = mysqli_fetch_assoc($taskTable);
        }
        array_push($calendarData[$i]["tasks"], $tasks);
    }
}

// Generate html

echo '<table><tbody>';
echo '<tr><th>D</th><th>L</th><th>M</th><th>M</th><th>J</th><th>V</th><th>S</th></tr>';
for ($i = 0; $i < 6; $i++) {
    echo '<tr>';
    for ($j = 0; $j < 7; $j++) {
        $index = 7 * $i + $j;
        $isActive = date("m", strtotime($calendarData[$index]["date"])) == $month;
        echo '<td' . (!$isActive ? ' unactive' : '') . ' onclick="openDateInfos(\'' . $calendarData[$index]["date"] . '\')"' . '>';
        echo '<h4>' . date("j", strtotime($calendarData[$index]["date"])) . '</h4>';
        if (isset($_SESSION["userID"])) {
            if ($calendarData[$index]["tasks"] != null) {
                echo '<div class="wrapper">';
                foreach ($calendarData[$index]['tasks'] as $task) {
                    echo '<p>' . $task['name'] . '</p>';
                }
                echo '</div>';
            }
        }
        echo '</td>';
    }
    echo '</tr>';
}
echo '</tbody></table>';