<?php
header('Content-Type: application/json');

$conn = new mysqli(
    "sql304.infinityfree.com",   // DB host
    "if0_40079571",              // DB user
    "fkefnBs6rO",                // DB password
    "if0_40079571_ionox"         // DB name
);

if ($conn->connect_error) {
    echo json_encode([
        "status" => "error",
        "message" => "Database connection failed"
    ]);
    exit;
}

$conn->set_charset("utf8mb4");
