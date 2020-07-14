<?php
require "req/header.php";

if (!isset($_SESSION["month"])) {
    $_SESSION["month"] = date("m");
    $_SESSION["year"] = date("y");
}
?>

<main>
    <form action="php/monthHandler.php" method="post">
        <button id="left" name="previous-month" type="submit"><i class="fas fa-caret-left"></i></button>
    </form>

    <section id="calendar">
        <h3>
            <!-- TODO: Month selector -->
            <form>
                <?php
setlocale(LC_TIME, "frc");
echo '<button id="month" type="submit">' .
utf8_encode(strftime("%B %Y", strtotime("20" . $_SESSION["year"] . "-" . $_SESSION["month"] . "-01"))) .
    '</button>';
?>
            </form>
            <?php require "req/header-toggle.php"?>
        </h3>
        <?php require "req/monthGenerator.php";?>
    </section>

    <section id="calendar-details">
        <h4>8</h4>
        <div id="container">
            <div id="scroller"></div>
            <div>
                <button onclick="closeDateInfos()">Ok</button>
            </div>
        </div>
    </section>

    <form action="php/monthHandler.php" method="post">
        <button id="right" name="next-month" type="submit"><i class="fas fa-caret-right"></i></button>
    </form>
</main>

<?php
require "req/footer.php";
?>