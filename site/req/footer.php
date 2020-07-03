<script src="js/header_connection.js"></script>

<?php
if (strpos($_SESSION["currentPage"], "calendar.php") !== false) {
    if (isset($_SESSION["userID"])) {
        echo '<script type="text/javascript"> var calendarData = ' . json_encode($calendarData) . ' </script>';
    }
    echo '<script src="js/calendar_infos.js"></script>';
} else if (strpos($_SESSION["currentPage"], "calendar-setup.php") != false) {
    echo '<script src="js/calendar_setup/calendar_setup.js"></script>';
    echo '<script src="js/calendar_setup/calendar_setup_events.js"></script>';
    echo '<script src="js/format.js"></script>';

    require "req/userTaskData.php";
    require "req/savedWeekData.php";
}
?>

</body>

</html>