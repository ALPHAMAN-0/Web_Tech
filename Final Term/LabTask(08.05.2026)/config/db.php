<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'library_db');

function getConnection() {
    $conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if (!$conn) {
        echo json_encode([
            "success" => false,
            "message" => "Connection failed: " . mysqli_connect_error()
        ]);
        exit;
    }

    return $conn;
}
