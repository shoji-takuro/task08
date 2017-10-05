<?php

//1.GETでidを取得
$id = $_GET["id"];
$league = $_GET["league"];//リーグ判別

//2.DB接続など
try {
  $pdo = new PDO('mysql:dbname=pro_bb;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ登録SQL作成
if($league == "central"){
    $stmt = $pdo->prepare("SELECT * FROM central_league WHERE id=:id");
} else {
    $stmt = $pdo->prepare("SELECT * FROM pacific_league WHERE id=:id");
}
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
  $row = $stmt->fetch();
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
    <div class="navbar-header"><a class="navbar-brand" href="select.php">順位予想一覧</a></div>
      </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form name="teamRank" method="post" action="update.php">
  <div class="jumbotron">
    <fieldset>
      <legend>順位予想変更</legend>
        <!-- 解説者 -->
        <label>解説者名：<input type="text" name="commentator" value="<?= $row["commentator"] ?>"></label><br>
        <!-- 掲載・放送日 -->
        <label>掲載・放送日：<input type="date" name="date" value="<?= $row["indate"] ?>"></label><br>
        <!-- 出所 -->
        <label>出所：<input type="text" name="source" value="<?= $row["source"] ?>"></label><br>
        <!-- リーグを選択 -->
        <label for="lea">予想するリーグ：</label>
        <select id="lea" name = "selectLeague" onChange="changeForm()">
          <option value = "central" id="central">セ・リーグ</option>
          <option value = "pacific" id="pacific">パ・リーグ</option>
        </select><br>
        <!-- 1位（リーグ選択の項目によって変化）-->
        <label for="one">優勝</label>
        <select id="one" name = "first"></select>
        <!-- 2位（リーグ選択の項目によって変化）-->
        <label for="two">2位</label>
        <select id="two" name = "second"></select>
        <!-- 3位（リーグ選択の項目によって変化）-->
        <label for="three">3位</label>
        <select id="three" name = "third"></select>
        <!-- 4位（リーグ選択の項目によって変化）-->
        <label for="four">4位</label>
        <select id="four" name = "fourth"></select>
        <!-- 5位（リーグ選択の項目によって変化）-->
        <label for="five">5位</label>
        <select id="five" name = "fifth"></select>
        <!-- 6位（リーグ選択の項目によって変化）-->
        <label for="six">6位</label>
        <select id="six" name = "sixth"></select>
        <br>
        <!-- 備考 -->
        <label>持論：<br>
        <textarea name="remarks" rows="4" cols="40"><?=$row["remarks"]?></textarea></label><br>
        <input type="hidden" name="id" value="<?= $id ?>">
        <input type="submit" value="送信">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

<script>
$(function(){

var leagueSelected = "<?= $league ?>"; //どちらのリーグの予想を変更するか
    
var first = document.forms.teamRank.first; //セレクトボックス1位
var second = document.forms.teamRank.second; //セレクトボックス2位
var third = document.forms.teamRank.third; //セレクトボックス3位
var fourth = document.forms.teamRank.fourth; //セレクトボックス4位
var fifth = document.forms.teamRank.fifth; //セレクトボックス5位
var sixth = document.forms.teamRank.sixth; //セレクトボックス6位

first.options.length = 0; // 選択肢の数がそれぞれに異なる場合は、これが重要になってくる
second.options.length = 0;
third.options.length = 0;
fourth.options.length = 0;
fifth.options.length = 0;
sixth.options.length = 0;
    
    
//データベースの値をhtmlに反映（リーグ）
if(leagueSelected == "central"){
    //予想しないリーグは隠す
    $("#pacific").css("display","none");
    //セリーグを予想すると反映
    $("#lea").val("central");
    
    //項目変更 1位
    first.options[0] = new Option("広島","広島");
    first.options[1] = new Option("巨人","巨人");
    first.options[2] = new Option("DeNA","DeNA");
    first.options[3] = new Option("阪神","阪神");
    first.options[4] = new Option("ヤクルト","ヤクルト");
    first.options[5] = new Option("中日","中日");

    //項目変更 2位
    second.options[0] = new Option("広島","広島");
    second.options[1] = new Option("巨人","巨人");
    second.options[2] = new Option("DeNA","DeNA");
    second.options[3] = new Option("阪神","阪神");
    second.options[4] = new Option("ヤクルト","ヤクルト");
    second.options[5] = new Option("中日","中日");

    //項目変更 3位
    third.options[0] = new Option("広島","広島");
    third.options[1] = new Option("巨人","巨人");
    third.options[2] = new Option("DeNA","DeNA");
    third.options[3] = new Option("阪神","阪神");
    third.options[4] = new Option("ヤクルト","ヤクルト");
    third.options[5] = new Option("中日","中日");

    //項目変更 4位
    fourth.options[0] = new Option("広島","広島");
    fourth.options[1] = new Option("巨人","巨人");
    fourth.options[2] = new Option("DeNA","DeNA");
    fourth.options[3] = new Option("阪神","阪神");
    fourth.options[4] = new Option("ヤクルト","ヤクルト");
    fourth.options[5] = new Option("中日","中日");

    //項目変更 5位
    fifth.options[0] = new Option("広島","広島");
    fifth.options[1] = new Option("巨人","巨人");
    fifth.options[2] = new Option("DeNA","DeNA");
    fifth.options[3] = new Option("阪神","阪神");
    fifth.options[4] = new Option("ヤクルト","ヤクルト");
    fifth.options[5] = new Option("中日","中日");

    //項目変更 6位
    sixth.options[0] = new Option("広島","広島");
    sixth.options[1] = new Option("巨人","巨人");
    sixth.options[2] = new Option("DeNA","DeNA");
    sixth.options[3] = new Option("阪神","阪神");
    sixth.options[4] = new Option("ヤクルト","ヤクルト");
    sixth.options[5] = new Option("中日","中日");

} else {
    //予想しないリーグは隠す
    $("#central").css("display","none");
    //パリーグを予想すると反映
    $("#lea").val("pacific");
    
    //項目変更 1位
    first.options[0] = new Option("日ハム","日ハム");
    first.options[1] = new Option("ソフトバンク","ソフトバンク");
    first.options[2] = new Option("ロッテ","ロッテ");
    first.options[3] = new Option("西武","西武");
    first.options[4] = new Option("楽天","楽天");
    first.options[5] = new Option("オリックス","オリックス");

    //項目変更 2位
    second.options[0] = new Option("日ハム","日ハム");
    second.options[1] = new Option("ソフトバンク","ソフトバンク");
    second.options[2] = new Option("ロッテ","ロッテ");
    second.options[3] = new Option("西武","西武");
    second.options[4] = new Option("楽天","楽天");
    second.options[5] = new Option("オリックス","オリックス");

    //項目変更 3位
    third.options[0] = new Option("日ハム","日ハム");
    third.options[1] = new Option("ソフトバンク","ソフトバンク");
    third.options[2] = new Option("ロッテ","ロッテ");
    third.options[3] = new Option("西武","西武");
    third.options[4] = new Option("楽天","楽天");
    third.options[5] = new Option("オリックス","オリックス");

    //項目変更 4位
    fourth.options[0] = new Option("日ハム","日ハム");
    fourth.options[1] = new Option("ソフトバンク","ソフトバンク");
    fourth.options[2] = new Option("ロッテ","ロッテ");
    fourth.options[3] = new Option("西武","西武");
    fourth.options[4] = new Option("楽天","楽天");
    fourth.options[5] = new Option("オリックス","オリックス");

    //項目変更 5位
    fifth.options[0] = new Option("日ハム","日ハム");
    fifth.options[1] = new Option("ソフトバンク","ソフトバンク");
    fifth.options[2] = new Option("ロッテ","ロッテ");
    fifth.options[3] = new Option("西武","西武");
    fifth.options[4] = new Option("楽天","楽天");
    fifth.options[5] = new Option("オリックス","オリックス");

    //項目変更 6位
    sixth.options[0] = new Option("日ハム","日ハム");
    sixth.options[1] = new Option("ソフトバンク","ソフトバンク");
    sixth.options[2] = new Option("ロッテ","ロッテ");
    sixth.options[3] = new Option("西武","西武");
    sixth.options[4] = new Option("楽天","楽天");
    sixth.options[5] = new Option("オリックス","オリックス");
}
    
//データベースの値をhtmlに反映（順位）
var firstVal = "<?= $row["first"] ?>";
var secondVal = "<?= $row["second"] ?>";
var thirdVal = "<?= $row["third"] ?>";
var fourthVal = "<?= $row["fourth"] ?>";
var fifthVal = "<?= $row["fifth"] ?>";
var sixthVal = "<?= $row["sixth"] ?>";
$("#one").val(firstVal);
$("#two").val(secondVal);
$("#three").val(thirdVal);
$("#four").val(fourthVal);
$("#five").val(fifthVal);
$("#six").val(sixthVal);

});

</script>

</body>
</html>