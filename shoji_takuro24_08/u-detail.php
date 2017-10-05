<?php

//1.GETでidを取得
$id = $_GET["id"];

//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=pro_bb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM bb_user_table WHERE id=:id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  $row = $stmt->fetch(); //$row["name"]
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>プロ野球順位予想</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
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
<form method="post" action="u-update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー情報変更</legend>
     <label>名前：<input type="text" name="name" value="<?= $row["name"] ?>"></label><br>
     <label>ユーザーID(半角英数字のみ)：<input type="text" name="lid"  pattern="^[0-9A-Za-z]+$" value="<?= $row["lid"] ?>"></label><br>
     <label>パスワード(半角英数字のみ)：<input type="password" name="lpw"  pattern="^[0-9A-Za-z]+$" value="<?= $row["lpw"] ?>"></label><br>
     <input type="radio" id="kanri0" name="kanri" value="0"><label for="kanri0">管理者</label>
     <input type="radio" id="kanri1" name="kanri" value="1"><label for="kanri1">スーパー管理者</label><br>
     <input type="radio" id="life0" name="life" value="0"><label for="life0">使用中</label>
     <input type="radio" id="life1" name="life" value="1"><label for="life1">スーパー管理者</label><br>
     <input type="hidden" name="id" value="<?= $id ?>">
     <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->
<script>
$(function(){
    //ラジオボタン選択
    $('input[name=kanri]').val(['<?= $row["kanri_flg"]; ?>']);
    $('input[name=life]').val(['<?= $row["life_flg"]; ?>']);
    
});
</script>
</body>
</html>