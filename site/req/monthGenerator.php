<?php

$month = max(1, min($_GET["m"], 12));
$year = max(18, min($_GET["y"], 22));

$numberOfDaysInMonth = date("t", strtotime("20" . $year . "-" . $month . "-01"));
$numberOfDayInPreviousMonth = date("t", strtotime("2020-" . (($month + 10) % 12 + 1) . "-01"));
$startOfMonthIndex = date("N", strtotime("20" . $year . "-" . $month . "-01"));

$calendarData = array();

$index = 0;
for ($i = 0; $i < $startOfMonthIndex; $i++) {
    $calendarData[$index++] = $numberOfDayInPreviousMonth - $startOfMonthIndex + $i + 1;
}
for ($i = 1; $i <= $numberOfDaysInMonth; $i++) {
    $calendarData[$index++] = $i;
}
for ($i = $index; $i < 42; $i++) {
    $calendarData[$index++] = $index - $numberOfDaysInMonth - $startOfMonthIndex;
}

require "php/dbHandler.php";

$startDate = "20" . $year . "-" . ($month - 1) . "-" . $calendarData[0];
$endDate = "20" . $year . "-" . ($month + 1) . "-" . $calendarData[41];

$queryAllTasks = "SELECT dailyTask.*, targetDate
                FROM dailyTask, daytodailytask
                WHERE id=dailyTaskID AND targetDate BETWEEN ? AND ?
                ORDER BY targetDate, targetStartTime";
$taskTable = executeSQL($queryAllTasks, "ss", $startDate, $endDate);

while (($task = mysqli_fetch_assoc($taskTable)) != null) {
    echo $task["taskName"];
}