<script src="js/header_connection.js"></script>

<?php
if (strpos($_SESSION["currentPage"], "calendar.php") !== false) {
    if (isset($_SESSION["userID"])) {
        echo '<script type="text/javascript"> var calendarData = ' . json_encode($calendarData) . ' </script>';
    }
    echo '<script src="js/calendar_infos.js"></script>';
}?>

</body>

</html>