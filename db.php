<?php
$env = parse_ini_file(__DIR__ . '/.env');

$dsn = "pgsql:host={$env['DB_HOST']};port={$env['DB_PORT']};dbname={$env['DB_NAME']}";
$user = $env['DB_USER'];
$pass = $env['DB_PASS'];

try{
    $pdo = new PDO($dsn, $user, $pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
    //echo "Connected to the database successfully!";
} catch(PDOException $e){
    echo "Failed to connect to the database: " . $e->getMessage();
}
