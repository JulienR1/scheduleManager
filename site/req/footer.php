<script src="js/header_connection.js"></script>

<?php
if (strpos($_SESSION["currentPage"], "calendar") !== false) {
    echo '<script type="text/javascript"> var calendarData = ' . json_encode($calendarData) . ' </script>';
    echo '<script src="js/calendar_infos.js"></script>';
}?>

</body>

</html>