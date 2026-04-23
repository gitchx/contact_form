<?php
$app = require __DIR__ . '/bootstrap.php';
$pdo = $app['pdo'];

try {
    $stmt = $pdo->prepare('SELECT id, name, email, message FROM contacts');
    $stmt->execute();
    $contacts = $stmt->fetchAll();

} catch (PDOException $e) {
    error_log("DBエラー: " . $e->getMessage());
    exit('DB接続エラーが発生しました。');
}
?>

<?php if (empty($contacts)): ?>
    <p>お問い合わせ内容はまだありません。</p>
<?php else: ?>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>お名前</th>
            <th>メールアドレス</th>
            <th>お問い合わせ内容</th>
            <th>操作</th>
        </tr>
        <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?= htmlspecialchars($contact['id'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($contact['name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($contact['email'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><?= htmlspecialchars($contact['message'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><a href="edit.php?id=<?= htmlspecialchars($contact['id'], ENT_QUOTES, 'UTF-8') ?>">編集</a></td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>