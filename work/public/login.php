<?php

require_once(__DIR__ . '/../app/config.php');

$validate = [];
$err = [];

// ログインバリデーション
$err = ValidateForm::setForm($_POST);
// エラーカウント
if (count($err) > 0) {
  $_SESSION = $err;
  header('Location: login_form.php');
  return;
}
$validate = ValidateForm::setLogin($_POST);
$userid = $validate['userid'];
$password = $validate['password'];
// ログイン成功処理
$result = UserLogic::Login($userid, $password);

// ログイン失敗処理
if (!$result) {
  header('Location: login_form.php');
  return;
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="Refresh" content="3; url=http://localhost:8560/mypage.php">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login completed</title>
</head>
<body>
  <main>
    <?php if (count($err) > 0) : ?>
      <?php foreach ($err as $e) : ?>
        <p><?= Utils::h($e); ?></p>
      <?php endforeach; ?>
    <?php else : ?>
      <p>Login completed!</p>
    <?php endif; ?>
    <a href="mypage.php">MyPage</a>
  </main>
</body>
</html>