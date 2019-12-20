<?php session_start(); ?>
<?php require 'header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$name=$email=$view_name=$password='';
if (isset($_SESSION['users'])) {
	$name=$_SESSION['users']['name'];
	$email=$_SESSION['users']['email'];
	$view_name=$_SESSION['users']['view_name'];
	$password=$_SESSION['users']['password'];
}
?>

<form action="user-output.php" method="post">
<div>
    <label for="name">お名前</label>
    <input id="name" type="text" name="name" value="">
</div>
<div>
    <label for="email">メールアドレス</label>
    <input id="email" type="text" name="email" value="">
</div>
<div>
    <label for="view_name">表示名</label>
    <input id="view_name" type="text" name="view_name" value="">
</div>
<div>
    <label for="password">パスワード</label>
    <input id="password" type="password" name="password" value="">
</div>
<input type="submit" value="確定">
</form>

<?php require 'footer.php'; ?>