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

<?php if (isset($_SESSION['users'])): ?>

<?php if( !empty($error_message) ): ?>
	<ul class="error_message">
		<?php foreach( $error_message as $value ): ?>
			<li>・<?php echo $value; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
<section>

<?php if( !empty($message_array) ){ ?>
<?php foreach( $message_array as $value ){ ?>
<article>
	<div class="info">
		<h2><?php echo $value['view_name']; ?></h2>
		<time><?php echo date('Y年m月d日 H:i', strtotime($value['post_date'])); ?></time>
		<p><a href="edit.php?message_id=<?php echo $value['id']; ?>">編集</a>&nbsp;&nbsp;<a href="delete.php?message_id=<?php echo $value['id']; ?>">削除</a></p>
	</div>
	<p><?php echo nl2br($value['message']); ?></p>
</article>
<?php } ?>
<?php } ?>

<?php else: ?>
	<p>ログインしてください。</p>
<?php endif; ?>
</section>
<?php require 'footer.php'; ?>