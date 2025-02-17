<?php

$host = "db"; // e.g., "localhost" or "mysql" (if using Docker)
$dbname = "db";
$username = "root";
$password = "root";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    echo "✅ Connected to MySQL successfully!";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}