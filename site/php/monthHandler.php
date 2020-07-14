<?php
$goingBack = isset($_POST["previous-month"]);
$goingForward = isset($_POST["next-month"]);

if ($goingBack || $goingForward) {
    session_start();
    $year = $_SESSION["year"];

    if ($goingBack) {
        $month = ($_SESSION["month"] + 10) % 12 + 1;
        if ($month == 12) {
            $year--;
        }
    } else if ($goingForward) {
        $month = ($_SESSION["month"] + 12) % 12 + 1;
        if ($month == 1) {
            $year++;
        }
    }

    $_SESSION["month"] = $month;
    $_SESSION["year"] = $year;
}
header("Location: ../calendar.php");
exit();