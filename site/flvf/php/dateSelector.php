<?php
if (isset($_GET["date-selection-submit"])) {
    if (isset($_GET["selected-month"]) && isset($_GET["selected-day"])) {
        $month = $_GET["selected-month"] + 1;
        $day = $_GET["selected-day"];
        if (checkdate($month, $day, date("Y"))) {
            $date = date("Y") . "-" . $month . "-" . $day;
            $daysToRemove = date("w", strtotime($date));
            $date = date("Y-m-d", strtotime($date . " - " . $daysToRemove . " days"));

            header("Location: ../calendar-setup.php?d=" . $date);
            exit();
        }
    }
}
header("Location: ../calendar-setup.php?d=" . date("Y-m-d"));
exit();