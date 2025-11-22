<?php

// Allow overriding connection settings with environment variables when running in Docker
$host = getenv('DB_HOST') ?: 'localhost'; // default for local/XAMPP
$db = getenv('DB_NAME') ?: 'attendance_db';
$user = getenv('DB_USER') ?: 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try {
    $pdo = new PDO($dsn, $user, $pass);

    if (isset($DEBUG) && $DEBUG) {
        echo 'Database connection successful.';
    }

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($DEBUG) && $DEBUG) {
        echo 'setAttribute called on the database connection object.';
    }
} catch (PDOException $e) {
    echo "<h1 class='text-danger'>Database connection failed.</h1>";

    if (isset($DEBUG) && $DEBUG) {
        echo "<pre>$e</pre>";
    }

    throw new PDOException($e->getMessage());
}

require_once 'crud.php';
require_once "user.php";

$crud = new Crud($pdo);
$user = new User($pdo);

$user->insertUser("admin", "password"); // Create admin user

if (isset($DEBUG) && $DEBUG) {
    echo "<h1 class='text-center text-success'>crud object given the pdo object</h1>";
}
