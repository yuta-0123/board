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
