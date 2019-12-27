<?php

require_once(__DIR__ . './config.php');

// 管理者としてログインしているか確認
if(!isset($_SESSION['users'])) {
	// ログインページへリダイレクト
	header("Location: ./login-input.php");
}

if( !empty($_GET['message_id']) && empty($_POST['message_id'])) {
	$message_id = (int)htmlspecialchars($_GET['message_id'], ENT_QUOTES);
	// データベースに接続
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	// 接続エラーの確認
	if( $mysqli->connect_errno ) {
		$error_message[] = 'データベースの接続に失敗しました。 エラー番号 '.$mysqli->connect_errno.' : '.$mysqli->connect_error;
	} else {
	
		// データの読み込み
		$sql = "SELECT * FROM message WHERE id = $message_id";
		$res = $mysqli->query($sql);
		
		if( $res ) {
			$message_data = $res->fetch_assoc();
		} else {
		
			// データが読み込めなかったら一覧に戻る
			header("Location: ./admin.php");
		}
		
		$mysqli->close();
	}
} elseif( !empty($_POST['message_id']) ) {
	$message_id = (int)htmlspecialchars( $_POST['message_id'], ENT_QUOTES);
	
	if( empty($_POST['view_name']) ) {
		$error_message[] = '表示名を入力してください。';
	} else {
		$message_data['view_name'] = htmlspecialchars($_POST['view_name'], ENT_QUOTES);
	}
	
	if( empty($_POST['message']) ) {
		$error_message[] = 'メッセージを入力してください。';
	} else {
		$message_data['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES);
	}
	if( empty($error_message) ) {
	
		// データベースに接続
		$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME);
		
		// 接続エラーの確認
		if( $mysqli->connect_errno ) {
			$error_message[] = 'データベースの接続に失敗しました。 エラー番号 ' . $mysqli->connect_errno . ' : ' . $mysqli->connect_error;
		} else {
			$sql = "UPDATE message SET view_name = '$message_data[view_name]', message= '$message_data[message]' WHERE id =  $message_id";
			$res = $mysqli->query($sql);
		}
		
		$mysqli->close();
		
		// 更新に成功したら一覧に戻る
		if( $res ) {
			header("Location: ./admin.php");
		}
	}
}
?>
<?php if( !empty($error_message) ): ?>
	<ul class="error_message">
		<?php foreach( $error_message as $value ): ?>
			<li>・<?php echo $value; ?></li>
		<?php endforeach; ?>
	</ul>
<?php endif; ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<form method="post">
	<div>
		<label for="view_name">表示名</label>
		<input id="view_name" type="text" name="view_name" value="<?php if( !empty($message_data['view_name']) ){ echo $message_data['view_name']; } ?>">
	</div>
	<div>
		<label for="message">ひと言メッセージ</label>
		<textarea id="message" name="message"><?php if( !empty($message_data['message']) ){ echo $message_data['message']; } ?></textarea>
	</div>
	<a class="btn_cancel" href="admin.php">キャンセル</a>
	<input type="submit" name="btn_submit" value="書き込む">
	<input type="hidden" name="message_id" value="<?php echo $message_data['id']; ?>">
</form>
<?php require 'footer.php'; ?>