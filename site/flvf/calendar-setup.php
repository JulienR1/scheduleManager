<?php
require "req/header.php";

if (!isset($_SESSION["userID"]) || !$_SESSION["isAdmin"]) {
    header("Location: /");
}

$date = date("Y-m-d");
if (isset($_GET["d"]) && !$_GET["d"] == "") {
    $date = $_GET["d"];
}
$daysToRemove = date("w", strtotime($date));
$newDate = date("Y-m-d", strtotime($date . " - " . $daysToRemove . " days"));
if ($newDate != $date) {
    if (!isset($_GET["err"])) {
        header("Location: calendar-setup.php?d=" . $newDate);
        exit();
    }
}
$_SESSION["currentSetupDate"] = $date;

?>

<main>
    <div id="calendar-setup">
        <form action="php/dateSelector.php" method="get" autocomplete="off">
            <h3 class="shadow-bg-desktop">
                <div class="container shadow-bg-cell">
                    <div id="month-selection">
                        <label for="month-dropdown">Mois: </label>
                        <select id="month-dropdown" name="selected-month">
                            <?php
$months = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
for ($i = 0; $i < sizeof($months); $i++) {
    echo '<option value="' . $i . '"' . (date("m", strtotime($date)) == ($i + 1) ? ' selected="selected" ' : "") . '>' . $months[$i] . '</option>';
}
?>
                        </select>
                    </div>
                    <?php require "req/header-toggle.php"?>
                </div>
                <div class="container" id="weekday-container">
                    <div id="weekday-selection" class="shadow-bg-cell">
                        <label for="weekday-dropdown">Semaine du: </label>
                        <?php
echo '<input type="text" value="' . date("j", strtotime($date)) . '" id="weekday-dropdown" name="selected-day">';
?>
                    </div>
                </div>
                <button type="submit" name="date-selection-submit" class="shadow-bg-cell">
                    <i class="fas fa-search"></i>
                </button>
            </h3>
        </form>

        <?php
$msgs = array();
if (isset($_GET["err"])) {
    if ($_GET["err"] == "sql") {
        array_push($msgs, "<span error>Erreur lors de la sauvegarde</span>");
    }if ($_GET["err"] == "pastDates") {
        array_push($msgs, "<span error>Impossible de modifier le passé</span>");
    }
}
if (isset($_GET["save"]) && $_GET["save"] == "success") {
    array_push($msgs, "<span success>Sauvegarde complétée avec succès</span>");
}
if (isset($_GET["users"]) && $_GET["users"] == "1") {
    array_push($msgs, "<span error>Un tâche n'avait pas d'employés</span>");
}
if (isset($_GET["tasks"]) && $_GET["tasks"] == "1") {
    array_push($msgs, "<span error>Une tâche n'avait pas de sélection</span>");
}

if (sizeof($msgs) > 0) {
    echo "<p>";
    for ($i = 0; $i < sizeof($msgs); $i++) {
        echo $msgs[$i];
        if ($i < sizeof($msgs) - 1) {
            echo "<br>";
        }
    }
    echo "</p>";
}

?>

        <form action="php/saveTasks.php" method="post" onkeydown="return event.key != 'Enter'">
            <div id="day-container">
                <?php require "req/weekEdition.php";?>
            </div>
            <button id="save" class="shadow-bg" type="submit" name="save-tasks">Sauvegarder</button>
        </form>
    </div>
</main>

<?php
require "req/footer.php";
?>