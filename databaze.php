<?php
$host = '192.168.33.234'; 
$db   = 'student';
$user = 'student';
$pass = 'student';

try {
    $dsn = "pgsql:host=$host;port=5432;dbname=$db";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);

} catch (PDOException $e) {
    die("Kruci, chyba databáze: " . $e->getMessage());
}
?>