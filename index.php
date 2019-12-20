<?php
// データベースの接続情報
define( 'DB_HOST', 'localhost');
define( 'DB_USER', 'root');
define( 'DB_PASS', 'password');
define( 'DB_NAME', 'sns');
// タイムゾーン設定
date_default_timezone_set('Asia/Tokyo');
// 変数の初期化
$now_date = null;
$data = null;
$file_handle = null;
$split_data = null;
$message = array();
$message_array = array();
$success_message = null;
$error_message = array();
$clean = array();
session_start();
if( !empty($_POST['btn_submit']) ) {
}
// データベースに接続
$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME);
// 接続エラーの確認
if( $mysqli->connect_errno ) {
	$error_message[] = 'データの読み込みに失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
} else {
	$sql = "SELECT view_name,message,post_date FROM message ORDER BY post_date DESC";
	$res = $mysqli->query($sql);
    if( $res ) {
		$message_array = $res->fetch_all(MYSQLI_ASSOC);
    }
    $mysqli->close();
}
?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
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
    </div>
    <p><?php echo $value['message']; ?></p>
</article>
<?php } ?>
<?php } ?>
</section>
<?php require 'footer.php'; ?>