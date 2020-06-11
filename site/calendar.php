<?php

/*if (!isset($_GET["y"]) && !isset($_GET["m"])) {
header("Location: calendar.php?y=" . date("y") . "&m=" . date("m"));
exit();
}*/
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
        <table>
            <tbody>
                <tr>
                    <th>D</th>
                    <th>L</th>
                    <th>M</th>
                    <th>M</th>
                    <th>J</th>
                    <th>V</th>
                    <th>S</th>
                </tr>
                <tr>
                    <td unactive>
                        <h4>30</h4>
                    </td>
                    <td unactive>
                        <h4>31</h4>
                    </td>
                    <td>
                        <h4>1</h4>
                    </td>
                    <td>
                        <h4>2</h4>
                        <div class="wrapper">
                            <p>Asperges</p>
                            <p>Fleur de fraises</p>
                            <p>Sarclage</p>
                        </div>
                    </td>
                    <td>
                        <h4>3</h4>
                    </td>
                    <td>
                        <h4>4</h4>
                    </td>
                    <td>
                        <h4>5</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>6</h4>
                    </td>
                    <td>
                        <h4>7</h4>
                    </td>
                    <td>
                        <h4>8</h4>
                    </td>
                    <td>
                        <h4>9</h4>
                    </td>
                    <td>
                        <h4>10</h4>
                    </td>
                    <td>
                        <h4>11</h4>
                    </td>
                    <td>
                        <h4>12</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>12</h4>
                    </td>
                    <td>
                        <h4>13</h4>
                    </td>
                    <td>
                        <h4>14</h4>
                    </td>
                    <td>
                        <h4>15</h4>
                    </td>
                    <td>
                        <h4>16</h4>
                    </td>
                    <td>
                        <h4>17</h4>
                    </td>
                    <td>
                        <h4>18</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>18</h4>
                    </td>
                    <td>
                        <h4>20</h4>
                    </td>
                    <td>
                        <h4>21</h4>
                    </td>
                    <td>
                        <h4>22</h4>
                    </td>
                    <td>
                        <h4>23</h4>
                    </td>
                    <td>
                        <h4>24</h4>
                    </td>
                    <td>
                        <h4>25</h4>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h4>26</h4>
                    </td>
                    <td>
                        <h4>27</h4>
                    </td>
                    <td>
                        <h4>28</h4>
                    </td>
                    <td>
                        <h4>29</h4>
                    </td>
                    <td>
                        <h4>30</h4>
                    </td>
                    <td>
                        <h4>31</h4>
                    </td>
                    <td unactive>
                        <h4>1</h4>
                    </td>
                </tr>
            </tbody>
        </table>
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