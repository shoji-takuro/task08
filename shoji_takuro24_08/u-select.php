<?php
//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=pro_bb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM bb_user_table");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
$view.='<tr>';
        $view.='<td>';
        $view.=$result["id"];
        $view.='</td>';
        $view.='<td>';
        $view.=$result["name"];
        $view.='</td>';
        $view.='<td>';
        $view.=$result["lid"];
        $view.='</td>';
        $view.='<td>';
        $view.=$result["lpw"];
        $view.='</td>';
        $view.='<td class="kanri">';
        $view.=$result["kanri_flg"];
        $view.='</td>';
        $view.='<td class="life">';
        $view.=$result["life_flg"];
        $view.='</td>';
        $view.='<td>';
        $view.='<a href="u-detail.php?id='.$result["id"].'">';
        $view.='[更新]';
        $view.='</a>';
        $view.='</td>';
        $view.='<td>';
        $view.='<a href="u-delete.php?id='.$result["id"].'">';
        $view.='[削除]';
        $view.='</a>';
        $view.='</td>';
        $view.='</tr>';
  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>プロ野球順位予想</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="select.php">順位予想一覧</a>
      <a class="navbar-brand" href="u-register.php">ユーザー登録</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
        <h1>ユーザー一覧</h1>
        <table border="1" bordercolor="#333333">
        <thead>
        <tr>
            <th width="80px">id</th>
            <th width="120px">名前</th>
            <th width="180px">ユーザーID</th>
            <th width="180px">パスワード</th>
            <th width="150px">管理フラグ</th>
            <th width="150px">ライフフラグ</th>
            <th width="60px">更新</th>
            <th width="60px">削除</th>
        </tr>
        </thead>
        <tbody>
        <?= $view ?>
        </tbody>
        </table>
    </div>
</div>
<!-- Main[End] -->

<script>
$(function(){

    
// replace関数による文字列の置換（eachで複数要素・メソッドチェーンで複数文字列）
//管理フラグ
$('.kanri').each(function(){
    var txt = $(this).html();
    $(this).html(
        txt.replace(/0/g,'管理者')
           .replace(/1/g,'スーパー管理者')
    );
});
//ライフフラグ
$('.life').each(function(){
    var txt = $(this).html();
    $(this).html(
        txt.replace(/0/g,'使用中')
           .replace(/1/g,'使用しなくなった')
    );
});

    
    
    
});
</script>
</body>
</html>