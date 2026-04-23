# Contact Form (PHP + PostgreSQL)

PHP（PDO）とPostgreSQLを使用して作成したお問い合わせフォームです。  
CRUD（登録・一覧表示・編集・更新）機能を実装しています。

---

## 機能

- お問い合わせ内容の登録（CREATE）
- 一覧表示（READ）
- 編集・更新（UPDATE）
- （※削除機能は未実装 or 実装予定）

---

## 使用技術

- PHP（PDO）
- PostgreSQL
- HTML

---

## ディレクトリ構成

contact_form/
├── contacts.php # 一覧表示
├── create.php # 登録処理
├── edit.php # 編集・更新
├── db.php # DB接続
├── .env # 環境変数（※Git管理外）

---

## セットアップ

1. PostgreSQLでデータベースを作成

2. テーブル作成

```sql
CREATE TABLE contacts (
    id SERIAL PRIMARY KEY,
    name TEXT,
    email TEXT,
    message TEXT
);
```

### .env を作成

DB_HOST=localhost
DB_PORT=5432
DB_NAME=contact_form
DB_USER=your_user
DB_PASS=your_password

### PHPで起動

php -S localhost:8000
学んだこと
PDOを使ったデータベース操作
fetch() と fetchAll() の違い
プレースホルダによるSQLインジェクション対策
CRUDの基本構造（Create / Read / Update）
PHPとHTMLの連携

## 今後の改善

削除機能（DELETE）の実装
バリデーション強化
UI改善（CSS）
MVC構造への分離

## 備考

このプロジェクトは学習目的で作成しています。
