<?php
$goingBack = isset($_POST["previous-month"]);
$goingForward = isset($_POST["next-month"]);

if ($goingBack || $goingForward) {
    $year = $_POST["year"];

    if ($goingBack) {
        $month = ($_POST["month"] + 10) % 12 + 1;
        if ($month == 12) {
            $year--;
        }
    } else if ($goingForward) {
        $month = ($_POST["month"] + 12) % 12 + 1;
        if ($month == 1) {
            $year++;
        }
    }

    header("Location: ../calendar.php?y=" . $year . "&m=" . $month);
} else {
    header("Location: ../calendar.php?y=" . date("y") . "&m=" . date("m"));
    exit();
}