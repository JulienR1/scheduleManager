<?php

// General variables for generation

$month = max(1, min($_GET["m"], 12));
$year = max(18, min($_GET["y"], 22));

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

$queryAllTasks = "SELECT dailyTask.*, targetDate
                FROM dailyTask, daytodailytask
                WHERE id=dailyTaskID AND targetDate BETWEEN ? AND ?
                ORDER BY targetDate, targetStartTime";
$taskTable = executeSQL($queryAllTasks, "ss", $calendarData[0], $calendarData[sizeof($calendarData) - 1]);

// Assign tasks to calendar in array structure

$task = mysqli_fetch_assoc($taskTable);
for ($i = 0; $i < sizeof($calendarData); $i++) {
    $currentDate = $calendarData[$i];
    $calendarData[$i] = array("date" => $currentDate, "tasks" => null);
    if ($task != null) {
        while (strtotime($task["targetDate"]) == strtotime($currentDate)) {
            if ($calendarData[$i]["tasks"] == null) {
                $calendarData[$i]["tasks"] = array($task);
            } else {
                array_push($calendarData[$i]["tasks"], $task);
            }
            $task = mysqli_fetch_assoc($taskTable);
            if ($task == null) {
                break;
            }
        }
    }
}

// Generate html

echo '<table><tbody>';
echo '<tr><th>D</th><th>L</th><th>M</th><th>M</th><th>J</th><th>V</th><th>S</th></tr>';
for ($i = 0; $i < 6; $i++) {
    echo '<tr>';
    for ($j = 0; $j < 7; $j++) {
        $day = $calendarData[$i * 7 + $j];
        $isActive = date("m", strtotime($day["date"])) == $month;
        echo '<td ' . (!$isActive ? "unactive" : "") . ' onclick="openDateInfos(\'' . $day["date"] . '\')">';
        echo '<h4>' . date("j", strtotime($day["date"])) . '</h4>';
        if ($day['tasks'] != null) {
            echo '<div class="wrapper">';
            foreach ($day["tasks"] as $task) {
                echo '<p>' . $task["taskName"] . '</p>';
            }
            echo '</div>';
        }
        echo '</td>';
    }
    echo '</tr>';
}
echo '</tbody></table>';