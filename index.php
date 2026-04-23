<?php include __DIR__ . '/header.php'; ?>

<body>
    <h1>お問い合わせフォーム</h1>
    <form action="create.php" method="post">
        <div>
            <label for="name">お名前:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div>
            <label for="email">メールアドレス:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div>
            <label for="message">お問い合わせ内容:</label>
            <textarea id="message" name="message" required></textarea>
        </div>
        <button type="submit">送信</button>
    </form>
</body>
</html>
