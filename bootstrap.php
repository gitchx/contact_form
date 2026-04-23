<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

$required = ['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASS'];
foreach ($required as $key) {
    if (empty($_ENV[$key])) {
        exit("環境変数{$key}が設定されていません");
    }
}

$config = require __DIR__ . '/config.php';

$dsn = "pgsql:host={$config['db']['host']};port={$config['db']['port']};dbname={$config['db']['name']}";
$user = $config['db']['user'];
$pass = $config['db']['pass'];

try{
    $pdo = new PDO($dsn, $user, $pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
    //echo "Connected to the database successfully!";
} catch(PDOException $e) {
    exit('DB接続エラー: ' . $e->getMessage());
}

return [
    'pdo' => $pdo,
    'config' => $config
];