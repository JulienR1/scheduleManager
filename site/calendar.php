<?php
require "req/header.php";
?>

<main>
    <button id="left"><i class="fas fa-caret-left"></i></button>

    <section id="calendar">
        <h3>
            <!-- TODO: Month selector -->
            <button id="month">Novembre</button>
            <?php require "req/header-toggle.php"?>
        </h3>
        <div id="container">
            <table>
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
                    <td>
                        <h4>30</h4>
                    </td>
                    <td>
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
            </table>
        </div>
    </section>

    <button id="right"><i class="fas fa-caret-right"></i></button>
</main>

<?php
require "req/footer.php";
?>