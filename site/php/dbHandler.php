<?php

$conn = "";

function connect()
{
    global $conn;
    $server = "localhost";
    $username = "root";
    $password = "Julien_SqlDEV";
    $database = "flvf_dev";

    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error);
    }
}

function disconnect()
{
    global $conn;
    mysqli_close($conn);
}

function executeSafeSQL($query){
    global $conn;
    connect();
    $data = mysqli_query($conn, $query);
    disconnect();
    return $data;
}

function executeSQL($query, $types, ...$params)
{
    global $conn;
    connect();

    $pageToLoad = isset($_SESSION["currentPage"]) ? $_SESSION["currentPage"] : "/index.php";

    $statement = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($statement, $query)) {
        disconnect();
        header("Location: " . $pageToLoad . "?err=sql");
        exit();
    } else {
        mysqli_stmt_bind_param($statement, $types, ...$params);
        mysqli_stmt_execute($statement);
        $data = mysqli_stmt_get_result($statement);
    }

    mysqli_stmt_close($statement);
    disconnect();

    return $data;
}