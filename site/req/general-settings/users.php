<?php

require "php/dbHandler.php";

$query = 'SELECT id, CONCAT(firstname, " ", lastname) AS fullname, email, isActive
            FROM users
            ORDER BY firstname ASC, lastname ASC';
$userTable = executeSafeSQL($query);

$userData = null;
while (($userData = mysqli_fetch_assoc($userTable)) != null) {
    printUserToTable($userData);
}

function printUserToTable($userData)
{
    echo '<tr">
            <td>' . $userData["fullname"] . '</td>
            <td>' . $userData["email"] . '</td>
            <td><input class="activeCheckbox" type="checkbox" name="userCheck[]" value="' . $userData["id"] . '" ' . ($userData["isActive"] ? "checked" : "") . '></td>
        </tr>';
}