<?php
require "req/header.php";

if (!isset($_SESSION["userID"]) || !$_SESSION["isAdmin"]) {
    header("Location: /");
}
?>

<main>
    <h1>Généralités</h1>

    <?php
if (isset($_GET["s"]) && $_GET["s"] == "success") {
    echo '<p success>Sauvegarde complétée avec succès</p>';
}
if (isset($_GET["s"]) && $_GET["s"] == "fail") {
    echo '<p error>Erreur lors de la sauvegarde</p>';
}
?>

    <div id="general-container">
        <form action="php/saveSettings.php" method="post" autocomplete="off">
            <div class="list-container shadow-bg">
                <h2>
                    <span>Employés actifs</span>
                    <button type="submit" name="save-users">
                        <i class="far fa-save"></i>
                        <i class="fas fa-save"></i>
                    </button>
                </h2>

                <table class="input-list" id="user-list">
                    <tbody>
                        <tr>
                            <th>Nom</th>
                            <th>Courriel</th>
                            <th>Actif</th>
                        </tr>
                        <?php require "req/general-settings/users.php";?>
                    </tbody>
                </table>
            </div>

            <div class="list-container shadow-bg">
                <h2>
                    <span>Tâches possibles</span>
                    <button type="submit" name="save-tasks">
                        <i class="far fa-save"></i>
                        <i class="fas fa-save"></i>
                    </button>
                </h2>

                <table class="input-list" id="task-list">
                    <tbody>
                        <tr>
                            <th>Tâches</th>
                        </tr>
                        <?php require "req/general-settings/tasks.php";?>
                        <tr>
                            <td><input type="text" onfocusout="addNewTask(this)" placeholder="Ajouter.."></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</main>

<?php
require "req/footer.php";
?>