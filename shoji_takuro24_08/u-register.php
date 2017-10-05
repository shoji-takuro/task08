<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>プロ野球順位予想</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="u-select.php">ユーザー一覧</a></div>
      </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="post" action="u-insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>ユーザーID(半角英数字のみ)：<input type="text" name="lid" pattern="^[0-9A-Za-z]+$"></label><br>
     <label>パスワード(半角英数字のみ)：<input type="password" name="lpw" pattern="^[0-9A-Za-z]+$"></label><br>
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
