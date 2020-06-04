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

    <button id="right"><i class="fas fa-caret-right"></i></button>
</main>

<?php
require "req/footer.php";
?>