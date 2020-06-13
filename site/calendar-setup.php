<?php
require "req/header.php";

if (!isset($_SESSION["userID"]) || !$_SESSION["isAdmin"]) {
    header("Location: /");
}
?>

<main>
    <form id="calendar-setup">
        <h3>
            <div class="container shadow-bg">
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
                <div id="weekday-selection" class="shadow-bg">
                    <label for="weekday-dropdown">Semaine du: </label>
                    <input type="text" id="weekday-dropdown">
                </div>
            </div>
        </h3>

        <div id="day-container">
            <div class="day shadow-bg">
                <h4 onclick="toggleDayView()" class="shadow-bg">Dimanche</h4>
                <div class="wrapper">
                    <div class="task">
                        <button onclick="removeTask()" type="button" id="cancel"><i class="fas fa-times"></i></button>
                        <div class="time">
                            <input type="text" class="startTime" placeholder="0:00">
                            <p>-</p>
                            <input type="text" class="endTime" placeholder="0:00">
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
                            <li><select name="user1" class="userSelection">
                                    <option value="user1">Filip</option>
                                </select></li>
                            <li><select name="user1" class="userSelection"></select></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="day shadow-bg" closed>
                <h4 onclick="toggleDayView()" class="shadow-bg">Lundi</h4>
            </div>

            <div class="day shadow-bg" closed>
                <h4 onclick="toggleDayView()" class="shadow-bg">Mardi</h4>
            </div>

            <div class="day shadow-bg" closed>
                <h4 onclick="toggleDayView()" class="shadow-bg">Mercredi</h4>
            </div>

            <div class="day shadow-bg" closed>
                <h4 onclick="toggleDayView()" class="shadow-bg">Jeudi</h4>
            </div>

            <div class="day shadow-bg" closed>
                <h4 onclick="toggleDayView()" class="shadow-bg">Vendredi</h4>
            </div>

            <div class="day shadow-bg" closed>
                <h4 onclick="toggleDayView()" class="shadow-bg">Samedi</h4>
            </div>

        </div>
    </form>
</main>

<?php
require "req/footer.php";
?>