<?php

$today = date("Y-m-d");
if (isset($_SESSION["currentSetupDate"])) {
    $date = $_SESSION["currentSetupDate"];
} else {
    $date = $currentDate;
}

$weekdays = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi");
$dayTemplate = '<div class="day shadow-bg-desktop" closed>
                    <h4 onclick="toggleDayView(this)" class="shadow-bg">%s</h4>
                    <div class="wrapper shadow-bg-cell" dayId="%u" %s>
                        <button type="button" class="addButton"><i class="fas fa-plus"></i></button>
                    </div>
                </div>';

for ($i = 0; $i < sizeof($weekdays); $i++) {
    $enabled = strtotime($date . " + " . $i . " days") > strtotime($today);
    echo sprintf($dayTemplate, $weekdays[$i], $i, $enabled ? "" : " readonly");
}