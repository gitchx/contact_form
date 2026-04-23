<?php
$app = require __DIR__ . '/bootstrap.php';
$pdo = $app['pdo'];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id = $_POST['id'] ?? null;

    if (!ctype_digit($id)){
        exit('IDが不正です。');
    }


    try {
        $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = :id');
        $stmt->execute([':id' => $id]);
        
        header('Location: contacts.php');
        exit;
    } catch (PDOException $e) {
        error_log("DBエラー: " . $e->getMessage());
        exit('DB接続エラーが発生しました。');
    }
}