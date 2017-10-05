<?php
//GETでidを取得
$id = $_GET["id"];
$league = $_GET["league"];//リーグ判別




//1.  DB接続します
try {
  $pdo = new PDO('mysql:dbname=pro_bb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ削除SQL作成

if($league == "central"){
    $stmt = $pdo->prepare("DELETE FROM central_league WHERE id=:id");
} else {
    $stmt = $pdo->prepare("DELETE FROM pacific_league WHERE id=:id");
}
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("QueryError:".$error[2]);
}else{
  //５．index.phpへリダイレクト
  header("Location: select.php");
  exit;
}

?>