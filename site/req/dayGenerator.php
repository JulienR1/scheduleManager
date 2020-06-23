<?php

require "php/dbHandler.php";

addDays();

function addDays()
{
    $weekDays = array("Dimanche", "Lundi", "Mardi", "Mecredi", "Jeudi", "Vendredi", "Samedi");
    for ($i = 0; $i < 7; $i++) {
        echo '<div class="day shadow-bg-desktop" closed>';
        echo '<h4 onclick="toggleDayView(this)" class="shadow-bg">' . $weekDays[$i] . '</h4>';
        addDayData($i);
        echo '</div>';
    }
}

function addDayData($dayId)
{
    echo '<div class="wrapper shadow-bg-cell">';

    $query = 'SELECT *
            FROM tasks, (SELECT taskId,  targetStartTime, targetEndTime, targetDate, targetQuantity, firstname, lastname
                        FROM dailytasktousers, users, dailytask
                        WHERE users.id = dailytasktousers.userId
                            AND dailyTask.id = dailytasktousers.dailyTaskId
                            AND targetDate BETWEEN ? AND ?) AS A
            WHERE tasks.id = taskId';

    $date = $_GET["d"];
    $startDate = date("Y-m-d", strtotime($date . " - " . date("w", strtotime($date)) . "days"));
    $endDate = date("Y-m-d", strtotime($startDate . " + 6 days"));

    $weekTaskTable = executeSQL($query, "ss", $startDate, $endDate);
    while (($taskData = mysqli_fetch_assoc($weekTaskTable)) != null) {
        if (date("w", strtotime($taskData["targetDate"])) == $dayId) {
            addTask($taskData);
        }
    }

// DEPLACER LE CALL VERS LA BD, IL EST FAIT 7x

    echo '</div>';
}

function addTask($taskData)
{
    print_r($taskData);
    echo '<div class="task">';

    echo '</div>';
}