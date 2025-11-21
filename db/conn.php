<?php

// Allow overriding connection settings with environment variables when running in Docker
$host = getenv('DB_HOST') ?: 'localhost'; // default for local/XAMPP
$db = getenv('DB_NAME') ?: 'attendance_db';
$user = getenv('DB_USER') ?: 'root';
$pass = '';
$charset = 'utf8mb4';

// Support Docker secrets: PASSWORD_FILE_PATH or MYSQL_PASSWORD_FILE (compose sets these)
$passwordFile = getenv('PASSWORD_FILE_PATH') ?: getenv('MYSQL_PASSWORD_FILE') ?: null;
if ($passwordFile && file_exists($passwordFile)) {
    $pass = trim(file_get_contents($passwordFile));
} elseif (getenv('DB_PASSWORD')) {
    $pass = getenv('DB_PASSWORD');
}

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
$crud = new Crud($pdo);
if (isset($DEBUG) && $DEBUG) {
    echo "<h1 class='text-center text-success'>crud object given the pdo object</h1>";
}
