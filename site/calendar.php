<?php

if (!isset($_GET["y"]) && !isset($_GET["m"])) {
    header("Location: calendar.php?y=" . date("y") . "&m=" . date("m"));
    exit();
}
require "req/header.php";
?>

<main>
    <form action="php/monthHandler.php" method="post">
        <button id="left" name="previous-month" type="submit"><i class="fas fa-caret-left"></i></button>
        <?php echo '<input name="month" value="' . $_GET["m"] . '" style="display:none;" />';
echo '<input name="year" value="' . $_GET["y"] . '" style="display:none;" />'; ?>
    </form>

    <section id="calendar">
        <h3>
            <!-- TODO: Month selector -->
            <form>
                <?php
setlocale(LC_TIME, "frc");
echo '<button id="month" type="submit">' .
utf8_encode(strftime("%B %Y", strtotime("20" . $_GET["y"] . "-" . $_GET["m"] . "-01"))) .
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
                <button onclick="closeWindow()">Ok</button>
            </div>
        </div>
    </section>

    <form action="php/monthHandler.php" method="post">
        <button id="right" name="next-month" type="submit"><i class="fas fa-caret-right"></i></button>
        <?php echo '<input name="month" value="' . $_GET["m"] . '" style="display:none;" />';
echo '<input name="year" value="' . $_GET["y"] . '" style="display:none;" />'; ?>
    </form>
</main>

<?php
require "req/footer.php";
?>