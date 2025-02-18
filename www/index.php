<?php


// Prepend a base path if Predis is not available in your "include_path".
require 'vendor/autoload.php';


$host = "database"; // e.g., "localhost" or "mysql" (if using Docker)
$dbname = "app";
$username = "user";
$password = "password";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    echo "✅ Connected to MySQL successfully!";
} catch (PDOException $e) {
    die("❌ Connection failed: " . $e->getMessage());
}

//
$client = new Predis\Client('tcp://redis:6379');

try {
    $client->ping();
    echo   "<br/> ✅ Connected to Redis successfully!";

    // Executes a pipeline inside the given callable block:
    $responses = $client->pipeline(function ($pipe) {
        for ($i = 0; $i < 1000; $i++) {
            $pipe->set("key:$i", str_pad($i, 4, '0', 0));
            $pipe->get("key:$i");
        }
    });



} catch (Exception $e) {
    die($e->getMessage());
}