<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$pdo=new PDO('mysql:host=localhost;dbname=sns;charset=utf8', 
	'root', 'password');
if (isset($_SESSION['users'])) {
	$id=$_SESSION['users']['id'];
	$sql=$pdo->prepare('select * from users where id!=? and view_name=?');
	$sql->execute([$id, $_REQUEST['view_name']]);
} else {
	$sql=$pdo->prepare('select * from users where view_name=?');
	$sql->execute([$_REQUEST['view_name']]);
}
if (empty($sql->fetchAll())) {
	if (isset($_SESSION['users'])) {
		$sql=$pdo->prepare('update users set name=?, email=?, '.
			'view_name=?, password=? where id=?');
		$sql->execute([
			$_REQUEST['name'], $_REQUEST['email'], 
			$_REQUEST['view_name'], $_REQUEST['password'], $id]);
		$_SESSION['users']=[
			'id'=>$id, 'name'=>$_REQUEST['name'], 
			'email'=>$_REQUEST['email'], 'view_name'=>$_REQUEST['view_name'], 
			'password'=>$_REQUEST['password']];
		echo 'お客様情報を更新しました。';
	} else {
		$sql=$pdo->prepare('insert into users values(null,?,?,?,?)');
		$sql->execute([
			$_REQUEST['name'], $_REQUEST['email'], 
			$_REQUEST['view_name'], $_REQUEST['password']]);
		echo 'お客様情報を登録しました。';
	}
} else {
	echo 'ログイン名がすでに使用されていますので、変更してください。';
}
?>
<?php require 'footer.php'; ?>
