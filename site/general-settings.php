<?php
require "req/header.php";

if (!isset($_SESSION["userID"]) || !$_SESSION["isAdmin"]) {
    header("Location: /");
}
?>

<main>
    <h1>Généralités</h1>

    <div id="general-container">
        <form action="php/saveSettings.php" method="post">
            <div class="list-container shadow-bg">
                <h2>
                    <span>Employés actifs</span>
                    <button type="submit" name="save-users">
                        <i class="far fa-save"></i>
                        <i class="fas fa-save"></i>
                    </button>
                </h2>

                <table class="input-list">
                    <tbody>
                        <tr>
                            <th>Nom</th>
                            <th>Courriel</th>
                            <th>Actif</th>
                        </tr>
                        <tr>
                            <td>Julien Rousseau</td>
                            <td>julrousseau20@gmail.com</td>
                            <td><input type="checkbox" checked></td>
                        </tr>
                        <tr>
                            <td>Fenelus Sylvain</td>
                            <td>fenelus@gmail.com</td>
                            <td><input type="checkbox"></td>
                        </tr>
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

                <table class="input-list">
                    <tbody>
                        <tr>
                            <th>Tâches</th>    
                        </tr>
                        <tr>
                            <td><input type="text"></td>
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