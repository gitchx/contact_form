<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($name === '' || $email === '' || $message === ''){
        exit('未入力の項目があります。すべての項目を入力してください。');
    }
    try {
    $stmt = $pdo->prepare('INSERT INTO contacts(name, email, message) VALUES (:name, :email, :message)');

    $stmt->execute([
        ':name' => $name,
        ':email' => $email,
        ':message' => $message
    ]);

    echo "お問い合わせ内容を送信しました。";
    } catch (PDOException $e) {
        echo "DBエラー: ".$e->getMessage();
    }
}
