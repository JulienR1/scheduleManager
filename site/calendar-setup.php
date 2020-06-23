<?php
require "req/header.php";

if (!isset($_SESSION["userID"]) || !$_SESSION["isAdmin"]) {
    header("Location: /");
}

$date = date("Y-m-d");
if (isset($_GET["d"]) && !$_GET["d"] == "") {
    $date = $_GET["d"];
} else {
    header("Location: calendar-setup.php?d=" . $date);
}
?>

<main>
    <form id="calendar-setup">
        <h3 class="shadow-bg-desktop">
            <div class="container shadow-bg-cell">
                <div id="month-selection">
                    <label for="month-dropdown">Mois: </label>
                    <select type="submit" id="month-dropdown">
                        <?php
$months = array("Janvier", "Février", "Mars", "Avril", "Mai", "Juin", "Juillet", "Août", "Septembre", "Octobre", "Novembre", "Décembre");
for ($i = 0; $i < sizeof($months); $i++) {
    echo '<option value="' . $i . '"' . (date("m") == ($i + 1) ? ' selected="selected" ' : "") . '>' . $months[$i] . '</option>';
}
?>
                    </select>
                </div>
                <?php require "req/header-toggle.php"?>
            </div>
            <div class="container">
                <div id="weekday-selection" class="shadow-bg-cell">
                    <label for="weekday-dropdown">Semaine du: </label>
                    <?php
echo '<input type="text" value="' . date("j", strtotime($date)) . '" id="weekday-dropdown">';
?>
                </div>
            </div>
        </h3>

        <div id="day-container">
            <?php require "req/dayGenerator.php";?>
            <div class="task">
                <button onclick="removeTask(this)" type="button" class="cancel"><i class="fas fa-times"></i></button>
                <div class="time">
                    <input type="text" class="timeInput startTime" placeholder="Début">
                    <p>-</p>
                    <input type="text" class="timeInput endTime" placeholder="Fin">
                </div>
                <div class="title">
                    <select name="taskName" id="taskName">
                        <option value="Asperges">Asperges</option>
                        <option value="Fleur de fraises">Fleurs de fraises</option>
                    </select>
                    <div id="qty">
                        <span>(</span>
                        <input type="text" placeholder="Qté">
                        <span>)</span>
                    </div>
                </div>
                <ul>
                    <li>
                        <select name="user1" class="userSelection">
                            <option selected="selected">Sélectionner..</option>
                            <option value="user1">Filip</option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </form>
</main>

<?php
require "req/footer.php";
?>