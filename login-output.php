<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
unset($_SESSION['users']);
$pdo=new PDO('mysql:host=localhost;dbname=sns;charset=utf8', 
	'root', 'password');
$sql=$pdo->prepare('select * from users where email=? and password=?');
$sql->execute([$_REQUEST['email'], $_REQUEST['password']]);
foreach ($sql as $row) {
	$_SESSION['users']=[
		'id'=>$row['id'],  
		'email'=>$row['email'], 'view_name'=>$row['view_name'], 
		'password'=>$row['password']];
}
if (isset($_SESSION['users'])) {
	echo 'ログインが完了しました';
} else {
	echo 'ログイン名またはパスワードが違います。';
}
?>
<?php require 'footer.php' ; ?>
