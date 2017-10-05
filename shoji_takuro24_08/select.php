<?php
//1. db接続
try {
    $pdo = new PDO('mysql:dbname=pro_bb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
    exit('データベースに接続できませんでした。'.$e->getMessage());
}

//2.データ登録SQL作成
//セ・リーグ
$stmt1 = $pdo->prepare("SELECT * FROM central_league");
$status1 = $stmt1->execute();
//パ・リーグ
$stmt2 = $pdo->prepare("SELECT * FROM pacific_league");
$status2 = $stmt2->execute();

//3
//セ・リーグ
$view1 = "";
if($status1==false){
    $error = $stmt1->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    while($result = $stmt1->fetch(PDO::FETCH_ASSOC)){
        $view1.='<tr>';
        $view1.='<td>';
        $view1.=$result["commentator"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["indate"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["source"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["first"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["second"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["third"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["fourth"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["fifth"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["sixth"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.=$result["remarks"];
        $view1.='</td>';
        $view1.='<td>';
        $view1.='<a href="detail.php?id='.$result["id"].'&league=central">';
        $view1.='[更新]';
        $view1.='</a>';
        $view1.='</td>';
        $view1.='<td>';
        $view1.='<a href="delete.php?id='.$result["id"].'&league=central">';
        $view1.='[削除]';
        $view1.='</a>';
        $view1.='</td>';
        $view1.='</tr>';

    }
}

//パ・リーグ
$view2 = "";
if($status2==false){
    $error = $stmt2->errorInfo();
    exit("ErrorQuery:".$error[2]);
} else {
    while($result = $stmt2->fetch(PDO::FETCH_ASSOC)){
        $view2.='<tr>';
        $view2.='<td>';
        $view2.=$result["commentator"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["indate"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["source"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["first"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["second"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["third"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["fourth"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["fifth"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["sixth"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.=$result["remarks"];
        $view2.='</td>';
        $view2.='<td>';
        $view2.='<a href="detail.php?id='.$result["id"].'&league=pacific">';
        $view2.='[更新]';
        $view2.='</a>';
        $view2.='</td>';
        $view2.='<td>';
        $view2.='<a href="delete.php?id='.$result["id"].'&league=pacific">';
        $view2.='[削除]';
        $view2.='</a>';
        $view2.='</td>';
        $view2.='</tr>';

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
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">順位予想を登録</a>
      <a class="navbar-brand" href="u-select.php">ユーザー一覧</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron">
        <h1>セ・リーグ順位予想</h1>
        <table border="1" bordercolor="#333333">
        <thead>
        <tr>
            <th width="120px">解説者</th>
            <th width="120px">掲載・放送日</th>
            <th width="120px">出所</th>
            <th width="80px">優勝</th>
            <th width="80px">2位</th>
            <th width="80px">3位</th>
            <th width="80px">4位</th>
            <th width="80px">5位</th>
            <th width="80px">6位</th>
            <th width="300px">持論</th>
            <th width="60px">更新</th>
            <th width="60px">削除</th>
        </tr>
        </thead>
        <tbody>
        <?= $view1 ?>
        </tbody>

        </table>
        <h1>パ・リーグ順位予想</h1>
        <table border="1" bordercolor="#333333">
        <thead>
        <tr>
            <th width="120px">解説者</th>
            <th width="120px">掲載・放送日</th>
            <th width="120px">出所</th>
            <th width="80px">優勝</th>
            <th width="80px">2位</th>
            <th width="80px">3位</th>
            <th width="80px">4位</th>
            <th width="80px">5位</th>
            <th width="80px">6位</th>
            <th width="300px">持論</th>
            <th width="60px">更新</th>
            <th width="60px">削除</th>
        </tr>
        </thead>
        <tbody>
        <?= $view2 ?>
        </tbody>
        </table>
    </div>
</div>
<!-- Main[End] -->

</body>
</html>
