<?php

require_once(__DIR__ . './config.php');

if( !empty($_SESSION['message']) === true ) {
	// 出力の設定
	header("Content-Type: application/octet-stream");
	header("Content-Disposition: attachment; filename=メッセージデータ.csv");
	header("Content-Transfer-Encoding: binary");
	// データベースに接続
	$mysqli = new mysqli( DB_HOST, DB_USER, DB_PASS, DB_NAME);
	
	// 接続エラーの確認
	if( !$mysqli->connect_errno ) {
		$sql = "SELECT * FROM message ORDER BY post_date ASC";
		$res = $mysqli->query($sql);
		if( $res ) {
			$message_array = $res->fetch_all(MYSQLI_ASSOC);
		}
		$mysqli->close();
	}
	// CSVデータを作成
	if( !empty($message_array) ) {
		
		// 1行目のラベル作成
		$csv_data .= '"ID","表示名","メッセージ","投稿日時"'."\n";
		
		foreach( $message_array as $value ) {
		
			// データを1行ずつCSVファイルに書き込む
			$csv_data .= '"' . $value['id'] . '","' . $value['view_name'] . '","' . $value['message'] . '","' . $value['post_date'] . "\"\n";
		}
	}
	// ファイルを出力	
	echo $csv_data;
} else {
	// ログインページへリダイレクト
	header("Location: ./admin.php");
}
return;