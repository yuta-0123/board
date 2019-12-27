<p class="login_name"><?php print(htmlspecialchars($_SESSION['users']['view_name'],ENT_QUOTES));?>さん ログイン中</p>
<div class="menu">
    <a href="index.php">掲示板</a>
    <a href="post.php">投稿</a>
    <a href="admin.php">マイページ</a>
    <a href="login-input.php">ログイン</a>
    <a href="logout-input.php">ログアウト</a>
    <a href="user-input.php">会員登録</a>
</div>
<hr>
