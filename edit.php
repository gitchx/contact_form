<?php
$app = require __DIR__ . '/bootstrap.php';
$pdo = $app['pdo'];

if ($_SERVER['REQUEST_METHOD'] === 'GET'){

    $id = $_GET['id'] ?? null;

    if ($id === null){
        exit('IDが指定されていません。');
    }

    try {
        $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $contact = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        exit('DBエラー: ' . $e->getMessage());
    }

    if (!$contact){
        exit('お問い合わせ内容が見つかりませんでした。');
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    $id = $_POST['id'] ?? null;
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $message = trim($_POST['message'] ?? '');

    if ($id === null|| $name === '' || $email === '' || $message === ''){
        exit('未入力の項目があります。すべての項目を入力してください。');
    }



    try {

    $stmt = $pdo->prepare('UPDATE contacts SET name = :name, email = :email, message = :message WHERE id = :id');

    $stmt->execute([
        ':id' => $id,
        ':name' => $name,
        ':email' => $email,
        ':message' => $message
    ]);

    header('Location: contacts.php');
    exit;
    
    } catch (PDOException $e) {
        echo "DBエラー: ".$e->getMessage();
    }

}

?>

<form method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($contact['id'], ENT_QUOTES, 'UTF-8') ?>">

    <input type="text" name="name" value="<?= htmlspecialchars($contact['name'], ENT_QUOTES, 'UTF-8') ?>" required>
    <input type="email" name="email" value="<?= htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8') ?>" required>
    <textarea name="message" required><?= htmlspecialchars($contact['message'], ENT_QUOTES, 'UTF-8') ?></textarea>

    <button type="submit">更新</button>
</form>
