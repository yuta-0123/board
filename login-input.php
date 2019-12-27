<?php

require_once(__DIR__ . './config.php');

// データベースに接続
$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME);
// 接続エラーの確認
if( $mysqli->connect_errno ) {
	$error_message[] = 'データの読み込みに失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
} else {
	$sql = "SELECT id,view_name,message,post_date FROM message ORDER BY post_date DESC";
	$res = $mysqli->query($sql);
    if( $res ) {
		$message_array = $res->fetch_all(MYSQLI_ASSOC);
    }
    $mysqli->close();
}
?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<form action="login-output.php" method="post">
<div>
    <label for="email">メールアドレス</label>
    <input id="email" type="text" name="email" value="">
</div>
<div>
    <label for="password">パスワード</label>
    <input id="password" type="password" name="password" value="">
</div>
<input type="submit" value="ログイン">
</form>
<?php require 'footer.php'; ?>
